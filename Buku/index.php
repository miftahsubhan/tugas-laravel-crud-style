<?php include_once("../connect.php"); ?>

<html>
<head>
  <title>Homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Penerit</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pengarang</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <table class="table" width="80%" border="1">
      <tr class="table-danger">
        <th>ISBN</th>
        <th>Judul</th>
        <th>Tahun</th>
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>Katalog</th>
        <th>Stok</th>
        <th>Harga Pinjam</th>
        <th>Aksi</th>
      </tr>
      <?php 
        $buku = mysqli_query($connect, "SELECT buku.*, nama_pengarang, nama_penerbit, katalog.nama as nama_katalog FROM buku 
                                        LEFT JOIN  pengarang ON pengarang.id_pengarang = buku.id_pengarang
                                        LEFT JOIN  penerbit ON penerbit.id_penerbit = buku.id_penerbit
                                        LEFT JOIN  katalog ON katalog.id_katalog = buku.id_katalog
                                        ORDER BY judul ASC");
      ?>
      <?php while ($buku_data = mysqli_fetch_array($buku)) { ?>
      <tr>
        <td><?php echo $buku_data['isbn'] ?></td>
        <td><?php echo $buku_data['judul'] ?></td>
        <td><?php echo $buku_data['tahun'] ?></td>
        <td><?php echo $buku_data['nama_pengarang'] ?></td>
        <td><?php echo $buku_data['nama_penerbit'] ?></td>
        <td><?php echo $buku_data['nama_katalog'] ?></td>
        <td><?php echo $buku_data['qty_stok'] ?></td>
        <td><?php echo $buku_data['harga_pinjam'] ?></td>
        <td>
          <!-- trigger modal -->
          <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update-<?php echo $buku_data['isbn'] ?>">Edit</a> | <a class="btn btn-danger" href="delete.php?isbn=<?php echo $buku_data['isbn']?>">Delete</a>          
          <!-- Modal Edit -->
          <div class="modal fade" id="update-<?php echo $buku_data['isbn'] ?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Book</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="edit.php?isbn=<?php echo $buku_data['isbn'] ?>" method="post">
                  <div class="modal-body">
                    <table class="col-auto" width="25%" border="0">
                      <tr>
                        <td>ISBN</td>
                        <td><input type="text" name="isbn" value="<?php echo $buku_data['isbn']?>"></td>
                      </tr>
                      <tr>
                        <td>Judul</td>
                        <td><input type="text" name="judul" value="<?php echo $buku_data['tahun']?>"></td>
                      </tr>
                      <tr>
                        <td>Tahun</td>
                        <td><input type="text" name="tahun" value="<?php echo $buku_data['tahun']?>"></td>
                      </tr>
                      <tr>
                        <td>Penerbit</td>
                        <td>
                          <select name="id_penerbit">
                          <?php $penerbit_edit = mysqli_query($connect, "SELECT * FROM penerbit") ?>
                          <?php while ($edit_penerbit_data = mysqli_fetch_array($penerbit_edit)) { ?>
                            <option value="<?php echo $edit_penerbit_data['id_penerbit'] ?>">
                            <?php echo $edit_penerbit_data['nama_penerbit'] ?>
                            </option>
                          <?php } ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Pengarang</td>
                        <td>
                          <select name="id_pengarang">
                            <?php $pengarang_edit = mysqli_query($connect, "SELECT * FROM Pengarang") ?>
                            <?php while ($edit_pengarang_data = mysqli_fetch_array($pengarang_edit)) { ?>
                             <option value="<?php echo $edit_pengarang_data['id_pengarang'] ?>">
                              <?php echo $edit_pengarang_data['nama_pengarang'] ?>
                             </option>
                            <?php } ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Katalog</td>
                        <td>
                          <select name="id_katalog">
                            <?php $katalog_edit = mysqli_query($connect, "SELECT * FROM Katalog") ?>
                            <?php while ($edit_katalog_data = mysqli_fetch_array($katalog_edit)) { ?>
                              <option value="<?php echo $edit_katalog_data['id_katalog']; ?>">
                                <?php echo $edit_katalog_data['nama']; ?>
                              </option>
                            <?php } ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Qty Stok</td>
                        <td><input type="text" name="qty_stok" value="<?php echo $buku_data['qty_stok']?>"></td>
                      </tr>
                      <tr>
                        <td>Harga Pinjam</td>
                        <td><input type="text" name="harga_pinjam" value="<?php echo $buku_data['harga_pinjam']?>"></td>
                      </tr>
                      <tr>
                    </table>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div> 
        </td>
      </tr>
    <?php } ?>
    </table>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
      Add New
    </button>
  </div>

  <!-- Modal Add -->
  <?php
    $penerbit = mysqli_query($connect, "SELECT * FROM penerbit");
    $pengarang = mysqli_query($connect, "SELECT * FROM pengarang");
    $katalog = mysqli_query($connect, "SELECT * FROM katalog");
  ?>

  <div class="modal fade" id="tambah" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Book</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="../Buku/add.php" method="post">
          <div class="modal-body">
            <table class="col-auto" width="25%" border="0">
              <tr>
                <td>ISBN</td>
                <td><input type="text" name="isbn"></td>
              </tr>
              <tr>
                <td>Judul</td>
                <td><input type="text" name="judul"></td>
              </tr>
              <tr>
                <td>Tahun</td>
                <td><input type="text" name="tahun"></td>
              </tr>
              <tr>
                <td>Penerbit</td>
                <td>
                  <select name="id_penerbit">
                  <?php while ($penerbit_data = mysqli_fetch_array($penerbit)) { ?>
                    <option value="<?php echo $penerbit_data['id_penerbit'] ?>">
                    <?php echo $penerbit_data['nama_penerbit'] ?>
                    </option>
                  <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Pengarang</td>
                <td>
                  <select name="id_pengarang">
                    <?php while ($pengarang_data = mysqli_fetch_array($pengarang)) { ?>
                    <option value="<?php echo $pengarang_data['id_pengarang'] ?>">
                      <?php echo $pengarang_data['nama_pengarang'] ?>
                    </option>
                    <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Katalog</td>
                <td>
                  <select name="id_katalog">
                    <?php while ($katalog_data = mysqli_fetch_array($katalog)) { ?>
                      <option value="<?php echo $katalog_data['id_katalog']; ?>">
                        <?php echo $katalog_data['nama']; ?>
                    </option>
                    <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Qty Stok</td>
                <td><input type="text" name="qty_stok"></td>
              </tr>
              <tr>
                <td>Harga Pinjam</td>
                <td><input type="text" name="harga_pinjam"></td>
              </tr>
              <tr>
            </table>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
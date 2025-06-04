<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1">
  <title>Dapur Mamak'e</title>

  <?php
$host = "localhost";    // biasanya localhost
$user = "root";         // username database, default: root
$pass = "";             // password database (default kosong jika di XAMPP)
$db   = "db_resep";        // nama database kamu

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
include 'koneksi.php';
?>



  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="theme/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="theme/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="theme/plugins/summernote/summernote-bs4.min.css">
  <style>
    
    </style>
</head>
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
      <img src="theme/dist/img/aneka-cinema.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Aneka Cinema</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="theme/dist/img/apps.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index-admin.php" class="d-block">Dashboard Admin</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <!-- <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
    </div> -->
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><strong>Dapur Mamak'e</strong></h1>
          </div><!-- /.col -->
          <div class="col-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"></li>
              
            </ol>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
     <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $resep = $_POST['resep'];
    $kategori = $_POST['kategori'];

    // Upload thumbnail
    $thumbnail_name = $_FILES['thumbnail']['name'];
    $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
    $upload_path = "uploads/" . $thumbnail_name;

    if (move_uploaded_file($thumbnail_tmp, $upload_path)) {
        $sql = "INSERT INTO resep (nama, resep, kategori, thumbnail) 
                VALUES ('$nama', '$resep', '$kategori', '$upload_path')";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
        } else {
            echo "<div class='alert alert-danger'>Gagal simpan data: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Gagal upload gambar.</div>";
    }
}
?>

    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Resep</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="resepForm" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Nama">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Resep</label>
                    <input type="nama" class="form-control" id="resep" placeholder="resep">
                  </div>
                  <div class="form-group">
  <label for="kategori">Kategori</label>
  <select class="form-control" id="kategori">
    <option value="makanan">Pilih</option>
    <option value="makanan">Makanan</option>
    <option value="minuman">Minuman</option>
  </select>
</div>

                  <div class="form-group">
      <label for="thumbnail">Thumbnail</label>
      <input type="file" class="form-control" id="thumbnail" name="thumbnail">
    </div>
                  <!-- <div class="form-group">
                    <label for="exampleInputFile">Thumbnail</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Thumbnail</label>
                      </div>
                    </div>
                  </div> -->
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  
                </div>

                

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Resep</th>
                    <th>Kategori</th>
                    <th>Thumbnail</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Resep</th>
                    <th>Kategori</th>
                    <th>Thumbnail</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="theme/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="theme/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="theme/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="theme/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="theme/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="theme/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="theme/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="theme/plugins/moment/moment.min.js"></script>
<script src="theme/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="theme/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="theme/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="theme/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="theme/dist/js/pages/dashboard.js"></script>

<script>
  let counter = 1;

  document.getElementById('resepForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const nama = document.getElementById('nama').value;
    const resep = document.getElementById('resep').value;
    const kategori = document.getElementById('kategori').value;
    const thumbnailInput = document.getElementById('thumbnail');
    const file = thumbnailInput.files[0];
    let thumbnail = '';

    if (file) {
      thumbnail = URL.createObjectURL(file);
    }

    const table = document.querySelector('#example1 tbody');
    const newRow = table.insertRow();

    newRow.innerHTML = `
      <td>${counter++}</td>
      <td>${nama}</td>
      <td>${resep}</td>
      <td>${kategori}</td>
      <td><img src="${thumbnail}" alt="Thumbnail" height="50"></td>
      <td><button class="btn btn-danger btn-sm" onclick="hapusRow(this)">Hapus</button></td>
    `;

    // Kosongkan form
    document.getElementById('resepForm').reset();
  });

  function hapusRow(button) {
    const row = button.closest('tr');
    row.remove();
  }
</script>

</body>
</html>
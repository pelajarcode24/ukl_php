<?php
require_once("../misc/require.php");
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/spp/utils/connect.php";
require($path);
if($_SESSION['level']!="admin"){
    header("location: ./../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/spp/Styles/table.css">
    <title>Data Kelas</title>
</head>
<body>
    <!-- Panggil script header -->
    <?php require_once("../misc/header.php"); ?>
    <div class="all-table">
    <!-- Isi Konten -->
    <h3>Petugas</h3>
    <p><a href="tambah_petugas.php"><button type="button" class="btn btn-outline-secondary">Tambah Data</button></a></p>
    <table class="table table-hover table-dark" cellspacing="0" border="1" cellpadding="5">
        <tr>
            <td>No. </td>
            <td>Username</td>
            <td>Password</td>
            <td>Nama Petugas</td>
            <td>Level</td>
            <td>Aksi</td>
        </tr>
<?php
// Kita buat konfigurasi pagging
$jmlhDataHal = 5;
$data = mysqli_query($conn, "SELECT * FROM petugas");
$jmlhData = mysqli_num_rows($data);
$jmlhHal = ceil($jmlhData / $jmlhDataHal);
$halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
$dataAwal = ($jmlhData * $halAktif) - $jmlhData;
// Konfigurasi Selesai
// Kita panggil tabel petugas
$sql = mysqli_query($conn, "SELECT * FROM petugas ");
$no = 1;
while($r = mysqli_fetch_assoc($sql)){ ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $r['username']; ?></td>
            <td><?= $r['password']; ?></td>
            <td><?= $r['nama_petugas']; ?></td>
            <td><?= $r['level']; ?></td>
            <td><a href="?hapus&id=<?= $r['id_petugas']; ?>">Hapus</a> | 
                <a href="edit_petugas.php?id=<?= $r['id_petugas']; ?>">Edit</a</td>
        </tr>
<?php $no++; } ?>
    </table>

<div class="table-number">
<!-- Sekarang kita buat tombol halamannya -->
<?php for($i=1; $i <= $jmlhHal; $i++): ?>
        <a href="?hal=<?= $i; ?>"><?= $i; ?></a>
<?php endfor; ?>
</div>
<!-- Selesai -->
</div>
    <?php 
    $Footerpath = $_SERVER['DOCUMENT_ROOT'];
    $Footerpath .= "/spp/misc/footer.php"; 
    require($Footerpath); ?>
</body>
</html>
<?php
// Tombol Hapus ditekan
if(isset($_GET['hapus'])){
    $id = $_GET['id'];
    $hapus = mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas='$id'");
    if($hapus){
        echo "<script>alert('Data Berhasil Dihapus !');location.href='petugas.php';</script>";
    }else{
        echo "<script>alert('Maaf, data tersebut masih terhubung dengan data yang lain');
        </script>";
    }
}
?>
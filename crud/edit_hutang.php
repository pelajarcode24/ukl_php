<?php
// if($_SESSION['level']!="admin"){
//     header("location: ./../index.php");
// }
require_once("../misc/require.php");
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/spp/utils/connect.php";
require($path);
$id = $_GET['id'];
$spp = mysqli_query($conn, "SELECT * FROM spp WHERE id_spp='$id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
       
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>     
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/spp/Styles/table.css">

    <meta charset="UTF-8">
    <title>Edit Pembayaran</title>
</head>
<body>
    <!-- Panggil header -->
    <?php require("../misc/header.php"); ?>
    <!-- Konten -->
    <div class="all-table">
    <h3>Edit data SPP</h3>
<?php
while($row = mysqli_fetch_assoc($spp)){?>
    <form action="" method="POST">
        <table class="table  table-hover table-dark" cellspacing="0" border="1" cellpadding="5">
            <input type="hidden" name="id" value="<?= $row['id_spp']; ?>">
            <tr>
                <td>Tahun :</td>
                <td><input class="form-control" type="number" name="tahun" value="<?= $row['tahun']; ?>"></td>
            </tr>
            <tr>
                <td>Nominal :</td>
                <td><input class="form-control" type="number" name="nominal" value="<?= $row['nominal']; ?>"></td>
            </tr>
            <tr>
                <td>Angkatan :</td>
                <td><input class="form-control" type="number" name="angkatan" value="<?= $row['angkatan']; ?>"></td>
            </tr>
            <tr>
                <td colspan="2">
                <button class="btn btn-outline-secondary" onclick="history.back()" type="button">Kembali</button>
                <button class="btn btn-outline-secondary" type="submit" name="simpan">Simpan</button>
            </td>
            </tr>
        </table>
    </form>
<?php } ?>
    </div>
    <!-- Panggil footer -->
    <?php 
    $Footerpath = $_SERVER['DOCUMENT_ROOT'];
    $Footerpath .= "/spp/misc/footer.php"; 
    require($Footerpath); ?>
</body>
</html>
<?php
// Proses update
if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];
    $angkatan = $_POST['angkatan'];
    $update = mysqli_query($conn, "UPDATE spp SET angkatan='$angkatan', tahun='$tahun', nominal='$nominal'
                                 WHERE id_spp='$id'");
        if($update){
            echo "<script>alert('Data Berhasil Diedit !');location.href='../crud/spp.php';</script>";
        }else{
            echo "<script>alert('Gagal'); </script>";
        }
}
?>
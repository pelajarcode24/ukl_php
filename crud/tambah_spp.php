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
<link rel="stylesheet" type="text/css" href="/spp/Styles/table.css">
    <meta charset="UTF-8">
    <title>Tambah SPP</title>
</head>
<body>
    <!-- Panggil header -->
    <?php require("../misc/header.php"); ?>
    <!-- Konten -->
    <div class="all-table">
    <h3>Tambah SPP</h3>
    <form action="" method="POST">
        <table class="table table-hover table-dark" cellspacing="0" border="1" cellpadding="5">
        <tr>
                <td>Id SPP : <br> *sama dengan angkatan </td>
                
                <td><input class="form-control" type="number" name="id"></td>
            </tr>
        <tr>
                <td>Angkatan :</td>
                <td><input class="form-control" type="number" name="angkatan"></td>
            </tr>
            <tr>
                <td>Bulan  :</td>
                <td><input class="form-control" type="text" name="bulan"></td>
            </tr>
            <tr>
                <td>Nominal :</td>
                <td><input class="form-control" type="number" name="nominal"></td>
            </tr>
            <tr>
                <td colspan="2"><button class="btn btn-outline-secondary" onclick="history.back()" type="button">Kembali</button>
                <button class="btn btn-outline-secondary" type="submit" name="simpan">Simpan</button>
            </td>
            </tr>
        </table>
    </form>
    </div>
            <!-- Panggil footer -->
    <?php $footerpath = $_SERVER['DOCUMENT_ROOT'];
    $footerpath .= "/spp/misc/footer.php"; 
    require($footerpath);?>
</body>
</html>
<?php
// Proses Simpan
if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $angkatan = $_POST['angkatan'];
    $bulan = $_POST['bulan'];
    $nominal = $_POST['nominal'];
    $simpan = mysqli_query($conn, "INSERT INTO spp VALUES( null, '$angkatan', '$bulan', '$nominal')");
        if($simpan){
            echo "<script>alert('Data Berhasil Ditambahkan !');location.href='../crud/spp.php';</script>";
        }else{
            //show the error
            $error = mysqli_error($conn);
        echo $error;
        echo "<script>alert('Data gagal disimpan : '$error' !');location.href='tambah_spp.php'</script>";
        }
}
?>
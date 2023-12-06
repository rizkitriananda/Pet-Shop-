<?php 
  session_start();
  if(!isset($_SESSION['user'])){
    header('location:../index.php');
    exit;
  }

require '../functions.php';

$id = $_GET['id'];
$table = $_GET['table'];


if(hapus($id,$table)> 0){
       echo "<script>
                alert('Data Berhasil dihapus');
                document.location.href = 'dashboard.php'
            </script>";
} else {
       echo "<script>
                alert('Data GAGAL dihapus');
                document.location.href = 'dashboard.php'
            </script>";
}




?>
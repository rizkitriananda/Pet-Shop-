<?php
session_start();
include 'functions.php';

$username=$_POST['username'];
$password=$_POST['password'];

$sql="SELECT * FROM users WHERE username='$username' AND password='$password'";



$hasil=$koneksi -> query ($sql);

$row=$hasil -> fetch_assoc();
echo $row['level'];

if ($hasil->num_rows){
    if($row['level'] == 'admin'){
        header('Location: ./admin-page/dashboard.php');
        $_SESSION['login']='sukses';
        $_SESSION['user']=$row['user'];
        $_SESSION['user']=$row['level'];
    } else {
        header('Location: ./user-page/index.php');
        $_SESSION['login']='sukses';
        $_SESSION['user']=$row['user'];
        $_SESSION['user']=$row['level'];
    };
    
   
} else {
    $_SESSION['login']='gagal';
};

?>


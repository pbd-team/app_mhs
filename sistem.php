<?php 

session_start();

include 'koneksi.php';


$username = $_POST['username'];
$password = $_POST['password'];



$login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
$cek = mysqli_num_rows($login);


if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	if($data['jenisuser']=="1"){
		$_SESSION['username'] = $username;
		$_SESSION['jenisuser'] = "1";
		header("location:admin.php");

	}else if($data['jenisuser']=="0"){
		$_SESSION['username'] = $username;
		$_SESSION['jenisuser'] = "0";
		header("location:user.php");

	}
	}else{
		header("location:login.php?pesan=gagal");
	}	
?>
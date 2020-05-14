<html>
<head>
	<title>Halaman Client</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
?>
	<div class="wrap">
		
		<nav class="menu">
			<ul>
				<li>
					<a href="user.php" class="nav-active">HOME</a>
				</li>
				<li>
					<a href="dataprodi_client.php">PRODI</a>
				</li>
				<li>
					<a href="datauser_client.php">USER</a>
				</li>
			</ul>
		</nav>
		<aside class="sidebar">
			<div class="widget">
				<h2>Keterangan Login</h2>
				<p>
    			<?php echo "Welcome " . $_SESSION['username'] . " | <a href=sistem.php?op=out>Keluar</a>"; ?>
				</p>
			</div>
			<div class="widget">
				<h2>Sebagai</h2>
				<b>
				<p><?php
   					 if ($_SESSION['jenisuser'] == '0') {
   					     $ju = 'User-Client';
 				   } else {
     					 $ju = 'User-Admin';
   					}
   					 echo $ju . '<hr>';
   					 ?></p>
					</div>
				</b>
					</aside>
		<div class="blog">
			<div class="conteudo">
				<div class="post-info">
					Di Posting Oleh <b>Admin</b>
				</div>
<?php
require("koneksi.php");

$hub = open_connection();
$a = @$_GET["a"];
$id = @$_GET["id"];
$sql = @$_POST["sql"];
switch ($sql) {
	case 'create':
		# code...
	create_prodi();
		break;
	case 'update':
		# code...
	update_prodi();
		break;
	case 'delete':
		# code...
	delete_prodi();
		break;
	}
	switch ($a) {
	case 'list':
		# code...
	read_data();
		break;
	default:
		# code...
	read_data();
		break;
	}
mysqli_close($hub);
?>

<?php
function read_data()
{
	global $hub;
	$query = "select * from mahasiswa";
	$result = mysqli_query($hub, $query);?>

	<h2>Data Mahasiswa</h2>
	<table border="1" cellpadding="2" class="table1">
	
		<tr class="re">
			<td>IDMHS</td>
			<td>NPM</td>
			<td>NAMA MAHASISWA</td>
			<td>ID PRODI</td>
		</tr>

<?php while ($row=mysqli_fetch_array($result)) {?>
	<tr>
	<td><?php echo $row['idmhs'];?></td>
	<td><?php echo $row['npm'];?></td>
	<td><?php echo $row['nama'];?></td>
	<td><?php echo $row['idprodi'];?></td>
	</tr>
	<?php } ?>
	</table>
	<?php } ?>		
			</div>
		</div>
	</div>
</body>
</html>



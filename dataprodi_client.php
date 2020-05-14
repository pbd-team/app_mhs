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
					<a href="user.php">Home</a>
				</li>
				<li>
					<a href="dataprodi_client.php" class="nav-active">PRODI</a>
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
					</aside>
				</b>
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
	$query = "select * from dt_prodi";
	$result = mysqli_query($hub, $query);?>

	<h2>Data Program Studi</h2>
	<table border="1" cellpadding="2" class="table1">
	
		<tr class="re">
			<td>ID</td>
			<td>KODE</td>
			<td>NAMA PRODI</td>
			<td>AKREDITASI</td>
		</tr>

<?php while ($row=mysqli_fetch_array($result)) {?>
	<tr>
	<td><?php echo $row['idprodi'];?></td>
	<td><?php echo $row['kdprodi'];?></td>
	<td><?php echo $row['nmprodi'];?></td>
	<td><?php echo $row['akreditasi'];?></td>
	</tr>

	<?php } ?>
	</table>
	<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>
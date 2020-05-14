<html>
<head>
	<title>Halaman Admin</title>
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
					<a href="admin.php" class="nav-active">HOME</a>
				</li>
				<li>
					<a href="dataprodi.php">PRODI</a>
				</li>
				<li>
					<a href="datauser.php">USER</a>
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
			<b>
			<div class="widget">
				<h2>Sebagai</h2>
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
	case 'input':
		# code...
	input_data();
		break;
	case 'edit':
			# code...
	edit_data($id);
		break;
	case 'delete':
			# code...
	delete_data($id);
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
	<button class="bg-1" onclick="location.href='admin.php?a=input'">INPUT</button>
	<br><br>
		<tr class="re">
			<td>IDMHS</td>
			<td>NPM</td>
			<td>NAMA MAHASISWA</td>
			<td>ID PRODI</td>
			<td>TOOLS</td>
		</tr>

<?php while ($row=mysqli_fetch_array($result)) {?>
	<tr>
	<td><?php echo $row['idmhs'];?></td>
	<td><?php echo $row['npm'];?></td>
	<td><?php echo $row['nama'];?></td>
	<td><?php echo $row['idprodi'];?></td>
	<td>
		<BUTTON class="bg-2" onclick="location.href='admin.php?a=edit&id=<?php echo $row['idmhs'];?>'">EDIT</BUTTON>
		<BUTTON class="bg-3" onclick="location.href='admin.php?a=delete&id=<?php echo $row['idmhs'];?>'">HAPUS</BUTTON>
	</td>
	</tr>

	<?php } ?>
	</table>
	<?php } ?>

<?php
function input_data() {
	$row = array(
		"npm"=> "",
		"nama"=> "",
		"idprodi"=> "5"
		); ?>

<h2>Input Data Mahasiswa</h2>
<form action="admin.php?a=list" method="post">
<input type="hidden" name="sql" value="create">
NPM<br>
<input type="text" name="npm" maxlength="8" size="8" value="<?php echo trim($row["npm"]); ?>"/><br>
<br>
NAMA MAHASISWA<br>
<input type="text" name="nama" maxlength="50" size="50" value="<?php echo trim($row["nama"]); ?>"/><br>
<br>
ID PRODI
<br>
<input type="radio" name="idprodi" value="1"
<?php if ($row["idprodi"]=='1' || $row["idprodi"]==''){
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >1

<input type="radio" name="idprodi" value="2"
<?php if ($row["idprodi"]=='2'){
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >2

<input type="radio" name="idprodi" value="3"
<?php if ($row["idprodi"]=='3') {
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >3

<input type="radio" name="idprodi" value="4"
<?php if ($row["idprodi"]=='4') {
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >4

<input type="radio" name="idprodi" value="5"
<?php if ($row["idprodi"]=='5' || $row["idprodi"]=='') {
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >5


<br>
<br>

<button class="bg-1" type="submit" name="action">Simpan</button>
<button class="bg-3" type="button" onclick="location.href='admin.php?a=list'">Batal</button>
</form>

<?php } ?>



<?php
function edit_data($id){
global $hub;
$query = "select * from mahasiswa where idmhs = $id";
$result = mysqli_query($hub,$query);
$row = mysqli_fetch_array($result);
?>


<h2>Edit Data Mahasiswa</h2>
<form action="admin.php?a=list" method="post">
<input type="hidden" name="sql" value="update">
<input type="hidden" name="idmhs" value="<?php echo trim($id);?>">
NPM<BR>
<input type="text" name="npm" maxlength="6" size="6" value="<?php echo trim($row["npm"]); ?>"/><BR>
<br>
NAMA MAHASISWA<br>
<input type="text" name="nama" maxlength="70" size="70" value="<?php echo trim($row["nama"]); ?>"/><BR>
<br>
ID PRODI
<BR>
<input type="radio" name="idprodi" value="1"
<?php if ($row["idprodi"]=='1'){
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >1

<input type="radio" name="idprodi" value="2"
<?php if ($row["idprodi"]=='2'){
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >2

<input type="radio" name="idprodi" value="3"
<?php if ($row["idprodi"]=='3') {
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >3

<input type="radio" name="idprodi" value="4"
<?php if ($row["idprodi"]=='4') {
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >4

<input type="radio" name="idprodi" value="5"
<?php if ($row["idprodi"]=='5' || $row["idprodi"]=='') {
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >5

<br>
<br>

<button class="bg-1" type="submit" name="action">Simpan</button>
<button class="bg-3" type="button" onclick="location.href='admin.php?a=list'">Batal</button>
</form>

<?php } ?>

<?php
function delete_data($id){
global $hub;
$query = "select * from mahasiswa where idmhs = $id";
$result = mysqli_query($hub,$query);
$row = mysqli_fetch_array($result);
?>
<h2>Hapus Data Mahasiswa</h2>
<form action="admin.php?a=list" method="post">
<input type="hidden" name="sql" value="delete">
<input type="hidden" name="idmhs" value="<?php echo trim($id)?>">
<table border="1" cellpadding="2" class="table1">
	<tr>
		<td>NPM</td>
		<td>NAMA MAHASISWA</td>
		<td>ID PRODI</td>
	</tr>
	<tr>
		<td><?php echo trim($row["npm"])?></td>
		<td><?php echo trim($row["nama"])?></td>
		<td><?php echo trim($row["idprodi"])?></td>
	</tr>	
</table>
	
<br>

<button type="submit" class="bg-1" name="action">Hapus</button>
<BUTTON type="button" class="bg-3" onclick="location.href='admin.php?a=list'">Batal</BUTTON>

</form>

<?php } ?>
<?php
function create_prodi()
{
global $hub;
global $_POST;
$query = "insert into mahasiswa (npm,nama,idprodi) values";
$query.="('".$_POST["npm"]."','".$_POST["nama"]."','".$_POST["idprodi"]."')";

mysqli_query($hub, $query) or die(mysql_error());
}
?>


<?php
function update_prodi(){
	global $hub;
	global $_POST;
	$query = "update mahasiswa";
	$query .=" SET npm='" .$_POST["npm"]."', nama='".$_POST["nama"]."', idprodi='".$_POST["idprodi"]."'";
	$query .= " where idmhs = ".$_POST["idmhs"];

mysqli_query($hub, $query) or die(mysql_error());
}
?>

<?php
function delete_prodi(){
	global $hub;
	global $_POST;
	$query = " delete from mahasiswa";
	$query .= " where idmhs = ".$_POST["idmhs"];

mysqli_query($hub, $query) or die(mysql_error());
}
?>
					
			</div>
		
		</div>
	</div>
 
</body>
</html>



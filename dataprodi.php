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
					<a href="admin.php">Home</a>
				</li>
				<li>
					<a href="dataprodi.php" class="nav-active">PRODI</a>
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
	$query = "select * from dt_prodi";
	$result = mysqli_query($hub, $query);?>

	<h2>Data Program Studi</h2>
	<table border="1" cellpadding="2" class="table1">
	
	<button class='bg-1' onclick="location.href='dataprodi.php?a=input'">INPUT</button>
	<br><br>
		<tr class="re">
			<td>ID</td>
			<td>KODE</td>
			<td>NAMA PRODI</td>
			<td>AKREDITASI</td>
			<td>TOOLS</td>
		</tr>

<?php while ($row=mysqli_fetch_array($result)) {?>
	<tr>
	<td><?php echo $row['idprodi'];?></td>
	<td><?php echo $row['kdprodi'];?></td>
	<td><?php echo $row['nmprodi'];?></td>
	<td><?php echo $row['akreditasi'];?></td>
	<td>
		<button class="bg-2" onclick="location.href='dataprodi.php?a=edit&id=<?php echo $row['idprodi'];?>'">EDIT</button>
		<button class="bg-3" onclick="location.href='dataprodi.php?a=delete&id=<?php echo $row['idprodi'];?>'">HAPUS</button>
	</td>
	</tr>

	<?php } ?>
	</table>
	<?php } ?>

<?php
function input_data() {
	$row = array(
		"kdprodi"=> "",
		"nmprodi"=> "",
		"akreditasi"=> "-"
		); ?>

<h2>Input Data Program Studi</h2>
<form action="dataprodi.php?a=list" method="post">
<input type="hidden" name="sql" value="create">
Kode Prodi<br>
<input type="text" name="kdprodi" maxlength="6" size="6" value="<?php echo trim($row["kdprodi"]); ?>"/><br>

<br>
Nama Prodi<br>
<input type="text" name="nmprodi" maxlength="70" size="70" value="<?php echo trim($row["nmprodi"]); ?>"/><br>

<br>
Akreditasi Prodi<br>
<input type="radio" name="akreditasi" value="-"
<?php if ($row["akreditasi"]=='-' || $row["akreditasi"]=='') {
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >-

<input type="radio" name="akreditasi" value="A"
<?php if ($row["akreditasi"]=='A'){
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >A

<input type="radio" name="akreditasi" value="B"
<?php if ($row["akreditasi"]=='B') {
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >B

<input type="radio" name="akreditasi" value="C"
<?php if ($row["akreditasi"]=='C') {
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >C

<br>
<br>

<button type="submit" name="action" class="bg-1">Simpan</button>
<button type="button" class="bg-3" onclick="location.href='dataprodi.php?a=list'">Batal</>
</form>

<?php } ?>


<?php
function edit_data($id){
global $hub;
$query = "select * from dt_prodi where idprodi = $id";
$result = mysqli_query($hub,$query);
$row = mysqli_fetch_array($result);
?>


<h2>Edit Data Program Studi</h2>
<form action="dataprodi.php?a=list" method="post">
<input type="hidden" name="sql" value="update">
<input type="hidden" name="idprodi" value="<?php echo trim($id);?>">
Kode Prodi<br>
<input type="text" name="kdprodi" maxlength="6" size="6" value="<?php echo trim($row["kdprodi"]); ?>"/><br>


<br>
Nama Prodi<br>
<input type="text" name="nmprodi" maxlength="70" size="70" value="<?php echo trim($row["nmprodi"]); ?>"/><br>


<br>
Akreditasi Prodi<br>
<input type="radio" name="akreditasi" value="-"
<?php if ($row["akreditasi"]=='-' || $row["akreditasi"]=='') {
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >-

<input type="radio" name="akreditasi" value="A"
<?php if ($row["akreditasi"]=='A'){
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >A

<input type="radio" name="akreditasi" value="B"
<?php if ($row["akreditasi"]=='B') {
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >B

<input type="radio" name="akreditasi" value="C"
<?php if ($row["akreditasi"]=='C') {
	# code...
	echo "checked=\"checked\"";}else {echo "";} 
?> >C

<br>
<br>

<button type="submit" name="action" class="bg-1">Simpan</button>
<button type="button" class="bg-3" onclick="location.href='dataprodi.php?a=list'">Batal</button>
</form>

<?php } ?>

<?php
function delete_data($id){
global $hub;
$query = "select * from dt_prodi where idprodi = $id";
$result = mysqli_query($hub,$query);
$row = mysqli_fetch_array($result);
?>
<form action="dataprodi.php?a=list" method="post">
<input type="hidden" name="sql" value="delete">
<input type="hidden" name="idprodi" value="<?php echo trim($id)?>">
<table border="1" cellpadding="2" class="table1">
	<tr>
		<td>Kode Prodi</td>
		<td>Nama Prodi</td>
		<td>Akreditasi</td>
	</tr>
	<tr>
		<td><?php echo trim($row["kdprodi"])?></td>
		<td><?php echo trim($row["nmprodi"])?></td>
		<td><?php echo trim($row["akreditasi"])?></td>
	</tr>	

</table>
<br>
<br>

<button type="submit" name="action" class="bg-1">Hapus</button>
<button type="button" class="bg-3" onclick="location.href='dataprodi.php?a=list'">Batal</button>

</form>

<?php } ?>





<?php
function create_prodi()
{
global $hub;
global $_POST;
$query = "insert into dt_prodi (kdprodi,nmprodi,akreditasi) values";
$query.="('".$_POST["kdprodi"]."','".$_POST["nmprodi"]."','".$_POST["akreditasi"]."')";

mysqli_query($hub, $query) or die(mysql_error());
}
?>


<?php
function update_prodi(){
	global $hub;
	global $_POST;
	$query = "update dt_prodi";
	$query .=" SET kdprodi='" .$_POST["kdprodi"]."', nmprodi='".$_POST["nmprodi"]."', akreditasi='".$_POST["akreditasi"]."'";
	$query .= " where idprodi = ".$_POST["idprodi"];

mysqli_query($hub, $query) or die(mysql_error());
}
?>

<?php
function delete_prodi(){
	global $hub;
	global $_POST;
	$query = " delete from dt_prodi";
	$query .= " where idprodi = ".$_POST["idprodi"];

mysqli_query($hub, $query) or die(mysql_error());
}
?>
					
			</div>
		
		</div>
	</div>
 
</body>
</html>



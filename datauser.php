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
					<a href="dataprodi.php">PRODI</a>
				</li>
				<li>
					<a href="datauser.php" class="nav-active">USER</a>
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
	create_user();
		break;
	case 'update':
		# code...
	update_user();
		break;
	case 'delete':
		# code...
	delete_user();
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
	$query = "select * from  user";
	$result = mysqli_query($hub, $query);?>

	<h2>Data User</h2>
	<table border="1" cellpadding="2" class="table1">
	
	<button class="bg-1" onclick="location.href='datauser.php?a=input'">INPUT</button>
	<br><br>
		<tr class="re">
			<td>ID USER</td>
			<td>USERNAME</td>
			<td>PASSWORD</td>
			<td>JENIS USER</td>
			<td>LEVEL</td>
			<td>STATUS</td>
			<td>ID PRODI</td>
		</tr>

<?php while ($row=mysqli_fetch_array($result)) {?>
	<tr>
	<td><?php echo $row['iduser'];?></td>
	<td><?php echo $row['username'];?></td>
	<td><?php echo $row['password'];?></td>
	<td><?php echo $row['jenisuser'];?></td>
	<td><?php echo $row['level'];?></td>
	<td><?php echo $row['status'];?></td>
	<td><?php echo $row['idprodi'];?></td>
	<td>
		<BUTTON onclick="location.href='datauser.php?a=edit&id=<?php echo $row['iduser'];?>'" class="bg-2">EDIT</BUTTON>
		<BUTTON onclick="location.href='datauser.php?a=delete&id=<?php echo $row['iduser'];?>'" class="bg-3">HAPUS</BUTTON>
	</td>
	</tr>

	<?php } ?>
	</table>
	<?php } ?>

<?php
function input_data() {
	$row = array(
		"iduser"=> "",
		"username"=> "",
		"password"=> "",
		"jenisuser"=> "",
		"level"=> "",
		"status"=> "",
		"idprodi"=> "5"
		); ?>

<h2>Input Data User</h2>
<form action="datauser.php?a=list" method="post">
<input type="hidden" name="sql" value="create">
Id User<br>
<input type="text" name="iduser" maxlength="8" size="8" value="<?php echo trim($row["iduser"]); ?>"/><br>
<br>
Username<br>
<input type="text" name="username" maxlength="50" size="50" value="<?php echo trim($row["username"]); ?>"/><br>
<br>
Password<br>
<input type="text" name="password" maxlength="8" size="8" value="<?php echo trim($row["password"]); ?>"/><br>
<br>
Jenis User<br>
<input type="text" name="jenisuser" maxlength="50" size="50" value="<?php echo trim($row["jenisuser"]); ?>"/><br>
<br>
Level<br>
<input type="text" name="level" maxlength="8" size="8" value="<?php echo trim($row["level"]); ?>"/><br>
<br>

Status<br>
<input type="text" name="status" maxlength="50" size="50" value="<?php echo trim($row["status"]); ?>"/><br>
<br>
ID PRODI
<br>

<input type="radio" name="idprodi" value="1"

<?php if ($row["idprodi"]=='1') {
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

<button type="submit" type="submit" name="action" class="bg-1">Simpan</button>
<button type="button" class="bg-3" onclick="location.href='datauser.php?a=list'">Batal</button>
</form>

<?php } ?>



<?php
function edit_data($id){
global $hub;
$query = "select * from user where iduser = $id";
$result = mysqli_query($hub,$query);
$row = mysqli_fetch_array($result);
?>


<h2>Edit Data User</h2>
<form action="datauser.php?a=list" method="post">
<input type="hidden" name="sql" value="update">
<input type="hidden" name="iduser" value="<?php echo trim($id);?>">
Id User<BR>
<input type="text" name="iduser" maxlength="6" size="6" value="<?php echo trim($row["iduser"]); ?>"/><BR>
<br>
Username<br>
<input type="text" name="username" maxlength="70" size="70" value="<?php echo trim($row["username"]); ?>"/><BR>
<br>
Password<BR>
<input type="text" name="password" maxlength="6" size="6" value="<?php echo trim($row["password"]); ?>"/><BR>
<br>
Jenis User<BR>
<input type="text" name="jenisuser" maxlength="6" size="6" value="<?php echo trim($row["jenisuser"]); ?>"/><BR>
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

<button type="submit" name="action" class="bg-1">Simpan</button>
<button type="button" class="bg-3" onclick="location.href='datauser.php?a=list'">Batal</button>
</form>

<?php } ?>

<?php
function delete_data($id){
global $hub;
$query = "select * from user where iduser = $id";
$result = mysqli_query($hub,$query);
$row = mysqli_fetch_array($result);
?>
<h2>Hapus Data User</h2>
<form action="datauser.php?a=list" method="post">
<input type="hidden" name="sql" value="delete">
<input type="hidden" name="iduser" value="<?php echo trim($id)?>">
<table border="1" cellpadding="2" class="table1">
	<tr>
		<td>Id User</td>
		<td>Username</td>
		<td>ID PRODI</td>
	</tr>
	<tr>
		<td><?php echo trim($row["iduser"])?></td>
		<td><?php echo trim($row["username"])?></td>
		<td><?php echo trim($row["idprodi"])?></td>
	</tr>	
</table>
	
<br>

<button type="submit" name="action" class="bg-1">Hapus</button>
<BUTTON type="button" class="bg-3" onclick="location.href='datauser.php?a=list'">Batal</BUTTON>

</form>

<?php } ?>





<?php
function create_user()
{
global $hub;
global $_POST;
$query = "insert into user (iduser,username,password,jenisuser,level,status,idprodi) values";
$query.="('".$_POST["iduser"]."','".$_POST["username"]."','".$_POST["password"]."','".$_POST["jenisuser"]."','".$_POST["level"]."','".$_POST["status"]."','".$_POST["idprodi"]."')";

mysqli_query($hub, $query) or die(mysql_error());
}
?>


<?php
function update_user(){
	global $hub;
	global $_POST;
	$query = "update user";
	$query .=" SET iduser='" .$_POST["iduser"]."', username='".$_POST["username"]."', password='".$_POST["password"]."', jenisuser='".$_POST["jenisuser"]."', idprodi='".$_POST["idprodi"]."'";
	$query .= " where iduser = ".$_POST["iduser"];

mysqli_query($hub, $query) or die(mysql_error());
}
?>

<?php
function delete_user(){
	global $hub;
	global $_POST;
	$query = " delete from user";
	$query .= " where iduser = ".$_POST["iduser"];

mysqli_query($hub, $query) or die(mysql_error());
}
?>
					
			</div>
		
		</div>
	</div>
 
</body>
</html>

<!-- #добавление -->

<form method=post action='index.php?p=10&act=add'>
name : <input type=text name=good_name></br>
<input type=submit value=Добавить></br>
</form>

<?php
if($_GET['act']=='add'){
	$conn = new mysqli("127.0.0.1", "root", "","book");	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

    $name = $_POST['good_name'];
    $query = "insert into categories(name) values('{$name}')";
    $result = mysqli_query($conn,$query);
    
    if($result){		
        echo "date are added-данные добавлены";
    }
    else{
         die("query failed: " . mysqli_error($conn));
    }
    
    
    mysqli_close($conn);
}
?>



<!-- #удаление  -->

<?php
if($_GET['act']=='del'){
	$conn = new mysqli("127.0.0.1", "root", "","book");	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	
	$query = "delete from categories where id = {$_POST['del_item']} ";
	$result = mysqli_query($conn,$query);
	
	if($result){		
		echo "date are deleted-даные удалены";
	}
	else{
		 die("query failed: " . mysqli_error($conn));
	}

	
	mysqli_close($conn);
}
?>
<!-- #выбор категории для удаления  -->
<?php
	$conn = new mysqli("127.0.0.1", "root", "","book");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}	
	$query = "SELECT id,name FROM categories";
	$result = mysqli_query($conn,$query);
?>

<form method=post action='index.php?p=10&act=del'>
<?php
if($result){
	while($row = mysqli_fetch_array($result)){
		echo "{$row['id']} -- 
			{$row['name']}---
			<input type=radio name=del_item value={$row['id']}><br>";
	}
}
else{
	 die("Query failed: " . mysqli_error($conn));
	}
?>
<input type=submit value=Удаление></br>
</form>

<!-- //возможно условие -->
<?php
	
	mysqli_close($conn);
?>


<!-- #редактирование  -->
<?php
$conn = new mysqli("127.0.0.1", "root", "","book");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT id,name FROM categories";	
$result = mysqli_query($conn,$query);
?>

<form method=post action='index.php?p=10&act=pre_edit'>
<?php
if($result){
	while($row = mysqli_fetch_array($result)){
		echo "{$row['id']} -- 
			{$row['name']}---
			<input type=radio name=edit_item value={$row['id']}><br>";
	}
}
else{
	 die("Query failed: " . mysqli_error($conn));
	}

?>
<input type=submit value=Редактирование></br>
</form>

<!-- //возможно условие -->
<?php
	
	mysqli_close($conn);
?>

<?php
#тут заполняем форму для редактирования

if($_GET['act']=='pre_edit'){

	$conn = new mysqli("127.0.0.1", "root", "","book");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$query = "select id,name FROM categories
			where id = {$_POST['edit_item']}";
	$result = mysqli_query($conn,$query);
	
	if($result){
		while($row = mysqli_fetch_array($result)){
		echo "
			<form method=post action='index.php?p=10&act=edit'>
			<input type=hidden name=id value={$row['id']}>
			name : <input type=text name=good_name value={$row['name']}></br>
			<input type=submit value=Отредактировать></br>
			</form>";
	}		
	}
	else{
		 die("query failed: " . mysqli_error($conn));
	}
	
	mysqli_close($conn);	
}
?>
<?php
if($_GET['act']=='edit'){

	$conn = new mysqli("127.0.0.1", "root", "","book");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$query = "update categories set name='{$_POST['good_name']}'
			where id = {$_POST['id']}";

	$result = mysqli_query($conn,$query);
	
	if($result){		
		echo "data edited-добавлено";
		}
	else{
		 die("query failed: " . mysqli_error($conn));
	}
	
	mysqli_close($conn);	
}
?>

<?php
$conn = new mysqli("127.0.0.1", "root", "","book");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
$query = "SELECT id,name FROM roles";	
$result = mysqli_query($conn,$query);
?>

<!-- #select -->
<form method=post action='index.php?p=12&act=categorie'>
    <p><select size="1" name="categorie">
        <option disabled selected>Выберите роль</option>
        <?php
            if($result){
                while($row = mysqli_fetch_array($result)){
                        echo "<option value={$row['id']}> {$row['name']} </option>";
                }
            } else {
                die("Query failed: " . mysqli_error($conn));
            }
        ?>
    </select></p>
    <input type=submit value=Выбор>
	
</form>

<?php
	
	mysqli_close($conn);
?>

<!-- #выбор элемента для удаления  -->
<?php
if($_GET['act']=='categorie'){
	$conn = new mysqli("127.0.0.1", "root", "","book");	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

    $query = "select id,name,pass FROM users WHERE role_id={$_POST['categorie']}";
    $result = mysqli_query($conn,$query);
    echo '<br> <h3>Удаление</h3>';
    
    if($result){
        echo '<p> <form method=post action="index.php?p=12&act=del">'; // enctype="multipart/form-data"
        while($row = mysqli_fetch_array($result)){
            echo "{$row['id']} -- 
            {$row['name']} --
            {$row['pass']} --";
            echo "<input type=radio name=del_item value={$row['id']}><br> </p>";
	    }
        echo '<input type=submit value=удалить> </form>';
    }
    else{
         die("query failed: " . mysqli_error($conn));
    }
    
    
    mysqli_close($conn);
}
?>

<!-- #выбор элемента для редактирования  -->
<?php
if($_GET['act']=='categorie'){
	$conn = new mysqli("127.0.0.1", "root", "","book");	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

    $query = "select id,name,pass FROM users WHERE role_id={$_POST['categorie']}";
    $result = mysqli_query($conn,$query);
    echo ' <br> <h3>Редактирование</h3>';
    
    if($result){
        echo '<p> <form method=post action="index.php?p=12&act=pre_edit">';  // enctype="multipart/form-data"
        while($row = mysqli_fetch_array($result)){
            echo "{$row['id']} -- 
            {$row['name']} --
            {$row['pass']} --";
            echo "<input type=radio name=edit_item value={$row['id']}><br> </p>";
	    }
        echo '<input type=submit value=редактировать> </form>';
    }
    else{
         die("query failed: " . mysqli_error($conn));
    }
    
    
    mysqli_close($conn);
}
?>

<!-- #удаление -->
<?php
if($_GET['act']=='del'){
	$conn = new mysqli("127.0.0.1", "root", "","book");	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
    $id =$_POST['del_item'];
    echo "<br>$id<br>";
	
	$query = "delete from users where id = {$id}";
	$result = mysqli_query($conn,$query);
	
	if($result){		
		echo "<h3>date are deleted</h3>";
	}
	else{
		 die("query failed: " . mysqli_error($conn));
	}

	
	mysqli_close($conn);
}
?>

<!-- #форма с данными для редактирования -->
<?php
if($_GET['act']=='pre_edit'){

	$conn = new mysqli("127.0.0.1", "root", "","book");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$query = "select id,name,pass FROM users
			where id = {$_POST['edit_item']}";
	$result = mysqli_query($conn,$query);
	
	if($result){
		while($row = mysqli_fetch_array($result)){
		echo "
			<form method=post action='index.php?p=12&act=edit'>
			<input type=hidden name=id value={$row['id']}>
			<p> name : <input type=text name=good_name value={$row['name']}> </p>
			<p><select size='3' name=good_role>
			<option disabled selected>новая роль</option>
			<option value={$row['role_id']}> {$row['name']} </option>
			 роль : <input type=text name=good_role value={$row['role_id']}> </select></p>
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

    $good_name = $_POST['good_name'];
    echo "<br>{$good_name}<br>";
    $id = $_POST['id'];
    echo "{$id} <br>";
	$role = $_POST['good_role'];
    echo "<br>{$role}<br>";

	$query = "update users set name='{$good_name}', role_id={$role}
				where id = {$id}";
	$result = mysqli_query($conn,$query);
	

	if($result){		
		echo "<h3>data edited</h3><br>";
		}
	else{
		 die("query failed: " . mysqli_error($conn));
	}
	
	mysqli_close($conn);	
}
?>
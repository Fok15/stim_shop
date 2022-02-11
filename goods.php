<?php
$session = session_start();
if(isset($_SESSION)) {
    //echo 'SESSION'; 
}
$conn = new mysqli("127.0.0.1", "root", "","book");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
	
$result = mysqli_query($conn,$query);
?>

<!-- #select -->
<form method=post action='index.php?p=11&act=categorie'>
    <p><select size="1" multiple name="categorie">
        <option disabled>Выберите категорию</option>
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
    <input type=submit value=Выбрать>
</form>

<?php
	
	mysqli_close($conn);
?>

<!-- #форма добавления -->
<?php
// echo "{$_POST['categorie']}<br>";
if($_GET['act']=='categorie') {
    $_SESSION['categorie'] = $_POST['categorie'];
    // echo "{$_SESSION['categorie']}<br>";
    echo '<br> <h3>Добавление данных</h3>';
    echo '<form method=post action="index.php?p=11&act=add" enctype="multipart/form-data">
    <p> name: <input type=text name="good_name"> </p>
    <p> about: <input type=text name="good_about"> </p>
    <p> price: <input type=text name="good_price"> </p>
    <p> file: <input type="file" name="file_name"> </p>
    <input type=submit value=добавить></br>
    </form>';
}
?>

<!-- #выбор элемента для удаления  -->
<?php
if($_GET['act']=='categorie'){
	$conn = new mysqli("127.0.0.1", "root", "","book");	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

    $query = "select id,name,about,price,img FROM goods WHERE cat_id={$_POST['categorie']}";
    $result = mysqli_query($conn,$query);
    echo '<br> <h3>Удаление</h3>';
    
    if($result){
        echo '<p> <form method=post action="index.php?p=11&act=del" enctype="multipart/form-data">';		
        while($row = mysqli_fetch_array($result)){
            echo "{$row['id']} &#10060; 
            {$row['name']} --
            {$row['about']} --
            {$row['price']} --";
            if($row['img']) {
                echo '<img src =image/'.$row['img'].' height=40 width=40> --';
            }
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

    $query = "select id,name,about,price,img FROM goods WHERE cat_id={$_POST['categorie']}";
    $result = mysqli_query($conn,$query);
    echo ' <br> <h3>Редактирование</h3>';
    
    if($result){
        echo '<p> <form method=post action="index.php?p=11&act=pre_edit">';  // enctype="multipart/form-data"
        while($row = mysqli_fetch_array($result)){
            echo "{$row['id']} &#128221 
            {$row['name']} --
            {$row['about']} --
            {$row['price']} --";
            if($row['img']) {
                echo '<img src =image/'.$row['img'].' height=40 width=40> --';
            }
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

<!-- #добавление -->
<?php
if($_GET['act']=='add'){
    // echo "{$_SESSION['categorie']}";
	$conn = new mysqli("127.0.0.1", "root", "","book");	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
    $name = $_POST['good_name'];
    $about = $_POST['good_about'];
    $price = $_POST['good_price'];
	$img = $_FILES['file_name']['name'];
    $cat_id = $_SESSION['categorie'];
    $query = "insert into goods(name,about,price,img,cat_id) values('{$name}','{$about}',{$price},'{$img}',{$cat_id})";
    
    $result = mysqli_query($conn,$query);
     
    
    if($result){		
        echo "date are added - добавлено<br>";
        $uploaddir = 'image/';
		$uploadfile = $uploaddir . basename($_FILES['file_name']['name']);
        if (move_uploaded_file($_FILES['file_name']['tmp_name'], $uploadfile)) {
            echo "Файл корректен и был успешно загружен.\n <br>";
        } else {
            echo "Файл не загружен!\n";
        }
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
	
	
	$query = "delete from goods where id = {$_POST['del_item']} ";
	$result = mysqli_query($conn,$query);
	
	if($result){		
		echo "<h3>date are deleted-удалено</h3>";
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
	
	$query = "select id,name,about,price,img FROM goods
			where id = {$_POST['edit_item']}";
	$result = mysqli_query($conn,$query);
	
	if($result){
		while($row = mysqli_fetch_array($result)){
		echo "
			<form method=post action='index.php?p=11&act=edit' enctype='multipart/form-data'>
			<input type=hidden name=id value={$row['id']}>
            <input type=hidden name=img value={$row['img']}>
			<p> name : <input type=text name=good_name value={$row['name']}> </p>
            <p> price : <input type=text name=good_price value={$row['price']}> </p>
            <p> about : <input type=text name=good_about value={$row['about']}> </p>
            <p> file : <input type='file' name=file_name> </p>
			<input type=submit value=добавление></br>
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
    $good_price = $_POST['good_price'];
    $good_about = $_POST['good_about'];
    $cat_id = $_SESSION['categorie'];
    $id = $_POST['id'];
    // $file_name = $_POST['img'];
    // echo "{$file_name} <br>";

    if(isset($_FILES['file_name']['name']) && !empty($_FILES['file_name']['name'])){
        $uploaddir = 'image/';
        $uploadfile = $uploaddir . basename($_FILES['file_name']['name']);
        if (move_uploaded_file($_FILES['file_name']['tmp_name'], $uploadfile)) {
            echo "Файл корректен и был успешно загружен.\n";
        } else {
            echo "Файл не загружен!\n";
        }
        $img = $_FILES['file_name']['name'];
        $query = "update goods set name='{$good_name}',
        about='{$good_about}',
        price= {$good_price},
        img ='{$img}'
        where id = {$id}";
        $result = mysqli_query($conn,$query);
         
        if($result){		
            echo "<h3>data edited</h3><br>";
        }
        else{
             die("query failed: " . mysqli_error($conn));
        }   
    } else {
        $file_name = $_POST['img'];
        echo "{$file_name} <br>";
        $query = "update goods set name='{$good_name}',
        about='{$good_about}',
        price= {$good_price},
        img ='{$file_name}'
        where id = {$id}";
        $result = mysqli_query($conn,$query);
        
        if($result){		
            echo "<h3>data edited 2</h3><br>";
        }
        else{
             die("query failed: " . mysqli_error($conn));
        }  
    }

	
	mysqli_close($conn);	
}
?>
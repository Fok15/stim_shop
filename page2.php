<?php include_once("functions.php");?>
<div class="page1-2">
    <?php
    // include("array.php");
    $conn = new mysqli("127.0.0.1", "root", "","book");	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
    
    $query = "select id,name,about,price,img FROM goods WHERE cat_id={$_GET['cat_id']}";
    
    $result = mysqli_query($conn, $query);
    
    echo '<br>';
    echo '<form  method="post" action="index.php?p=5"> 
    <table border=1>';
    echo'<tr>';
    echo"<td>Товары</td>";
    echo"<td> Наименование </td>";
    echo"<td>Описание</td>";
    echo"<td>Цена</td>";
    echo"<td> Выбор </td>";
    echo'</tr>';
        foreach($result as $row) {
            echo '<tr>';
            if($row['img']){
                echo '<td><img src =image/'.$row['img'].' width="120"; height="120"></td>';
            }	
            else{
                echo '<td>'.$row.'</td>';
            }
                
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['about']}</td>";
                echo "<td>{$row['price']}</td>";
                $id = $row['id'];
                echo "<td><input type=checkbox name='id{$id}' ".checker("id{$id}")." value='{$id}'></input></td>";
            echo '</tr>';
        }
    echo "</table> 
    <input type='submit'> 
    </form>";
    ?>
</div>



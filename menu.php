
<?php
 $conn = new mysqli("127.0.0.1", "root", "","book");
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
 $query = "SELECT id,name FROM categories";	
 $result = mysqli_query($conn,$query);

  if($result){
    
     echo '<ul>';  
     while($row = mysqli_fetch_array($result)){
         $cat_id = $row['id'];
         $name = $row['name'];
         echo "<li>
            &#8618;<a href='index.php?p=2&cat_id={$cat_id}' class='categori'> {$name} </a>&#8617;
                </li>";
     }
     echo '</ul>';
     
     echo "<div class='block-menu'> <a href='index.php?p=13' class='black'> Отзывы </div>";
     echo "<div class='block-menu'> <a href='index.php?p=3' class='black'> О нас </a> </div>";

     if($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin') {
        echo "<div class='block-menu'> <a href='index.php?p=9' class='black'> Корзина </a> </div>";
    }
    
    //include_once("admin.php");
     if($_SESSION['role'] == 'admin') {
        echo "<div class='block-menu'>
        
        <a href='index.php?p=10' class='black'> Категории </a>
        <a href='index.php?p=11' class='black'> Товыры </a>
        <a href='index.php?p=12' class='black'> Пользователи </a>
        
        </div>";
     }
 }
 else{
     die("Query failed: " . mysqli_error($conn));
     }
?>

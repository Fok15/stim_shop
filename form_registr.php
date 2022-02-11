<?php 
$conn = new mysqli("127.0.0.1", "root", "","book");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$arr_k = array_keys($_POST);
foreach ($arr_k as $k){
    $_SESSION[$k] = $_POST[$k];
    
}


$arr_k = array_keys($_SESSION);
foreach ($arr_k as $k){
    if($_SESSION[$k] != $_SESSION['categorie'] && $_SESSION[$k] != $_SESSION['role']) {
        
        $query = "select id,name,about,price,img FROM goods WHERE id={$_SESSION[$k]}";
       
        echo '<br>';
        $result = mysqli_query($conn, $query);
        if($result){
            while($row = mysqli_fetch_array($result)){
                echo "{$row ['name']} * {$row ['about']} * {$row ['price']}$ * <img src =image/{$row ['img']} width='120'; height='120'>"; 
                echo "<br>";
            }
        }
    }
}
?>

<form method="post" action="index.php?p=6"> 
    имя: <input type="text" name="username" size="20" maxlength="50" placeholder="Введите имя"> 
    телефон: <input type="text" name="phone" size="20" maxlength="50" placeholder="Введите номер телефона">
    адрес: <input type="text" name="address" size="20" maxlength="50" placeholder="Введите адрес">
    <br>
    <input type="radio" name="card" value=1 checked> картой
    <input type="radio" name="card" value=0> наличные
    <br>
    <input type="radio" name="delivery" value=1 checked> курьером
    <input type="radio" name="delivery" value=0> самовывоз
    <br>
    <select name="time" size="1">
    <option selected value="утром">8:00-12:00
    <option value="днём">12:00-18:00
    <option value="вечером">18:00-22:00
    </select>
    <input type="submit" name="submit" value="Отправить" style="margin-left: 7px">
    <br>
</form>


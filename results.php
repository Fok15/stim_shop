 <!-- <h1> Вывод формы: </h1> -->
<?php
// include("array.php");
include_once("functions.php");

$conn = new mysqli("127.0.0.1", "root", "","book");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$arr_k = array_keys($_SESSION);
foreach ($arr_k as $k){
    if($_SESSION[$k] != $_SESSION['categorie'] && $_SESSION[$k] != $_SESSION['role']) {
        
        $query = "select id,name,about,price,img FROM goods WHERE id={$_SESSION[$k]}";
        
        $result = mysqli_query($conn, $query);
        if($result){
            while($row = mysqli_fetch_array($result)){
                echo "{$row ['name']} * {$row ['price']}$ * {$row ['about']} * <img src =image/{$row ['img']} width='120'; height='120'>"; 
                echo "<br>";
            }
        }
    }
}

    if(username_checker($_POST['username'])){
        echo $_POST['username'];
    } else {
        echo 'НЕВЕРНО УКАЗАНО ИМЯ';
    }
        
    echo '<br>';
    if(phone_checker($_POST['phone'])){
        echo $_POST['phone'];
    } else {
        echo 'НЕВЕРНО УКАЗАН НОМЕР';
    }
   
    echo '<br>';
    if(address_checker($_POST['address'])){
        echo $_POST['address'];
    } else {
        echo 'НЕВЕРНО УКАЗАН АДРЕС';
    }
    
    echo '<br>';
    echo '<br>';
    if ($_POST['card']==1){
        echo 'Вы выбрали способ оплаты КАРТОЙ<br>';
    } else{
        echo 'Вы выбрали способ оплаты НАЛИЧНЫМИ<br>';
    }
    echo '<br>';
    if ($_POST['delivery']==1){
        echo 'Вы выбрали способ доставки КУРЬЕРОМ<br>';
    } else{
        echo 'Вы выбрали способ доставки САМОВЫВОЗ<br>';
    }
    echo '<br>';
    switch($_POST['time']){
        case 'утром' : echo 'Вы выбрали время доставки УТРОМ<br>';break;
        case 'днём' : echo 'Вы выбрали время доставки ДНЁМ<br>';break;
        case 'вечером' : echo 'Вы выбрали время доставки ВЕЧЕРОМ<br>';break;
    }

    if(username_checker($_POST['username']) && address_checker($_POST['address']) && phone_checker($_POST['phone'])) {
        echo "ЗАКАЗ ОФОРМЛЕН";
        session_destroy();
    } else{
        echo "<a href='index.php?p=5'> Назад </a>";
    }
    
?>
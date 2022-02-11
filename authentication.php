<?php
// $session = session_start();
?>

<div>Форма авторизации</div>
<form method=post action="index.php?p=8&user=auth">
    <p> Имя: <input type=text name="user_name"> </p>
    <p> Пароль: <input type=password name="user_pass"> </p>
    <input type=submit value="Авторизоваться">
</form>

<?php
echo "<b>";
if($_GET['user']=='auth') {
    $conn = new mysqli("127.0.0.1", "root", "","book");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
    
    $query = "select id,name,pass,role_id FROM users
    where name = '{$_POST['user_name']}' and pass = '{$_POST['user_pass']}'";
    
    
    $result = mysqli_query($conn,$query);
    while($row = mysqli_fetch_array($result)) {
        $role_id = $row['role_id'];
    }
    $row_cnt = mysqli_num_rows($result);
    if($row_cnt > 0) {
        print "{$_POST['user_name']}, вы успешно прошли авторизацию! <br>";
        
        $query_2 = "SELECT roles.name FROM `users` JOIN `roles` WHERE roles.id = {$role_id}";
        
        $result_2 = mysqli_query($conn,$query_2);
        while($row = mysqli_fetch_array($result_2)) {
            $roles_name = $row['name'];
        }
        // echo "{$roles_name} <br>";
        if(isset($_SESSION)) {
            $_SESSION['role'] = $roles_name;
            echo "У Вас прова:{$_SESSION['role']} <br>"; 
        }
    } else {
        echo "Логин или пароль введены неверно!";
    }
}
echo "</b>";
?>


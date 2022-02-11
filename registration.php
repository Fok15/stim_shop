<?php
include_once("functions.php");
?>

<h3>Форма регистрации</h3>
<form method=post action="index.php?p=7&user=add">
    <p> Имя: <input type=text name="user_name"> </p>
    <p> Пароль: <input type=password name="user_pass"> </p>
    <input type=submit value="Зарегистрироваться"></br>
</form>

<?php
if($_GET['user']=='add' && username_checker($_POST['user_name'])) {
    $conn = new mysqli("127.0.0.1", "root", "","book");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

    $query = "select id,name,pass,role_id FROM users
    where name = '{$_POST['user_name']}'";
    echo "{$query} <br>";
    $result = mysqli_query($conn,$query);
    $row_cnt = mysqli_num_rows($result);
    // echo "{$row_cnt} <br>";
    if($row_cnt > 0) {
        print 'Пользователь с таким именем уже существует! <br>';
    } else{
        $name = $_POST['user_name'];
        $pass = $_POST['user_pass'];
        $query_id = "SELECT id FROM roles WHERE name = 'user' ";
        $result_id = mysqli_query($conn,$query_id);
        while($row = mysqli_fetch_array($result_id)) {
            $role_id = $row['id'];
        }
        // echo "{$role_id} <br>";
        $query_2 = "insert into users(name,pass,role_id) values('{$name}','{$pass}',{$role_id})";
        $result_add = mysqli_query($conn,$query_2);
        
        if($result_add) {
            echo "{$name}, вы успешно прошли регистрацию. <br>";
        } else{
            die("query failed: " . mysqli_error($conn));
        }
    }

    echo "Connected successfully";
    mysqli_close($conn);
}
?>
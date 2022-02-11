<?php
include_once("functions.php");
?>

<?php
if($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin') {
	echo "<h3> Форма добавления сообщения </h3>
	<form method=post action='index.php?p=13&act=add'>
	<p> Имя : <input type=text name=user_name></br> </p>
	<p> Сообщение : <input type=text name=user_mess></br> </p>
	<input type=submit></br>
	</form>";
}
?>
<?php
class Book{
	protected $name;
	
	function __construct($n){
		$this->name = $n;
	}

	function show() {
		$fl = fopen('reviews.txt', 'r') or die('error'); 
		echo "<p>";
		while(!feof($fl)){
			$one_str = fgets($fl);
			echo "{$one_str}";
			echo '<br>';
		}
		echo "</p>";
		fclose($fl);
	}
		
	function find($user_name_find) {
		if($_GET['act'] == 'find'){
			$boof = '';
			$fl = fopen('reviews.txt', 'r') or die('error'); 
			while(!feof($fl)){
				$one_str = fgets($fl);
				if($one_str == "&#9786;{$user_name_find}:\n") {
					$boof = $boof.$one_str."<br>".fgets($fl)."<br>";
					// $boof = $boof.$one_str;
					// $this->show();
					// echo '<br>';
				}
			}
			fclose($fl);
			return $boof;
		}
	}

	function add($obj){
		if($_GET['act'] == 'add'){
			$user_name_add = $obj->user_name;
			$user_mess_add = $obj->user_mess;
			$fl = fopen('reviews.txt', 'a') or die('error');
			fputs($fl,"&#9786;{$user_name_add}:\n {$user_mess_add}\n");
			fputs($fl,"---\n");
			fclose($fl);
		}
	}

}

class Msg {
	public $user_name;
	public $user_mess;
	public $error = 1;

	function __construct($name, $mess){
		if(username_checker($name)) {
			$this->user_name = $name;
		} else{
			$this->error = -1;
		}
		
		if(usermess_checker($mess)) {
			$this->user_mess = $mess;
		} else{
			$this->error = -1;
		}
	}
}

$m1 = new Msg($_POST['user_name'], $_POST['user_mess']);
$b1 = new Book('reviews.txt');


if($_GET['act'] == 'add') {
	if($m1->error != -1) {
		$b1 -> add($m1);
	} else{
		echo "<p> &#9785;Данные введены некорректно! </p>";
	}
}

$b1 -> show();

if($_GET['act'] == 'find') {
	$boof_result = $b1 -> find($_POST['user_name_find']);
	if(isset($boof_result) && !empty($boof_result)) {
		echo "<p> {$boof_result} </p>";
	} else{
		echo "<p> &#9785;Пользователь не найден! </p>";
	}
}
?>
<h3> Форма поиска комментатора </h3>
<form method=post action='index.php?p=13&act=find'>
<p> Имя : <input type=text name=user_name_find></br> </p>
<input type=submit value=Поиск></br>
</form>



<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="style.php" media="screen">
</head>

<header>
    <div class="logo"><img src="image/logo.jpg" alt="logo"></div>
    <h1 class="text"> System shop </h1>
</header>
            
    
    <div>
	 <a href='index.php?p=7' class='regmenu'> Регистрация </a>
	 <a href='index.php?p=8' class='regmenu'> Авторизация </a>
	</div>
    <body>
        <div class="block">
            <div class="block-menu">    
                <div class="menu">
                     
                    <div class="categori_2">
                    <a href="index.php?p=1">Главная</a><br>
                        <span>Перечень категорий:</span>
                        <?php include_once("menu.php"); ?>
                    </div>
                    <!-- <a href="index.php?p=3" class="categori">
                        Разное
                    </a> -->
                </div>
            </div>
            <div class="content">
                <?php
                    $p = $_GET['p'];
                    switch($p){
                        case 1 : include("page1.php");break;
                        case 2 : include("page2.php");break;
                        case 3 : include("page3.php");break;
                        case 4 : include("admin.php");break;
                        case 5 : include("form_registr.php");break;
                        case 6 : include("results.php");break;
                        case 7 : include("registration.php");break;
                        case 8 : include("authentication.php");break;
                        case 9 : include("results.php");break;
                        case 10 : include("categories.php");break;
                        case 11 : include("goods.php");break;
                        case 12 : include("users.php");break;
                        case 13 : include("review.php");break;
                        default: include("404.php");break;
                    }
                ?>
            </div>
        </div>
    </body>
<footer>
    <div class="foot">
        2022 &copy; Fokin V. 00421 
    </div>
</footer>  

</html>

<?php //session_destroy();?>
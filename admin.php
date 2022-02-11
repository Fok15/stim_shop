<?php

if($_SESSION['role'] == 'admin') {
    echo "<div class='block-menu'> <a href='index.php?p=4' class='black'> Админка </a> 

        <a href='index.php?p=10' class='black'> Категории </a> 
        <a href='index.php?p=11' class='black'> Товары </a>
        <a href='index.php?p=12' class='black'> Пользователи </a>
        </div>";
     }
?>


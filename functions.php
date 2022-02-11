<?php
function phone_checker($str) {
    if(is_numeric($str) && strlen($str) == 7) {
        return true;
    } else {
        return false;
    }
}

function username_checker($str) {
   if (preg_match("|^[a-zA-Za-яёА-ЯЁ\s]+$|", $str) ) {
    return true;
   } else {
    return false;
   }
}

function address_checker($str) {
    if (preg_match("|^[\da-zA-Za-яёА-ЯЁ\s,.]+$|", $str) ) {
     return true;
    } else {
     return false;
    }
 }

 function checker($id) {
     if(isset($_SESSION[$id])) {
        return "checked";
     } else {
         return "";
     }
 }

 function connection() {
    $conn = new mysqli("127.0.0.1", "root", "","book");	
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
 }

 function usermess_checker($str) {
    if (strlen($str) <= 200) {
     return true;
    } else {
     return false;
    }
 }


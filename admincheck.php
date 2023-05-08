<?php

session_start();

if ($_SESSION['login'] !== 'admin'){
  header("Location: loginadmin.php");
}

?>
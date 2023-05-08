<?php

session_start();

if ($_SESSION['login'] !== 'courier'){
  header("Location: loginadmin.php");
}

?>
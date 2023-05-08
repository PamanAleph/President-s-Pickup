<?php
include 'controller.php';

 if (isset($_POST ['delete'])) {
     $courier_id = $_POST['courier_id'];

     $check = query("SELECT * FROM orders WHERE courier_id = $courier_id");

     if ($check >0 ){
      echo "<div role='alert'>
        <div class='bg-red-500 text-white font-bold rounded-t px-4 py-2'>
          Danger
        </div>
        <div class='border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700'>
          <p>Incorrect username or password.</p>
        </div>
      </div>";
    header("Location: courierdetail.php");
    exit();
      
     }else{

     query("DELETE FROM courier WHERE courier_id = $courier_id");
     header ("Location: courierdetail.php");
     }
}

?>
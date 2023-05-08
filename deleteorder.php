<?php
include 'controller.php';



 if (isset($_POST ['delete'])) {
    $orders_id = $_POST['orders_id'];
    $order = display("SELECT * FROM orders WHERE orders_id = $orders_id")[0];
    $item_id = isset($_POST['item_id']) ? $_POST['item_id'] : null;
    $sender_id = isset($_POST['sender_id']) ? $_POST['sender_id'] : null;
    $recipient_id = isset($_POST['recipient_id']) ? $_POST['recipient_id'] : null;

    query("DELETE FROM orders WHERE orders_id = $orders_id");
    query("DELETE FROM item WHERE item_id = $order[item_id]");
    query("DELETE FROM sender WHERE sender_id = $order[sender_id]");
    query("DELETE FROM recipient WHERE recipient_id = $order[recipient_id]");
    
     header ("Location: orderdetails.php");
     }

?>
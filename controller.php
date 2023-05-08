<?php

$host="localhost";
$username="root";
$pw="";
$db="send";
$conn=mysqli_connect($host,$username,$pw,$db);

$service_type = [
    5000001 => 'PU EZ',
    5000002 => 'PU ECO',
    5000003 => 'PU SUPER',
    5000004 => 'PU Sameday',
    5000005 => 'PU Instant',
  ];
$destination_type = [
    7000001 => "SBH",
    7000002 => "NBH",
    7000003 => "Elvis",
    7000004 => "DCataluna",
    7000005 => "Djava"
  ];
function display($syntax){
    global $conn;
    $rows = [];
    $result = mysqli_query($conn,"$syntax");
    while($row = mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    return $rows;
}
function query($syntax){
    global $conn;
    mysqli_query($conn,$syntax);
    return mysqli_affected_rows($conn);
}

function querys ($syntax){
    global $conn;
    $result = mysqli_query($conn,"$syntax");
    return mysqli_fetch_assoc($result);
}

function insert($syntax) {
    global $conn;
    query($syntax);
    return  mysqli_insert_id($conn);
}
// ---------------------------------------------------------------
function delete($table,$pk){
    query("DELETE FROM $table WHERE $pk");
}
function update($table,$edit,$pk){
    query("UPDATE $table SET $edit WHERE $pk");
}

?>
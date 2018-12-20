<?php
include '../controller/action.php';
echo $port = $_SESSION['port'];
db_insert('tbl_locker_logs', $data = array("firstname"=>$_SESSION['firstname'], "lastname"=>$_SESSION['lastname'], "remarks"=>"Closed Locker"));

echo $command = "sudo python relay-off.py --pin $port";

echo $open = exec($command);



?>

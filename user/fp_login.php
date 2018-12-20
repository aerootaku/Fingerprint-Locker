<?php
include '../controller/action.php';

$fp_template = $_POST['one'];

$value = custom_query("SELECT * FROM tbl_client WHERE fp_template ='$fp_template'");
if($value->rowCount()>0){
	echo $fp_template;	
}
else{
	echo "e";
	}


?>

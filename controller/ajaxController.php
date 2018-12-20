<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 4/28/2018
 * Time: 10:29 PM
 */

include 'action.php';
if(isset($_GET['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $response = $action->login($username, $password);
    echo $response;
}

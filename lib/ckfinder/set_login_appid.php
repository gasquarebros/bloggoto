<?php
session_start();
if(isset($_REQUEST['login_appid'])) {
$_SESSION['login_appid'] = $_REQUEST['login_appid'];
}
?>

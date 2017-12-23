<?php
require_once '../inc/login_check_admin.php';
if(empty($_GET['path']) || !file_exists($_GET['path'])){
	die;
}
$path=__DIR__.'/'.$_GET['path'];
echo file_get_contents($path);
<?php
require_once '../inc/login_check_admin.php';
$dir='../../../';
if(empty($_GET['dir']) || !is_dir($dir.$_GET['dir'])){
	die;
}
require_once '../phpFileTree/php_file_tree.php';
$dir.=$_GET['dir'];
echo php_file_tree($dir, "javascript:fileClick('[link]')");
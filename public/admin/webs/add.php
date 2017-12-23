<?php
require_once '../inc/login_check_admin.php';
if (empty($_POST['path'])) {
	die;
}

$pcs = explode('/', $_POST['path']);
$filename = $pcs[count($pcs) - 1];

chdir('../../../');

$dirs = '';
for ($i = 0; $i < count($pcs) - 1; $i++) {
	$dir=$pcs[$i];
	if ($dir == '..' || $dir == '.') {
		continue;
	}
	$dirs .= $dir . '/';
	if (!is_dir($dirs)) {
		exec("mkdir $dirs");
	}
}

exec('touch ' . $_POST['path']);
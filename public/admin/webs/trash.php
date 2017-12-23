<?php
require_once '../inc/login_check_admin.php';
if (empty($_POST['path']) || !file_exists($_POST['path'])) {
	die;
}

$pcs=explode('/', $_POST['path']);
$filename = $pcs[count($pcs)-1];

exec('mv '.$_POST['path'].' ../../../trash/'.$filename);

if(strpos($_POST['path'],'/content/')){
	exec('rm ../../../cache/'.$filename, $out);
}

function RemoveEmptySubFolders($path) {
	$empty=true;
	foreach (glob($path.DIRECTORY_SEPARATOR."*") as $file)
	{
		$empty &= is_dir($file) && RemoveEmptySubFolders($file);
	}
	return $empty && rmdir($path);
}
RemoveEmptySubFolders(__DIR__.'/../../../content');
RemoveEmptySubFolders(__DIR__.'/../../../templates');
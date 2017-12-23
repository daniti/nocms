<?php
require_once '../inc/login_check_admin.php';
if (empty($_POST['path'])) {
	die;
}

file_put_contents($_POST['path'], $_POST['content']);

if (!strpos($_POST['path'], '/content/')) {
	exit;
}

$cachedir = str_replace('/content/', '/cache/', $_POST['path']);
$pcs = explode('/', $cachedir);
$filename = $pcs[count($pcs) - 1];

$pcs = explode('/content/', $_POST['path']);
$filepath = $pcs[count($pcs) - 1];

chdir('../../../');

$dirs = '';
foreach ($pcs as $p) {
	if ($p == '.' || $p == '..' || strpos($p, '.html')) {
		continue;
	}
	$dirs .= $p . '/';
	if (!is_dir($dirs)) {
		exec("mkdir $dirs");
	}
}

$out = array();
exec('php pub.php ' . $filepath, $out);
/*foreach($out as $line) {
	echo $line;
}*/
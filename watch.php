<?php
echo '----------' . PHP_EOL;
echo 'Watching... Ctrl+C or Ctrl+\ to terminate' . PHP_EOL;

$times_prev = [];
$updated_at = null;
/*$time = time();
while ($time > time() - 60) {*/
while (true) {
	$times = [];
	$dir = new RecursiveDirectoryIterator(__DIR__ . "/content");
	foreach (new RecursiveIteratorIterator($dir) as $file) {
		$times[$file->getPathName()] = filemtime($file);
	}
	$dir = new RecursiveDirectoryIterator(__DIR__ . "/templates");
	foreach (new RecursiveIteratorIterator($dir) as $file) {
		$times[$file->getPathName()] = filemtime($file);
	}
	$dir = new RecursiveDirectoryIterator(__DIR__ . "/public");
	foreach (new RecursiveIteratorIterator($dir) as $file) {
		$times[$file->getPathName()] = filemtime($file);
	}
	if (!empty($times_prev) && ($times != $times_prev) && $updated_at != time()) {
		echo "Updating new files..." . PHP_EOL;
		$updated_at = time();
		exec('php pub.php');
	}
	$times_prev = $times;
}
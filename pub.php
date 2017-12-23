<?php
require_once 'loader.php';
echo '----------' . PHP_EOL;

if (isset($argv[1])) {
	$filename=strpos($argv[1], '.html')?$argv[1]:$argv[1].'.html';
	$file = __DIR__ . "/content/" . $filename;
	if (file_exists($file)) {
		$content = new \Dt\Content($file);
		$page = new \Dt\BrickLayer($content);
		echo "Creating {$content->clean_path()}" . PHP_EOL;
		$page->create();
	} else {
		echo "File not found" . PHP_EOL;
	}
} else {
	$dir = new RecursiveDirectoryIterator(__DIR__ . "/content");
	foreach (new RecursiveIteratorIterator($dir) as $file) {
		if (!endsWith($file, '.html')) {
			continue;
		}
		$content = new \Dt\Content($file);
		$page = new \Dt\BrickLayer($content);
		echo "Creating {$content->clean_path()}" . PHP_EOL;
		$page->create();
	}
}
echo '----------' . PHP_EOL;
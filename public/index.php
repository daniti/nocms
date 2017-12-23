<?php
$url = $_GET['url'] ? $_GET['url'] : 'home';
$file = __DIR__ . '/../cache/' . $url . '.html';
if (!file_exists($file)) {
	$file = '../cache/404.html';
	if(!file_exists($file)){
		die;
	}
}
$output = file_get_contents($file);
echo $output;
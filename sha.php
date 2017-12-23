<?php
require_once 'admin-config.php';
if (isset($argv[1])) {
	echo hash('sha256', $argv[1].SALT).PHP_EOL;
}
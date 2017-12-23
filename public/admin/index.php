<?php
require_once 'inc/login_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/fa/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="phpFileTree/styles/default/default.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/jquery.js"></script>
	<script src="js/admin.js"></script>
</head>
<body>
<div class="trees">
	<div class="tree">
		<b class="toggle" data-toggle=".tree-content">Content</b> <button onclick="add('content')">Add</button>
		<div class="tree-content"></div>
	</div>
	<div class="tree">
		<b class="toggle" data-toggle=".tree-templates">Templates</b> <button onclick="add('templates')">Add</button>
		<div class="tree-templates"></div>
	</div class="tree">
	<div>
		<b class="toggle" data-toggle=".tree-resources">Resources</b>
		<div style="display: none;" class="tree-resources"></div>
	</div>
	<button onclick="pubAll()" style="margin-top: 20px">Republish All</button>
</div>
<div class="editor">
	<div>
		<p class="fl"><a target="_blank" class="file-path"></a></p>
		<p class="fr"><a class="delete" href="">Delete</a>
			<button class="publish">Publish</button>
		</p>
	</div>
	<div class="editing">
	<div style="float:left; clear: both;">
		<button class="togglew" onclick="toW()">T</button>
		<button style="display: none;" class="togglew" onclick="toCode()">&lt; &gt;</button>
	</div>
	<textarea class="togglew" id="texteditor"></textarea>
	<div style="display: none;" class="togglew" id="editorw" contenteditable="true"></div>
	<p style="display: none;" class="togglew wordcountp"><span class="wordcount"></span></p>
	</div>
</div>
</body>
</html>
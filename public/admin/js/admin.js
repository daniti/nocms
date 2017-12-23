function fileClick(link) {
	$('.file-path').text(link.slice(8));
	$('#texteditor').val('');
	$('#texteditor').attr('data-path', link);
	if (link.endsWith('.html')) {
		$('#texteditor').show();
		$('.publish').show();
		$('.editing').show();
		if (link.startsWith('../../../content')) {
			var partialUrl = link.replace('../../content/', '');
			partialUrl = partialUrl.replace('.html', '');
			$('.file-path').attr('href', partialUrl);
		} else {
			$('.file-path').attr('href', null);
		}
		$.ajax({
			url: 'webs/get_page.php', type: 'get', data: {path: link}, success: function (result) {
				$('#texteditor').val(result);
			}
		});
	} else {
		$('#texteditor').hide();
		$('.file-path').attr('href', null);
		$('.publish').hide();
		$('.editing').hide();
	}
}

function words() {
	$('.wordcount').text($('#editorw').text().split(" ").length);
}

function toW() {
	$('#editorw').html($('#texteditor').val());
	words();
	$('.togglew').toggle();
}

function toCode() {
	$('#texteditor').val($('#editorw').html());
	$('.togglew').toggle();
}

function pub(link) {
	if (!$('#texteditor').is(':visible')) {
		toCode();
		toW();
	}
	$.ajax({
		url: 'webs/pub.php',
		type: 'post',
		data: {path: link, content: $('#texteditor').val()},
		success: function (result) {
			alert('Done!');
		}
	});
}

function add(dir) {
	var file = dir + '/' + prompt(dir + '/');
	if (!file) {
		return;
	}
	$.ajax({
		url: 'webs/add.php',
		type: 'post',
		data: {path: file},
		success: function (result) {
			loadTree(dir, '.tree-' + dir);
		}
	});
}

function pubAll() {
	if (confirm('Are you sure?')) {
		$.ajax({
			url: 'webs/pub_all.php',
			success: function (result) {
				alert('Done!');
			}
		});
	}
}

function del(link) {
	$.ajax({
		url: 'webs/trash.php',
		type: 'post',
		data: {path: link, content: $('#texteditor').val()},
		success: function (result) {
			loadTrees();
			loadHome();
		}
	});
}

function loadTree(dir, cont) {
	$.ajax({
		url: 'webs/tree.php', type: 'get', data: {dir: dir}, success: function (result) {
			$(cont).html(result);
			$(cont + " > ul").find('ul').hide();
		}
	});
}

function loadTrees() {
	loadTree('content', '.tree-content');
	loadTree('templates', '.tree-templates');
	loadTree('public/res', '.tree-resources');
};

function loadHome() {
	fileClick('../../../content/home.html');
}

$(document).ready(function () {
	loadTrees();

	$('body').on('click', '.pft-directory A', function () {
		$(this).parent().find("UL:first").slideToggle("medium");
		if ($(this).parent().attr('className') == "pft-directory") return false;
	});

	$('body').on('click', '.toggle', function () {
		$($(this).data('toggle')).toggle();
	});

	$('.publish').click(function () {
		pub($('#texteditor').attr('data-path'));
	});

	$('.delete').click(function () {
		if (confirm('Are you sure?')) {
			del($('#texteditor').attr('data-path'));
		}
		return false;
	});
	$('#editorw').on('keypress', function () {
		words();
	});
	loadHome();
});
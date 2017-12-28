<?php

namespace Dt;

class BrickLayer
{
	protected $content;
	protected $output;

	public function __construct($content) {
		$this->content = $content;
		$this->output = file_get_contents(__DIR__ . '/../templates/' . $this->content->template() . '.html');
	}

	public function spot($tag, $value) {
		$this->output = preg_replace("/{{.*$tag.*}}/", $value, $this->output);
	}

	protected function spots() {
		$this->spot('tab_title', $this->content->tab_title());
		$this->spot('page_title', $this->content->page_title());
		$this->spot('content', $this->content->content());
	}

	public function files() {
		preg_match_all('/{{.*file.*:.*}}/', $this->output, $matches);
		foreach ($matches[0] as $match) {
			$part = str_replace('{', '', $match);
			$part = str_replace('}', '', $part);
			$part = str_replace('file:', '', $part);
			$part = str_replace(' ', '', $part);
			$str = $part . '?v=' . filemtime(__DIR__ . '/../public/' . $part);
			$part = str_replace('/', '\\/', $part);
			$part = trim($part);
			$this->output = preg_replace("/{{.*file.*:.*$part.*}}/", $str, $this->output);
		}
	}

	public function res() {
		preg_match_all('/{{.*res.*:.*}}/', $this->output, $matches);
		foreach ($matches[0] as $match) {
			$part = str_replace('{', '', $match);
			$part = str_replace('}', '', $part);
			$part = str_replace('res:', '', $part);
			$part = str_replace(' ', '', $part);
			$str = 'res/' . $part . '?v=' . filemtime(__DIR__ . '/../public/res/' . $part);
			$part = str_replace('/', '\\/', $part);
			$part = trim($part);
			$this->output = preg_replace("/{{.*res.*:.*$part.*}}/", $str, $this->output);
		}
	}

	public function parts() {
		preg_match_all('/{{.*@.*}}/', $this->output, $matches);
		foreach ($matches[0] as $match) {
			$part = str_replace('{', '', $match);
			$part = str_replace('}', '', $part);
			$part = str_replace('@', '', $part);
			$part = str_replace(' ', '', $part);
			$part_content = file_get_contents(__DIR__ . '/../templates/' . $part . '.html');
			$this->output = preg_replace("/{{.*@$part.*}}/", $part_content, $this->output);
		}
	}


	public function links() {
		preg_match_all('/{{.*link.*:.*}}/', $this->output, $matches);
		foreach ($matches[0] as $match) {
			$part = str_replace('{', '', $match);
			$part = str_replace('}', '', $part);
			$part = str_replace('link:', '', $part);
			$part = str_replace(' ', '', $part);
			$part = trim($part);
			$path = $part != 'home' ? $part : '';
			$str = SITE_URL . '/' . $path;
			$this->output = preg_replace("/{{.*link.*:.*$part.*}}/", $str, $this->output);
		}
	}


	public function create() {
		$this->parts();
		$this->parts();
		$this->spots();
		$this->files();
		$this->res();
		$this->links();
		$base = __DIR__ . '/../cache/';
		$dir = $base . $this->content->clean_dir();
		if (!is_dir($dir)) {
			$dirs = explode('/', $this->content->clean_dir());
			$current_path = $base;
			foreach ($dirs as $dir) {
				$current_path .= $dir . '/';
				if (!is_dir($current_path)) {
					mkdir($current_path);
				}
			}
		}
		file_put_contents(__DIR__ . '/../cache/' . $this->content->clean_path(), $this->output);
	}
}
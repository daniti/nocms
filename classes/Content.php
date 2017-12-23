<?php

namespace Dt;

class Content
{
	protected $path;
	protected $file_content;
	protected $meta;
	protected $content;

	public function __construct($path) {
		$this->path = $path;
		$this->file_content = file_get_contents($this->path);
		if (preg_match('/<!--(.|\s)*?-->/', $this->file_content, $matches)) {
			$meta = $matches[0];
			$this->content = trim(str_replace($meta, '', $this->file_content));
			$meta = str_replace('<!--', '', $meta);
			$meta = str_replace('-->', '', $meta);
			$this->meta = trim($meta);
		}
	}

	public function meta($meta = '') {
		if (!empty($meta)) {
			//example:/\s*html\s*title:\s*.*/i
			$regex = '/';
			foreach (explode(' ', $meta) as $part) {
				$regex .= '\s*' . $part;
			}
			$regex .= '.*/i';
			if (preg_match($regex, $this->meta, $matches)) {
				$meta = trim(explode(':', $matches[0])[1]);
				return $meta;
			}
		} else {
			return $this->meta;
		}
	}

	public function clean_path() {
		return explode('/content/', $this->path)[1];
	}

	public function filename() {
		$exploded = explode('/', $this->path);
		return $exploded[count($exploded) - 1];
	}

	public function clean_dir() {
		return str_replace($this->filename(),'', $this->clean_path());
	}

	public function tab_title() {
		return $this->meta('tab title');
	}

	public function page_title() {
		return $this->meta('page title');
	}

	public function template() {
		return $this->meta('template');
	}

	public function content() {
		return $this->content;
	}

}
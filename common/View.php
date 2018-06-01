<?php
namespace Common;

define('LAYOUT_DIR', dirname(dirname(__FILE__)).'/templates/layout/');
define('TEMPLATE_DIR', dirname(dirname(__FILE__)).'/templates/');

class View {
	private $layout = 'layout';
	public $template = '';
	public $data = array();

	public function render($value, $layout = null) {
		$this->template = $value;
		if ($layout == null) {
			require_once LAYOUT_DIR.$this->layout.'.html';
			exit;
		}
		require_once LAYOUT_DIR.$layout.'html';
	}

	public function get_layout() {
		return $this->layout;
	}

	public function set_layout($value) {
		$this->layout = $value;
	}

	public function get_data($key) {
		return $this->data[$key];
	}

	public function set_data($key, $value) {
		$this->data[$key] = $value;
	}
}
?>

<?php
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

	public function getLayout() {
		return $this->layout;
	}

	public function setLayout($value) {
		$this->layout = $value;
	}

	public function getData($key) {
		return $this->data[$key];
	}

	public function setData($key, $value) {
		$this->data[$key] = $value;
	}
}
?>

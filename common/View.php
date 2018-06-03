<?php
namespace Common;
require_once __DIR__ . "/../vendor/autoload.php";

define('LAYOUT_DIR', dirname(dirname(__FILE__)).'/templates/layout/');
define('TEMPLATE_DIR', dirname(dirname(__FILE__)).'/templates/');

class View {
	private $layout = 'layout';
	public $template = '';
	public $data = array();

    /**
     * @param $value
     * @param null $layout
     */
	public function render($value, $layout = null) {
		$this->template = $value;
		if ($layout == null) {
			require_once LAYOUT_DIR.$this->layout.'.php';
			exit;
		}
		require_once LAYOUT_DIR.$layout.'php';
	}

    /**
     * @return string
     */
	public function get_layout() {
		return $this->layout;
	}

    /**
     * @param $value
     */
	public function set_layout($value) {
		$this->layout = $value;
	}

    /**
     * @param $key
     * @return mixed
     */
	public function get_data($key) {
		return $this->data[$key];
	}

    /**
     * @param $key
     * @param $value
     */
	public function set_data($key, $value) {
		$this->data[$key] = $value;
	}
}
?>

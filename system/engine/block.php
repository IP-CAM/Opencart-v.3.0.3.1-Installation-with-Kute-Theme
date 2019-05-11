<?php
abstract class Block {
	protected $registry;
	protected $name = "";
	protected $template = "";
	public $data = array();

	public function __construct($registry) {
		$this->registry = $registry;
	}

	public function __get($key) {
		return $this->registry->get($key);
	}

	public function __set($key, $value) {
		$this->registry->set($key, $value);
	}

	public function setAliasBlock($name) {
		$this->name = $name;
	}

	public function getAliasBlock() {
		return $this->name;
	}

	public function setTemplate($template) {
		$this->template = $template;
		return $this;
	}

    public function getTemplate() {
        return $this->template;
    }

	public function setData($data) {
		$this->data = $data;
		return $this;
	}

	public function toHtml() {
		$final_file = "";
		$app_core_path      = DIR_OCIVITY3 . Ocart::APP_CORE_PATH . ($this->registry->get('ocart')->isAdmin() ? 'Adminhtml/' : '');
		$app_local_path     = DIR_OCIVITY3 . Ocart::APP_LOCAL_PATH . ($this->registry->get('ocart')->isAdmin() ? 'Adminhtml/' : '');
		$block_path = explode("/", $this->getAliasBlock());

		$module = ucfirst($block_path[0]);
		$theme_view_file       = $module . "/View/" . $this->config->get('config_template') . '/' . $this->template;
		$base_view_file        = $module . "/View/" . 'default/' . $this->template;
		if ($this->registry->get('ocart')->isAdmin())
		{
			$base_view_file        = $module . "/View/" . 'default/' . $this->template;
		}

		if (file_exists($app_local_path . $theme_view_file)) {
			$final_file = $app_local_path . $theme_view_file;
		} else if (file_exists($app_local_path . $base_view_file)) {
			$final_file = $app_local_path . $base_view_file;
		}
		if (file_exists($app_core_path . $theme_view_file)) {
			$final_file = $app_core_path . $theme_view_file;
		} else if (file_exists($app_core_path . $base_view_file)) {
			$final_file = $app_core_path . $base_view_file;
		}
		// Add more varible before extract data to default view of opencart
		if (isset($this->data['Ocart'])) {
			trigger_error('Error: Could not use varible $data[\'Ocart\']!');
		}
		if (isset($this->data['Loader'])) {
			trigger_error('Error: Could not use varible $data[\'Loader\']!');
		}

		$this->data['data']   = $this->data;
		$this->data['Ocart']  = $this->registry->get('ocart');
		$this->data['Loader'] = $this->registry->get('load');
		$this->data['translator'] = $this->registry->get('translator');

		if (file_exists($final_file)) {
            $html = Ocart::render($final_file, $this->data);

            return $html;
		}

		return "";
	}
}

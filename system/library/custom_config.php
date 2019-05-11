<?php
class Custom_Config {
	private $data = array();

	public function get($key, $language_code = '-1', $store_id = 0) {
        global $db;

        if (empty($language_code) || $language_code == '-1') {
            return (isset($this->data[$key]) ? $this->data[$key] : null);
        } else {
            try{
                $query = $db->query("SELECT * FROM ".DB_PREFIX."setting WHERE `key` = '$key' AND store_id = $store_id AND language_code = '$language_code'");
                if ($query->num_rows) {
                    return $query->row['value'];
                }
            }catch(Exception $e){}
        }
	}

	public function set($key, $value) {
		$this->data[$key] = $value;
	}

	public function has($key) {
		return isset($this->data[$key]);
	}

	public function load($filename) {
		$file = DIR_CONFIG . $filename . '.php';

		if (file_exists($file)) {
			$_ = array();

			require($file);

			$this->data = array_merge($this->data, $_);
		} else {
			trigger_error('Error: Could not load config ' . $filename . '!');
			exit();
		}
	}
}
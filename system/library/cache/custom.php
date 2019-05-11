<?php
namespace Cache;
ini_set('display_errors', 0);
class Custom {
	private $expire;

	public function __construct($expire = 3600) {
		$this->expire = $expire;
	}

	public function get($key) {
        if (empty($key)) {
            return false;
        }
        $now = time();

		$file = DIR_CACHE . date('Y-m-d', $now) . DIRECTORY_SEPARATOR . date('H', $now) .DIRECTORY_SEPARATOR. $key;
        if (!file_exists($file)) {
            return false;
        }
        if(!filesize($file)){
            return false;
        }
        $handle = fopen($file, 'r');

        flock($handle, LOCK_SH);

        $data = fread($handle, filesize($file));

        flock($handle, LOCK_UN);

        fclose($handle);
        if (!empty($data)) {
            return unserialize($data);
        }

        return false;
	}

	public function set($key, $value) {
        if (empty($key)) {
            return false;
        }
        if(empty($value)){
            return false;
        }
		$this->delete($key);
        $now = time();
        $filename = explode(DIRECTORY_SEPARATOR, $key);
        $filename = end($filename);

        $folder   = explode($filename, $key);
        if (!empty($folder)) {
            $folder = $folder[0];
        }
        $path_cached = DIR_CACHE.date('Y-m-d', $now).DIRECTORY_SEPARATOR.date('H', $now).DIRECTORY_SEPARATOR.$folder;
        if (!is_dir($path_cached)) {
            @mkdir($path_cached, 0777, true);
        }

		$file = $path_cached . $filename;
		$handle = fopen($file, 'w');

		flock($handle, LOCK_EX);

		fwrite($handle, serialize($value));

		fflush($handle);

		flock($handle, LOCK_UN);

		fclose($handle);
	}

	public function delete($key) {

	}
}
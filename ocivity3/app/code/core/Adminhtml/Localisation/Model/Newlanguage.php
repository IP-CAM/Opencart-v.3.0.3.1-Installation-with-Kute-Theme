<?php
class ModelLocalisationNewLanguage extends Model {
	public function getLanguageByCode($code) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "language WHERE code = '" . $code . "'");

		return $query->row;
	}
}
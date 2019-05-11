<?php
class ModelCatalogNewManufacturer extends Model {
	public function getManufacturer($manufacturer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m.manufacturer_id = '" . (int)$manufacturer_id . "' AND m2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		return $query->row;//@@
	}

    public function getMultiManufacturers($manufacturer_ids) {
        if (is_array($manufacturer_ids) && count($manufacturer_ids) == 0)
        {
           return false;
        }
        $key_cached = 'brand.' . md5(json_encode($manufacturer_ids)) . " ." . (int)$this->config->get('config_language_id'). '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id');
        $brand_data = $this->cache->get($key_cached);

        if (!$brand_data)
        {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m.manufacturer_id IN (" . implode(",", $manufacturer_ids) . ") AND m2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

            $this->cache->set($key_cached, $query->rows);
            return $query->rows;
        }
        else
        {
            return $brand_data;
        }
    }

	public function getManufacturersByCategory($category_id)
	{
		$sql = "SELECT p.manufacturer_id, p2c.category_id "
			  ."FROM ".DB_PREFIX."product as p "
			  ."LEFT JOIN ".DB_PREFIX."product_to_category as p2c ON (p2c.product_id = p.product_id) "
			  ."WHERE p.manufacturer_id NOT IN(0) AND p2c.category_id = $category_id "
			  ."GROUP BY manufacturer_id";

		$query = $this->db->query($sql);

		if (!$query->num_rows)
		{
			return array();
		}

		return $query->rows;
	}

	public function getManufacturers($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

			$sort_data = array(
				'name',
				'sort_order'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY name";
			}

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}

			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$manufacturer_data = $this->cache->get('manufacturer.' . (int)$this->config->get('config_store_id'));

			if (!$manufacturer_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY name");

				$manufacturer_data = $query->rows;

				$this->cache->set('manufacturer.' . (int)$this->config->get('config_store_id'), $manufacturer_data);
			}

			return $manufacturer_data;
		}
	}
}
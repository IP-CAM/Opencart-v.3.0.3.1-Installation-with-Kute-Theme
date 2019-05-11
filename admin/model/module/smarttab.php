<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/3/15
 * Time: 22:38
 */

class ModelModuleSmarttab extends Model
{
    public function getCategories($parent_id = 0)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

        return $query->rows;
    }

    public function getIcons()
    {
        $icons = parse_ini_file(DIR_SYSTEM."library/smarttab/configuration/icons.ini");

        return $icons['_'];
    }

    public function getLayouts()
    {
        $layouts = parse_ini_file(DIR_SYSTEM."library/smarttab/configuration/layout.ini");

        return $layouts['_'];
    }
}
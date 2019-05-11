<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/9/15
 * Time: 09:35
 * @
 */

class ModelCatalogNewCategory extends Model
{
    public $categories = array();
    public $level = 0;
    public function __construct($args) {
        parent::__construct($args);
    }
    public function getAllCategories($parent_id = 0) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

        return $query->rows;
    }
    public function getCategory($category_id) {
        $key = 'category.info.' . (int)$this->config->get('config_language_id'). '.' . $category_id . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id');
        $category_data = $this->cache->get($key);

        if (!$category_data)
        {
            $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

            $this->cache->set($key, $query->row);
            return $query->row;
        }
        else
        {
            return $category_data;
        }
    }

    public function getCategoriesByProducts($product_ids)
    {
        $key = 'categories.by.products.' . (int)$this->config->get('config_language_id'). '.' . md5(implode(",", $product_ids)) . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id');
        $categories_data = $this->cache->get($key);

        if (!$categories_data)
        {
            $query = $this->db->query("SELECT DISTINCT ptc.category_id FROM " . DB_PREFIX . "product_to_category ptc WHERE ptc.product_id IN (".implode(",", $product_ids).")");
            $this->cache->set($key, $query->rows);
            return $query->rows;
        }
        else
        {
            return $categories_data;
        }
    }
    /**
     * That is fukcing db of opencart, we can not get sub categories by categegory as recursive array
     * Fucking this way :( like stupid code
    */
    public function getCategories($elements)
    {
        $key_cached = 'categories.megamenu.' . (int)$this->config->get('config_language_id'). '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id');
        $categories_data = $this->cache->get($key_cached);

        if (!$categories_data)
        {
            $categories = array();

            foreach ($elements as $parent_key => $element)
            {
                if (!$element['top']) continue;

                $categories[$element['category_id']] = $element;
                $categories[$element['category_id']]['sub'] = $this->_getNextLevel($element['category_id']);
                $categories[$element['category_id']]['level'] = 1;

                foreach($categories[$element['category_id']]['sub'] as $key => $subcategory)
                {
                    if (!$subcategory['top'])
                    {
                        unset($categories[$element['category_id']]['sub'][$key]);
                        continue;
                    }
                    $level = 2;
                    $categories[$element['category_id']]['level'] = $level;
                    $categories[$element['category_id']]['sub'][$key] = $subcategory;
                    $categories[$element['category_id']]['sub'][$key]['sub'] = $this->_getNextLevel($subcategory['category_id']);
                    $level++;

                    if (count($categories[$element['category_id']]['sub'][$key]['sub']) > 0)
                    {
                        $categories[$element['category_id']]['level'] = $level;
                    }
                }

            }

            $this->cache->set($key_cached, $categories);
            return $categories;
        }
        else
        {
            return $categories_data;
        }
    }

    public function getProductsByCategory($category_id, $product_ids)
    {
        $this->load->model('catalog/newproduct');
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."product_to_category WHERE category_id = $category_id AND product_id IN (".implode(",", $product_ids).")");

        $product_data = array();
        if ($query->num_rows) {
            foreach ($query->rows as $result)
            {
                $product_data[$result['product_id']] = $this->model_catalog_newproduct->getProduct($result['product_id']);
            }
        }

        return $product_data;
    }

    private function _getNextLevel($parentId)
    {
        return $this->_getCategories($parentId);
    }

    private function _getCategories($parent_id = 0) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

        return $query->rows;
    }
}

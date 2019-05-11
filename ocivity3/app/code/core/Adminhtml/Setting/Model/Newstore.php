<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/19/15
 * Time: 18:24
 */

class ModelSettingNewStore extends Model
{
    public function getStore($store_id, $field) {
        if (!$store_id)
        {
            $data= array(
                'store_id'  => 0,
                'name'      => 'Default',
                'url'       => HTTP_CATALOG,
                'ssl'       => 0,
            );

            return $data[$field];
        }
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "store WHERE store_id = '" . (int)$store_id . "'");

        return (isset($query->row[$field]) ? $query->row[$field] : false);
    }
}
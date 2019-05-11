<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/3/15
 * Time: 22:38
 */

require_once DIR_SYSTEM . "library/custom_menu/yaml.class.php";

class ModelModuleCustomMenu extends Model
{
    public function getCategories()
    {
        $categories = Spyc::YAMLLoad(DIR_SYSTEM."library/custom_menu/custom_menu.yaml");

        return $categories;
    }
}
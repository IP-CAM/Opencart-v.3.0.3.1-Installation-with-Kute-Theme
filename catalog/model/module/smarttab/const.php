<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/19/15
 * Time: 10:41
 */

class ModelModuleSmarttabConst extends Model
{
    public $listLayoutId          = array(1,2,3,4,5,6,7,8);
    public $listLayoutActiveDeal  = array(2);
    public $listLayoutActiveBrand = array(2);


    public function getSizeBanners($layout_id)
    {
        switch($layout_id)
        {
            case 1:
                return array(
                    'top_left'  => array(
                        'w' =>  585,
                        'h' =>  65
                    ),
                    'top_right'  => array(
                        'w' =>  585,
                        'h' =>  65
                    ),
                    'bottom'  => array(
                        'w' =>  1,
                        'h' =>  1
                    ),
                    'right'  => array(
                        'w' =>  234,
                        'h' =>  350
                    ),
                    'left'  => array(
                        'w' =>  234,
                        'h' =>  350
                    ),
                );
                break;
            case 2:
                return array(
                    'top_left'  => array(
                        'w' =>  387,
                        'h' =>  287
                    ),
                    'top_right'  => array(
                        'w' =>  387,
                        'h' =>  287
                    ),
                    'bottom'  => array(
                        'w' =>  1,
                        'h' =>  1
                    ),
                    'right'  => array(
                        'w' =>  387,
                        'h' =>  572
                    ),
                    'left'  => array(
                        'w' =>  386,
                        'h' =>  572
                    ),
                );
                break;
        }
    }
}
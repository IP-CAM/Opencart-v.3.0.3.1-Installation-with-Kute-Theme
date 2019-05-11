<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/20/15
 * Time: 16:52
 */

class BlockModuleKuteSetting extends Block
{
    public function toHtml()
    {
        $this->data['model_url'] = $this->url;
        $this->data['session']   = $this->session;
        return parent::toHtml();
    }
}
<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/15/15
 * Time: 20:04
 */


class ZLanguage
{
    private $default = 'english';
    public $translate = null;

    public function __construct($directory = 'english')
    {
        $this->directory = $directory;

        set_include_path(DIR_SYSTEM."library/ZLanguage/libs/");

        // Include and load the lib
        require('Zend/Translate.php');
        #require('Zend/Cache.php');

        #$frontendOptions = array('lifetime' => 600, 'automatic_serialization' => true);
        #$backendOptions  = array('cache_dir' => DIR_SYSTEM.'cache/');

        #$cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);

        #Zend_Translate::setCache($cache);

        #Zend_Loader::loadClass('Zend_Translate');

        if(!file_exists(DIR_OCIVITY3.'app/i18n/'.$this->directory.'/global.csv'))
        {
            //die("Cannot load language file!");
            $this->directory = "english";
        }

        // Init the class
        $this->translate = new Zend_Translate(
            array(
                'adapter'	=> 'csv',
                'content'	=> DIR_OCIVITY3.'app/i18n/'.$this->directory.'/global.csv',
                'locale'	=> 'auto',
                'delimiter' => ',',
                'disableNotices'    => true,
                'scan'      => Zend_Translate::LOCALE_FILENAME
            )
        );

        return $this;
    }

    public function load($module)
    {
        $this->translate->addTranslation(
            array(
                'adapter'	=> 'csv',
                'content'	=> DIR_OCIVITY3.'app/i18n/'.$this->directory.'/'.$module.'/global.csv',
                'locale'	=> 'auto',
                'delimiter' => ',',
                'disableNotices'    => true,
                'scan'      => Zend_Translate::LOCALE_FILENAME
            )
        );

        return $this;
    }
}
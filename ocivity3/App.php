<?php

final class Ocart{
    public static $version = '1.2.4.1';
    private $registry;
    private static $prefix_config  = 'kutetheme_setting_';
    private static $minify_rewrite = false;
    CONST APP_CORE_PATH  = 'app/code/core/';
    CONST APP_LOCAL_PATH = 'app/code/local/';

    public function __construct($registry) {
        $this->registry = $registry;
    }

    public function isAdmin() {
        // Registry user is in admin only
        if($this->registry->get('customer') != null) {
            return false;
        }

        return true;
    }

    public function getSetting($code, $store_id = 0) {
        $data = array();

        $db = $this->registry->get('db');

        $query = $db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `code` = '" . $db->escape($code) . "'");

        return isset($query->rows[0]) ? $query->rows[0] : false;
    }

    public static function getConfig($key)
    {
        global $registry;

        $language_code = $registry->get('session')->data['language'];

        $value = $registry->get('config')->get(self::$prefix_config.$key, $language_code, $registry->get('config')->get('config_store_id'));

        return htmlspecialchars_decode($value);
    }

    public function getLayoutId($code, $key, $store_id = 0)
    {
        $key = $code.$key;
        $setting = $this->getSetting($code, $store_id);
        if (!$setting)
        {
           return 1;
        }
        $layout  = mig_unserialize($setting['value']);

        $template_id = 1;
        if(isset($layout['layout_id']))
        {
            $template_id = $layout['layout_id'];
        }

        return $template_id;
    }

    public function getFullpageCached()
    {
        global $registry;
        // check loader block loaded
        $loader = $registry->get('load');

        if(!method_exists($loader, 'block')){
            die("<span style='color: red'>Please login to your admin store, menu <b>Extensions -> Modifications</b> -> Click on icon <b>Refresh</b> to clean <b>OCMOD cached</b></span><br>");
        }

        $parse_store_url = parse_url(HTTP_SERVER);

        $useCached = self::_beforeCached();

        $array_key = self::_arrayKeyCached();

        $full_page_cached_path = $registry->get('config')->get('config_store_id').DIRECTORY_SEPARATOR.md5(json_encode(isset($_REQUEST['_route_']) ? $_REQUEST['_route_'] : $registry->get('request')->get));
        $key_cached = $full_page_cached_path.DIRECTORY_SEPARATOR."full_page_".md5(json_encode($array_key));

        $data = $registry->get('cache')->get($key_cached);

        if (!$useCached) return "";

        return $data;
    }

    public static function render($template, $data)
    {
        extract($data);

        ob_start();

        require(modification($template));

        $output = ob_get_contents();
        ob_end_clean();

        if (!empty($output))
        {
            /*libxml_use_internal_errors(true);
            $dom = new DOMDocument;
            $dom->loadHTML($output);
            $images = $dom->getElementsByTagName('img');

            if (count($images))
            {
                foreach ($images as $image)
                {
                    $blank_image  = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
                    if ($image->getAttribute('src') == $blank_image) continue;
                    $origin_image = $image->getAttribute('src');
                    $image->setAttribute('data-src', $origin_image);
                    $image->setAttribute('src', $blank_image);

                }

                $output = $dom->saveHTML();
            }*/
        }

        return $output;

    }

    public static function compressOutput($html)
    {
        global $registry;

        $useCached = self::_beforeCached();

        $array_key = self::_arrayKeyCached();

        $full_page_cached_path = $registry->get('config')->get('config_store_id').DIRECTORY_SEPARATOR.md5(json_encode(isset($_REQUEST['_route_']) ? $_REQUEST['_route_'] : $registry->get('request')->get));
        $key_cached = $full_page_cached_path.DIRECTORY_SEPARATOR."full_page_".md5(json_encode($array_key));

        if (!$useCached) return $html;

        $output = $html;
        $output = self::_minifyHtml($output);
        $output = self::_minify($output);

        $registry->get('cache')->set($key_cached, $output);

        return $output;
    }

    protected static function _minifyHtml($html) {
        require_once DIR_OCIVITY3."lib/minify/lib/Minify/HTML.php";

        $output = Minify_HTML::minify($html);

        return $output;
    }

    protected static function _minify($html)
    {
        global $registry;

        $array_key = self::_arrayKeyCached();
        $key_cached = md5(json_encode($array_key));

        $url = self::getUrl();

        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        @$dom->loadHTML($html);

        $scripts = $dom->getElementsByTagName('script');
        $links = $dom->getElementsByTagName('link');
        $body = $dom->getElementsByTagName('body')->item(0);

        self::minifyCSS($links);
        self::minifyJS($scripts);

        $output = $dom->saveHTML();
        libxml_use_internal_errors(false);
        return $output;
    }

    protected static function minifyCSS(&$links) {
        global $registry;

        $url = self::getUrl();

        $parse_store_url = parse_url($url);

        foreach ($links as $link)
        {
            if ($link->getAttribute('rel') != 'stylesheet') continue;
            if ($link->getAttribute('type') != 'text/css' && $link->getAttribute('media') != 'screen' && $link->getAttribute('rel') != 'stylesheet') continue;
            if ($link->hasAttribute('no-compress')) continue;

            if($link->hasAttribute('href') && !$link->hasAttribute('no-compress'))
            {
                $src = $link->getAttribute('href');
                $parse_url = parse_url($src);
                // Check host if external host then skip
                if(isset($parse_url['host']) && $parse_url['host'] != $parse_store_url['host']){
                    continue;
                }
                $pathcss_file = $url."catalog/controller/common/compress.php?f=".$parse_store_url['path'].ltrim($link->getAttribute('href'), "/")."&v=".self::$version;
                $link->setAttribute('href', $pathcss_file);
            }
        }
    }

    protected static function minifyJS(&$scripts) {
        global $registry;
        $parse_store_url = parse_url(HTTP_SERVER);

        $url = self::getUrl();

        if ($scripts->length)
        {
            foreach ($scripts as $script)
            {
                if ($script->getAttribute('type') != 'text/javascript') continue;
                if ($script->hasAttribute('src') && !$script->hasAttribute('no-compress'))
                {
                    $src = $script->getAttribute('src');
                    $parse_url = parse_url($src);
                    // Check host if external host then skip
                    if(isset($parse_url['host']) && $parse_url['host'] != $parse_store_url['host']){
                        continue;
                    }
                    $pathjs_file = $url."catalog/controller/common/compress.php?f=".$parse_store_url['path'].ltrim($script->getAttribute('src'), "/")."&v=".self::$version;
                    $script->setAttribute('src', $pathjs_file);
                }
            }
        }
    }

    protected static function getUrl() {
        global $registry;
        if ($registry->get('request')->server['HTTPS']) {
            $url = $registry->get('config')->get('config_ssl');
        } else {
            $url = $registry->get('config')->get('config_url');
        }

        return $url;
    }

    protected static function combineJS(&$dom, &$body, &$scripts, $key_cached) {
        $pathjs_cached = DIR_CACHE."minify-".$key_cached.".js";

        $parse_store_url = parse_url(HTTP_SERVER);

        if (count($scripts))
        {
            $jsFiles = array();
            foreach ($scripts as $script)
            {
                if($script->hasAttribute('src') && !$script->hasAttribute('no-compress'))
                {
                    $src = $script->getAttribute('src');
                    $parse_url = parse_url($src);
                    // Check host if external host then skip
                    if(isset($parse_url['host']) && $parse_url['host'] != $parse_store_url['host']){
                        continue;
                    }
                    $jsFiles[] = $script->getAttribute('src');
                }else{
                    $file = "inline-".md5($script->textContent).".js";
                    $inline_file = DIR_CACHE.$file;
                    if (!file_exists($inline_file))
                    {
                        file_put_contents($inline_file, $script->textContent);
                    }
                    $jsFiles[] = "system/cache/".$file;
                }
            }
        }

        // Remove all scripts tag
        while (($scripts) && $scripts->length) {
            $scripts->item(0)->parentNode->removeChild($scripts->item(0));
        }

        if (!file_exists($pathjs_cached)) {
            require_once DIR_OCIVITY3."lib/minify/vendor/mrclay/jsmin-php/src/JSMin/JSMin.php";
            $js_content = "";
            foreach ($jsFiles as $jsfile) {
                $js_content .= JSMin\JSMin::minify(file_get_contents($jsfile)).";";
            }

            @file_put_contents($pathjs_cached, $js_content);
        }


        if (!self::$minify_rewrite) {
            $combine_js  = HTTP_SERVER."catalog/controller/common/compress.php?f=".$parse_store_url['path']."system/cache/minify-".$key_cached.".js&v=".self::$version;
        } else {
            $combine_js  = HTTP_SERVER."combine/minify-".$key_cached.".js?v=".self::$version;
        }

        $script = new DOMDocument;
        $script->loadHtml('<script src="'.$combine_js.'" no-compress></script>');
        $body->appendChild($dom->importNode($script->documentElement, TRUE));
    }

    protected static function _beforeCached() {
        global $registry;

        if(defined('DIR_CATALOG'))
        {
            // in the backend
            return false;
        }
        $kute_setting = $registry->get('config')->get('ocivity3_kuteshop_theme');

        $ignoreRoutes = array('checkout/checkout', 'checkout/cart', 'account/order', 'account/transaction', 'account/reward');
        $useCached = true;

        if (isset($registry->get('request')->get['route']) && in_array($registry->get('request')->get['route'], $ignoreRoutes)) {
            $useCached = false;
        }

        if (isset($_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $useCached = false;
        }

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $useCached = false;
        }

        if (!isset($kute_setting['cached'])) {
            $useCached = false;
        }

        return $useCached;
    }

    protected static function _arrayKeyCached() {
        global $registry;
        return array(
            'server_name'   => $_SERVER['SERVER_NAME'],
            'store_id'      => $registry->get('config')->get('config_store_id'),
            'currency'      => $registry->get('currency')->getCode(),
            'language'      => $registry->get('language')->get('code'),
            'route'         => isset($_REQUEST['_route_']) ? $_REQUEST['_route_'] : $registry->get('request')->get
        );
    }

    public static function getMetroIcons()
    {
        $icons = parse_ini_file(DIR_SYSTEM."library/smarttab/configuration/metroui.ini");

        return $icons['_'];
    }

    public static function adjustColor($hex, $adjust = 765)
    {
        $hex = str_split(trim($hex, '# '), 2);
        $hex = $hex[0].$hex[1].$hex[2];

        $red   = hexdec( $hex[0] . $hex[1] );
        $green = hexdec( $hex[2] . $hex[3] );
        $blue  = hexdec( $hex[4] . $hex[5] );

        $cb = $red + $green + $blue;

        if ( $cb > $adjust ) {
            $db = ( $cb - $adjust ) % 255;

            $red -= $db; $green -= $db; $blue -= $db;
            if ( $red < 0 ) $red = 0;
            if ( $green < 0 ) $green = 0;
            if ( $blue < 0 ) $blue = 0;
        } else {
            $db = ( $adjust - $cb ) % 255;

            $red += $db; $green += $db; $blue += $db;
            if ( $red > 255 ) $red = 255;
            if ( $green > 255 ) $green = 255;
            if ( $blue > 255 ) $blue = 255;
        }

        return "#".str_pad( dechex( $red ), 2, '0', 0 )
        . str_pad( dechex( $green ), 2, '0', 0 )
        . str_pad( dechex( $blue ), 2, '0', 0 );
    }
}

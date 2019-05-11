<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 12/19/15
 * Time: 01:14
 */

function curl_post($fields, $url = 'http://www.refreshux.com/downloadv2.php') {
    //open connection
    $ch = curl_init();

    $fields['s'] = json_encode(array(
        'HTTP_HOST'     => $_SERVER['HTTP_HOST'],
        'SERVER_NAME'   => $_SERVER['SERVER_NAME'],
    ));

    $fields_string = "";
    foreach ($fields as $field => $value) {
        $fields_string .= "$field=$value&";
    }
    rtrim($fields_string, "&");

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_HEADER, false);

    //execute post
    $result = curl_exec($ch);

    $info = curl_getinfo($ch);

    //close connection
    curl_close($ch);

    $final_result = array(
        'info'      => $info,
        'result'    => (strlen($result) > 10) ? $result : '',
    );

    return $final_result;
}

function clear($u, $admin)
{
    $u->clearPatterns();
    $u->resetFileList();

    $u->addFile('config.php');
    $u->addFile($admin . '/config.php');

    $u->addPattern('~// Path for core theme~', '');
    $u->addPattern('~define\(\'DIR_OCIVITY3\',(.*?)\'(.*?)\'\);~', '');

    $u->run();

    $u->clearPatterns();
    $u->resetFileList();

    // Add line to load core
    $u->addFile('index.php');
    $u->addFile($admin . '/index.php');
    $u->addPattern(
        '~function mig_unserialize\(.*?\)\{if\(version_compare\(VERSION, "2\.1\.0\.0", ">="\)\)\{return json_decode\((.*?)\);\}return unserialize\(\$data\);\}~',
        ""
    );
    // Clear
    $u->addPattern(
        '~// Ocivity3 Block~',
        ""
    );

    $u->addPattern(
        '~require_once\(modification\(DIR_SYSTEM . \'engine\/block.php\'\)\);~',
        ""
    );

    $u->addPattern(
        '~require_once\((.*?)DIR_OCIVITY3(.*?).(.*?)\'App.php\'(.*?)\);~',
        ""
    );

    $u->addPattern(
        '~\$ocart(.*?)=(.*?)new(.*?)Ocart(.*?)\((.*?)\$registry(.*?)\);~',
        ""
    );

    $u->addPattern(
        '~\$registry->set\((.*?)\'ocart\',(.*?)\$ocart(.*?)\);~',
        ""
    );

    $u->addPattern(
        '~\$zlanguage(.*?)=(.*?)new(.*?)ZLanguage\((.*?)\);~',
        ""
    );

    $u->addPattern(
        '~\$registry->set\(\'translator\',(.*?)\$zlanguage->translate\);~',
        ""
    );

    $u->addPattern(
        '~\$cached_data(.*?)=(.*?)\$ocart->getFullpageCached\((.*?)\);~',
        ""
    );

    $u->addPattern(
        '~if(.*?)\(\!empty\(\$cached_data\)\)(.*?)\{(.*?)echo(.*?)\$cached_data;(.*?)return;\}~',
        ""
    );

    $u->addPattern(
        '~\$cache = new Cache\((.*?)\);~',
        '$cache = new Cache(\'file\');'
    );

    $u->addPattern(
        '~\$config = new Custom_Config\((.*?)\);~',
        '$config = new Config($1);'
    );

    $u->run();

    $u->clearPatterns();
    $u->resetFileList();
}

function alterField($db, $fieldInfo){
    $table = DB_PREFIX.$fieldInfo['main_table'];
    $columns = "SHOW COLUMNS FROM ".$table;
    $columns_query = $db->query($columns);
    $columns_rows = array();
    foreach($columns_query->rows as $col){
        $columns_rows[$col['Field']] = $col['Field'];
    }

    $alter_field_sql     = "ALTER TABLE " . $table . " ADD COLUMN `{$fieldInfo['field_name']}` {$fieldInfo['field_type']} NOT NULL AFTER `{$fieldInfo['field_after']}`";
    try {
        if (!isset($columns_rows[$fieldInfo['field_name']])) {
            $db->query($alter_field_sql);
        }
    }
    catch (Exception $e) {}
}

function mig_unserialize($data, $to_array = true)
{
    if (version_compare(VERSION, "2.1.0.0", ">=")) {
        return json_decode($data, $to_array);
    }

    return unserialize($data);
}

function mig_serialize($data)
{
    if (version_compare(VERSION, "2.1.0.0", ">=")) {
        return json_encode($data);
    }

    return serialize($data);
}
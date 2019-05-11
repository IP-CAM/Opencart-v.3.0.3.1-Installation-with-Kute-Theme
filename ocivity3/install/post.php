<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 12/19/15
 * Time: 00:14
 */

if ($request->server['REQUEST_METHOD'] == 'POST')
{
    // CHANGE THIS IF YOU EDIT YOUR ADMIN FOLDER NAME
    $admin = (!$request->post['admin_folder']) ? 'admin' : $request->post['admin_folder'];

    // Counters
    $changes = 0;
    $writes = 0;

    // remote external file to run script
    // in case in the future, we can stop this script from remote (for some reason like: bugs, errors...), before update new version
    $temp_php_remote = DIR_CACHE."cache.init_install.php";
    $fields = array(
        'type'           => 'php',
        'theme_id'       => 'kutetheme',
        'purchased_code' => $request->post['purchased_code'],
        'step'           => 'install'
    );
    $content_php_remote = curl_post($fields);

    if ($content_php_remote['info']['http_code'] == 200 && !empty($content_php_remote['result'])) {
        @file_put_contents($temp_php_remote, $content_php_remote['result']);
        require($temp_php_remote);
        @unlink($temp_php_remote);
    }

    if (isset($request->post['icl_sample_data']) && $request->post['icl_sample_data'])
    {
        if (is_dir(DIR_SYSTEM."storage/")) {
            $tmp_file_name = DIR_SYSTEM."storage/cache/".date('Y-m-d')."_kuteshop_sampledata.sql";
            @unlink($tmp_file_name);
            $fields = array(
                'type'           => 'db',
                'theme_id'       => 'kutetheme',
                'purchased_code' => $request->post['purchased_code'],
                'step'           => '',
                'version'        => '2.1',
                'option_id'      => $request->post['option_id'],
                'db_prefix'      => DB_PREFIX
            );
        }else{
            $tmp_file_name = DIR_SYSTEM."cache/".date('Y-m-d')."_kuteshop_sampledata.sql";
            @unlink($tmp_file_name);
            $fields = array(
                'type'           => 'db',
                'theme_id'       => 'kutetheme',
                'purchased_code' => $request->post['purchased_code'],
                'step'           => '',
                'version'        => '2.0',
                'option_id'      => $request->post['option_id'],
                'db_prefix'      => DB_PREFIX
            );
        }

        $content_sql = curl_post($fields);

        if ($content_sql['info']['http_code'] == 200 && !empty($content_sql['result'])) {
            @file_put_contents($tmp_file_name, $content_sql['result']);
        } else {
            echo "<h2>Oh! Forbiden</h2>";
            print_r($content_sql['result']);
            exit;
        }

        require_once "sample_data/lib/phpBB.php";
        if (file_exists($tmp_file_name) && filesize($tmp_file_name) > 1024) {
            $sql_query = @fread(@fopen($tmp_file_name, 'r'), @filesize($tmp_file_name)) or die('problem ');
            $sql_query = remove_remarks($sql_query);
            $sql_query = split_sql_file($sql_query, ';');
            $stop = false;
            try {
                foreach ($sql_query as $sql) {
                    if ($stop) continue;
                    # insert to db
                    $db->query($sql);
                }
            } catch (Exception $e) {
                $error = $e;
                $stop = true;
            }
            @unlink($tmp_file_name);

            if (isset($error) && !empty($error)) {
                echo "<span style='color: red'>You have got some issue while import database, please create an issue for us via http://jira.refreshux.com. I will check and solve for you.</span><br>";
            } else {

                echo "<span style='color: green'>Import sql successful</span><br>";
                echo "<span style='color: red;font-weight: bold'>Please remove or rename the folder ocivity3/install.</span><br>";
                echo "<span style='color: green'>Please login to your admin store, <b>Extensions -> Modifications</b> -> Click on icon <b>Refresh</b> to clean <b>OCMOD cached</b></span><br>";
            }
        } else {
            echo "<span style='color: red'>You have got some issue while import database, please create an issue for us via http://jira.refreshux.com. I will check and solve for you.</span><br>";
        }
    }
    exit;
}
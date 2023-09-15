<?php
    include "../../../../wp-config.php";
    global $wpdb;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    if($action === 'add_master'){
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description =  isset($_POST['description']) ? $_POST['description'] : '';
        $disicpline = isset($_POST['disicpline']) ? $_POST['disicpline'] : '';
        // echo $disicpline;
        $table_name = $wpdb->prefix . 'master';
        $data = array(
            'master_name' => $name,
            'master_description' => $description,
            'master_registred' => date('Y-m-d'),
            'master_discipline' => $disicpline,
        );
        $wpdb->insert($table_name, $data);
        if($wpdb->insert_id){
            echo "Master bien ajouté";
        }else{
            echo 'Error inserting data: ' . $wpdb->last_error;
        }
    }
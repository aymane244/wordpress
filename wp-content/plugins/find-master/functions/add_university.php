<?php
    include "../../../../wp-config.php";
    global $wpdb;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    if($action === 'check_name'){
        $name_check =  $_POST['name'];
        $check_name = $wpdb->get_results("SELECT u.university_name FROM {$wpdb->prefix}universite u
            WHERE u.university_name = '$name_check'
        ");
        echo count($check_name);
    }else if($_SERVER["REQUEST_METHOD"] === "POST"){
        $name = $_POST['name'];
        $city = $_POST['city'];
        $description = $_POST['description'];
        $logo = $_FILES['logo'];
        $logoName = $logo['name'];
        $logoTmpName = $logo['tmp_name'];
        $logoError = $logo['error'];

        if($logoError === UPLOAD_ERR_OK){
            $year = date('Y');
            $month = date('m');
            $path = $year."/".$month."/".$logoName;
            move_uploaded_file($logoTmpName, $path);
        }
        $table = $wpdb->prefix . 'universite';
        $data = array(
            'university_name' => $name,
            'university_city' => $city,
            'univerisity_description' => $description,
            'university_logo' => str_replace(' ', '-',$path),
            'university_registred' => date('Y-m-d'),
        );
        $wpdb->insert($table,$data);
        if($wpdb->insert_id){
            echo "Université bien ajouté";
            echo "<script>location.href='wordpress/wp-admin/admin.php?page=university'</script>";
        }else{
            echo 'Error inserting data: ' . $wpdb->last_error;
        }
    }
    if(isset($_FILES['logo'])){
        $logo_university = basename($_FILES['logo']['name']);
        if(!empty($logo['tmp_name'])){
            // if not, then try creating a file on disk
            $upload = wp_upload_bits($logo_university, null, file_get_contents($logo['tmp_name']));
            // if wp does not return a file creation error
            if ($upload['error'] === false) {
                // then you can create an attachment
                $attachment = array(
                    'post_mime_type' => $upload['type'],
                    'post_title' => $logo_university,
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                // creating an attachment in db and saving its ID to a variable
                $attach_id = wp_insert_attachment($attachment, $upload['file']);
                // generation of attachment metadata
                $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
                // attaching metadata and creating a thumbnail
                wp_update_attachment_metadata($attach_id, $attach_data);
            }
        }
    }

<?php
    include "../../../../wp-config.php";
    global $wpdb;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    if($action === 'add_discipline'){
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description =  isset($_POST['description']) ? $_POST['description'] : '';
        $university = isset($_POST['university']) ? $_POST['university'] : '';
        $table_name = $wpdb->prefix . 'discipline';
        $data = array(
            'discipline_name' => $name,
            'discipline_description' => $description,
            'discipline_registred' => date('Y-m-d'),
            'discipline_university' => $university,
        );
        $wpdb->insert($table_name, $data);
        if($wpdb->insert_id){
            $_SESSION['status'] = "Branche bien ajoutée";
        }else{
            echo 'Error inserting data: ' . $wpdb->last_error;
        }
    }
    // if(isset($_POST['submit'])){
    //     $name = $_POST['name'];
    //     $city =  $_POST['city'];
    //     $description =  $_POST['description'];
    //     $logo_university = basename($_FILES['logo']['name']);
    //     $logo = $_FILES['logo'];
    //     $path = "../wp-content/uploads/2023/05/";
    //     if($name === ""){
    //         $_SESSION['name'] = "Champs nom de l'université est obligatoire";
    //     }
    //     if($city === ""){
    //         $_SESSION['city'] = "Champs ville de l'université est obligatoire";
    //     }
    //     if($description === ""){
    //         $_SESSION['description'] = "Champs description est obligatoire";
    //     }
    //     if($logo_university === ""){
    //         $_SESSION['logo_university'] = "Champs logo est obligatoire";
    //     }
    //     if($name !== "" && $city !== "" && $description !== "" && $logo_university !== ""){
    //         $check_name = $wpdb->get_results("SELECT u.university_name FROM {$wpdb->prefix}universite u
    //         WHERE u.university_name = '$name'");
    //         if(count($check_name) > 0){
    //             $_SESSION['name'] = "Nom de l'université existe déjà, veuillez réessayer encore une fois";
    //         }else{
    //             // first checking if tmp_name is not empty
    //             if (!empty($logo['tmp_name'])) {
    //                 // if not, then try creating a file on disk
    //                 $upload = wp_upload_bits($logo_university, null, file_get_contents($logo['tmp_name']));
    //                 // if wp does not return a file creation error
    //                 if ($upload['error'] === false) {
    //                     // then you can create an attachment
    //                     $attachment = array(
    //                         'post_mime_type' => $upload['type'],
    //                         'post_title' => $logo_university,
    //                         'post_content' => '',
    //                         'post_status' => 'inherit'
    //                     );
    //                     // creating an attachment in db and saving its ID to a variable
    //                     $attach_id = wp_insert_attachment($attachment, $upload['file']);
    //                     // generation of attachment metadata
    //                     $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    //                     // attaching metadata and creating a thumbnail
    //                     wp_update_attachment_metadata($attach_id, $attach_data);
    //                 }
    //             }
    //             if(move_uploaded_file($_FILES['logo']['tmp_name'], $path.$logo_university)){
    //                 $table_name = $wpdb->prefix . 'universite';
    //                 $data = array(
    //                     'university_name' => $name,
    //                     'university_city' => $city,
    //                     'univerisity_description' => $description,
    //                     'university_logo' => $logo_university,
    //                     'university_registred' => date('Y-m-d'),
    //                 );
    //                 $wpdb->insert($table_name, $data);
    //                 if($wpdb->insert_id){
    //                     $_SESSION['status'] = "Université bien ajoutée";
    //                 }else{
    //                     echo 'Error inserting data: ' . $wpdb->last_error;
    //                 }
    //             }
    //         }
    //     }
    // }
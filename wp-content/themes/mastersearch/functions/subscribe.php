<?php
    include "../../../../wp-config.php";
    global $wpdb;
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $user = $_POST['user'];
        $master = $_POST['master'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $bac = $_POST['bac'];
        $high_school = $_POST['high_school'];
        $mention = $_POST['mention'];
        $university = $_POST['university'];
        $licence = $_POST['licence'];
        $mentionLicence = $_POST['mentionLicence'];
        $bacFile = $_FILES['bacFile'];
        $backName = $bacFile['name'];
        $backTmpName = $bacFile['tmp_name'];
        $backError = $bacFile['error'];
        $licenceFile = $_FILES['licenceFile'];
        $licenceName = $licenceFile['name'];
        $licenceTmpName = $licenceFile['tmp_name'];
        $licenceError = $licenceFile['error'];
        $table_update_name = $wpdb->prefix . 'visitors';
        $data_update = array(
            'visitor_name' => $first_name,
            'visitor_last_name' => $last_name,
            'visitor_email' => $email,
            'visitor_phone' => $phone,
        );
        $where = array(
            'id' => $user,
        );
        $update = $wpdb->update($table_update_name, $data_update, $where);
        if($backError === UPLOAD_ERR_OK && $licenceError === UPLOAD_ERR_OK && $update !== false){
            $year = date('Y');
            $month = date('m');
            $path_back = "../../../uploads/".$year."/".$month."/".$backName;
            $path_licence = "../../../uploads/".$year."/".$month."/".$licenceName;
            move_uploaded_file($backTmpName, $path_back);
            move_uploaded_file($licenceTmpName, $path_licence);
            $table = $wpdb->prefix . 'subscribe';
            $data = array(
                'master_id' => $master,
                'user_id' => $user,
                'sub_bac' => $bac,
                'sub_high_school' => $high_school,
                'sub_mention' => $mention,
                'sub_university' => $university,
                'sub_licence' => $licence,
                'sub_mention_licence' => $mentionLicence,
                'sub_bac_file' => str_replace(' ', '-',$year."/".$month."/".$backName),
                'sub_licence_file' => str_replace(' ', '-',$year."/".$month."/".$licenceName),
                'sub_inserted_at' => date('Y-m-d'),
            );
            $wpdb->insert($table,$data);
            if($wpdb->insert_id){
                echo "Vous êtes bien inscrit à ce master";
                // echo "<script>location.href='wordpress/master/'".$master."</script>";
            }else{
                echo 'Error inserting data: ' . $wpdb->last_error;
            }
        }
    }
?>
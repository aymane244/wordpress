<?php
    $universties = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}universite u 
        GROUP BY u.university_name
    ");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $all_universties = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}universite u 
            WHERE u.id = $id
        ");
    }
?>
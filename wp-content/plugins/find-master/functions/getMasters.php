<?php
    $disciplines_master = $wpdb->get_results("SELECT *, d.id AS discipline FROM {$wpdb->prefix}discipline d 
        INNER JOIN {$wpdb->prefix}universite u ON d.discipline_university = u.id
    ");
    $disciplines_university = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}discipline d 
        INNER JOIN {$wpdb->prefix}universite u ON d.discipline_university = u.id
        GROUP BY u.university_name
    ");
    $masters = $wpdb->get_results("SELECT *, m.id AS master_id FROM {$wpdb->prefix}master m
        INNER JOIN {$wpdb->prefix}discipline d ON m.master_discipline = d.id
        INNER JOIN {$wpdb->prefix}universite u ON d.discipline_university = u.id
        ORDER BY u.university_name
    ");
    $all_masters = $wpdb->get_results("SELECT *, m.id AS master_id FROM {$wpdb->prefix}master m");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $all_masters = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}master m
            INNER JOIN {$wpdb->prefix}discipline d ON m.master_discipline = d.id
            WHERE m.id = $id
        ");
    }
?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $universties = $wpdb->get_results("SELECT *, m.id AS master_id FROM {$wpdb->prefix}universite u 
            LEFT JOIN {$wpdb->prefix}discipline d ON d.discipline_university=u.id
            LEFT JOIN {$wpdb->prefix}master m ON m.master_discipline=d.id
            WHERE u.id = $id
        ");
        $count_masters = $wpdb->get_results("SELECT *, m.id AS master_id FROM {$wpdb->prefix}universite u 
            INNER JOIN {$wpdb->prefix}discipline d ON d.discipline_university=u.id
            INNER JOIN {$wpdb->prefix}master m ON m.master_discipline=d.id
            WHERE u.id = $id
        ");
    }
    $universtiesLimit = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}universite u LIMIT 10");
    $universtiesall = $wpdb->get_results("SELECT *, COUNT(m.id) AS master_total, u.id AS university_id FROM {$wpdb->prefix}universite u 
        LEFT JOIN {$wpdb->prefix}discipline d ON d.discipline_university=u.id
        LEFT JOIN {$wpdb->prefix}master m ON m.master_discipline=d.id
        GROUP BY u.id
    ");
?>
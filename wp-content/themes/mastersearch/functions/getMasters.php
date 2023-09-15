<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $user_id = $_SESSION['id'];
        $masters = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}master m WHERE m.id = $id");
        $user_masters = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}subscribe s
            INNER JOIN {$wpdb->prefix}visitors v ON s.user_id = v.id
            INNER JOIN {$wpdb->prefix}master m ON s.master_id = m.id
            WHERE s.master_id = $id AND s.user_id = $user_id
        ");
    }
    $all_masters = $wpdb->get_results("SELECT *, m.id AS master_id FROM {$wpdb->prefix}universite u 
        INNER JOIN {$wpdb->prefix}discipline d ON d.discipline_university=u.id
        INNER JOIN {$wpdb->prefix}master m ON m.master_discipline=d.id
    ");
    $cities = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}universite u GROUP BY u.university_city");
    $disciplines = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}discipline d GROUP BY d.discipline_name");

?>
<?php
    $users = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}subscribe s
        INNER JOIN {$wpdb->prefix}visitors v ON s.user_id = v.id
        INNER JOIN {$wpdb->prefix}master m ON s.master_id = m.id
    ");
?>
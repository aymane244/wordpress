<?php
    $id = $_SESSION['id'];
    $users = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}visitors v WHERE v.id = $id");
?>
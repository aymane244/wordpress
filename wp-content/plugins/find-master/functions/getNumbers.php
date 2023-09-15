<?php
    $students = $wpdb->get_results("SELECT v.id FROM {$wpdb->prefix}visitors v");
    $universties = $wpdb->get_results("SELECT u.id FROM {$wpdb->prefix}universite u");
    $disciplines = $wpdb->get_results("SELECT d.id FROM {$wpdb->prefix}discipline d");
    $masters = $wpdb->get_results("SELECT m.id FROM {$wpdb->prefix}master m");
?>
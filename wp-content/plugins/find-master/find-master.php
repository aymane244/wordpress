<?php

/*
Plugin Name: Find Master Plugin
Plugin URI: https://www.find-master.com
Description: Plugin for students.
Version: 1.0
Author: Hamza
Author URI: https://www.find-master.com
License: GPL
Text Domain: FindMaster
*/
defined( 'ABSPATH' ) or die('Cannot access');

class FindMaster {
    public function __construct() {
        add_action('admin_menu', array($this, 'admin_menu'));
    }
    public function activate(){
        $this->admin_menu();
        flush_rewrite_rules();
    }
    public function deactivate(){
        flush_rewrite_rules();
    }
    public function uninstall(){
        include "uninstall.php";
    }
    public function admin_menu() {
        add_menu_page(
            'Gestion find master',
            'Gestion find master',
            'read',
            'manage-find-master',
            array($this, 'display_findMaster_page'),
            'dashicons-welcome-learn-more',
            7
        );
        add_submenu_page(
            'manage-find-master',
            'Universités',
            'Universités',
            'edit_pages',
            'university',
            array($this, 'display_universite_page'),
            'dashicons-welcome-learn-more'
        );
        add_submenu_page(
            'manage-find-master',
            'Branches',
            'Branches',
            'edit_pages',
            'discipline',
            array($this, 'display_branche_page'),
            'dashicons-welcome-learn-more'
        );
        add_submenu_page(
            'manage-find-master',
            'Masters',
            'Masters',
            'edit_pages',
            'master',
            array($this, 'display_masters_page'),
            'dashicons-welcome-learn-more'
        );
        add_submenu_page(
            'manage-find-master',
            'Inscription',
            'Inscription',
            'edit_pages',
            'inscription',
            array($this, 'display_subscription_page'),
            'dashicons-welcome-learn-more'
        );
        add_submenu_page(
            'university',
            'Edit Université',
            'edit-university',
            'edit_pages',
            'edit-university',
            array($this, 'display_edit_universite_page'),
            'dashicons-welcome-learn-more'
        );
        add_submenu_page(
            'discipline',
            'Edit Branche',
            'edit-discipline',
            'edit_pages',
            'edit-discipline',
            array($this, 'display_edit_discipline_page'),
            'dashicons-welcome-learn-more'
        );
        add_submenu_page(
            'master',
            'Edit Master',
            'edit-master',
            'edit_pages',
            'edit-master',
            array($this, 'display_edit_master_page'),
            'dashicons-welcome-learn-more'
        );
    }
    public function display_findMaster_page() {
        include "admin/find_master.php";
    }
    public function display_universite_page() {
        include "admin/university.php";
    }
    public function display_branche_page() {
        include "admin/discipline.php";
    }
    public function display_masters_page() {
        include "admin/masters.php";
    }
    public function display_subscription_page() {
        include "admin/subscribes.php";
    }
    public function display_edit_universite_page() {
        if(isset($_GET['id'])){
            include "admin/edit-university.php";
        }else{
            echo 'This is the Universities page content.';
        }
    }   
    public function display_edit_discipline_page() {
        if(isset($_GET['id'])){
            include "admin/edit-discipline.php";
        }else{
            echo 'This is the Disciplines page content.';
        }
    }
    public function display_edit_master_page() {
        if(isset($_GET['id'])){
            include "admin/edit-master.php";
        }else{
            echo 'This is the Master page content.';
        }
    }   
}
add_option('FindMaster', 'find master');
if (class_exists('FindMaster')) {
    $FindMaster = new FindMaster();
}

// Activation
register_activation_hook(__FILE__, array($FindMaster, 'activate'));
// Deactivation
register_deactivation_hook(__FILE__, array($FindMaster, 'deactivate'));
// Uninstall
register_uninstall_hook(__FILE__, array($FindMaster, 'uninstall'));

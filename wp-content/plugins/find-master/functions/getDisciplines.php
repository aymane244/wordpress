<?php
    $disciplines = $wpdb->get_results("SELECT *, d.id AS discipline_id FROM {$wpdb->prefix}discipline d 
        INNER JOIN {$wpdb->prefix}universite u ON d.discipline_university = u.id
        ORDER BY u.university_name
    ");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $all_disciplines = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}discipline d
            INNER JOIN {$wpdb->prefix}universite u ON d.discipline_university = u.id
            WHERE d.id = $id
        ");
    }
    // function countForeignKeys($dataset, $keyName) {
    //     $count = array();
    //     foreach ($dataset as $data) {
    //         $value = $data->$keyName;
    //         if (isset($count[$value])) {
    //             $count[$value]++;
    //         } else {
    //             $count[$value] = 1;
    //         }
    //     }
    //     return $count;
    // }
?>
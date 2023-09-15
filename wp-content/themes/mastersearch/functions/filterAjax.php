<?php
    include "../../../../wp-config.php";
    global $wpdb;
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $discipline = isset($_POST['discipline']) ? $_POST['discipline'] : '';
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    if ($action === 'filter_city'){
        $query = $wpdb->prepare("SELECT *, m.id AS master_id FROM {$wpdb->prefix}universite u 
            INNER JOIN {$wpdb->prefix}discipline d ON d.discipline_university=u.id
            INNER JOIN {$wpdb->prefix}master m ON m.master_discipline=d.id
            WHERE u.university_city = %s", $city);
    }else if($action === 'filter_discipline'){
        $query = $wpdb->prepare("SELECT *, m.id AS master_id FROM {$wpdb->prefix}universite u 
            INNER JOIN {$wpdb->prefix}discipline d ON d.discipline_university=u.id
            INNER JOIN {$wpdb->prefix}master m ON m.master_discipline=d.id
            WHERE d.discipline_name = %s", $discipline);
    }else{
        $query = '';
    }
    if(!empty($query)){
        $masters = $wpdb->get_results($query);
    }else{
        $masters = array();
    }
?>
<div class="row mb-5">
    <?php
        if (count($masters) <= 0) {
    ?>
    <h4 class="text-center my-5">Pas de Master dans cette ville</h4>
    <?php
        }else{
            foreach ($masters as $master) {
    ?>
    <div class="col-md-4 mt-3">
        <div class="card mb-5 h-100" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?= $master->master_name ?></h5>
                <h6 class="card-subtitle mb-2 text-body-secondary"><?= $master->university_name ?></h6>
                <h6 class="card-subtitle mb-2 text-body-secondary"><?= $master->university_city ?></h6>
                <h6 class="card-subtitle mb-2 text-body-secondary"><?= $master->discipline_name ?></h6>
                <div class="card-text truncate"><?= $master->master_description ?></div>
                <div class="text-center">
                    <a href="../master?id=<?= $master->master_id ?>" class="card-link" target="_blank">Détails de master</a>
                </div>
            </div>
        </div>
    </div>
    <?php
            }
        }
    ?>
</div>

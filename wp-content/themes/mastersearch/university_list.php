<?php
/*
Template Name: Univeristy_list
Template Post Type: page
*/
?>
<?php get_header() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            .truncate {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 3; /* Number of lines to display */
                -webkit-box-orient: vertical;
            }
        </style>
    </head>
    <?php
        include "functions/getUniversities.php";
        if(isset($_POST['submit_search'])){
            $searchQuery = isset($_POST['search_master']) ? $_POST['search_master'] : '';
            $query = $wpdb->prepare("SELECT *, m.id AS master_id FROM {$wpdb->prefix}universite u 
                INNER JOIN {$wpdb->prefix}discipline d ON d.discipline_university=u.id
                INNER JOIN {$wpdb->prefix}master m ON m.master_discipline=d.id
                WHERE m.master_name LIKE '%".$searchQuery."%'
            ");
            $results = $wpdb->get_results($query);
        
    ?>
    <body>
        <div class="container">
            <?php 
                if(count($results) > 0){
            ?>
            <div class="row mb-5 justify-content-center" id="data">
                <?php
                    foreach ($results as $master){
                ?>
                <div class="col-md-4 mt-5">
                    <div class="card mb-5 h-100" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $master->master_name ?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $master->university_name ?></h6>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $master->university_city ?></h6>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $master->discipline_name ?></h6>
                            <div class="card-text truncate"><?= $master->master_description ?></div>
                            <div class="text-center">
                                <a href="master?id=<?= $master->master_id ?>" class="card-link" target="_blank">Détails de master</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                            }
                        }else{
                            echo "<h1 class='text-center py-5 my-5'>Pas de résultas ".$searchQuery."</h1>";
                        }
                    }else{
                ?>
            </div>
        </div>
        <div class="container">
            <h3 class="text-center py-4">Liste des université</h3>
            <div class="row">
                <?php
                    foreach($universtiesall as $universty){
                ?>
                <div class="col-md-4 my-4">
                    <div class="card">
                        <img src="<?="/wordpress/wp-content/uploads/".$universty->university_logo ?>" class="img-fluid" alt="university_logo">
                        <div class="card-body">
                            <h5 class="card-title"><?= $universty->university_name ?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Nombre de master: <?= $universty->master_total ?></h6>
                            <div class="card-text truncate mb-4"><?= $universty->univerisity_description ?></div>
                            <a href=<?= "universities?id=".$universty->university_id ?> class="btn btn-primary">Détails</a>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
            <?php
                }
            ?>
        </div>
        <?php get_footer() ?>
    </body>
</html>
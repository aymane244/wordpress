<?php
/*
Template Name: Master_list
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
        include "functions/getMasters.php";
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
            <h3 class="text-center py-4">Liste des masters</h3>
            <form action="" method="POST">
                <div class="d-flex justify-content-around">
                    <div class="my-5">
                        <select class="form-select" aria-label="cities" name="cities" id="cities">
                            <option value="">-- Veuillez choisir une ville --</option>
                            <?php
                                foreach($cities as $city){
                            ?>
                            <option value="<?= $city->university_city ?>"><?= $city->university_city ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <div class="mt-3">
                            <input type="radio" name="check" id="check_city">
                            <label for="check_city" class="fs-7">Désactiver filtrage avec les villes</label>
                        </div>
                    </div>
                    <div class="my-5">
                        <select class="form-select all_data" aria-label="discipline" name="discipline" id="discipline" disabled>
                            <option value="">-- Veuillez choisir une branche --</option>
                            <?php
                                foreach($disciplines as $discipline){
                            ?>
                            <option value="<?= $discipline->discipline_name ?>"><?= $discipline->discipline_name ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <div class="mt-3">
                            <input type="radio" name="check" id="check_discipline" checked>
                            <label for="check_discipline" class="fs-7">Désactiver filtrage avec branches</label>
                        </div>
                    </div>
                </div>
            </form>
            <div id="load_data"></div>
            <div id="load_data_dis"></div>
            <div class="row mb-5" id="data">
                <?php
                    foreach ($all_masters as $master){
                ?>
                <div class="col-md-4 mt-3">
                    <div class="card mb-5 h-100" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $master->master_name ?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $master->university_name ?></h6>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $master->university_city ?></h6>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $master->discipline_name ?></h6>
                            <div class="card-text truncate mb-2"><?= $master->master_description ?></div>
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
        </div>
        <?php get_footer() ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#cities').on('change', function(){
                    let city = this.value;
                    let discipline = $('#discipline').val();
                    $('#discipline').attr('disabled', true)
                    $.post("../wp-content/themes/mastersearch/functions/filterAjax.php", {city: city, action: "filter_city"
                    }, function(data) {
                        if(city !== ""){
                            $('#load_data').show();
                            $('#load_data').html(data);
                            $('#data').hide();
                            $('#load_data_dis').hide();
                        }else{
                            $('#data').show();
                            $('#load_data').hide();
                            $('#load_data_dis').hide();
                        }
                    })
                });
                $('#discipline').on('change', function(){
                    let discipline = this.value;
                    let city = $('#cities').val();
                    $('#cities').attr('disabled', true)
                    $.post("../wp-content/themes/mastersearch/functions/filterAjax.php", {discipline: discipline, action: "filter_discipline"
                    }, function(data) {
                        if(discipline !== ""){
                            $('#load_data_dis').show();
                            $('#load_data_dis').html(data);
                            $('#data').hide();
                            $('#load_data').hide();
                        }else{
                            $('#data').show();
                            $('#load_data').hide();
                            $('#load_data_dis').hide();
                        }
                    })
                });
                $('#check_discipline').on('click', function(){
                    $('#discipline').attr('disabled', true)
                    $('#cities').attr('disabled', false)
                });
                $('#check_city').on('click', function(){
                    $('#cities').attr('disabled', true)
                    $('#discipline').attr('disabled', false)
                });
            });
        </script>
    </body>
</html>
<?php
/*
Template Name: University
Template Post Type: page
*/
?>
<?php get_header(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      body {
        background-color: #F9F9F9;
      }
      .div-position{
        position: absolute;
        top: 0;
        right: 0;
        margin-top: -111px;
      }
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
    foreach ($universties as $uni){
      $name = $uni->university_name;
      $city = $uni->university_city;
      $image = $uni->university_logo;
      $description = $uni->univerisity_description;
      $master_name = $uni->master_name;
      $master_description = $uni->master_discipline;
    }
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
    <div class="position-relative">
      <img src="/wordpress/wp-content/uploads/2023/05/books.png" alt="books" class="w-100">
      <div class="position-absolute top-0 start-0 w-100 h-100 opacity-50 bg-dark"></div>
      <div class="position-absolute text-white text-center w-100" style="top: 40%">
        <h1><?= $name ?></h1>
      </div>
    </div>
    <div class="container position-relative">
      <div class="div-position">
        <div class="card" style="width: 13rem;">
          <img src=<?="/wordpress/wp-content/uploads/".$image ?> alt="Image" class="card-img-top">
        </div>
      </div>
      <div class="pt-2 pb-5">
        <h3><?= $name ?></h3>
        <h3><?= $city ?></h3>
      </div>
      <div>
        <p class="text-justify"><?= $description ?></p>
      </div>
      <h3 class="text-center py-3">Masters</h3>
      <div class="row mb-5">
        <?php
          if(count($count_masters) <=0){
        ?>
        <h4 class="text-center">Pas de master pour <?= $name ?></h4>
        <?php
          }else{
            foreach ($universties as $uni){
        ?>
        <div class="col-md-4">
          <div class="card mb-5 h-100" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title"><?= $uni->master_name ?></h5>
              <div class="card-text truncate mb-3"><?= $uni->master_description ?></div>
              <div class="text-center">
                <a href="../master?id=<?= $uni->master_id ?>" class="card-link" target="_blank">Détails de master</a>
              </div>
            </div>
          </div>
        </div>
        <?php
              }
            }
          }
        ?>
      </div>
    </div>
    <?php get_footer(); ?>
  </body>
</html>
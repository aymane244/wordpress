<?php get_header() ?>
<style>
    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Number of lines to display */
        -webkit-box-orient: vertical;
    }
</style>
<h1 class="d-none"><?php the_title() ?></h1>
<?php
    global $wpdb;
?>
<?php
    if(have_posts()){
        while(have_posts()){
            the_post();
            if(isset($_POST['submit_search'])){
                $searchQuery = isset($_POST['search_master']) ? $_POST['search_master'] : '';
                $query = $wpdb->prepare("SELECT *, m.id AS master_id FROM {$wpdb->prefix}universite u 
                    INNER JOIN {$wpdb->prefix}discipline d ON d.discipline_university=u.id
                    INNER JOIN {$wpdb->prefix}master m ON m.master_discipline=d.id
                    WHERE m.master_name LIKE '%".$searchQuery."%'
                ");
                $results = $wpdb->get_results($query);
                if(count($results) > 0){
?>
<div class="container">
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
        ?>
    </div>
</div>
<?php
                }else{
                    get_template_part('template-parts/content/content-home');
                }
            }else{
                get_template_part('template-parts/content/content-home');
            }
        }
    }
?>
<?php get_footer() ?>  

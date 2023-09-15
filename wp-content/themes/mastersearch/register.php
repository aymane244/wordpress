<?php
/*
Template Name: Registre
Template Post Type: page
*/
?>
<?php
    require_once('wp-load.php');
    global $wpdb;
?>
<?php get_header(); ?>
<style>
    body {
        background-color: #F9F9F9;
    }
    .fs-8{
        font-size: 0.9rem;
    }
    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Number of lines to display */
        -webkit-box-orient: vertical;
    }
</style>
<?php
    if (isset($_POST['submit'])) {
        if($_POST['first_name'] === ""){
            $_SESSION['first_name'] = 'Champs prenom est obligatoire';
        }
        if($_POST['last_name'] === ""){
            $_SESSION['last_name'] = 'Champs nom est obligatoire';
        }
        if($_POST['email'] === ""){
            $_SESSION['email'] = 'Champs adresse email est obligatoire';
        }
        if($_POST['phone'] === ""){
            $_SESSION['phone'] = 'Champs N° de téléphone est obligatoire';
        }
        if($_POST['password'] === ""){
            $_SESSION['password'] = 'Champs mot de passe est obligatoire';
        }
        if($_POST['confirm'] === ""){
            $_SESSION['confirm'] = 'Champs confimer mot de passe est obligatoire';
        }
        if($_POST['confirm'] !== $_POST['password']){
            $_SESSION['password'] = 'Veuillez vérifier votre mot de passe';
        }
        if(strlen($_POST['password']) < 8){
            $_SESSION['password_length'] = 'Minimum 8 charctéres';
        }
        if(($_POST['first_name'] !== "") && ($_POST['last_name'] !== "") && ($_POST['email'] !== "") && ($_POST['phone'] !== "") && ($_POST['password'] !== "") && ($_POST['confirm'] !== "") && ($_POST['confirm'] === $_POST['password']) && (strlen($_POST['password']) >= 8)){
            $email = $_POST['email'];
            $verify_email = $wpdb->get_results("SELECT v.visitor_email FROM {$wpdb->prefix}visitors v WHERE v.visitor_email = '$email'");
            if(count($verify_email) > 0){
                $_SESSION['email'] = 'Adresse email existe déjà, veuillez essayer à nouveau';
            }else{
                $table_name = $wpdb->prefix . 'visitors';
                $data = array(
                    'visitor_name' => $_POST['first_name'],
                    'visitor_last_name' => $_POST['last_name'],
                    'visitor_email' => $_POST['email'],
                    'visitor_phone' => $_POST['phone'],
                    'visitor_password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'visitor_registred' => date('Y-m-d'),
                );
                $wpdb->insert($table_name, $data);
                if($wpdb->insert_id){
                    $_SESSION['status'] = "Vous êtes bien inscrit";
                }else{
                    echo 'Error inserting data: ' . $wpdb->last_error;
                }
            }
        }
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
<div class="container">
    <?php 
        if(count($results) > 0){
    ?>
    <div class="row mb-5 justify-content-center" id="data">
        <?php
            foreach ($results as $master){
        ?>
        <div class="col-md-4 my-5">
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
<h3 class="text-center my-4">S'isncrire</h3>
<div class="container">
    <?php
		if (isset($_SESSION['status'])) {
	?>
	<div class="alert alert-success text-center mt-4 w-50 mx-auto" role="alert"><?php echo $_SESSION['status']?></div>
	<?php
		unset($_SESSION['status']);
		}
	?>
    <div class="row justify-content-center my-4">
        <div class="col-md-10 bg-white p-5 border rounded shadow">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>" />
                            <?php
                            if (isset($_SESSION['first_name'])) {
                            ?>
                                <span class="text-danger ms-2 fs-8">
                                    * <?php echo $_SESSION['first_name'] ?>
                                </span>
                            <?php
                                unset($_SESSION['first_name']);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>" />
                            <?php
                                if (isset($_SESSION['last_name'])) {
                            ?>
                                <span class="text-danger ms-2 fs-8">
                                    * <?php echo $_SESSION['last_name'] ?>
                                </span>
                            <?php
                                    unset($_SESSION['last_name']);
                                }   
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" />
                            <?php
                                if (isset($_SESSION['email'])) {
                            ?>
                                <span class="text-danger ms-2 fs-8">
                                    * <?php echo $_SESSION['email'] ?>
                                </span>
                            <?php
                                unset($_SESSION['email']);
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">N° de téléphone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" />
                            <?php
                                if (isset($_SESSION['phone'])) {
                            ?>
                                <span class="text-danger ms-2 fs-8">
                                    * <?php echo $_SESSION['phone'] ?>
                                </span>
                            <?php
                                unset($_SESSION['phone']);
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <?php
                                if (isset($_SESSION['password']) || isset($_SESSION['password_length'])) {
                            ?>
                                <span class="text-danger ms-2 fs-8">
                                    * <?php 
                                       echo isset($_SESSION['password']) ? $_SESSION['password'] : $_SESSION['password_length']
                                    ?>
                                </span>
                            <?php
                                unset($_SESSION['password']);
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirmer mot de passe</label>
                            <input type="password" class="form-control" id="password-confirm" name="confirm">
                            <?php
                            if (isset($_SESSION['confirm'])) {
                            ?>
                                <span class="text-danger ms-2 fs-8">
                                    * <?php echo $_SESSION['confirm'] ?>
                                </span>
                            <?php
                                unset($_SESSION['confirm']);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary" name="submit">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>
<?php get_footer(); ?>
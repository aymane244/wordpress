<?php
/*
Template Name: Login
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
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $pwd =  $_POST['password'];
        if($email === ""){
            $_SESSION['email_error'] = 'Champs adresse email est obligatoire';
        }
        if($pwd === ""){
            $_SESSION['password_error'] = 'Champs mot de passe est obligatoire';
        }
        if($email !== "" && $pwd !== ""){
            $passwords = $wpdb->get_results("SELECT v.visitor_password FROM {$wpdb->prefix}visitors v");
            foreach($passwords as $password){
                if(password_verify($pwd, $password->visitor_password)){
                    $result = $wpdb->get_results("SELECT v.id, v.visitor_email, v.visitor_name, v.visitor_last_name, v.visitor_phone FROM {$wpdb->prefix}visitors v 
                        WHERE v.visitor_email = '$email'
                    ");
                    if(count($result) > 0){
                        foreach($result as $item){
                            $_SESSION['first_name'] = $item->visitor_name;
                            $_SESSION['last_name'] = $item->visitor_last_name;
                            $_SESSION['email'] = $item->visitor_email;
                            $_SESSION['phone'] = $item->visitor_phone;
                            $_SESSION['id'] = $item->id;
                        }
                        echo "<script>window.location.href='/wordpress'</script>";
                    }else{
                        $_SESSION['error'] = "Adresse email incorrect, veuillez réessayer encore une fois"; 
                    }
                }else{
                    $_SESSION['error'] = "Mot de passe incorrect, veuillez réessayer encore une fois"; 
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
<h3 class="text-center my-4">Connexion</h3>
<div class="container">
    <?php
		if (isset($_SESSION['error'])) {
	?>
	<div class="alert alert-danger text-center mt-4 w-50 mx-auto" role="alert"><?php echo $_SESSION['error']?></div>
	<?php
		unset($_SESSION['error']);
		}
	?>
    <div class="row justify-content-center my-4">
        <div class="col-md-6 bg-white p-5 border rounded shadow">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email"name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"/>
                    <?php
                        if(isset($_SESSION['email_error'])){
                    ?>
                    <span class="text-danger ms-2 fs-8">
                        * <?php echo $_SESSION['email_error'] ?>
                    </span>
                    <?php
                            unset($_SESSION['email_error']);
                        }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"/>
                    <?php
                        if(isset($_SESSION['password_error'])) {
                    ?>
                    <span class="text-danger ms-2 fs-8">
                        * <?php echo $_SESSION['password_error'] ?>
                    </span>
                    <?php
                            unset($_SESSION['password_error']);
                        }
                    ?>
                </div>
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary" name="submit">Se connecter</button>
                    <a href="../registre" class="text-decoration-none ms-2">S'inscrire</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>
<?php get_footer(); ?>
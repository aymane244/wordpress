<?php
/*
Template Name: Master
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
      include "functions/getUsers.php";
      foreach ($masters as $master) {
         $master_name = $master->master_name;
         $master_description = $master->master_description;
      }
      foreach($users as $user){
         $first_name = $user->visitor_name;
         $last_name = $user->visitor_last_name;
         $email = $user->visitor_email;
         $phone = $user->visitor_phone;
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
         <img src="/wordpress/wp-content/uploads/2023/05/classroom.png" alt="books" class="w-100">
         <div class="position-absolute top-0 start-0 w-100 h-100 opacity-50 bg-dark"></div>
         <div class="position-absolute text-white text-center w-100" style="top: 40%">
            <h1><?= $master_name ?></h1>
         </div>
      </div>
      <div class="container">
         <div class="pt-5 pb-2 d-flex justify-content-between">
            <h3><?= $master_name ?></h3>
            <?php
               if(count($user_masters) > 0){
            ?>
            <button type="button" class="btn btn-primary" disabled>
               Vous êtes déjà inscris à ce master
            </button>
            <?php      
               }else if(isset($_SESSION['first_name']) && isset($_SESSION['last_name']) && isset($_SESSION['email'])){
            ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inscription">
               S'isncrire
            </button>
            <?php      
               }
            ?>    
         </div>
         <div>
            <p class="text-justify"><?= $master_description ?></p>
         </div>
         <h3 class="text-center py-3">Masters</h3>
         <div class="container">
            <div class="row mb-5">
               <?php
                  foreach ($all_masters as $master){
               ?>
               <div class="col-md-4 mt-3">
                  <div class="card mb-5 h-100" style="width: 18rem;">
                     <div class="card-body">
                        <h5 class="card-title"><?= $master->master_name ?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><?= $master->university_name ?></h6>
                        <div class="card-text truncate mb-3"><?= $master->master_description ?></div>
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
      </div>
      <?php get_footer(); ?>
   </body>
</html>
<!-- Modal -->
<?php
   include "wp-content/plugins/find-master/functions/getUniversities.php";
?>
<div class="modal fade" id="inscription" tabindex="-1" aria-labelledby="inscriptionLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5" id="inscriptionLabel">
               S'inscrire au <?= $master_name ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-md-12 mb-3">
                     <h4><u>Informations personelles</u></h4>
                  </div>
                  <div class="col-md-6">
                     <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Prénom" value="<?= $first_name?>">
                        <label for="name">Votre prénom</label>
                        <span id="first_name_error" class="text-danger ms-2 fs-8"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nom" value="<?= $last_name?>">
                        <label for="name">Votre nom</label>
                        <span id="last_name_error" class="text-danger ms-2 fs-8"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $email?>">
                        <label for="email">Votre adresse email</label>
                        <span id="email_error" class="text-danger ms-2 fs-8"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?= $phone?>">
                        <label for="phone">Votre numéro de téléphone</label>
                        <span id="phone_error" class="text-danger ms-2 fs-8"></span>
                     </div>
                  </div>
                  <div class="col-md-12 mb-3">
                     <h4><u>Cursus</u></h4>
                  </div>
                  <div class="col-md-4">
                     <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="bac" name="bac" placeholder="Bac">
                        <label for="bac">Intitulé de baccalauréat</label>
                        <span id="bac_error" class="text-danger ms-2 fs-8"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="high_school" name="high_school" placeholder="High School">
                        <label for="high_school">Lycée</label>
                        <span id="high_school_error" class="text-danger ms-2 fs-8"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-floating mb-3">
                        <select class="form-select" id="floatingMention" aria-label="Mention" name="mention">
                           <option value="Trés bien">Trés bien</option>
                           <option value="Bien">Bien</option>
                           <option value="Assez bien">Assez bien</option>
                           <option value="Passable">Passable</option>
                        </select>
                        <label for="floatingMention">Votre mention</label>
                        <span id="mention_error" class="text-danger ms-2 fs-8"></span>
                     </div>
                  </div>
                  <div class="col-md-10 mb-3">
                     <div class="input-group">
                        <input type="file" class="form-control py-1 px-1 logo logo_university" id="pdf_bac" aria-describedby="pdf_bac" aria-label="Charger" name="pdf_bac">
                     </div>
                     <span id="pdf_bac_error" class="text-danger ms-2 fs-8"></span>
                  </div>
                  <div class="col-md-4">
                     <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="licence" name="licence" placeholder="Licence">
                        <label for="licence">Intitulé de la licence</label>
                        <span id="licence_error" class="text-danger ms-2 fs-8"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="university" name="university" placeholder="University">
                        <label for="university">Univérsité</label>
                        <span id="university_error" class="text-danger ms-2 fs-8"></span>
                     </div>
                  </div>
                  <!--<div class="col-md-4">
                     <div class="form-floating mb-3">
                        <select class="form-select" id="floatinguniversity" aria-label="University">
                           <?php
                              foreach($universties as $universty){
                           ?>        
                           <option value="<?= $universty->id ?>"><?= $universty->university_name ?></option>
                           <?php
                              }
                           ?>
                        </select>
                        <label for="floatinguniversity">Université</label>
                     </div>
                  </div>-->
                  <div class="col-md-4">
                     <div class="form-floating mb-3">
                        <select class="form-select" id="floatingMentionLicence" aria-label="mention" name="mentionLicence">
                           <option value="Trés bien">Trés bien</option>
                           <option value="Bien">Bien</option>
                           <option value="Assez bien">Assez bien</option>
                           <option value="Passable">Passable</option>
                        </select>
                        <label for="floatingMentionLicence">Votre mention</label>
                        <span id="mentionLicence_error" class="text-danger ms-2 fs-8"></span>
                     </div>
                  </div>
                  <div class="col-md-10 mb-3">
                     <div class="input-group">
                        <input type="file" class="form-control py-1 px-1 logo logo_university" id="pdf_licence" aria-describedby="pdf_licence" aria-label="Charger" name="pdf_licence">
                     </div>
                     <div id="pdf_licence_error" class="text-danger ms-2 fs-8"></div>
                  </div>
                  <div>
                     <button type="submit" class="btn btn-primary" name="submit" id="submit">S'inscrire</button>
                  </div>
               </div>
               <input type="hidden" value="<?= $id ?>" name="master" id="master">
               <input type="hidden" value="<?= $_SESSION['id'] ?>" name="user" id="user">
            </form>
         </div>
         <div role="alert" id="load_data"></div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
         </div>
      </div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
   $(document).ready(function(){
      $("#submit").click(function(event){
         event.preventDefault();
         let master = $("#master").val();
         let user = $("#user").val();
         let first_name = $("#first_name").val();
         let last_name = $("#last_name").val();
         let email = $("#email").val();
         let phone = $("#phone").val();
         let bac = $("#bac").val();
         let high_school = $("#high_school").val();
         let mention = $("#floatingMention").val();
         let licence = $("#licence").val();
         let university = $("#university").val();
         let mentionLicence = $("#floatingMentionLicence").val();
         let pdf_bac = $("#pdf_bac").val();
         let bacFile = $("#pdf_bac")[0].files[0];
         let pdf_licence = $("#pdf_licence").val();
         let licenceFile = $("#pdf_licence")[0].files[0];
         let bac_file = $("#pdf_bac").prop('files');
         let licence_file = $("#pdf_licence").prop('files');
         let maxSize = 2 * 1024
         if(first_name === ""){
            $("#first_name_error").html("Champs Prénom est obligatoire");
         }else{
            $("#first_name_error").html("");
         }
         if(last_name === ""){
            $("#last_name_error").html("Champs nom est obligatoire");
         }else{
            $("#last_name_error").html("");
         }
         if(email === ""){
            $("#email_error").html("Champs email est obligatoire");
         }else{
            $("#email_error").html("");
         }
         if(phone === ""){
            $("#phone_error").html("Champs N° de téléphone est obligatoire");
         }else{
            $("#phone_error").html("");
         }
         if(bac === ""){
            $("#bac_error").html("Champs intitulé de baccalauréat est obligatoire");
         }else{
            $("#bac_error").html("");
         }
         if(high_school === ""){
            $("#high_school_error").html("Champs noms du lycée est obligatoire");
         }else{
            $("#high_school_error").html("");
         }
         if(pdf_bac === ""){
            $("#pdf_bac_error").html("Champs fichier baccalauréat est obligatoire");
         }else{
            $("#pdf_bac_error").html("");
         }
         if(bac_file.length > 0){
            if(bac_file[0].type !== "application/pdf"){
               $("#pdf_bac_error").html("Nous acceptons que les fichiers pdf");
            }else if(bac_file[0].size <= maxSize){
               $("#pdf_bac_error").html("La capacité de fichier doit être inférieur à 2 mega");
            }else{
               $("#pdf_bac_error").html("");
            }
         }
         if(licence === ""){
            $("#licence_error").html("Champs intitulé de licence est obligatoire");
         }else{
            $("#licence_error").html("");
         }
         if(university === ""){
            $("#university_error").html("Champs nom de l'univérsité est obligatoire");
         }else{
            $("#university_error").html("");
         }
         if(pdf_licence === ""){
            $("#pdf_licence_error").html("Champs fichier de licence est obligatoire");
         }else{
            $("#pdf_licence_error").html("");
         }
         if(licence_file.length > 0){
            if(licence_file[0].type !== "application/pdf"){
               $("#pdf_licence_error").html("Nous acceptons que les fichiers pdf");
            }else if(licence_file[0].size <= maxSize){
               $("#pdf_licence_error").html("La capacité de fichier doit être inférieur à 2 mega");
            }else{
               $("#pdf_licence_error").html("");
            }
         }
         if(first_name !== "" && last_name !== "" && email !== "" && phone !== "" && bac !== "" && high_school !== "" && pdf_bac !== "" && licence !== "" && university !== "" && pdf_licence !== ""){
            let formData = new FormData();
            formData.append("first_name", first_name);
            formData.append("last_name", last_name);
            formData.append("email", email);
            formData.append("phone", phone);
            formData.append("bac", bac);
            formData.append("high_school", high_school);
            formData.append("mention", mention);
            formData.append("licence", licence);
            formData.append("university", university);
            formData.append("mentionLicence", mentionLicence);
            formData.append("bacFile", bacFile);
            formData.append("licenceFile", licenceFile);
            formData.append("master", master);
            formData.append("user", user);
            $.ajax({
               url: "../wp-content/themes/mastersearch/functions/subscribe.php",
               type: "POST",
               data: formData,
               dataType: 'json',
               contentType: false,
               processData: false,
            },function(result){
                  console.log(result)
               });
            $("#load_data").html("Vous êtes bien inscrit à ce master");
            $("#load_data").addClass("alert");
            $("#load_data").addClass("alert-success");
            $("#load_data").addClass("text-center");
            $("#load_data").addClass("mt-4");
            $("#load_data").addClass("w-50");
            $("#load_data").addClass("mx-auto");
            location.reload();
         }
      })
   })
</script>
<?php
    global $wpdb;
?>
<?php
    include "../wp-content/plugins/find-master/functions/getUsers.php";
    include "../wp-content/plugins/find-master/functions/getMasters.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include "../wp-content/plugins/find-master/includes/external/external.php" ?>
        <style>
            <?php include "../wp-content/plugins/find-master/includes/css/styles.css" ?>
        </style>
        <script>
            <?php include "../wp-content/plugins/find-master/includes/js/main.js" ?>
        </script>
    </head>
    <body>
        <div class="container">
            <h3 class="text-center mt-5 mb-3">Inscription</h3>
            <div class="row text-center my-4">
                <?php
                    foreach($all_masters as $master){  
                ?>
                <div class="col-md-3 mt-3">
                    <button type="button" class="btn btn-primary master" data-name="<?= $master->id ?>">
                        <?= $master->master_name ?>
                    </button>
                </div>
                <?php
                    }
                ?>
            </div>
            <h3 class="text-center pt-5" id="note">Veuillez choisir un master pour les candidats</h3>
            <div id="load_data"></div>
            <table class="table table-striped table-hover" id="table" style="display: none;">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Candidat</th>
                        <th>Email</th>
                        <th>Master postulé</th>
                        <th>Bac</th>
                        <th>Mention</th>
                        <th>Licence</th>
                        <th>Mention</th>
                        <th>Documents</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="load_data">
                </tbody>
            </table>
        </div>
    </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.master').click(function(){
            $('#note').hide()
            let master = $(this).data('name');
            $.post("../wp-content/plugins/find-master/functions/get_master_by_user.php", {master: master, action: "master_candidat"
            }, function(data) {
                $('#load_data').html(data);
            })
        })
    })
</script>
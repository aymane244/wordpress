<?php
    global $wpdb;
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
    <?php
        include "../wp-content/plugins/find-master/functions/getNumbers.php";
    ?>
    <body>
        <div class="container">
            <h3 class="text-center mt-5 mb-3">DASHBOARD</h3>
            <div class="row mt-5">
                <div class="col-md-3 mt-3">
                    <div class="bg-success text-white border rounded shadow px-3 py-3">
                        <p class="fs-5">Nombre des étudiants inscris : <?php echo count($students) ?></p>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="bg-primary text-white border rounded shadow px-3 py-3">
                        <p class="fs-5">Nombre des universités ouvertes : <?php echo count($universties) ?></p>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="bg-white text-dark border rounded shadow px-3 py-3">
                        <p class="fs-5">Nombre des branches ouvertes : <?php echo count($disciplines) ?></p>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="bg-danger text-white border rounded shadow px-3 py-3">
                        <p class="fs-5">Nombre des master ouverts : <?php echo count($masters) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

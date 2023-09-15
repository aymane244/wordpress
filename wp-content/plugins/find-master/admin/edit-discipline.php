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
    <title>Edit Branche</title>
</head>
<?php 
    include "../wp-content/plugins/find-master/functions/getUniversities.php";
    include "../wp-content/plugins/find-master/functions/getDisciplines.php";
    foreach($all_disciplines as $discipline){
        $name = $discipline->discipline_name;
        $description = $discipline->discipline_description;
        $university_name = $discipline->university_name;
        $university_id = $discipline->discipline_university;
    }
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $universty = $_POST['university'];
        $description = $_POST['description'];
        $table_name = $wpdb->prefix . 'discipline';
        $data = array(
            'discipline_name' => $name,
            'discipline_description' => $description,
            'discipline_university' => $universty,
        );
        $where = array(
            'id' => $id,
        );
        $result = $wpdb->update($table_name, $data, $where);
        echo "<script>location.href='/wordpress/wp-admin/admin.php?page=discipline'</script>";
    }
?>
<body>
    <div class="container">
        <h3 class="text-center my-5">Editer <?= $name ?></h3>
        <form action="" method="POST">
            <div class="row justify-content-center">
                <div class="col-md-6 mb-3">
                    <div class="form-floating mb-3">
                        <select class="form-select w-100" id="select_university" aria-label="University" name="university">
                            <option value="<?= $university_id ?>"><?= $university_name ?></option>
                            <?php
                                foreach($universties as $universty){
                                    if($university_id !== $universty->id){
                            ?>        
                            <option value="<?= $universty->id ?>"><?= $universty->university_name ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                        <label for="select_university">Veuillez choisir une université</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?= $name ?>">
                        <label for="name">Nom de la branche</label>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description" style="height: 100px"><?= $description ?></textarea>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary mt-3 px-5 py-2 fs-5" name="submit" id="submit">
                        <i class="fa-solid fa-pen-to-square"></i> Modifier
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        tinymce.init({
            selector: '#description',
            branding: false,
            plugins: [
                'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
                'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
                'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
        });
    </script>
</body>
</html>
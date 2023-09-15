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
    <title>Edit Université</title>
</head>
<?php 
    include "../wp-content/plugins/find-master/functions/getUniversities.php";
    foreach($all_universties as $university){
        $name = $university->university_name;
        $city = $university->university_city;
        $description = $university->univerisity_description;
        $logo = $university->university_logo;
    }
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $city = $_POST['city'];
        $description = $_POST['description'];
        $logo_db = $_FILES['logo'];
        $logoName = $logo_db['name'];
        $logoTmpName = $logo_db['tmp_name'];
        $logoError = $logo_db['error'];
        $path = '';
        if($logoError === UPLOAD_ERR_OK){
            $year = date('Y');
            $month = date('m');
            $path = $year."/".$month."/".$logoName;
            move_uploaded_file($logoTmpName, "../wp-content/uploads/".$path);
        }
        $table_name = $wpdb->prefix . 'universite';
        $data = array(
            'university_name' => $name,
            'university_city' => $city,
            'univerisity_description' => $description,
        );
        $data_img = array(
            'university_name' => $name,
            'university_city' => $city,
            'univerisity_description' => $description,
            'university_logo' => str_replace(' ', '-',$path),
        );
        $where = array(
            'id' => $id,
        );
        if($_FILES['logo']['error'] === UPLOAD_ERR_OK){
            $wpdb->update($table_name, $data_img, $where);
        }else{
            $wpdb->update($table_name, $data, $where);
        }
        echo "<script>location.href='/wordpress/wp-admin/admin.php?page=university'</script>";
    }
    if(isset($_FILES['logo'])){
        $logo_university = basename($_FILES['logo']['name']);
        if(!empty($logo_db['tmp_name'])){
            $upload = wp_upload_bits($logo_university, null, file_get_contents($logo_db['tmp_name']));
            if ($upload['error'] === false) {
                $attachment = array(
                    'post_mime_type' => $upload['type'],
                    'post_title' => $logo_university,
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                $attach_id = wp_insert_attachment($attachment, $upload['file']);
                $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
                wp_update_attachment_metadata($attach_id, $attach_data);
            }
        }
    }
?>
<body>
    <div class="container">
        <h3 class="text-center my-5">Editer <?= $name ?></h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 text-center border-end mb-3">
                    <img src="../wp-content/uploads/<?= $logo ?>" alt="logo" class="rounded-circle img-fluid position-relative" id="db-img">
                    <div class="position-relative">
                        <div id="show_logo" style="background-repeat:no-repeat" class="mx-auto rounded-circle mb-4 img-fluid"></div>
                        <div class="div-position"><i class="fa-solid fa-xmark fs-3 text-danger pointer" id="hide_logo"></i></div>
                    </div>
                    <div class="input-group">
                        <input type="file" class="form-control py-1 px-1 logo" id="logo_university" aria-describedby="logo_university" aria-label="Charger" name="logo" id="logo_university">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?= $name ?>">
                        <label for="name">Nom de l'université</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?= $city ?>">
                        <label for="city">Ville de l'université</label>
                    </div>
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
    <script>
        $(document).ready(function() {
            $("#logo_university").change(function(e){
                $("#show_logo").show();
                const input = e.target;
                const fileName = input.files[0].name;
                const extension = fileName.split('.').pop();
                if(extension != "png" && extension != "jpg" && extension != "jpeg") {
                    alert('Veuillez insérer un fichier de type jpg, jpeg, png. Le fichier inséré est de type ' + extension);
                    $('#show_logo').removeClass('show_logo');
                }else{
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        let uploaded_image = e.target.result;
                        $('#show_logo').css('background-image', 'url(' + uploaded_image + ')');
                        $('#show_logo').addClass('show_logo');
                    };
                    reader.readAsDataURL(input.files[0]);
                }
                $("#db-img").hide();
            });
            $('#hide_logo').click(function(){
                $("#db-img").show();
                $("#show_logo").hide();
                $('#logo_university').val('');
            })
        });
    </script>
</body>
</html>
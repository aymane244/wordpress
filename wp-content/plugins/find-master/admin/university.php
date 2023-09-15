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
    include "../wp-content/plugins/find-master/functions/getUniversities.php";
    if(isset($_POST['submit_delete'])){
        $id = $_POST['university_id'];
        $table_name = $wpdb->prefix . 'universite';
        $result = $wpdb->delete($table_name, array('id' => $id));
        echo "<script>location.href='/wordpress/wp-admin/admin.php?page=university'</script>";
    }
?>
<body>
    <div class="container">
        <h3 class="text-center mt-5 mb-3">Universités</h3>
        <div class="text-center my-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_university">
                <i class="fa-solid fa-plus"></i> Ajouter une université
            </button>
        </div>
        <table class="table table-striped table-hover">
            <thead class="text-center">
                <tr>
                    <th>#</th>
                    <th>Nom de l'université</th>
                    <th>Ville</th>
                    <th>Logo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                    if(count($universties) == 0){
                ?>
                    <td colspan="4" class="fs-4 text-center">Pas encore d'enregistrement</td>
                <?php        
                    }else{
                ?>
                <?php
                    $i = 1;
                    foreach($universties as $universty){
                ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $universty->university_name ?></td>
                    <td><?= $universty->university_city ?></td>
                    <td><img src=<?="../wp-content/uploads/".$universty->university_logo ?> style="width:100px" /> </td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">
                            <a href="<?php echo admin_url('admin.php?page=edit-university&id=' . $universty->id); ?>" target="_blank">
                                    <i class="fas fa-edit text-success fs-4 pr-lg-2"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="" method="POST">
                                    <input type="hidden" name="university_id" value="<?= $universty->id?>">
                                    <button type="submit" class="bg-transparent border-0" name="submit_delete" onclick='return confirm("Voulez-vous supprimer cette université")'>
                                        <i class="fas fa-trash-alt text-danger fs-4"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php   
                        }     
                    }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade mt-5" id="add_university" tabindex="-1" aria-labelledby="add_university" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add_university">Ajouter une université</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="name">
                            <label for="name">Nom de l'université</label>
                            <span id="name_error" class="text-danger ms-2 fs-8"></span>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="city" placeholder="City" name="city">
                            <label for="city">Ville de l'université</label>
                            <span id="city_error" class="text-danger ms-2 fs-8"></span>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description" style="height: 100px"></textarea>
                            <span id="description_error" class="text-danger ms-2 fs-8"></span>
                        </div>
                        <div class="input-group">
                            <input type="file" class="form-control py-1 px-1 logo logo_university" id="logo_university" aria-describedby="logo_university" aria-label="Charger" name="logo" id="logo_university">
                        </div>
                        <div id="logo_university_error" class="text-danger ms-2 fs-8 mb-3 py-2"></div>
                        <div id="show_logo" style="background-size:100% 100%; background-repeat:no-repeat" class="show_logo"></div>
                        <div id="show_logo_university" class="text-center"></div>
                        <div role="alert" id="load_data"></div>
                        <button type="submit" class="btn btn-primary mt-3" name="submit" id="submit">
                            <i class="fa-solid fa-plus"></i> Ajouter
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
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
        $(document).ready(function(){
            $("#submit").click(function(event){
                tinymce.triggerSave();
                event.preventDefault();
                let name = $("#name").val();
                let city = $("#city").val();
                let description = $("#description").val();
                let logo = $("#logo_university").val();
                let logoFile = $("#logo_university")[0].files[0];
                if(name === ""){
                    $("#name_error").html("Champs nom de l'université est obligatoire");
                }else{
                    $("#name_error").html("");
                }
                if(city === ""){
                    $("#city_error").html("Champs ville de l'université est obligatoire");
                }else{
                    $("#city_error").html("");
                }
                if(description === ""){
                    $("#description_error").html("Champs description est obligatoire");
                }else{
                    $("#description_error").html("");
                }
                if(logo === ""){
                    $("#logo_university_error").html("Champs logo de l'université est obligatoire");
                }else{
                    $("#logo_university_error").html("");
                }
                if(name !== "" && city !== "" && description !== "" && logo !== ""){
                    $.post("../wp-content/plugins/find-master/functions/add_university.php", {name: name, action: "check_name"
                    }, function(result) {
                        if(result > 0){
                            $("#name_error").html("Nom de l'université existe déjà, veuillez réessayer encore une fois");
                        }else{
                            let formData = new FormData();
                            formData.append("name", name);
                            formData.append("city", city);
                            formData.append("description", description);
                            formData.append("logo", logoFile);
                            $.ajax({
                                url: "../wp-content/plugins/find-master/functions/add_university.php",
                                type: "POST",
                                data: formData,
                                dataType: 'json',
                                contentType: false,
                                processData: false,
                                success: function(data){
                                    console.log(data)
                                }
                            });
                            $("#load_data").html("Université bien ajouté");
                            $("#load_data").addClass("alert");
                            $("#load_data").addClass("alert-success");
                            $("#load_data").addClass("text-center");
                            $("#load_data").addClass("mt-4");
                            $("#load_data").addClass("w-50");
                            $("#load_data").addClass("mx-auto");
                            $("#name").val('');
                            $("#city").val('');
                            $("#description").val('');
                            $("#logo_university").val('');
                            $("#show_logo").hide();
                            $("#show_logo_university").hide();
                            location.reload();
                        }
                    })
                }
            })
        });
    </script>
</body>

</html>
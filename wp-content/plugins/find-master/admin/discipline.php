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
    include "../wp-content/plugins/find-master/functions/getDisciplines.php";
    if(isset($_POST['submit_delete'])){
        $id = $_POST['discipline_id'];
        $table_name = $wpdb->prefix . 'discipline';
        $result = $wpdb->delete($table_name, array('id' => $id));
        echo "<script>location.href='/wordpress/wp-admin/admin.php?page=discipline'</script>";
    }
?>
<body>
    <div class="container">
        <h3 class="text-center mt-5 mb-3">Branches</h3>
        <div class="text-center my-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_discipline">
                <i class="fa-solid fa-plus"></i> Ajouter une branche
            </button>
        </div>
        <table class="table table-striped table-hover">
            <thead class="text-center">
                <tr>
                    <th>#</th>
                    <th>Nom de l'université</th>
                    <th>Nom de la branche</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <?php
                        if(count($disciplines) == 0){
                    ?>
                        <td colspan="3" class="fs-4 text-center">Pas encore d'enregistrement</td>
                    <?php        
                        }else{
                    ?>
                    <?php
                        $i = 1;
                        // $counts = countForeignKeys($disciplines, 'university_name');
                        foreach($disciplines as $discipline){
                            $currentUniversity = $discipline->university_name;
                            // $rowspan = isset($counts[$currentUniversity]) ? $counts[$currentUniversity] : 0;
                    ?>
                    <td><?= $i++ ?></td>
                    <td rowspan=""><?= $currentUniversity ?></td>
                    <td><?= $discipline->discipline_name ?></td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">
                            <a href="<?php echo admin_url('admin.php?page=edit-discipline&id=' . $discipline->discipline_id); ?>" target="_blank">
                                    <i class="fas fa-edit text-success fs-4 pr-lg-2"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="" method="POST">
                                    <input type="hidden" name="discipline_id" value="<?= $discipline->discipline_id?>">
                                    <button type="submit" class="bg-transparent border-0" name="submit_delete" onclick='return confirm("Voulez-vous supprimer cette branche")'>
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
    <div class="modal fade mt-5" id="add_discipline" tabindex="-1" aria-labelledby="add_discipline" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add_discipline">Ajouter une branche</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="select_university" aria-label="University" name="university">
                                <?php
                                    foreach($universties as $universty){
                                ?>        
                                <option value="<?= $universty->id ?>"><?= $universty->university_name ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <label for="select_university">Veuillez choisir une université</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="name">
                            <label for="name">Nom de la branche</label>
                            <span id="name_error" class="text-danger ms-2 fs-8"></span>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description" style="height: 100px"></textarea>
                            <span id="description_error" class="text-danger ms-2 fs-8"></span>
                        </div>
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
                let description = $("#description").val();
                let university = $("#select_university").val();
                if(name === ""){
                    $("#name_error").html("Champs nom de la branche est obligatoire");
                }else{
                    $("#name_error").html("");
                }
                if(description === ""){
                    $("#description_error").html("Champs description est obligatoire");
                }else{
                    $("#description_error").html("");
                }
                if(name !== "" && description !== "" ){
                    $.post("../wp-content/plugins/find-master/functions/add_discipline.php", 
                    {name: name, description: description, university: university,action: "add_discipline"
                    }, function(result) {
                        $("#load_data").html("Branche bien ajoutée");
                        $("#load_data").addClass("alert");
                        $("#load_data").addClass("alert-success");
                        $("#load_data").addClass("text-center");
                        $("#load_data").addClass("mt-4");
                        $("#load_data").addClass("w-50");
                        $("#load_data").addClass("mx-auto");
                        $("#name").val('');
                        $("#description").val('');
                        location.reload();
                    })
                }
            })
        });
    </script>
</body>

</html>
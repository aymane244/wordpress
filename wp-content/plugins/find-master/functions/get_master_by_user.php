<?php
    include "../../../../wp-config.php";
    global $wpdb;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    if($action === 'master_candidat'){
        $master = $_POST['master'];
        $users = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}subscribe s
            INNER JOIN {$wpdb->prefix}visitors v ON s.user_id = v.id
            INNER JOIN {$wpdb->prefix}master m ON s.master_id = m.id
            WHERE s.master_id = $master
        ");
        $masters = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}master m WHERE m.id = $master");
        foreach($masters as $item){
            $name = $item->master_name;
        }
?>
<table class="table table-striped table-hover">
    <thead class="text-center"> 
        <tr>
            <th>#</th>
            <th>Candidat</th>
            <th>Email</th>
            <th>Bac</th>
            <th>Mention</th>
            <th>Licence</th>
            <th>Mention</th>
            <th>Documents</th>
        </tr>
    </thead>
<?php    
        if(count($users) === 0){
?>
    <tbody class="text-center">
        <tr>
            <td colspan="9"><h3>Pas de candidats pour <?= $name ?></h3></td>
        </tr>
<?php
        }else{
            $i = 1;
            foreach($users as $user){
?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $user->visitor_name.' '. $user->visitor_last_name ?></td>
            <td><?= $user->visitor_email ?></td>
            <td><?= $user->sub_bac ?></td>
            <td><?= $user->sub_mention ?></td>
            <td><?= $user->sub_licence ?></td>
            <td><?= $user->sub_mention_licence ?></td>
            <td>
                <a href=<?="../wp-content/uploads/".$user->sub_bac_file ?> download="<?="../wp-content/uploads/".$user->sub_bac_file ?>">Document bac</a>
                <a href=<?="../wp-content/uploads/".$user->sub_licence_file ?> download="<?="../wp-content/uploads/".$user->sub_licence_file ?>">Document licence</a>
            </td>
        </tr>
<?php
            }           
        }
?>
    </tbody>
</table>
<?php
    }
?>
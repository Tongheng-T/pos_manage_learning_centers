<?php require_once("../../config.php");


if(isset($_GET['id'])){

    $query = query("DELETE FROM other_expenses WHERE id = " .escape_string($_GET['id']) . "");
    confirm($query);
    $last_id = $_GET['id'];
    redirect("../../../ui/itemth?tak");
    $alert = <<<DELIMETER

    <script>

    Swal.fire(
        'បាបលុប!',
        'បានលុបការចំណាយប្រចាំថ្ងៃ id {$last_id}',
        'success'
    )
    </script>
    DELIMETER;
    set_message($alert);

}else{
    redirect("../../../ui/itemth?tak");
}

?>
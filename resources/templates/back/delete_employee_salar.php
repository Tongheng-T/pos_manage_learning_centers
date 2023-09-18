<?php require_once("../../config.php");


if(isset($_GET['id'])){

    $query = query("DELETE FROM employee_salar WHERE id = " .escape_string($_GET['id']) . "");
    confirm($query);
    $last_id = $_GET['id'];
    redirect("../../../ui/itemth?monthly_total");
    $alert = <<<DELIMETER

    <script>

    Swal.fire(
        'បាបលុប!',
        'កំណត់ហេតុប្រាក់ខែបុគ្គលិកត្រូវបានលុប id {$last_id}',
        'success'
    )
    </script>
    DELIMETER;
    set_message($alert);

}else{
    redirect("../../../ui/itemth?monthly_total");
}

?>
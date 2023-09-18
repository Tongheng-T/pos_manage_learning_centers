<?php require_once("../../config.php");


if(isset($_GET['id'])){

    $query = query("DELETE FROM pay_for_water WHERE id = " .escape_string($_GET['id']) . "");
    confirm($query);
    $last_id = $_GET['id'];
    redirect("../../../ui/itemt?monthly_total");
    $alert = <<<DELIMETER

    <script>

    Swal.fire(
        'បាបលុប!',
        'បានលុបកំណត់ហេតុបង់ប្រាក់ id {$last_id}',
        'success'
    )
    </script>
    DELIMETER;
    echo $alert;
    set_message($alert);

}else{
    redirect("../../../ui/itemth?monthly_total");
}

?>
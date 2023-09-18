<?php require_once("../../config.php");


if(isset($_GET['id'])){

    $query = query("DELETE FROM invoices WHERE id_oder = " .escape_string($_GET['id']) . "");
    confirm($query);
    $query1 = query("DELETE FROM repaymentdate WHERE id = " .escape_string($_GET['id']) . "");
    confirm($query1);
    $last_id = $_GET['id'];
    redirect("../../../ui/itemt?pos");
    $alert = <<<DELIMETER

    <script>

    Swal.fire(
        'បាបលុប!',
        'ព័ត៌មានអំពីការលក់ {$last_id}ត្រូវបាបលុប។',
        'success'
    )
    </script>
    DELIMETER;
    echo $alert;
    set_message($alert);

}else{
    redirect("../../../ui/itemth?pos");
}

?>
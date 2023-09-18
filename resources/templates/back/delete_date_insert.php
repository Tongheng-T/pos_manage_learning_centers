<?php require_once("../../config.php");


if(isset($_GET['id'])){

    $query = query("DELETE FROM product_insert WHERE id_date = " .escape_string($_GET['id']) . "");
    confirm($query);
    $last_id = $_GET['id'];
    redirect("../../../ui/itemt?products");
    $alert = <<<DELIMETER

    <script>

    Swal.fire(
        'បាបលុប!',
        'កំណត់ហេតុនាំចូល!',
        'success'
    )
    </script>
    DELIMETER;
    echo $alert;
    set_message($alert);

}else{
    redirect("../../../ui/itemth?products");
}

?>​​
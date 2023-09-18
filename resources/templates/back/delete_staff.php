<?php require_once("../../config.php");


if (isset($_GET['id'])) {
    $queryy = query("DELETE FROM seller_name WHERE id_staff = " . escape_string($_GET['id']) . "");
    $query = query("DELETE FROM staff WHERE id_staff = " . escape_string($_GET['id']) . "");
    unlink("../../imguser/".$_GET["n"]);
    confirm($query);
    confirm($queryy);

    $last_id = $_GET['id'];
    redirect("../../../ui/itemth?staff");
    $alert = <<<DELIMETER

    <script>

    Swal.fire(
        'បាបលុប!',
        'បុគ្គលិកលេខសម្គាល់ {$last_id}ត្រូវបាបលុប។',
        'success'
    )
    </script>
    DELIMETER;
    echo $alert;
    set_message($alert);
} else {
    redirect("../../../ui/itemth?staff");
}

?>​​
<?php require_once("../../config.php");


if (isset($_GET['id'])) {


    $query = query("DELETE FROM tbl_employee_students WHERE sdpay_id = " . escape_string($_GET['id']) . "");
    confirm($query);

    $last_id = $_GET['id'];

    set_message(' <script>
    Swal.fire({
      icon: "success",
      title: "បាបលុប!",
      text: "អព័ត៌មានបង់ប្រាក់ ID: ' . $last_id . '"
     });
   </script>');

    redirect("../../../ui/itemt?students_pay");
} else {

    set_message(' <script>

    Swal.fire(
        title: "មិនបាបលុប!",
        text: "អព័ត៌មានបង់ប្រាក់ ID: ' . $last_id . '",
        icon: "error"
    )
    </script>');
    redirect("../../../ui/itemt?students_pay");
}

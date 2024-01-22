<?php require_once("../../config.php");


if (isset($_GET['id'])) {

    $select_img = query("SELECT sd_img from tbl_students where sd_id =" . $_GET['id'] . "");
    confirm($select_img);
    $row = $select_img->fetch_assoc();

    $query = query("DELETE FROM tbl_students WHERE sd_id = " . escape_string($_GET['id']) . "");
    $queryy = query("DELETE FROM tbl_employee_students WHERE sd_id = " . escape_string($_GET['id']) . "");
    confirm($query);

    $db_image = $row['sd_img'];

    if ($db_image != 'display.jpg') {
        unlink("../../../productimages/students/$db_image");
    }

    $last_id = $_GET['id'];

    set_message(' <script>
    Swal.fire({
      icon: "success",
      title: "បាបលុប!",
      text: "អព័ត៌មានសិស្ស ID: ' . $last_id . '"
     });
   </script>');

    redirect("../../../ui/itemt?tudentslist");
} else {

    set_message(' <script>

    Swal.fire(
        title: "មិនបាបលុប!",
        text: "អព័ត៌មានសិស្ស ID: ' . $last_id . '",
        icon: "error"
    )
    </script>');
    redirect("../../../ui/itemt?tudentslist");
}

<?php require_once("../../config.php");


if (isset($_GET['id'])) {

    $select_img = query("SELECT tc_img from tbl_teacher where tc_id =" . $_GET['id'] . "");
    confirm($select_img);
    $row = $select_img->fetch_assoc();

    $query = query("DELETE FROM tbl_teacher WHERE tc_id = " . escape_string($_GET['id']) . "");
    confirm($query);

    $db_image = $row['tc_img'];

    if ($db_image != 'display.jpg') {
        unlink("../../../productimages/teacher/$db_image");
    }

    $last_id = $_GET['id'];

    set_message(' <script>
    Swal.fire({
      icon: "success",
      title: "បាបលុប!",
      text: "អព័ត៌មានគ្រូ ID: ' . $last_id . '"
     });
   </script>');

    redirect("../../../ui/itemt?teacher_list");
} else {

    set_message(' <script>

    Swal.fire(
        title: "មិនបាបលុប!",
        text: "អព័ត៌មានគ្រូ ID: ' . $last_id . '",
        icon: "error"
    )
    </script>');
    redirect("../../../ui/itemt?teacher_list");
}

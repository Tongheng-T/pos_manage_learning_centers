<?php require_once("../../config.php");


if (isset($_GET['id'])) {

    $select_img = query("SELECT car_img from tbl_car_driver where car_id =" . $_GET['id'] . "");
    confirm($select_img);
    $row = $select_img->fetch_assoc();

    $query = query("DELETE FROM tbl_car_driver WHERE car_id = " . escape_string($_GET['id']) . "");
    confirm($query);

    $db_image = $row['car_img'];

    if ($db_image != 'display.jpg') {
        unlink("../../../productimages/driver/$db_image");
    }

    $last_id = $_GET['id'];

    set_message(' <script>
    Swal.fire({
      icon: "success",
      title: "បាបលុប!",
      text: "អព័ត៌មានអ្នកបើកបររថយន្ត ID: ' . $last_id . '"
     });
   </script>');

    redirect("../../../ui/itemt?driverlist");
} else {

    set_message(' <script>

    Swal.fire(
        title: "មិនបាបលុប!",
        text: "អព័ត៌មានអ្នកបើកបររថយន្ត ID: ' . $last_id . '",
        icon: "error"
    )
    </script>');
    redirect("../../../ui/itemt?driverlist");
}

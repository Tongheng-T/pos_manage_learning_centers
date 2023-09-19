<?php
include_once '../../config.php';
$id = $_GET['id'];

if (isset($id)) {

    $select_img = query("SELECT img from tbl_user where user_id =" . $_GET['id'] . "");
    confirm($select_img);
    $row = $select_img->fetch_assoc();
    $db_image = $row['img'];

    $delete = query("DELETE from tbl_user where user_id =" . $id);
    confirm($delete);
    if ($delete) {
        
        if ($db_image != 'hello.png') {
            unlink("../../../productimages/user/$db_image");
        }

        set_message(' <script>
        Swal.fire({
        icon: "success",
        title: "Account deleted successfully"
        });
       </script>');
        redirect('../../../ui/itemt?registration');
    } else {
        set_message(' <script>
        Swal.fire({
        icon: "warning",
        title: "Account Is Not Deleted"
        });
       </script>');
        redirect('../../../ui/itemt?registration');
       
    }
}

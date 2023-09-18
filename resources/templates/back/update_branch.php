<?php

require_once("../../config.php");
?>




<div class="card card-success card-outline">

  <div class="card-body">

    <?php

    if (isset($_POST['id'])) {
      $id_branch =  $_POST['id'];
      $id =$_SESSION['userid'];
      $update = query("UPDATE tbl_user set id_branch= '$id_branch' where user_id=" . $id);
      confirm($update);
    }redirect("../../../ui/itemt?chang_branch");
    ?>


  </div>
</div>
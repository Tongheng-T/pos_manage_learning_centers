<?php require_once("../resources/config.php"); ?>

<?php

if ($_SESSION['role'] == "Admin") {
    include_once(TEMPLATE_BACK . "/header.php");
} else {
    include_once(TEMPLATE_BACK . "/headeruser.php");
}
?>


<?php check_login();
if ($_SESSION['useremail'] == "" or $_SESSION['role'] == "Admin") {
    header("Location: ../");
}
?>


<div class="content-wrapper">


    <?php

if ($_SERVER['REQUEST_URI'] == "/user/" || $_SERVER['REQUEST_URI'] == "/user/itemt") {

    include(TEMPLATE_BACK . "/tudentslist.php");
}

if (isset($_GET['tudentslist'])) {

    include(TEMPLATE_BACK . "/tudentslist.php");
}


if (isset($_GET['changepassword'])) {

    include(TEMPLATE_BACK . "/changepassword.php");
}
if (isset($_GET['logout'])) {

    include(TEMPLATE_BACK . "/logout.php");
}
if (isset($_GET['editorderpos'])) {

    include(TEMPLATE_BACK . "/editorderpos.php");
}

    
    ?>



</div>


<!-- /#page-wrapper -->
<?php include(TEMPLATE_BACK . "/footer.php"); ?>
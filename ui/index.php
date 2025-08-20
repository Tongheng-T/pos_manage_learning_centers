<?php require_once("../resources/config.php"); ?>

<?php

if ($_SESSION['role'] == "Admin") {
    include_once(TEMPLATE_BACK . "/header.php");
} elseif ($_SESSION['role'] == "Adminn"){
    include_once(TEMPLATE_BACK . "/headeradminn.php");
} else {
    include_once(TEMPLATE_BACK . "/headeruser.php");
}
?>


<?php check_login();
if ($_SESSION['useremail'] == "" or $_SESSION['role'] == "User") {
    header("Location: ../");
}
?>
<!-- <style>
    .content-wrapper::before{
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url(../productimages/logo/22.png);
        background-size: cover;
        background-repeat:no-repeat ;
        opacity: 0.2;
        

    }
</style> -->

<div class="content-wrapper">


    <?php

    if ($_SERVER['REQUEST_URI'] == "/ui/" || $_SERVER['REQUEST_URI'] == "/ui/itemt") {

        include(TEMPLATE_BACK . "/dashboard.php");
    }

    if (isset($_GET['dashboard'])) {

        include(TEMPLATE_BACK . "/dashboard.php");
    }
        if (isset($_GET['certificate'])) {

        include(TEMPLATE_BACK . "/certificate.php");
    }

    if (isset($_GET['subject'])) {

        include(TEMPLATE_BACK . "/Subject.php");
    }


    if (isset($_GET['studytime'])) {

        include(TEMPLATE_BACK . "/studytime.php");
    }
    if (isset($_GET['Classroom'])) {

        include(TEMPLATE_BACK . "/Classroom.php");
    }

    if (isset($_GET['teacher_list'])) {

        include(TEMPLATE_BACK . "/teacher_list.php");
    }

    if (isset($_GET['edit_teacher'])) {

        include(TEMPLATE_BACK . "/edit_teacher.php");
    }
    if (isset($_GET['car_price'])) {

        include(TEMPLATE_BACK . "/car_price.php");
    }

    if (isset($_GET['tudentslist'])) {

        include(TEMPLATE_BACK . "/tudentslist.php");
    }

    if (isset($_GET['add_tudents'])) {

        include(TEMPLATE_BACK . "/pos.php");
    }

    if (isset($_GET['students_pay'])) {

        include(TEMPLATE_BACK . "/students_pay.php");
    }

    if (isset($_GET['setting'])) {

        include(TEMPLATE_BACK . "/setting.php");
    }



    if (isset($_GET['reportbycategory'])) {

        include(TEMPLATE_BACK . "/reportbycategory.php");
    }
    if (isset($_GET['tablereport'])) {

        include(TEMPLATE_BACK . "/tablereport.php");
    }



    if (isset($_GET['driverlist'])) {

        include(TEMPLATE_BACK . "/driver_list.php");
    }


    if (isset($_GET['chang_branch'])) {

        include(TEMPLATE_BACK . "/chang_branch.php");
    }
    if (isset($_GET['branch'])) {
        include(TEMPLATE_BACK . "/branch.php");
    }


    if (isset($_GET['registration'])) {
        include(TEMPLATE_BACK . "/registration.php");
    }
    if (isset($_GET['changepassword'])) {

        include(TEMPLATE_BACK . "/changepassword.php");
    }
    if (isset($_GET['logout'])) {

        include(TEMPLATE_BACK . "/logout.php");
    }
    
    ?>



</div>


<!-- /#page-wrapper -->
<?php include(TEMPLATE_BACK . "/footer.php"); ?>
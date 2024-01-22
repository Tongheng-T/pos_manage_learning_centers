<?php


if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

    header('location:../');
}


display_message();
insert_update_delete_Classroom();


?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">ថ្នាក់រៀន</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li> -->
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">

        <div class="card card-warning card-outline">
            <div class="card-header">
                <h5 class="m-0">ថ្នាក់រៀន Form</h5>
            </div>


            <form action="" method="post">
                <div class="card-body">


                    <div class="row">


                        <?php edit_Classroom(); ?>

                        <div class="col-md-8">

                            <table id="table_category" class="table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Category</td>
                                        <td>Edit</td>
                                        <td>Delete</td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php query_Classroom(); ?>

                                </tbody>

                                <!-- <tfoot>
                                    <tr>
                                        <td>#</td>
                                        <td>Category</td>
                                        <td>Edit</td>
                                        <td>Delete</td>

                                    </tr>

                                </tfoot> -->

                            </table>

                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->



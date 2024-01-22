<?php


if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

    header('location:../');
}


display_message();
insert_update_delete_car_price();


?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">ម៉ោងសិក្សារ</h1>
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
                <h5 class="m-0">ម៉ោងសិក្សារ Form</h5>
            </div>


            <form action="" method="post">
                <div class="card-body">


                    <div class="row">


                        <?php edit_car_price(); ?>

                        <div class="col-md-8">

                            <table id="table_category" class="table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>ចំនួន</td>
                                        <td>តម្លៃ</td>
                                        <td>Edit</td>
                                        <td>Delete</td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php query_car_price(); ?>

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



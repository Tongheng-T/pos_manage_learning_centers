<?php


if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

    header('location:../');
}


display_message();
insert_update_delete_Branch_Name();


?>


<!-- Main content -->
<div class="content">
    <div class="container-fluid">

        <div class="card card-success card-outline">
            <div class="card-header">
                <h5 class="m-0">សាខា Form</h5>
            </div>


            <form action="" method="post">
                <div class="card-body">


                    <div class="row">


                        <?php edit_branch(); ?>

                        <div class="col-md-8">

                            <table id="table_category" class="table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>ឈ្មោះសាខា</td>
                                        <td>Edit</td>
                                        <td>Delete</td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php query_branch(); ?>

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



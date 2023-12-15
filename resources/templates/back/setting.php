<?php
if ($_SESSION['useremail'] == "") {
    header('location:../');
}
display_message();
changepassword();

?>



<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Setting</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class="content" style="padding: 10px;">
                                    <div class="row">

                                        <table class="table table-striped table-hover ">
                                            <thead>
                                                <tr>
                                                    <td>Logo</td>
                                                    <td>Name_receipt</td>
                                                    <td>Receipt_Address</td>
                                                    <td>Receipt_Email</td>
                                                    <td>Receipt_Phone</td>
                                                    <td>Importan_Notice</td>
                                                    <td>Edit</td>

                                                </tr>

                                            </thead>


                                            <tbody>

                                                <?php

                                                $select = query("SELECT * from tbl_setting ");
                                                confirm($select);


                                                while ($row = $select->fetch_object()) {


                                                    echo '
                                       <tr>
                                       <td> <img height="50" src="../productimages/logo/' . $row->logo . '" alt=""> </td>
                                       <td>' . $row->name_receipt . '</td>
                                       <td>' . $row->receipt_Address . '</td> 
                                       <td>' . $row->receipt_Email . '</td>
                                       <td>' . $row->receipt_Phone . '</td>
                                       <td>' . $row->Importan_Notice . '</td>
                                       <td><button type="submit" class="btn btn-primary" value="' . $row->setting_id . '" name="btnedit">Edit</button></td>
      
                                       </tr>';
                                                }
                                                ?>
                                            </tbody>

                                        </table>

                                    </div>
                                </div>

                        </div>
                        </form>
                        <?php edit_setting() ?>
                    </div>



                    <br>
                </div>
                <!-- /.card -->






                <!-- Horizontal Form -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">វិញ្ញាបនបត្របញ្ជប់ការសិក្សា</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class="content" style="padding: 10px;">
                                    <div class="row">

                                        <table class="table table-striped table-hover ">
                                            <thead>
                                                <tr>
                                                    <td>ឈ្មោះមជ្ឈមណ្ឌលសិក្សា(សូមបញ្ជាក់ថា ៖សិស្សឈ្មោះ៖...) </td>
                                                    <td>សេចក្តីបញ្ជាក់បញ្ចប់ការសិក្សា</td>
                                                    <td>សេចក្តីបញ្ជាក់ខាងក្រោយ</td>
                                                    <td>ថ្ងៃខែចេញវិញ្ញាប័ណ្ណ(ខ្មែរ​)</td>
                                                    <td>ត្រា</td>
                                                    <td>ហត្ថលេខា</td>
                                                    <td>ស៊ុម</td>
                                                    <td>ឈ្មោះនាយក</td>
                                                    <td>Edit</td>

                                                </tr>

                                            </thead>


                                            <tbody>

                                                <?php

                                                $select = query("SELECT * from tbl_setting ");
                                                confirm($select);


                                                while ($row = $select->fetch_object()) {


                                                    echo '
                                       <tr>
                            
                                       <td>' . $row->Technology_Top . '</td>
                                       <td>' . $row->Technology_txt . '</td> 
                                       <td>' . $row->Technology_Study . '</td>
                                       <td>' . $row->Date_of_certificate . '</td>
                                       <td> <img height="50" src="../productimages/logo/' . $row->traimg . '" ></td>
                                       <td><img height="50" src="../productimages/logo/' . $row->signature . '" ></td>
                                       <td><img height="50" src="../productimages/certificate/' . $row->form_image . '" ></td>
                                       <td>' . $row->director . '</td>
                                       <td><button type="submit" class="btn btn-primary" value="' . $row->setting_id . '" name="btnedit_certificate">Edit</button></td>
      
                                       </tr>';
                                                }
                                                ?>
                                            </tbody>

                                        </table>

                                    </div>
                                </div>

                        </div>
                        </form>

                    </div>

                    <div class="card card-danger ">

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">

                                    <?php edit_setting_certificate() ?>

                                </div>

                                <br>
                            </div>

                        </form>

                        <!-- /.card -->

                    </div>

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->








    <script>
        $('.chang_branch').on('click', function() {
            var id = $(this).attr("id");
            $.ajax({
                url: "../resources/templates/back/update_branch.php",
                method: "post",
                data: {
                    id: id
                },
                success: function(data) {
                    window.location.href = 'itemt?chang_branch';
                }

            });
        })
    </script>
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
                        <h3 class="card-title">ជ្រើសរើសសាខា</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <br>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="content" style="padding: 10px;">
                                <div class="row">
                                    <?php branch() ?>
                                </div>
                            </div>

                        </div>
                    </div>



                    <br>
                </div>
                <!-- /.card -->


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
<?php


if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

    header('location:../');
}


display_message();
insert_update_delete();


?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">មុខវិជ្ជា</h1>
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
                <h5 class="m-0">មុខវិជ្ជា Form</h5>
            </div>


            <form action="" method="post">
                <div class="card-body">


                    <div class="row">


                        <?php edit_category(); ?>

                        <div class="col-md-8">

                            <table id="table_categoryy" class="table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>មុខវិជ្ជា</td>
                                        <td>តម្លៃសិក្សារ/ខែ</td>
                                        <td>តម្លៃសិក្សារ/ឆ្នាំ</td>
                                        <td>តម្លៃឡាន/ខែ</td>
                                        <td>តម្លៃឡាន/ឆ្នាំ</td>
                                        <td>Edit</td>
                                        <td>Delete</td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php query_category(); ?>

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



<!-- <script>
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')
        Swal.fire({
            title: "លុបឈ្មោះគ្រូ!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    })
</script> -->
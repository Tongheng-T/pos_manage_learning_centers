<!-- Content Header (Page header) -->

<?php if ($_SESSION['useremail'] == "User") {
    header('location:../');
}; ?>

<?php
display_message();
registration();
?>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Registration</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php edit_registration(); ?>

                    <div class="col-md-8">
                        <form action="" method="post">
                            <table class="table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Password</td>
                                        <td>Role</td>
                                        <td>Delete</td>
                                    </tr>

                                </thead>


                                <tbody>

                                    <?php

                                    $select = query("SELECT * from tbl_user order by user_id ASC");
                                    confirm($select);

                                    $admin = 'Admin';
                                    $user = 'User';
                                    while ($row = $select->fetch_object()) {
                                        if ($row->role == $admin or $row->role == $user) {
                                            $password = "********";
                                        } else {
                                            $password = $row->password;
                                        }
                                        if ($row->useremail == "admin@gmail.com") {
                                            $delete = '';
                                        } else {
                                            $delete = '<a href="../resources/templates/back/delete_user.php?id=' . $row->user_id . '" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>';
                                        }
                                        echo '
                                       <tr>
                                       <td>' . $row->user_id . '</td>
                                       <td> <img height="50" src="../productimages/user/' . $row->img . '" alt=""> ' . $row->username . '</td>
                                       <td>' . $row->useremail . '</td>
                                       <td>' . $password . '</td>  
                                       <td>' . $row->role . '</td>
                                       <td><button type="submit" class="btn btn-primary" value="' . $row->user_id . '" name="btnedit">Edit</button></td>
                                       <td>' . $delete . '</td>
                                       </tr>';
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </form>
                    </div>

                </div>
            </div>
        </div>


    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<script>
    function show() {
        var p = document.getElementById('pwd');
        p.setAttribute('type', 'text');
    }

    function hide() {
        var p = document.getElementById('pwd');
        p.setAttribute('type', 'password');
    }

    var pwShown = 0;

    document.getElementById("eye").addEventListener("click", function() {
        if (pwShown == 0) {
            pwShown = 1;
            show();
        } else {
            pwShown = 0;
            hide();
        }
    }, false);
</script>
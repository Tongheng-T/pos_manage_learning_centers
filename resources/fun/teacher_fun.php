<?php


function teacher_list()
{
    $id_branch =branch_id();
    $select = query("SELECT * from tbl_teacher where id_branch= $id_branch order by tc_id DESC");
    confirm($select);

    while ($row = $select->fetch_object()) {

        echo '
           <tr>
           <td>' . $row->tc_id . '</td>
           <td>' . $row->tc_namekh . ' <img width="40px" height="40px" class="img-rounded" src="../productimages/teacher/' . $row->tc_img . '"></td>
           <td>' . $row->tc_nameen . '</td>
           <td>' . $row->tc_sex . '</td>
           <td>' . date('d-m-Y', strtotime($row->tc_db)) . '</td>
           <td>' . $row->tc_phone . '</td>

           <td>' . show_subject($row->tc_subjects_id) . '</td>
           <td>' . $row->tc_salary . '</td>	
           <td>' . date('d-m-Y', strtotime($row->tc_date_of_employment)) . '</td>	
  
           <td>
           
           <div class="btn-group">
           <a href="teacher_id.php?id=' . $row->tc_id . '" class="btn btn-primary btn-xs" role="button"><span class="fa fa-id-card" style="color:#ffffff" data-toggle="tooltip" title="Delete students"></span></a>
           
           <button id=' . $row->tc_id . ' class="btn btn-info btn-xs payroll" data-toggle="modal" role="button" data-target="#exampleModalpay"><span class="fas fa-money-bill-alt" style="color:#ffffff" data-toggle="tooltip" title="បើកប្រាក់ខែ"></span></button>
           
           <button id=' . $row->tc_id . ' class="btn btn-warning btn-xs view" data-toggle="modal" role="button" data-target="#exampleModal_view"><span class="fa fa-eye" style="color:#ffffff" data-toggle="tooltip" title="View teacher"></span></button>
           
           <button id=' . $row->tc_id . ' class="btn btn-success btn-xs btnedit" data-toggle="modal" role="button" data-target="#exampleModal"><span class="fa fa-edit" style="color:#ffffff" data-toggle="tooltip" title="Edit teacher"></span></button>
           
           <a href="../resources/templates/back/delete_teacher.php?id=' . $row->tc_id . '" class="btn btn-danger btn-delete btn-xs" role="button"><span class="fa fa-trash" style="color:#ffffff" data-toggle="tooltip" title="Delete teacher"></span></a>
          
           </div>
           
           </td>
           
           </tr>';
    }
}

function teacher_Payroll()
{
    if (isset($_POST['submit'])) {

        $tc_id = $_POST['submit'];
        $money = $_POST['txt_salary'];
        $date = $_POST['txtdatesalary'];
        $datedb = date('Y-m-d', strtotime($date));
        $name = $_POST['txtnamekh'];
        $result = explode('-', $datedb);
        $datee = $result[2];
        $month = $result[1];
        $year = $result[0];
        $new = $year . '-' . $month;

        // $queryy = query("SELECT * FROM tbl_employee_teacher WHERE tc_id = $tc_id and date like '{$new}%' ");
        // $row = fetch_array($queryy);
        // $moneyin =  $row['money'];
        // $id =  $row['id'];
        // $total_money = $moneyin + $money;
        // if (mysqli_num_rows($queryy) > 0) {

        //     $queryupdate = query("UPDATE tbl_employee_teacher SET money ='$total_money', date ='$datedb' WHERE tc_id = '$tc_id' and date like '{$new}%' ");
        //     confirm($queryupdate);
        //     $last_id = $id;
        // } else {

        // }
        $id_branch =branch_id();

        if ($money == 0) {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Money Feild is Empty"
            });
           </script>');
            redirect('itemt?teacher_list');
        } else {

            $query = query("INSERT INTO tbl_employee_teacher(tc_id,money,date,id_branch) VALUES('{$tc_id}','{$money}','{$datedb}','{$id_branch}')");
            $last_id = last_id();
            confirm($query);

            set_message(' <script>
        Swal.fire({
        icon: "success",
        title: "បើកប្រាក់ខែឲ្យបុគ្គលិក",
        text:"បានបើកប្រាក់ខែឲ្យបុគ្គលិក ' . $name . ' ចំនូន ' . $money . '",
        });
       </script>');

            redirect("itemth?teacher_list");
        }
    }
}


function add_teacher()
{
    if (isset($_POST['btnsave'])) {

        $txtnamekh       = $_POST['txtnamekh'];
        $txtdb       = $_POST['txtdb'];
        $datedb = date('Y-m-d', strtotime($txtdb));
        $txtsubject      = $_POST['txtsubject'];
        $txt_date_of_employment     = $_POST['txt_date_of_employment'];
        $dateof_employment = date('Y-m-d', strtotime($txt_date_of_employment));

        $txt_salary   = $_POST['txt_salary'];
        $txtnameen         = $_POST['txtnameen'];
        $txtphone = $_POST['txtphone'];

        $sex     = $_POST['sex'];

        $id_branch =branch_id();

        //Image Code or File Code Start Here..
        $f_name        = $_FILES['myfile']['name'];

        if (!empty($f_name)) {
            $f_tmp         = $_FILES['myfile']['tmp_name'];
            $f_size        = $_FILES['myfile']['size'];
            $f_extension   = explode('.', $f_name);
            $f_extension   = strtolower(end($f_extension));
            $f_newfile     = uniqid() . '.' . $f_extension;

            $store = "../productimages/teacher/" . $f_newfile;

            if ($f_extension == 'jpg' || $f_extension == 'jpeg' ||   $f_extension == 'png' || $f_extension == 'gif') {

                if ($f_size >= 2000000) {

                    set_message(' <script>
                            Swal.fire({
                              icon: "warning",
                              title: "Max file should be 2MB"
                            });
                          </script>');
                    redirect('itemt?addteacher');
                } else {

                    if (move_uploaded_file($f_tmp, $store)) {

                        $productimage = $f_newfile;

                        $insert = query("INSERT into tbl_teacher ( tc_namekh,tc_nameen,tc_sex,tc_db,tc_phone,tc_subjects_id,tc_salary,tc_date_of_employment,tc_img,id_branch) 
                        values('{$txtnamekh}','{$txtnameen}','{$sex}','{$datedb}','{$txtphone}','{$txtsubject}','{$txt_salary}','{$dateof_employment}','{$productimage}','{$id_branch}')");
                        confirm($insert);

                        if ($insert) {

                            set_message(' <script>
                            Swal.fire({
                              icon: "success",
                              title: "Tudents Inserted Successfully"
                            });
                          </script>');
                            redirect('itemt?teacher_list');
                        } else {
                            set_message(' <script>
                            Swal.fire({
                              icon: "error",
                              title: "Tudents Inserted Failed"
                            });
                          </script>');
                            redirect('itemt?add_tudents');
                        }
                    }
                }
            } else {

                set_message(' <script>
            Swal.fire({
              icon: "warning",
              title: "only jpg, jpeg, png and gif can be upload"
            });
          </script>');
                redirect('itemt?add_tudents');
            }
        } else {
            $productimage = 'display.jpg';

            $insert = query("INSERT into tbl_teacher ( tc_namekh,tc_nameen,tc_sex,tc_db,tc_phone,tc_subjects_id,tc_salary,tc_date_of_employment,tc_img,id_branch) 
                        values('{$txtnamekh}','{$txtnameen}','{$sex}','{$datedb}','{$txtphone}','{$txtsubject}','{$txt_salary}','{$dateof_employment}','{$productimage}','{$id_branch}')");
            confirm($insert);

            if ($insert) {

                set_message(' <script>
                            Swal.fire({
                              icon: "success",
                              title: "Tudents Inserted Successfully"
                            });
                          </script>');
                redirect('itemt?teacher_list');
            } else {
                set_message(' <script>
                            Swal.fire({
                              icon: "error",
                              title: "Tudents Inserted Failed"
                            });
                          </script>');
                redirect('itemt?add_tudents');
            }
        }
    }
}



function view_teacher()
{
    $id = $_GET['id'];

    $select = query("SELECT * from tbl_teacher where tc_id = $id");
    confirm($select);

    while ($row = $select->fetch_object()) {

        echo '
<div class="row">
<div class="col-md-6">

<ul class="list-group">

<center><p class="list-group-item list-group-item-info"><b>TEACHER DETAILS</b></p></center>  

  <li class="list-group-item"><b>ID</b> <span class="badge label badge-light float-right">' . $row->tc_id . '</span></li>
  <li class="list-group-item"><b>ឈ្មោះជាភាសាខ្មែរ</b><span class="badge label badge-warning float-right">' . $row->tc_namekh . '</span></li>
  <li class="list-group-item"><b>ឈ្មោះជាអក្សរឡាតាំង</b> <span class="badge label badge-success float-right">' . $row->tc_nameen . '</span></li>
  <li class="list-group-item"><b>ភេទ </b><span class="badge label badge-primary float-right">' . $row->tc_sex . '</span></li>
  <li class="list-group-item"><b>ថ្ងៃខែឆ្នាំកំណើត</b> <span class="badge label badge-danger float-right">' . date('d-m-Y', strtotime($row->tc_db)) . '</span></li>
  <li class="list-group-item"><b>លេខទូរសព្ទ </b><span class="badge label badge-secondary float-right">' . $row->tc_phone . '</span></li>
  <li class="list-group-item"><b>មុខវិជ្ជា</b> <span class="badge label badge-info float-right">' . show_subject($row->tc_subjects_id) . '</span></li>

  <li class="list-group-item"><b>ប្រាក់ខែ</b> <span class="badge label badge-dark float-right">' . $row->tc_salary . '</span></li>

  <li class="list-group-item"><b>ថ្ងៃខែចូលធ្វើការ</b> <span class="badge label badge-success float-right">' . date('d-m-Y', strtotime($row->tc_date_of_employment)) . '</span></li>
</ul>
</div>

<div class="col-md-6">
<ul class="list-group">
<center><p class="list-group-item list-group-item-info"><b>TEACHER IMAGE</b></p></center>  
<img src="../productimages/teacher/' . $row->tc_img . '" class="img-thumbnail"/>
</ul>
</div>
</div>



';
    }
}



function update_teacher()
{


    if (isset($_POST['btnupdate'])) {


        $txtnamekh                  = $_POST['txtnamekh'];
        $txtdb                      = $_POST['txtdb'];
        $date_db                    = date('Y-m-d', strtotime($txtdb));
        $txtsubject                 = $_POST['txtsubject'];
        $txt_date_of_enrollment     = $_POST['txt_date_of_employment'];

        $txtnameen                  = $_POST['txtnameen'];
        $txtphone                   = $_POST['txtphone'];
        $txt_salary                 = $_POST['txt_salary'];

        $sex                        = $_POST['sex'];

        $dateof_employment = date('Y-m-d', strtotime($txt_date_of_enrollment));
        $id  = $_POST['btnupdate'];


        //Image Code or File Code Start Here..
        $f_name        = $_FILES['myfile']['name'];

        if (!empty($f_name)) {

            $f_tmp         = $_FILES['myfile']['tmp_name'];
            $f_size        = $_FILES['myfile']['size'];
            $f_extension   = explode('.', $f_name);
            $f_extension   = strtolower(end($f_extension));
            $f_newfile     = uniqid() . '.' . $f_extension;

            $store = "../productimages/teacher/" . $f_newfile;
            $teacher_image = $f_newfile;

            if ($f_extension == 'jpg' || $f_extension == 'jpeg' ||   $f_extension == 'png' || $f_extension == 'gif') {

                if ($f_size >= 2000000) {

                    set_message(' <script>
                            Swal.fire({
                              icon: "warning",
                              title: "Max file should be 2MB"
                            });
                          </script>');
                    redirect('itemt?edit_teacher&id=' . $id . '');
                } else {

                    $select_img = query("SELECT tc_img from tbl_teacher where tc_id = $id");
                    confirm($select_img);
                    $row = $select_img->fetch_assoc();

                    if (move_uploaded_file($f_tmp, $store)) {
                        $db_image = $row['tc_img'];
                        if ($db_image != 'display.jpg') {
                            unlink("../productimages/teacher/$db_image");
                        }
                        $query = "UPDATE tbl_teacher SET ";
                        $query .= "tc_namekh               = '{$txtnamekh}'         , ";
                        $query .= "tc_nameen               = '{$txtnameen}'         , ";
                        $query .= "tc_sex                  = '{$sex}'               , ";
                        $query .= "tc_db                   = '{$date_db}'           , ";
                        $query .= "tc_phone                = '{$txtphone}'          , ";
                        $query .= "tc_subjects_id          = '{$txtsubject}'        , ";
                        $query .= "tc_salary               = '{$txt_salary}'        , ";
                        $query .= "tc_date_of_employment   = '{$dateof_employment}' , ";
                        $query .= "tc_img                  = '{$teacher_image}'      ";
                        $query .= "WHERE tc_id=" . $id;

                        $send_update_query = query($query);
                        confirm($send_update_query);

                        if ($send_update_query) {
                            set_message(' <script>
                        Swal.fire({
                          icon: "success",
                          title: "Teacher Updated Successfully With New Image"
                        });
                      </script>');
                            redirect('itemt?teacher_list');
                        } else {
                            set_message(' <script>
                       Swal.fire({
                      icon: "error",
                      title: "Teacher Update Failed"
                       });
                     </script>');
                            redirect('itemt?edit_teacher&id=' . $id . '');
                        }
                    }
                }
            } else {

                set_message(' <script>
                  Swal.fire({
                  icon: "warning",
                  title: "only jpg, jpeg, png and gif can be upload"
                  });
                  </script>');
                redirect('itemt?edit_tudents&id=' . $id . '');
            }
        } else {

            $query = "UPDATE tbl_teacher SET ";
            $query .= "tc_namekh               = '{$txtnamekh}'         , ";
            $query .= "tc_nameen               = '{$txtnameen}'         , ";
            $query .= "tc_sex                  = '{$sex}'               , ";
            $query .= "tc_db                   = '{$date_db}'           , ";
            $query .= "tc_phone                = '{$txtphone}'          , ";
            $query .= "tc_subjects_id          = '{$txtsubject}'        , ";
            $query .= "tc_salary               = '{$txt_salary}'        , ";
            $query .= "tc_date_of_employment   = '{$dateof_employment}'   ";
            $query .= "WHERE tc_id=" . $id;

            $send_update_query = query($query);
            confirm($send_update_query);

            if ($send_update_query) {
                set_message(' <script>
               Swal.fire({
                icon: "success",
                title: "Teacher Updated Successfully "
                 });
                </script>');
                redirect('itemt?teacher_list');
            } else {
                set_message(' <script>
               Swal.fire({
              icon: "error",
              title: "Teacher Update Failed"
              });
               </script>');
                redirect('itemt?edit_teacher&id=' . $id . '');
            }
        }
    }
}

<?php

function st_active($id)
{
  $select = query("SELECT * from tbl_students where sd_id = $id");
  confirm($select);
  $row = $select->fetch_object();

  if ($row->studyclose == 'ឈប់រៀន') {

    return "rdstudts";
  } elseif ($row->studyclose == 'រៀនចប់') {
    return "rdstudts1";
  }
}

function tudentslist($searchh)
{

  $id_branch = branch_id();

  if (empty($searchh)) {

    $searchh = "";
    $select = query("SELECT * from tbl_students where id_branch= $id_branch ");
    confirm($select);
    $rows = mysqli_num_rows($select);
    $lik = "";
  } else {
    $search = preg_replace('#[^0-9,a-z,ក-អ]#', '', $searchh);
  
    $select = query("SELECT * FROM tbl_students  WHERE id_branch = $id_branch AND (sd_namekh LIKE '{$search}%' OR sd_id LIKE '{$search}%' OR sd_nameen LIKE '{$search}%')");

    $rows = mysqli_num_rows($select);

    $lik = "AND (sd_namekh LIKE '{$search}%' OR sd_id LIKE '{$search}%' OR sd_nameen LIKE '{$search}%')";

  }

  if (mysqli_num_rows($select) == 0) {

    echo '<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty text-center">No matching records found</td></tr></tbody>
    </table>
    </div>';
  } else {

    if (isset($_GET['page'])) {

      $page = preg_replace('#[^0-9]#', '', $_GET['page']);
    } else {

      $page = 1;
    }
    if (empty($_SESSION['perPage'])) {
      $perPage = 10;
      $_SESSION['perPage'] = $perPage;
      $perPage = $_SESSION['perPage'];
    } else {

      $perPage = $_SESSION['perPage'];
    }
    $lastPage = ceil($rows / $perPage);
    if ($page < 1) {
      $page = 1;
    } elseif ($page > $lastPage) {

      $page = $lastPage;
    }

    $middleNumbers = '';
    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;

    if ($page == 1) {

      $middleNumbers .= '<li class="page-item active"><buttone class="btn page-link">' . $page . '</buttone></li>';

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link sd_page" page=' . $add1 . ' ">' . $add1 . '</buttone></li>';
    } elseif ($page == $lastPage) {

      $middleNumbers .= '<li class="page-item "><buttone class=" btn page-link sd_page" page=' . $sub1 . ' ">' . $sub1 . '</buttone></li>';

      $middleNumbers .= '<li class="page-item active"><buttone class="btn page-link ">' . $page . '</buttone></li>';
    } elseif ($page > 2 && $page < ($lastPage - 1)) {

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link sd_page" page=' . $sub2 . ' ">' . $sub2 . '</buttone></li>';

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link sd_page" page=' . $sub1 . ' ">' . $sub1 . '</buttone></li>';

      $middleNumbers .= '<li class="page-item active"><buttone class="btn page-link">' . $page . '</buttone></li>';

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link sd_page" page=' . $add1 . ' ">' . $add1 . '</buttone></li>';

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link sd_page" page=' . $add2 . ' ">' . $add2 . '</buttone></li>';
    } elseif ($page > 1 && $page < $lastPage) {

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link sd_page" page=' . $sub1 . ' ">' . $sub1 . '</buttone></li>';

      $middleNumbers .= '<li class="page-item active"><buttone class="btn page-link ">' . $page . '</buttone></li>';

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link sd_page" page=' . $add1 . ' ">' . $add1 . '</buttone></li>';
    }

    $limit = 'LIMIT ' . ($page - 1) * $perPage . ',' . $perPage;

    $query2 =  query("SELECT * FROM tbl_students WHERE id_branch= $id_branch $lik order by sd_id DESC $limit");

    confirm($query2);

    $outputPagination = "";

    if ($page != 1) {
      $prev = $page - 1;
      $outputPagination .= '<li class="page-item "><buttone class="btn page-link sd_page" page=' . $prev . ' ">Back</buttone></li>';
    }

    $outputPagination .= $middleNumbers;

    if ($page != $lastPage) {
      $next = $page + 1;
      $outputPagination .= '<li class="page-item "><buttone class="btn page-link sd_page" page=' . $next . ' ">Next</buttone></li>';
    }



    $echo = "";
    $no = 1;
    while ($row = $query2->fetch_object()) {
      $id = $row->sd_id;
      $salary = $row->txtprice;
      $rdstudts = st_active($id);
      $sd_studytime = $row->sd_studytime;


      $date_of_enrollment = $row->sd_date_of_enrollment;
      $echo .= '
           <tr class="' . $rdstudts . '">
           <td>' . $no . '</td>
           <td>' . $id . '</td>
           <td>' . $row->sd_namekh . ' <image src="../productimages/students/' . $row->sd_img . '" class="img-rounded" width="40px" height="40px/"></td>
           <td>' . $row->sd_nameen . '</td>
           <td>' . $row->sd_sex . '</td>
           <td>' . date('d-m-Y', strtotime($row->sd_db)) . '</td>


           <td>' . show_subject($row->sd_subject_id) . '</td>
           <td>' . show_teacher($row->sd_teacher_id) . '</td>

           ';


      if ($row->sd_studytime == "month") {

        $echo .= '<td><span class="badge badgeth badge-danger">' . $row->sd_studytime . '</span></td>';
      } else {
        $echo .= '<td><span class="badge badgeth badge-primary">' . $row->sd_studytime . '</span></td>';
      }



      $query_cddate = query("SELECT * FROM tbl_employee_students WHERE sd_id = $id ");

      if (mysqli_num_rows($query_cddate) > 0) {
        $query_date = query("SELECT date,MAX(date) as max_date FROM tbl_employee_students WHERE sd_id = $id  ");
        $roww = $query_date->fetch_assoc();
        $count_datee = $roww['max_date'];
      } else {
        $count_datee = $date_of_enrollment;
      }


      $date = date('d-m-Y');
      $result = explode('-', $date);
      $month = $result[1];
      $year = $result[2];
      // $salary = show_price($row->sd_subject_id, $id,$row->sd_time_id);

      if ($sd_studytime == 'years') {
        $new = $year;
        $selectt = query("SELECT * FROM tbl_employee_students WHERE sd_id = $id");
        if (mysqli_num_rows($selectt) > 0) {

          while ($rowe = fetch_array($selectt)) {
            $dbe_date = $rowe['date'];
            $text = '<span class="badge badgeth badge-success">' . date('d-m-Y', strtotime($dbe_date)) . '</span>';
          }
        } else {
          $text = '<span class="badge badgeth badge-warning">' . date('d-m-Y', strtotime($date_of_enrollment)) . '</span>';
        }
      } elseif ($sd_studytime == '6month') {
        $selectt = query("SELECT * FROM tbl_employee_students WHERE sd_id = $id");
        if (mysqli_num_rows($selectt) > 0) {

          while ($rowe = fetch_array($selectt)) {
            $dbe_date = $rowe['date'];
            $text = '<span class="badge badgeth badge-success">' . date('d-m-Y', strtotime($dbe_date)) . '</span>';
          }
        } else {
          $text = '<span class="badge badgeth badge-warning">' . date('d-m-Y', strtotime($date_of_enrollment)) . '</span>';
        }
      } else {
        $new = $year . '-' . $month;

        $selectt = query("SELECT * FROM tbl_employee_students WHERE sd_id = $id");
        $query_pay = query("SELECT * FROM tbl_employee_students WHERE sd_id = $id and date like '{$new}%' ");
        if (mysqli_num_rows($query_pay) > 0) {

          $total = 0;
          $money = 0;
          while ($rowe = fetch_array($query_pay)) {
            $dbe_date = $rowe['date'];
            $money +=  $rowe['money'];
            $total = $salary - $money;
          }
          $text = date('d-m-Y', strtotime($dbe_date));
        } elseif (mysqli_num_rows($selectt) > 0) {

          $total = $salary;

          $roww = $selectt->fetch_object();

          $darex = $roww->date;
          $text = '<span class="badge badgeth badge-danger">' . date('d-m-Y', strtotime($darex)) . '</span>';
        } else {
          $text = '<span class="badge badgeth badge-warning">' . date('d-m-Y', strtotime($date_of_enrollment)) . '</span>';
        }
      }


      $echo .= '
           <td>' . $text . '</td>	
  
           
           <td>
           
           
           <div class="btn-group">
           <a href="students_id?id=' . $row->sd_id . '" class="btn btn-primary btn-xs" role="button"><span class="fa fa-id-card" style="color:#ffffff" data-toggle="tooltip" title="ID students"></span></a>
           <a href="certificate?id=' . $row->sd_id . '" class="btn btn-secondary btn-xs" role="button" target="_blank"><span class="fa fa-certificate" style="color:#ffffff" data-toggle="tooltip" title="Certificate"></span></a>
           
           <button id=' . $row->sd_id . ' class="btn btn-info btn-xs payroll" data-toggle="modal" data-target="#exampleModalpay"><span class="fas fa-money-bill-alt" style="color:#ffffff" data-toggle="tooltip" title="បង់ប្រាក់"></span></button>
           
           
           <button id=' . $row->sd_id . '  class="btn btn-warning btn-xs view" data-toggle="modal" data-target="#exampleModall"  role="button"><span class="fa fa-eye" style="color:#ffffff" data-toggle="tooltip" title="View students"></span></button>
           
           <button id=' . $row->sd_id . '  class="btn btn-success btn-xs btnedit" data-toggle="modal" data-target="#exampleModal_edit"  role="button"><span class="fa fa-edit" style="color:#ffffff" data-toggle="tooltip" title="Edit students"></span></button>
           
           ' . show_delete($row->sd_id) . '
           
          
           </div>
           
           </td>
           
           </tr>
          ';
      $no++;
    }
    echo $echo;
    echo ' </tbody></table>
    <div class="row">
    <div class="col-sm-12 col-md-5"><div class="dataTables_info" id="table_orderlist_info" role="status" aria-live="polite">Showing ' . $page . ' to ' . $lastPage . ' of ' . $rows . ' entries</div></div>';
    echo "<div class='col-sm-12 col-md-7'>
    <div class='dataTables_paginate paging_simple_numbers'>
    <ul class='pagination' >{$outputPagination}</ul></div></div></div></div>";
  }
  unset($_SESSION['search']);
  unset($_SESSION['perPage']);
}


function show_delete($invoice_id)
{
  if ($_SESSION['useremail'] == "" or $_SESSION['role'] == "Admin") {

    return '
        <a href="../resources/templates/back/delete_students.php?id=' . $invoice_id . '" class="btn btn-danger btn-delete btn-xs" role="button"><span class="fa fa-trash" style="color:#ffffff" data-toggle="tooltip" title="Delete students"></span></a>
        ';
  }
}
function show_price($sj_id, $sd_id, $sdi_id)
{

  $select = query("SELECT * from tbl_subject where sj_id = $sj_id");
  confirm($select);
  $sjRow = $select->fetch_object();

  $students = query("SELECT * from tbl_students where sd_id = $sd_id");
  confirm($students);
  $sdRow = $students->fetch_assoc();

  $selectr = query("SELECT * from tbl_studytime where sdi_id=$sdi_id");
  confirm($selectr);
  $row = $selectr->fetch_assoc();

  $time = $row['qty'];

  if ($sdRow['sd_studytime'] == "session") {
    $price = $sjRow->price_session;
    return $price;
  } else {
    $price = $sjRow->sj_price;

    return $price;
  }
}
function viewstudents()
{
  $id = $_GET['id'];

  $select = query("SELECT * from tbl_students where sd_id = $id");
  confirm($select);

  while ($row = $select->fetch_object()) {

    echo '
<div class="row">
<div class="col-md-6">

<ul class="list-group">

<center><p class="list-group-item list-group-item-primary"><b>STUDENT DETAILS</b></p></center>  

  <li class="list-group-item"><b>ID</b> <span class="badge label badge-light float-right">' . $row->sd_id . '</span></li>
  <li class="list-group-item"><b>ឈ្មោះជាភាសាខ្មែរ</b><span class="badge label badge-warning float-right">' . $row->sd_namekh . '</span></li>
  <li class="list-group-item"><b>ឈ្មោះជាអក្សរឡាតាំង</b> <span class="badge label badge-success float-right">' . $row->sd_nameen . '</span></li>
  <li class="list-group-item"><b>ភេទ </b><span class="badge label badge-primary float-right">' . $row->sd_sex . '</span></li>
  <li class="list-group-item"><b>ថ្ងៃខែឆ្នាំកំណើត</b> <span class="badge label badge-danger float-right">' . date('d-m-Y', strtotime($row->sd_db)) . '</span></li>
  <li class="list-group-item"><b>លេខទូរសព្ទ </b><span class="badge label badge-secondary float-right">' . $row->sd_phone . '</span></li>
  <li class="list-group-item"><b>មុខវិជ្ជា</b> <span class="badge label badge-info float-right">' . show_subject($row->sd_subject_id) . '</span></li>
  <li class="list-group-item"><b>ម៉ោងសិក្សារ</b> <span class="badge label badge-dark float-right">' . show_studytime($row->sd_time_id) . '</span></li>
  <li class="list-group-item"><b>គ្រូ</b> <span class="badge label badge-primary float-right">' . show_teacher($row->sd_teacher_id) . '</span></li>

  <li class="list-group-item"><b>រៀនគិតជា</b> <span class="badge label badge-dark float-right">' . $row->sd_studytime . '</span></li>

  <li class="list-group-item"><b>តម្លៃសិក្សារ</b> <span class="badge label badge-dark float-right">' . show_price($row->sd_subject_id, $row->sd_id, $row->sd_time_id) . '</span></li>
  <li class="list-group-item"><b>ថ្ងៃខែចូលរៀន</b> <span class="badge label badge-success float-right">' . date('d-m-Y', strtotime($row->sd_date_of_enrollment)) . '</span></li>
</ul>
</div>

<div class="col-md-6">
<ul class="list-group">
<center><p class="list-group-item list-group-item-primary"><b>STUDENT IMAGE</b></p></center>  
<img src="../productimages/students/' . $row->sd_img . '" class="img-thumbnail"/>
</ul>
</div>
</div>



';
  }
}







function addstudents()
{
  if (isset($_POST['btnsave'])) {
    // txtnamekh txtsubject txtstudytime txtprice txtdate_of_enrollment txtnameen txtphone txtaddress txttim txtteacher sex
    $txtnamekh                  = $_POST['txtnamekh'];
    $txtdb                      = $_POST['txtdb'];
    $date_db                    = date('Y-m-d', strtotime($txtdb));
    $txtsubject                 = $_POST['txtsubject'];
    $txtteacher                 = $_POST['txtteacher'];
    $txtnameen                  = $_POST['txtnameen'];
    $txtphone                   = $_POST['txtphone'];
    $txttim                     = $_POST['txttim'];
    // $txtcar                     = $_POST['txtcar'];
    $sex                        = $_POST['sex'];
    // $txtclass                   = $_POST['txtclass'];
    $txtstudytime               = $_POST['txtstudytime'];
    $txt_date_of_enrollment     = $_POST['txtdate_of_enrollment'];
    $txtprice                   = $_POST['txtprice'];
    $txtaddress                   = $_POST['txtaddress'];

    $dateof_employment = date('Y-m-d', strtotime($txt_date_of_enrollment));
    $id_branch = branch_id();
    //Image Code or File Code Start Here..
    $f_name        = $_FILES['myfile']['name'];

    if (!empty($f_name)) {
      $f_tmp         = $_FILES['myfile']['tmp_name'];
      $f_size        = $_FILES['myfile']['size'];
      $f_extension   = explode('.', $f_name);
      $f_extension   = strtolower(end($f_extension));
      $f_newfile     = uniqid() . '.' . $f_extension;

      $store = "../productimages/students/" . $f_newfile;

      if ($f_extension == 'jpg' || $f_extension == 'jpeg' ||   $f_extension == 'png' || $f_extension == 'gif') {

        if ($f_size >= 2000000) {

          $_SESSION['status'] = "Max file should be 2MB";
          $_SESSION['status_code'] = "warning";
        } else {

          if (move_uploaded_file($f_tmp, $store)) {

            $productimage = $f_newfile;

            $insert = query("INSERT into tbl_students (sd_namekh,sd_nameen,sd_sex,sd_db,sd_phone,sd_address,sd_subject_id,sd_time_id,sd_teacher_id,sd_img,sd_studytime,sd_date_of_enrollment,id_branch,txtprice) 
                        values('{$txtnamekh}','{$txtnameen}','{$sex}','{$date_db}','{$txtphone}','{$txtaddress}','{$txtsubject}','{$txttim}','{$txtteacher}','{$productimage}','{$txtstudytime}','{$dateof_employment}','{$id_branch}','{$txtprice}')");
            confirm($insert);
            $pid = last_id(); // which was the 5

            // $query = query("INSERT INTO tbl_employee_students(sd_id,money,date,id_branch) VALUES('{$pid}','{$txtprice}','{$dateof_employment}','{$id_branch}')");
            // confirm($query);
            // $sdpay_id = last_id();
            date_default_timezone_set("Asia/Bangkok");
            $newbarcode = $pid . date('his');

            // $update = query("UPDATE tbl_product SET barcode='$newbarcode' where pid='" . $pid . "'");

            if ($insert) {

              set_message(' <script>
                Swal.fire({
                  icon: "success",
                  title: "Students Inserted Successfully"
                });
              </script>');
              redirect('itemt?tudentslist');
            } else {
              set_message(' <script>
                            Swal.fire({
                              icon: "error",
                              title: "Students Inserted Failed"
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

      $insert = query("INSERT into tbl_students (sd_namekh,sd_nameen,sd_sex,sd_db,sd_phone,sd_address,sd_subject_id,sd_time_id,sd_teacher_id,sd_img,sd_studytime,sd_date_of_enrollment,id_branch,txtprice) 
                        values('{$txtnamekh}','{$txtnameen}','{$sex}','{$date_db}','{$txtphone}','{$txtaddress}','{$txtsubject}','{$txttim}','{$txtteacher}','{$productimage}','{$txtstudytime}','{$dateof_employment}','{$id_branch}','{$txtprice}')");
      confirm($insert);
      $pid = last_id(); // which was the 5
      // $query = query("INSERT INTO tbl_employee_students(sd_id,money,date,id_branch) VALUES('{$pid}','{$txtprice}','{$dateof_employment}','{$id_branch}')");
      // confirm($query);
      // $sdpay_id = last_id();
      date_default_timezone_set("Asia/Bangkok");
      $newbarcode = $pid . date('his');

      // $update = query("UPDATE tbl_product SET barcode='$newbarcode' where pid='" . $pid . "'");

      if ($insert) {

        set_message(' <script>
          Swal.fire({
            icon: "success",
            title: "Students Inserted Successfully"
          });
        </script>');

        redirect('itemt?tudentslist');
      } else {
        set_message(' <script>
                            Swal.fire({
                              icon: "error",
                              title: "Students Inserted Failed"
                            });
                          </script>');
        redirect('itemt?tudentslist');
      }
    }
  }
}





function update_tudents()
{


  if (isset($_POST['btnupdate'])) {


    $txtnamekh                  = $_POST['txtnamekh'];
    $txtdb                      = $_POST['txtdb'];
    $date_db                    = date('Y-m-d', strtotime($txtdb));
    $txtsubject                 = $_POST['txtsubject'];
    $txtteacher                 = $_POST['txtteacher'];
    $txtnameen                  = $_POST['txtnameen'];
    $txtphone                   = $_POST['txtphone'];
    $txttim                     = $_POST['txttim'];
    // $txtcar                     = $_POST['txtcar'];
    $sex                        = $_POST['sex'];
    // $txtclass                   = $_POST['txtclass'];
    $txtstudytime               = $_POST['txtstudytime'];
    $txt_date_of_enrollment     = $_POST['txtdate_of_enrollment'];
    $txt_date_of_enrollment     = $_POST['txtdate_of_enrollment'];
    $studyclose                 = $_POST['studyclose'];
    $txtprice                   = $_POST['txtprice'];
    $txtaddress                 = $_POST['txtaddress'];
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

      $store = "../productimages/students/" . $f_newfile;
      $students_image = $f_newfile;

      if ($f_extension == 'jpg' || $f_extension == 'jpeg' ||   $f_extension == 'png' || $f_extension == 'gif') {

        if ($f_size >= 2000000) {

          set_message(' <script>
                            Swal.fire({
                              icon: "warning",
                              title: "Max file should be 2MB"
                            });
                          </script>');
          redirect('itemt?tudentslist');
        } else {

          $select_img = query("SELECT sd_img from tbl_students where sd_id = $id");
          confirm($select_img);
          $row = $select_img->fetch_assoc();

          if (move_uploaded_file($f_tmp, $store)) {
            $db_image = $row['sd_img'];
            if ($db_image != 'display.jpg') {
              unlink("../productimages/students/$db_image");
            }

            $query = "UPDATE tbl_students SET ";
            $query .= "sd_namekh               = '{$txtnamekh}'         , ";
            $query .= "sd_nameen               = '{$txtnameen}'         , ";
            $query .= "sd_sex                  = '{$sex}'               , ";
            $query .= "sd_db                   = '{$date_db}'           , ";
            $query .= "sd_phone                = '{$txtphone}'          , ";
            $query .= "sd_address              = '{$txtaddress}'        , ";
            $query .= "sd_subject_id           = '{$txtsubject}'        , ";
            $query .= "sd_time_id              = '{$txttim}'            , ";
            $query .= "sd_teacher_id           = '{$txtteacher}'        , ";
            // $query .= "sd_car_id               = '{$txtcar}'            , ";
            $query .= "sd_img                  = '{$students_image}'    , ";
            // $query .= "sd_class_id             = '{$txtclass}'          , ";
            $query .= "sd_studytime            = '{$txtstudytime}'      , ";
            $query .= "sd_date_of_enrollment   = '{$dateof_employment}' , ";
            $query .= "studyclose              = '{$studyclose}'        , ";
            $query .= "txtprice                = '{$txtprice}'            ";
            $query .= "WHERE sd_id=" . $id;

            $send_update_query = query($query);
            confirm($send_update_query);

            redirect("itemt?tudentslist");
            if ($send_update_query) {
              set_message(' <script>
                        Swal.fire({
                          icon: "success",
                          title: "Students Updated Successfully With New Image"
                        });
                      </script>');
              redirect('itemt?tudentslist');
            } else {
              set_message(' <script>
                       Swal.fire({
                      icon: "error",
                      title: "Students Update Failed"
                       });
                     </script>');
              redirect('itemt?edit_tudents&id=' . $id . '');
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

      $query = "UPDATE tbl_students SET ";
      $query .= "sd_namekh               = '{$txtnamekh}'         , ";
      $query .= "sd_nameen               = '{$txtnameen}'         , ";
      $query .= "sd_sex                  = '{$sex}'               , ";
      $query .= "sd_db                   = '{$date_db}'           , ";
      $query .= "sd_phone                = '{$txtphone}'          , ";
      $query .= "sd_address              = '{$txtaddress}'        , ";
      $query .= "sd_subject_id           = '{$txtsubject}'        , ";
      $query .= "sd_time_id              = '{$txttim}'            , ";
      $query .= "sd_teacher_id           = '{$txtteacher}'        , ";
      // $query .= "sd_car_id               = '{$txtcar}'            , ";
      // $query .= "sd_class_id             = '{$txtclass}'          , ";
      $query .= "sd_studytime            = '{$txtstudytime}'      , ";
      $query .= "sd_date_of_enrollment   = '{$dateof_employment}' , ";
      $query .= "studyclose              = '{$studyclose}'        , ";
      $query .= "txtprice                = '{$txtprice}'            ";
      $query .= "WHERE sd_id=" . $id;

      $send_update_query = query($query);
      confirm($send_update_query);

      if ($send_update_query) {
        set_message(' <script>
            Swal.fire({
              icon: "success",
              title: "Students Updated Successfully "
            });
          </script>');
        redirect('itemt?tudentslist');
      } else {
        set_message(' <script>
           Swal.fire({
          icon: "error",
          title: "Students Update Failed"
           });
         </script>');
        redirect('itemt?edit_tudents&id=' . $id . '');
      }
    }
  }
}



function students_Payroll()
{
  if (isset($_POST['submit'])) {
    $id_branch = branch_id();
    $sd_id = $_POST['submit'];
    $numdate = $_POST['txt_numdate'];
    $sd_teacher_id = $_POST['sd_teacher_id'];
    $txt_jompeak = $_POST['txt_jompeak'];

    $money = $_POST['txt_salaryy'];
    $date = $_POST['txtdatesalary'];
    $txtstudytime = $_POST['txtstudytime'];
    $datedb = date('Y-m-d', strtotime($date));
    $name = $_POST['txtnamekh'];
    $result = explode('-', $datedb);
    $datee = $result[2];
    $month = $result[1];
    $year = $result[0];
    $new = $year . '-' . $month;



    if ($money == 0) {
      set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Money Feild is Empty"
            });
           </script>');
    } else {

      $query = query("INSERT INTO tbl_employee_students(sd_id,money,date,numdate,id_branch) VALUES('{$sd_id}','{$money}','{$datedb}','{$numdate}','{$id_branch}')");
      $last_id = last_id();
      confirm($query);
      $insert = query(" UPDATE tbl_students set debt='$txt_jompeak' WHERE sd_id = $sd_id");

      set_message(' <script>
        Swal.fire({
        icon: "success",
        title: "បង់ប្រាក់",
        text:"សិស្ស ' . $name . ' បានបង់ប្រាក់ចំនូន ' . $money . '",
        });
       </script>');
    }
  }
}

function show_studyname($sd_id)
{
  $scaleL_query = query("SELECT * FROM tbl_students WHERE sd_id = '{$sd_id}'");
  confirm($scaleL_query);
  while ($scale_row = fetch_array($scaleL_query)) {

    return $scale_row['sd_namekh'];
  }
}



function students_pay()
{
  $id_branch = branch_id();
  $select = query("SELECT * from tbl_employee_students where id_branch= $id_branch order by sd_id DESC");
  confirm($select);
  $no = 1;
  $total = 0;
  $echo = '';
  while ($row = $select->fetch_object()) {

    $money = $row->money;
    $total += $row->money;

    $scaleL_query = query("SELECT * FROM tbl_students WHERE sd_id = '{$row->sd_id}' order by sd_id DESC");
    confirm($scaleL_query);
    while ($scale_row = fetch_array($scaleL_query)) {
      $img = $scale_row['sd_img'];
      $nameen = $scale_row['sd_nameen'];
      $db = $scale_row['sd_db'];
      $time = $scale_row['sd_time_id'];
      $sd_subject_id = $scale_row['sd_subject_id'];
      $sex = $scale_row['sd_sex'];
      $scale_sdid = $scale_row['sd_id'];
    }
    $echo .= '
           <tr>
           <td>' . $no . '</td>
           <td>' . $scale_sdid . '</td>
           <td>' . show_studyname($row->sd_id) . ' <image src="../productimages/students/' . $img . '" class="img-rounded" width="40px" height="40px/"></td>
           <td>' . $nameen . '</td>
           <td>' . $sex . '</td>
           <td>' . date('d-m-Y', strtotime($db)) . '</td>
           <td>' . show_subject($sd_subject_id) . '</td>
           <td>' . show_price($sd_subject_id, $scale_sdid, $time) . '</td>
           <td>' . $money . '</td>
           <td><span class="badge badgeth badge-primary">' . date('d-m-Y', strtotime($row->date)) . '</span></td>

           <td>
           
           
           <div class="btn-group">
          
           <a href="../resources/templates/back/delete_students_pay.php?id=' . $row->sdpay_id . '" class="btn btn-danger btn-delete " role="button"><span class="fa fa-trash" style="color:#ffffff" data-toggle="tooltip" title="Delete students"></span></a>
          
           </div>
           
           </td>
           
           </tr>';

    $no++; //
  }
  $echo .= '
  <tr> 
  <td colspan="6"></td>
  <td>សរុប</td>
  <td><span class="badge badgeth badge-danger">' . number_format($total) . ' ៛</span></td>
  
  </tr>

  ';

  echo $echo;
}


// ///////////////////////pay
function show_datepay($id, $new)
{
  $query = query("SELECT * FROM tbl_employee_students WHERE sd_id = $id and date like '{$new}%'  order by sdpay_id DESC");
  confirm($query);

  if (mysqli_num_rows($query) > 0) {

    $rows = mysqli_num_rows($query);

    if (isset($_POST['page'])) {

      $page = preg_replace('#[^0-9]#', '', $_POST['page']);
    } else {

      $page = 1;
    }

    $perPage = 20;
    $lastPage = ceil($rows / $perPage);
    if ($page < 1) {
      $page = 1;
    } elseif ($page > $lastPage) {

      $page = $lastPage;
    }

    $middleNumbers = '';
    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;

    if ($page == 1) {

      $middleNumbers .= '<li class="page-item active"><buttone class="btn page-link btn-xs page" page=' . $page . '>' . $page . '</buttone></li>';

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link btn-xs page" page=' . $add1 . '>' . $add1 . '</buttone></li>';
    } elseif ($page == $lastPage) {

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link btn-xs page" page=' . $sub1 . '>' . $sub1 . '</buttone></li>';

      $middleNumbers .= '<li class="page-item active"><buttone class="btn page-link btn-xs page" page=' . $page . '>' . $page . '</buttone></li>';
    } elseif ($page > 2 && $page < ($lastPage - 1)) {

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link btn-xs page" page=' . $sub2 . '>' . $sub2 . '</buttone></li>';

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link btn-xs page" page=' . $sub1 . '>' . $sub1 . '</buttone></li>';

      $middleNumbers .= '<li class="page-item active"><buttone class="btn page-link btn-xs page" page=' . $page . '>' . $page . '</buttone></li>';

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link btn-xs page" page=' . $add1 . '>' . $add1 . '</buttone></li>';

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link btn-xs page" page=' . $add2 . '>' . $add2 . '</buttone></li>';
    } elseif ($page > 1 && $page < $lastPage) {

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link btn-xs page" page=' . $sub1 . '>' . $sub1 . '</buttone></li>';

      $middleNumbers .= '<li class="page-item active"><buttone class="btn page-link btn-xs page" page=' . $page . '>' . $page . '</buttone></li>';

      $middleNumbers .= '<li class="page-item "><buttone class="btn page-link btn-xs page" page=' . $add1 . '>' . $add1 . '</buttone></li>';
    }

    $limit = 'LIMIT ' . ($page - 1) * $perPage . ',' . $perPage;


    $query2 =  query("SELECT * FROM tbl_employee_students WHERE sd_id = $id and date like '{$new}%'  order by sdpay_id DESC");
    confirm($query2);

    $outputPagination = "";
    $outputPagination .= $middleNumbers;
    $totall = 0;
    $no = 1;
    while ($row = fetch_array($query2)) {
      $money =  $row['money'];
      $totall += $money;
      $dbe_date = $row['date'];
      $numdate = $row['numdate'];
      echo '<h6>' . $no . ' ថ្ងៃ: ' . date('d-m-Y', strtotime($dbe_date)) . ' ចំនួន ' . number_format($money) . '៛ : ' . $numdate . 'ថ្ងៃ </h6>';
      $no++;
    }
    echo  '<h5 style="color: #001ff9;white-space: nowrap;">     ' . '  សរុបៈ ' . number_format($totall) . '៛​ </h5>';
    echo "<div class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>";
  } else {
    echo '<h5 class="text-center" style="color: #001ff9;white-space: nowrap;">No matching records found</h5>';
  }
}

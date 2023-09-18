<?php


function driverlist()
{
  $id_branch =branch_id();
  $select = query("SELECT * from tbl_car_driver where id_branch= $id_branch order by car_id DESC");
  confirm($select);
  $echo = '';
  while ($row = $select->fetch_object()) {

    $echo .= '
           <tr>
           <td>' . $row->car_id . '</td>
           <td>' . $row->car_namekh . ' <img width="40" height="40" class="img-rounded" src="../productimages/driver/' . $row->car_img . '"></td>
           <td>' . $row->car_nameen . '</td>
           <td>' . $row->car_sex . '</td>
           <td>' . $row->car_phone . '</td>
           <td>' . $row->car_car_type . '</td>
           <td>' . $row->car_license_plate . '</td>
           <td>' . $row->car_vehicle_id . '</td>
           <td>' . date('d-m-Y', strtotime($row->car_date_of_employment)) . '</td>	
           <td>';
           
    if ($row->car_id == 1 or $row->car_id == 2) {
      $echo .= '';
    } else {

      $echo .= '
           <div class="btn-group">
           
           <a href="driver_id.php?id=' . $row->car_id . '" class="btn btn-primary btn-xs" role="button"><span class="fa fa-id-card" style="color:#ffffff" data-toggle="tooltip" title="Card ID"></span></a>

           <button id=' . $row->car_id . ' class="btn btn-info btn-xs payroll" data-toggle="modal" data-target="#exampleModalpay"><span class="fas fa-money-bill-alt" style="color:#ffffff" data-toggle="tooltip" title="បើកប្រាក់ខែ"></span></button>
         
           
           <button id=' . $row->car_id . ' class="btn btn-warning btn-xs view" data-toggle="modal" data-target="#exampleModal_view"><span class="fa fa-eye" style="color:#ffffff" data-toggle="tooltip" title="View driver"></span></button>
        
           
           <button id=' . $row->car_id . ' class="btn btn-success btn-xs btnedit" data-toggle="modal" data-target="#exampleModal"><span class="fa fa-edit" style="color:#ffffff" data-toggle="tooltip" title="Edit driver"></span></button>
       
           
           <a href="../resources/templates/back/delete_driver.php?id=' . $row->car_id . '" class="btn btn-danger btn-xs btn-delete" role="button"><span class="fa fa-trash" style="color:#ffffff" data-toggle="tooltip" title="Delete driver"></span></a>
          
           </div>

           
           ';
    }
    $echo .= '
           
           </td>
           
           </tr>';
  }
  echo $echo;
}

function viewdriverlist()
{
  $id = $_GET['id'];

  $select = query("SELECT * from tbl_car_driver where car_id = $id");
  confirm($select);

  while ($row = $select->fetch_object()) {

    echo '
<div class="row">
<div class="col-md-6">

<ul class="list-group">

<center><p class="list-group-item list-group-item-info"><b>DRIVER DETAILS</b></p></center>  

  <li class="list-group-item"><b>ID</b> <span class="badge label badge-light float-right">' . $row->car_id . '</span></li>
  <li class="list-group-item"><b>ឈ្មោះជាភាសាខ្មែរ</b><span class="badge label badge-warning float-right">' . $row->car_namekh . '</span></li>
  <li class="list-group-item"><b>ឈ្មោះជាអក្សរឡាតាំង</b> <span class="badge label badge-success float-right">' . $row->car_nameen . '</span></li>
  <li class="list-group-item"><b>ភេទ </b><span class="badge label badge-primary float-right">' . $row->car_sex . '</span></li>
  <li class="list-group-item"><b>ថ្ងៃខែឆ្នាំកំណើត</b> <span class="badge label badge-danger float-right">' . date('d-m-Y', strtotime($row->car_db)) . '</span></li>
  <li class="list-group-item"><b>លេខទូរសព្ទ </b><span class="badge label badge-secondary float-right">' . $row->car_phone . '</span></li>

  <li class="list-group-item"><b>ប្រភេទរថយន្ត</b> <span class="badge label badge-info float-right">' . $row->car_car_type . '</span></li>
  <li class="list-group-item"><b>ស្លាកលេខរថយន្ត</b> <span class="badge label badge-dark float-right">' . $row->car_license_plate . '</span></li>
  <li class="list-group-item"><b>លេខសំគាល់រថយន្ត</b> <span class="badge label badge-primary float-right">' . $row->car_vehicle_id . '</span></li>
  <li class="list-group-item"><b>ប្រាក់ខែ</b> <span class="badge label badge-danger float-right">' . $row->car_salary . '</span></li>
  <li class="list-group-item"><b>ចំនួនប្រេង</b> <span class="badge label badge-dark float-right">' . $row->car_oil . '</span></li>
  <li class="list-group-item"><b>ថ្ងៃខែចូលធ្វើការ</b> <span class="badge label badge-success float-right">' . date('d-m-Y', strtotime($row->car_date_of_employment)) . '</span></li>
</ul>
</div>

<div class="col-md-6">
<ul class="list-group">
<center><p class="list-group-item list-group-item-info"><b>DRIVER IMAGE</b></p></center>  
<img src="../productimages/driver/' . $row->car_img . '" class="img-thumbnail"/>
</ul>
</div>
</div>



';
  }
}


function add_car_driver()
{
  if (isset($_POST['btnsave'])) {

    $txtnamekh                  = $_POST['txtnamekh'];
    $txtdb                      = $_POST['txtdb'];
    $datedb                     = date('Y-m-d', strtotime($txtdb));
    $txtcar_type                = $_POST['txtcar_type'];
    $txt_salary                 = $_POST['txt_salary'];
    $txtnameen                  = $_POST['txtnameen'];
    $txtphone                   = $_POST['txtphone'];
    $txt_License_plate          = $_POST['txt_License_plate'];
    $txt_car_oil                = $_POST['txt_car_oil'];
    $sex                        = $_POST['sex'];
    $txt_Vehicle_ID             = $_POST['txt_Vehicle_ID'];
    $txt_date_of_employment     = $_POST['txt_date_of_employment'];
    $dateof_employment          = date('Y-m-d', strtotime($txt_date_of_employment));
    $id_branch =branch_id();
    //Image Code or File Code Start Here..
    $f_name        = $_FILES['myfile']['name'];

    if (!empty($f_name)) {

      $f_tmp         = $_FILES['myfile']['tmp_name'];
      $f_size        = $_FILES['myfile']['size'];
      $f_extension   = explode('.', $f_name);
      $f_extension   = strtolower(end($f_extension));
      $f_newfile     = uniqid() . '.' . $f_extension;

      $store = "../productimages/driver/" . $f_newfile;

      if ($f_extension == 'jpg' || $f_extension == 'jpeg' ||   $f_extension == 'png' || $f_extension == 'gif') {

        if ($f_size >= 2000000) {

          set_message(' <script>
                            Swal.fire({
                              icon: "warning",
                              title: "Max file should be 2MB"
                            });
                          </script>');
          redirect('itemt?addcardriver');
        } else {

          if (move_uploaded_file($f_tmp, $store)) {

            $productimage = $f_newfile;

            $insert = query("INSERT into tbl_car_driver ( car_namekh,car_nameen,car_sex,car_db,car_phone,car_car_type,car_license_plate,car_vehicle_id,car_salary,car_oil,car_date_of_employment,car_img,id_branch) 
                        values('{$txtnamekh}','{$txtnameen}','{$sex}','{$datedb}','{$txtphone}','{$txtcar_type}','{$txt_License_plate}','{$txt_Vehicle_ID}','{$txt_salary}','{$txt_car_oil}','{$dateof_employment}','{$productimage}','{$id_branch}')");
            confirm($insert);

            if ($insert) {

              set_message(' <script>
                            Swal.fire({
                              icon: "success",
                              title: "Driver Inserted Successfully"
                            });
                          </script>');
              redirect('itemt?driverlist');
            } else {
              set_message(' <script>
                            Swal.fire({
                              icon: "error",
                              title: "Driver Inserted Failed"
                            });
                          </script>');
              redirect('itemt?addcardriver');
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
        redirect('itemt?addcardriver');
      }
    } else {
      $productimage = 'display.jpg';

      $insert = query("INSERT into tbl_car_driver ( car_namekh,car_nameen,car_sex,car_db,car_phone,car_car_type,car_license_plate,car_vehicle_id,car_salary,car_oil,car_date_of_employment,car_img,id_branch) 
            values('{$txtnamekh}','{$txtnameen}','{$sex}','{$datedb}','{$txtphone}','{$txtcar_type}','{$txt_License_plate}','{$txt_Vehicle_ID}','{$txt_salary}','{$txt_car_oil}','{$dateof_employment}','{$productimage}','{$id_branch}')");
      confirm($insert);

      if ($insert) {

        set_message(' <script>
                Swal.fire({
                  icon: "success",
                  title: "Driver Inserted Successfully"
                });
              </script>');
        redirect('itemt?driverlist');
      } else {
        set_message(' <script>
                Swal.fire({
                  icon: "error",
                  title: "Driver Inserted Failed"
                });
              </script>');
        redirect('itemt?addcardriver');
      }
    }
  }
}



function update_driver()
{


  if (isset($_POST['btnupdate'])) {


    $txtnamekh                  = $_POST['txtnamekh'];
    $txtdb                      = $_POST['txtdb'];
    $datedb                     = date('Y-m-d', strtotime($txtdb));
    $txtcar_type                = $_POST['txtcar_type'];
    $txt_salary                 = $_POST['txt_salary'];
    $txtnameen                  = $_POST['txtnameen'];
    $txtphone                   = $_POST['txtphone'];
    $txt_License_plate          = $_POST['txt_License_plate'];
    $txt_car_oil                = $_POST['txt_car_oil'];
    $sex                        = $_POST['sex'];
    $txt_Vehicle_ID             = $_POST['txt_Vehicle_ID'];
    $txt_date_of_employment     = $_POST['txt_date_of_employment'];
    $dateof_employment          = date('Y-m-d', strtotime($txt_date_of_employment));

    $id = $_POST['btnupdate'];


    //Image Code or File Code Start Here..
    $f_name        = $_FILES['myfile']['name'];

    if (!empty($f_name)) {

      $f_tmp         = $_FILES['myfile']['tmp_name'];
      $f_size        = $_FILES['myfile']['size'];
      $f_extension   = explode('.', $f_name);
      $f_extension   = strtolower(end($f_extension));
      $f_newfile     = uniqid() . '.' . $f_extension;

      $store = "../productimages/driver/" . $f_newfile;
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

          $select_img = query("SELECT car_img from tbl_car_driver where car_id = $id");
          confirm($select_img);
          $row = $select_img->fetch_assoc();

          if (move_uploaded_file($f_tmp, $store)) {
            $db_image = $row['car_img'];
            if ($db_image != 'display.jpg') {
              unlink("../productimages/driver/$db_image");
            }
            $query = "UPDATE tbl_car_driver SET ";
            $query .= "car_namekh               = '{$txtnamekh}'                 , ";
            $query .= "car_nameen               = '{$txtnameen}'                 , ";
            $query .= "car_sex                  = '{$sex}'                       , ";
            $query .= "car_db                   = '{$datedb}'                    , ";
            $query .= "car_phone                = '{$txtphone}'                  , ";
            $query .= "car_car_type             = '{$txtcar_type}'               , ";
            $query .= "car_license_plate               = '{$txt_License_plate}'  , ";
            $query .= "car_vehicle_id           = '{$txt_Vehicle_ID}'            , ";
            $query .= "car_salary               = '{$txt_salary}'                , ";
            $query .= "car_oil                  = '{$txt_car_oil}'               , ";
            $query .= "car_date_of_employment   = '{$dateof_employment}'         , ";
            $query .= "car_img                  = '{$teacher_image}'               ";
            $query .= "WHERE car_id=" . $id;

            $send_update_query = query($query);
            confirm($send_update_query);

            if ($send_update_query) {
              set_message(' <script>
                        Swal.fire({
                          icon: "success",
                          title: "Driver Updated Successfully With New Image"
                        });
                      </script>');
              redirect('itemt?driverlist');
            } else {
              set_message(' <script>
                       Swal.fire({
                      icon: "error",
                      title: "Driver Update Failed"
                       });
                     </script>');
              redirect('itemt?editdriver&id=' . $id . '');
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
        redirect('itemt?editdriver&id=' . $id . '');
      }
    } else {


      $query = "UPDATE tbl_car_driver SET ";
      $query .= "car_namekh               = '{$txtnamekh}'                 , ";
      $query .= "car_nameen               = '{$txtnameen}'                 , ";
      $query .= "car_sex                  = '{$sex}'                       , ";
      $query .= "car_db                   = '{$datedb}'                    , ";
      $query .= "car_phone                = '{$txtphone}'                  , ";
      $query .= "car_car_type             = '{$txtcar_type}'               , ";
      $query .= "car_license_plate               = '{$txt_License_plate}'  , ";
      $query .= "car_vehicle_id           = '{$txt_Vehicle_ID}'            , ";
      $query .= "car_salary               = '{$txt_salary}'                , ";
      $query .= "car_oil                  = '{$txt_car_oil}'               , ";
      $query .= "car_date_of_employment   = '{$dateof_employment}'          ";
      $query .= "WHERE car_id=" . $id;

      $send_update_query = query($query);
      confirm($send_update_query);

      if ($send_update_query) {
        set_message(' <script>
               Swal.fire({
                icon: "success",
                title: "Driver Updated Successfully "
                 });
                </script>');
        redirect('itemt?driverlist');
      } else {
        set_message(' <script>
               Swal.fire({
              icon: "error",
              title: "Driver Update Failed"
              });
               </script>');
        redirect('itemt?editdriver&id=' . $id . '');
      }
    }
  }
}


function driver_Payroll()
{
  if (isset($_POST['submit'])) {

    $car_id = $_POST['submit'];
    $money = $_POST['txt_salary'];
    $date = $_POST['txtdatesalary'];
    $datedb = date('Y-m-d', strtotime($date));
    $name = $_POST['txtnamekh'];
    $result = explode('-', $datedb);
    $datee = $result[2];
    $month = $result[1];
    $year = $result[0];
    $new = $year . '-' . $month;
    $id_branch =branch_id();
    if ($money == 0) {
      set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Money Feild is Empty"
            });
           </script>');
      redirect('itemt?driverlist');
    } else {

      $query = query("INSERT INTO tbl_employee_driver(car_id,money,date,id_branch) VALUES('{$car_id}','{$money}','{$datedb}','{$id_branch}')");
      $last_id = last_id();
      confirm($query);

      set_message(' <script>
        Swal.fire({
        icon: "success",
        title: "បើកប្រាក់ខែឲ្យបុគ្គលិក",
        text:"បានបើកប្រាក់ខែឲ្យបុគ្គលិក ' . $name . ' ចំនូន ' . $money . '",
        });
       </script>');

      redirect("itemth?driverlist");
    }
  }
}

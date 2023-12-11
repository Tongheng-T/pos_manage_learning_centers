<?php

$upload_directory = "uploads";

// helper function

function last_id()
{
    global $connection;
    return mysqli_insert_id($connection);
}

function set_message($msg)
{
    if (!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

function display_message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}
function actr($path)
{
    if (isset($_GET[$path])) {
        $active = "active";
        echo $active;
    }
}

function redirect($location)
{
    header("Location: $location");
}

function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}

function confirm($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}


function fetch_array($result)
{

    return ($row = mysqli_fetch_array($result));
}

/*********************************FRONT END FUNCTIONS************************************/

function login_user()
{
    if (isset($_POST['btn_login'])) {

        $useremail = $_POST['txt_email'];
        $password = $_POST['txt_password'];

        $query = query("SELECT * from tbl_user where useremail='$useremail' AND password='$password' and role ='Admin'");
        confirm($query);

        if (mysqli_num_rows($query) == 0) {
            $query2 = query("SELECT * from tbl_user where useremail='$useremail' AND password='$password' and role ='User'");
            confirm($query2);
            if (mysqli_num_rows($query2) == 0) {

                $_SESSION['status'] = "អ៊ីមែល ឬពាក្យសម្ងាត់ខុស ឬវាលគឺទទេ!";
                $_SESSION['status_code'] = "error";
                redirect("");
            } else {
                $row =  $query2->fetch_assoc();
                $_SESSION['userid'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['useremail'] = $row['useremail'];
                $_SESSION['img'] = $row['img'];
                $_SESSION['role'] = $row['role'];

                $_SESSION['status'] = "Login success By User";
                $_SESSION['status_code'] = "success";

                header('refresh:2;user/');
            }
        } else {
            $row =  $query->fetch_assoc();
            $_SESSION['userid'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['useremail'] = $row['useremail'];
            $_SESSION['role'] = $row['role'];

            $_SESSION['status'] = "Login success By Admin";
            $_SESSION['status_code'] = "success";

            header('refresh:2;ui/');
        }
    }
}

function check_login()
{
    if (isset($_SESSION['userid'])) {

        $id = $_SESSION['userid'];
        $query = query("SELECT * from tbl_user where user_id = '$id' limit 1");

        if ($query && mysqli_num_rows($query) > 0) {

            $user_data = mysqli_fetch_assoc($query);
            return $user_data;
        }
    }

    //redirect to login
    header("Location: ../");
    die;
}
function name_user()
{
    if (isset($_SESSION['userid'])) {
        $id = $_SESSION['userid'];
        $query =  query("SELECT * FROM tbl_user WHERE user_id =  $id ");
        confirm($query);
        while ($row = fetch_array($query)) {

            $name = <<<DELIMETER
        {$row['username']}

        DELIMETER;
        }
        echo $name;
    } else {
        echo "Hello";
    }
}


function name_branch()
{
    if (isset($_SESSION['userid'])) {
        $id = $_SESSION['userid'];
        $query =  query("SELECT * FROM tbl_user WHERE user_id =  $id ");
        confirm($query);
        $row = $query->fetch_assoc();
        $id_branch = $row['id_branch'];
    }
    $query =  query("SELECT * FROM tbl_branch WHERE id =  $id_branch ");
    confirm($query);
    $row = $query->fetch_assoc();
    echo  $row['branch_name'];
}

function qr_teacher_id()
{
    $idd = $_GET['id'];
    $query =  query("SELECT * FROM tbl_students WHERE sd_id='$idd'");
    confirm($query);
    $uel = 'http://54.254.62.28/teacher_id.php?id=' . $idd;
    $qrcode = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . $uel . '&choe=UTF-8';
    echo $qrcode;
}

function qr()
{
    $idd = $_GET['id'];
    $query =  query("SELECT * FROM tbl_students WHERE sd_id='$idd'");
    confirm($query);
    $uel = 'http://54.254.62.28/students_id.php?id=' . $idd;
    $qrcode = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . $uel . '&choe=UTF-8';
    echo $qrcode;
}
function qr_driver_id()
{
    $idd = $_GET['id'];
    $query =  query("SELECT * FROM tbl_students WHERE sd_id='$idd'");
    confirm($query);
    $uel = 'http://54.254.62.28/driver_id.php?id=' . $idd;
    $qrcode = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . $uel . '&choe=UTF-8';
    echo $qrcode;
}

function img_user()
{
    if (isset($_SESSION['userid'])) {
        $id = $_SESSION['userid'];
        $query =  query("SELECT * FROM tbl_user WHERE user_id =  $id ");
        confirm($query);
        while ($row = fetch_array($query)) {

            $name = <<<DELIMETER
        {$row['img']}

        DELIMETER;
        }
        echo $name;
    } else {
        echo "Hello.png";
    }
}

/*********************************BACK END FUNCTIONS************************************/

function changepassword()
{
    if (isset($_POST['btnupdate'])) {

        $oldpassword_txt = $_POST['txt_oldpassword'];
        $newpassword_txt = $_POST['txt_newpassword'];
        $rnewpassword_txt = $_POST['txt_rnewpassword'];

        //echo $oldpassword_txt."-".$newpassword_txt."-".$rnewpassword_txt;


        // 2 Step) Using of select Query we will get out database records according to useremail.

        $email = $_SESSION['useremail'];

        $select = query("SELECT * from tbl_user where useremail='$email'");
        confirm($select);

        $row = $select->fetch_assoc();

        $useremail_db = $row['useremail'];
        $password_db = $row['password'];



        // 3 Step) We will compare the user inputs values to database values.

        if ($oldpassword_txt == $password_db) {

            if ($newpassword_txt == $rnewpassword_txt) {

                // 4 Step) If values will match then we will run update Query. 


                $update = query("UPDATE tbl_user set password='$rnewpassword_txt' where useremail='$email'");
                confirm($update);

                if ($update) {
                    set_message(' <script>
                            Swal.fire({
                              icon: "success",
                              title: "Password Updated successfully"
                            });
                          </script>');
                    redirect('itemt?changepassword');
                } else {
                    set_message(' <script>
                    Swal.fire({
                      icon: "error",
                      title: "Password Not Updated successfully"
                    });
                  </script>');
                    redirect('itemt?changepassword');
                }

                // $_SESSION['status']="New Password Matched";
                // $_SESSION['status_code']="success";

            } else {
                set_message(' <script>
                    Swal.fire({
                      icon: "error",
                      title: "New Password Deos Not Matched"
                    });
                  </script>');
                redirect('itemt?changepassword');
            }
        } else {

            set_message(' <script>
            Swal.fire({
              icon: "error",
              title: "Password Deos Not Matched"
            });
          </script>');
            redirect('itemt?changepassword');
        }
    }
}


function registration()
{
    if (isset($_POST['btnsave'])) {

        $username = $_POST['txtname'];
        $useremail = $_POST['txtemail'];
        $userpassword = $_POST['txtpassword'];
        $userrole = $_POST['txtselect_option'];
        $id_branch = $_POST['id_branch'];

        $user_photo = $_FILES['file']['name'];
        $image_temp_location = $_FILES['file']['tmp_name'];

        if (!empty($user_photo)) {
            move_uploaded_file($image_temp_location, "../productimages/user/" . $user_photo);
            $image = $user_photo;
        } else {
            $image = 'hello.png';
        }
        move_uploaded_file($image_temp_location,  UPLOAD_DIRECTORY_UDER . DS . $user_photo);

        if (isset($_POST['txtemail'])) {

            $select = query("SELECT useremail from tbl_user where useremail='$useremail'");
            confirm($select);


            if (mysqli_num_rows($select) > 0) {
                set_message(' <script>
                Swal.fire({
                  icon: "warning",
                  title: "Email already exists. Create Account From New Email"
                });
               </script>');
                redirect('itemt?registration');
            } else {

                $insert = query("INSERT into tbl_user (username,useremail,password,role,img,id_branch) values('{$username}','{$useremail}','{$userpassword}','{$userrole}','{$image}','{$id_branch}')");
                confirm($insert);
                if ($insert) {

                    set_message(' <script>
                      Swal.fire({
                      icon: "success",
                      title: "Insert successfully the user into the database"
                      });
                     </script>');
                    redirect('itemt?registration');
                } else {
                    set_message(' <script>
                      Swal.fire({
                      icon: "error",
                      title: "Error inserting the user into the database"
                      });
                     </script>');
                    redirect('itemt?registration');
                }
            }
        }
    }





    if (isset($_POST['btnupdate'])) {

        $username = $_POST['txtname'];
        $useremail = $_POST['txtemail'];
        $userpassword = $_POST['txtpassword'];
        $userrole = $_POST['txtselect_option'];
        $id_branch = $_POST['id_branch'];
        $id = $_POST['btnupdate'];
        $user_photo = $_FILES['file']['name'];
        $image_temp_location = $_FILES['file']['tmp_name'];

        $select_img = query("SELECT img from tbl_user where user_id = $id");
        confirm($select_img);
        $row = $select_img->fetch_assoc();


        if (!empty($user_photo)) {
            move_uploaded_file($image_temp_location, "../productimages/user/" . $user_photo);
            $dbimage = $row['img'];
            $image = $user_photo;
            unlink("../productimages/user/$dbimage");
        } else {
            $image = $row['img'];
        }


        if (isset($_POST['txtemail'])) {

            $select = query("SELECT useremail from tbl_user where useremail='$useremail'");
            confirm($select);


            if (mysqli_num_rows($select) < 0) {
                set_message(' <script>
                Swal.fire({
                  icon: "warning",
                  title: "Email already exists. Create Account From New Email"
                });
               </script>');
                redirect('itemt?registration');
            } else {

                $insert = query("UPDATE tbl_user set username='$username' , useremail='$useremail', useremail='$useremail', password='$userpassword', img='$image' , role='$userrole',id_branch='$id_branch' where user_id='$id'");
                confirm($insert);
                if ($insert) {

                    set_message(' <script>
                      Swal.fire({
                      icon: "success",
                      title: "UPDATE successfully the user into the database"
                      });
                     </script>');
                    redirect('itemt?registration');
                } else {
                    set_message(' <script>
                      Swal.fire({
                      icon: "error",
                      title: "Error inserting the user into the database"
                      });
                     </script>');
                    redirect('itemt?registration');
                }
            }
        }
    }
}




// ////////////////////////////////


function edit_registration()
{
    if (isset($_POST['btnedit'])) {

        $select = query("SELECT * from tbl_user where user_id =" . $_POST['btnedit']);
        confirm($select);

        $show =  "";

        if ($select) {
            $row = $select->fetch_object();

            $show .= ' <div class="col-md-4">
               <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>រូបថត រូបភាព</label>
                <input type="file" class="input-group" name="file" onchange="displayImage(this)" id="profilImg">
                <img  src="../productimages/user/' . $row->img . ' " onclick="triggerClick()" id="profiledisplay">
               </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="txtname" value="' . $row->username . '" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="txtemail" value="' . $row->useremail . '" required>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <div class="input-group">
                    <input type="password" placeholder="Password" id="pwd" class="form-control" placeholder="Password" name="txtpassword" value="' . $row->password . '"  required>
                    <button type="button" class="input-group-text" id="eye">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                   </button>
                </div>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="txtselect_option" required>
                        <option value="" disabled selected>Select Role</option>
                        <option selected>' . $row->role . '</option>
                        <option>Admin</option>
                        <option>User</option>

                    </select>
                </div>

                <div class="form-group">
                <label>Branch</label>
                <select class="form-control" name="id_branch" required>';

            $select = query("SELECT * from tbl_branch");
            confirm($select);

            while ($roww = $select->fetch_assoc()) {

                if ($row->id_branch == $roww['id']) {
                    $show .= '
                  <option value=" ' . $roww['id'] . ' "  selected="selected" > ' . $roww['branch_name'] . '</option>';
                } else {

                    $show .= '
                  <option value=" ' . $roww['id'] . ' "  > ' . $roww['branch_name'] . '</option>';
                }
            }


            $show .= '
                </select>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info" value="' . $row->user_id . '" name="btnupdate">Update</button>
                </div>
            </form>

         </div>';
        }
    } else {
        $show =  "";

        $show .= '<div class="col-md-4">
           <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label>រូបថត រូបភាព</label>
               <input type="file" class="input-group" name="file" onchange="displayImage(this)" id="profilImg">
               <img  src="../productimages/user/display.jpg " onclick="triggerClick()" id="profiledisplay">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" placeholder="Enter Name" name="txtname" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" placeholder="Enter email" name="txtemail" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" placeholder="Password" name="txtpassword" required>
            </div>

            <div class="form-group">
                <label>Role</label>
                <select class="form-control" name="txtselect_option" required>
                    <option value="" disabled selected>Select Role</option>
                    <option>Admin</option>
                    <option>User</option>

                </select>
            </div>

            <div class="form-group">
           <label>Branch</label>
           <select class="form-control" name="id_branch" required>
           <option value="" disabled selected>Select Branch</option>
           ';



        $select = query("SELECT * from tbl_branch");
        confirm($select);

        while ($row = $select->fetch_assoc()) {

            $show .= '
          <option value=" ' . $row['id'] . ' "> ' . $row['branch_name'] . '</option>';
        }


        $show .= '

            </select>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="btnsave">Save</button>
            </div>
        </form>

    </div>';
    }
    echo $show;
}



function convert_month_kh($value)
{
    $kh_month =
        '{
            "01": "មករា",
            "1": "មករា",
            "02": "កុម្ភៈ",
            "2": "កុម្ភៈ",
            "03": "មិនា",
            "3": "មិនា",
            "04": "មេសា",
            "4": "មេសា",
            "05": "ឧសភា",
            "5": "ឧសភា",
            "06": "មិថុនា",
            "6": "មិថុនា",
            "07": "កក្កដា",
            "7": "កក្កដា",
            "08": "សីហា",
            "8": "សីហា",
            "09": "កញ្ញា",
            "9": "កញ្ញា",
            "10": "តុលា",
            "11": "វិចិ្ឆកា",
            "12": "ធ្នូ"
        }';


    $month = json_decode($kh_month);
    return $month->$value;
}
function convert_date($date)
{
    $dates = explode("-", $date);
    $month = convert_month_kh($dates[1]);
    return "$month";
}





function edit_setting()
{
    if (isset($_POST['btnedit'])) {

        $select = query("SELECT * from tbl_setting where setting_id =" . $_POST['btnedit']);
        confirm($select);

        $show =  "";

        if ($select) {
            $row = $select->fetch_object();

            $show .= ' <div class="col-md-12">
               <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>រូបថត Logo</label>
                <input type="file" class="input-group" name="file" onchange="displayImage(this)" id="profilImg">
                <img  src="../productimages/logo/' . $row->logo . ' " onclick="triggerClick()" id="profiledisplay">
               </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">name_receipt</label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="txtname" value="' . $row->name_receipt . '" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">receipt_Address</label>
                    <input type="text" class="form-control" placeholder="Enter Address" name="txtAddress" value="' . $row->receipt_Address     . '" required>
                </div>
                <div class="form-group">
                 <label for="exampleInputEmail1">receipt_Email</label>
                 <input type="email" class="form-control" placeholder="Enter email" name="txtemail" value="' . $row->receipt_Email     . '" required>
               </div>

               <div class="form-group">
               <label for="exampleInputEmail1">receipt_Phone</label>
               <input type="text" class="form-control" placeholder="Enter Phone" name="txtPhone" value="' . $row->receipt_Phone     . '" required>
             </div>

             <div class="form-group">
             <label for="exampleInputEmail1">Importan_Notice</label>
             <input type="text" class="form-control" placeholder="Enter Notice" name="txtNotice" value="' . $row->Importan_Notice     . '" required>
           </div>
 ';



            $show .= '
                </select>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info" value="' . $row->setting_id . '" name="btnupdate">Update</button>
                </div>
            </form>

         </div>';
        }
        echo $show;
    }





    if (isset($_POST['btnupdate'])) {

        $username = $_POST['txtname'];
        $txtAddress = $_POST['txtAddress'];
        $useremail = $_POST['txtemail'];
        $txtPhone = $_POST['txtPhone'];
        $txtNotice = $_POST['txtNotice'];

        $id = $_POST['btnupdate'];
        $user_photo = $_FILES['file']['name'];
        $image_temp_location = $_FILES['file']['tmp_name'];

        $select_img = query("SELECT logo from tbl_setting where setting_id = $id");
        confirm($select_img);
        $row = $select_img->fetch_assoc();


        if (!empty($user_photo)) {
            move_uploaded_file($image_temp_location, "../productimages/logo/" . $user_photo);
            $dbimage = $row['logo'];
            $image = $user_photo;
            unlink("../productimages/logo/$dbimage");
        } else {
            $image = $row['logo'];
        }


        $insert = query("UPDATE tbl_setting set logo='$image' , receipt_Address	='$txtAddress', receipt_Email='$useremail', receipt_Phone='$txtPhone', Importan_Notice='$txtNotice' , name_receipt='$username' where setting_id='$id'");
        confirm($insert);
        if ($insert) {

            set_message(' <script>
                      Swal.fire({
                      icon: "success",
                      title: "UPDATE successfully the user into the database"
                      });
                     </script>');
            redirect('itemt?setting');
        } else {
            set_message(' <script>
                      Swal.fire({
                      icon: "error",
                      title: "Error inserting the user into the database"
                      });
                     </script>');
            redirect('itemt?setting');
        }
    }
}









////////////////////////////////////////////////////////////////////////////

require  "functions_pr.php";
require "fun/teacher_fun.php";
require  "fun/driver_fun.php";
require  "fun/students_fun.php";

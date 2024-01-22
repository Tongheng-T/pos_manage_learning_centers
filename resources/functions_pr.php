<?php



function show_subject($sj_id)
{
    $scaleL_query = query("SELECT * FROM tbl_subject WHERE sj_id = '{$sj_id}'");
    confirm($scaleL_query);
    while ($scale_row = fetch_array($scaleL_query)) {

        return $scale_row['sj_name'];
    }
}

function show_teacher($tc_id)
{
    $scaleL_query = query("SELECT * FROM tbl_teacher WHERE tc_id = '{$tc_id}'");
    confirm($scaleL_query);
    while ($scale_row = fetch_array($scaleL_query)) {

        return $scale_row['tc_namekh'];
    }
}
function show_studytime($sdi_id)
{
    $scaleL_query = query("SELECT * FROM tbl_studytime WHERE sdi_id = '{$sdi_id}'");
    confirm($scaleL_query);
    while ($scale_row = fetch_array($scaleL_query)) {

        return $scale_row['sdi_name'];
    }
}
function show_car_driver($car_id)
{
    $scaleL_query = query("SELECT * FROM tbl_car_driver WHERE car_id = '{$car_id}'");
    confirm($scaleL_query);
    if ($car_id != 1) {
        while ($scale_row = fetch_array($scaleL_query)) {

            $car_id = " - លេខសម្គាល់ ";
            $license = " ស្លាកលេខរថយន្ត ";

            return $license . $scale_row['car_license_plate'] . $car_id . $scale_row['car_vehicle_id'];
        }
    } else {
        $car_id = "ដោយខ្លួនឯង";
        return $car_id;
    }
}

function show_classroom($sdi_id)
{
    $scaleL_query = query("SELECT * FROM tbl_classroom WHERE cr_id = '{$sdi_id}'");
    confirm($scaleL_query);
    while ($scale_row = fetch_array($scaleL_query)) {

        return $scale_row['cr_name'];
    }
}



// //////////////////////////////////////////////////////////////////




function fill_subject()
{
    $id_branch = branch_id();
    $output = '';
    $select = query("SELECT * from tbl_subject WHERE id_branch='$id_branch' order by sj_name asc");
    confirm($select);

    foreach ($select as $row) {
        $output .= '<option value="' . $row["sj_id"] . '">' . $row["sj_name"] . '</option>';
    }

    return $output;
}
function fill_studytime()
{

    $output = '';
    $select = query("SELECT * from tbl_studytime");
    confirm($select);

    foreach ($select as $row) {
        $output .= '<option value="' . $row["sdi_id"] . '">' . $row["sdi_name"] . '</option>';
    }

    return $output;
}
function fill_classroom()
{
    $id_branch = branch_id();
    $output = '';
    $select = query("SELECT * from tbl_classroom WHERE id_branch='$id_branch'");
    confirm($select);

    foreach ($select as $row) {
        $output .= '<option value="' . $row["cr_id"] . '">' . $row["cr_name"] . '</option>';
    }

    return $output;
}
function fill_car_driver()
{
    $id_branch = branch_id();
    $output = '';
    $select = query("SELECT * from tbl_car_price ");
    confirm($select);
    $output.='<option value="">Select</option>';

    foreach ($select as $row) {
        $output .= '
        <option value="' . $row["price"] . '">' . $row["tit_price"] .$row["price"]. '</option>';
    }

    return $output;
}
function fill_teacher()
{
    $id_branch = branch_id();
    $output = '';
    $select = query("SELECT * from tbl_teacher WHERE id_branch='$id_branch'");
    confirm($select);

    foreach ($select as $row) {
        $output .= '<option value="' . $row["tc_id"] . '">' . $row["tc_namekh"] . '</option>';
    }

    return $output;
}

// //////////////////////////////////////////////////////////////////


function insert_update_delete()
{
    if (isset($_POST['btnsave'])) {

        $category = $_POST['txtcategory'];
        $price = $_POST['txtprice'];
        $txtprice_year = $_POST['txtprice_year'];
        $carprice_month = $_POST['txtcarprice_month'];
        $carprice_year = $_POST['txtcarprice_year'];
        $txtprice_session = $_POST['txtprice_session'];
        $id_branch = branch_id();

        if (empty($category)) {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Subject Feild is Empty"
            });
           </script>');
            redirect('itemt?subject');
        } else {

            $insert = query("INSERT into tbl_subject (sj_name,sj_price,sj_price_year,price_session,car_price_year,car_price_month,id_branch) values('{$category}','{$price}','{$txtprice_year}','{$txtprice_session}','{$carprice_year}','{$carprice_month}','{$id_branch}')");
            confirm($insert);
            if ($insert) {
                set_message(' <script>
                Swal.fire({
                icon: "success",
                title: "Subject Added successfully"
                });
               </script>');
                redirect('itemt?subject');
            } else {
                set_message(' <script>
                Swal.fire({
                icon: "warning",
                title: "Subject Added Failed"
                });
               </script>');
                redirect('itemt?subject');
            }
        }
    }



    if (isset($_POST['btnupdate'])) {

        $category = $_POST['txtcategory'];
        $price = $_POST['txtprice'];
        $txtprice_year = $_POST['txtprice_year'];
        $id = $_POST['txtcatid'];
        $carprice_month = $_POST['txtcarprice_month'];
        $carprice_year = $_POST['txtcarprice_year'];
        $txtprice_session = $_POST['txtprice_session'];

        if (empty($category)) {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Subject Feild is Empty"
            });
           </script>');
            redirect('itemt?subject');
        } else {

            $update = query("UPDATE tbl_subject set sj_name='$category', sj_price='$price',sj_price_year='$txtprice_year',price_session='$txtprice_session',car_price_year='$carprice_year',car_price_month='$carprice_month' where sj_id=" . $id);
            confirm($update);

            if ($update) {
                set_message(' <script>
                Swal.fire({
                icon: "success",
                title: "Subject Update successfully"
                });
               </script>');
                redirect('itemt?subject');
            } else {
                set_message(' <script>
                Swal.fire({
                icon: "warning",
                title: "Subject Update Failed"
                });
               </script>');
                redirect('itemt?subject');
            }
        }
    }


    if (isset($_POST['btndelete'])) {

        $delete = query("DELETE from tbl_subject where sj_id=" . $_POST['btndelete']);
        confirm($delete);
        if ($delete) {
            set_message(' <script>
            Swal.fire({
            icon: "success",
            title: "Deleted"
            });
           </script>');
            redirect('itemt?subject');
        } else {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Delete Failed"
            });
           </script>');
            redirect('itemt?subject');
        }
    } else {
    }
}


function edit_category()
{
    if (isset($_POST['btnedit'])) {

        $select = query("SELECT * from tbl_subject where sj_id =" . $_POST['btnedit']);
        confirm($select);

        if ($select) {
            $row = $select->fetch_object();

            echo '<div class="col-md-4">

                <div class="form-group">
               <label for="exampleInputEmail1">Category</label>
               <input type="hidden" class="form-control" placeholder="Enter Category"  value="' . $row->sj_id . '" name="txtcatid" >
               <input type="text" class="form-control" placeholder="Enter Category"  value="' . $row->sj_name . '" name="txtcategory" >
               </div>

               <div class="form-group">
               <label for="exampleInputEmail1">Price</label>
               <input type="text" class="form-control" placeholder="Enter Category"  value="' . $row->sj_price . '" name="txtprice" >
               </div>
               <div class="form-group">
               <label for="exampleInputEmail1">តម្លៃ/១ឆ្នាំ</label>
               <input type="text" class="form-control" placeholder="Enter Price" value="' . $row->sj_price_year . '" name="txtprice_year" >
               </div>

               <div class="form-group">
               <label for="exampleInputEmail1">តម្លៃ/១វគ្គ</label>
               <input type="text" class="form-control" placeholder="Enter Price" value="' . $row->price_session . '" name="txtprice_session" >
               </div>

               <div class="form-group">
               <label for="exampleInputEmail1">តម្លៃឡាន/ខែ</label>
               <input type="text" class="form-control" placeholder="Enter Price" value="' . $row->car_price_month . '" name="txtcarprice_month" >
               </div>


               <div class="form-group">
               <label for="exampleInputEmail1">តម្លៃឡាន/ឆ្នាំ</label>
               <input type="text" class="form-control" placeholder="Enter Price" value="' . $row->car_price_year . '" name="txtcarprice_year" >
               </div>

               <div class="card-footer">
               <button type="submit" class="btn btn-info" name="btnupdate">Update</button>
               </div>
               </div>';
        }
    } else {

        echo '<div class="col-md-4">

         <div class="form-group">
         <label for="exampleInputEmail1">មុខវិជ្ជា</label>
         <input type="text" class="form-control" placeholder="បញ្ចូល មុខវិជ្ជា"  name="txtcategory" >
         </div>
         <div class="form-group">
         <label for="exampleInputEmail1">តម្លៃ/១ខែ</label>
         <input type="text" class="form-control" placeholder="Enter Price" name="txtprice" >
         </div>
         <div class="form-group">
         <label for="exampleInputEmail1">តម្លៃ/១ឆ្នាំ</label>
         <input type="text" class="form-control" placeholder="Enter Price" name="txtprice_year" >
         </div>

         <div class="form-group">
         <label for="exampleInputEmail1">តម្លៃ/១វគ្គ</label>
         <input type="text" class="form-control" placeholder="Enter Price" name="txtprice_session" >
         </div>
         
         <div class="form-group">
         <label for="exampleInputEmail1">តម្លៃឡាន/ខែ</label>
         <input type="text" class="form-control" placeholder="Enter Price"  name="txtcarprice_month" >
         </div>


         <div class="form-group">
         <label for="exampleInputEmail1">តម្លៃឡាន/ឆ្នាំ</label>
         <input type="text" class="form-control" placeholder="Enter Price"  name="txtcarprice_year" >
         </div>

         <div class="card-footer">
         <button type="submit" class="btn btn-warning" name="btnsave">Save</button>
         </div>

         </div>';
    }
}

function query_category()
{
    $id_branch = branch_id();

    $select = query("SELECT * from tbl_subject  where id_branch= $id_branch order by sj_id ASC");
    confirm($select);

    while ($row = $select->fetch_object()) {
        echo '
        <tr>
        <td>' . $row->sj_id . '</td>
        <td>' . $row->sj_name . '</td>
        <td>' . $row->sj_price . '</td>
        <td>' . $row->sj_price_year . '</td>
        <td>' . $row->price_session . '</td>
        <td>' . $row->car_price_month . '</td>
        <td>' . $row->car_price_year . '</td>
        <td>
        <button type="submit" class="btn btn-primary" value="' . $row->sj_id . '" name="btnedit">Edit</button>
        </td>
        <td>
        <button type="submit" class="btn btn-danger btn-delete" value="' . $row->sj_id . '" name="btndelete">Delete</button>
       </td>
      </tr>';
    }
}


function insert_update_delete_studytime()
{
    if (isset($_POST['btnsave'])) {

        $category = $_POST['txtcategory'];
        $qty = $_POST['txtcategory_qty'];
        if (empty($category)) {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Study time Feild is Empty"
            });
           </script>');
            redirect('itemt?studytime');
        } else {

            $insert = query("INSERT into tbl_studytime (sdi_name,qty) values('{$category}','{$qty}')");
            confirm($insert);
            if ($insert) {
                set_message(' <script>
                Swal.fire({
                icon: "success",
                title: "Study time Added successfully"
                });
               </script>');
                redirect('itemt?studytime');
            } else {
                set_message(' <script>
                Swal.fire({
                icon: "warning",
                title: "Study time Added Failed"
                });
               </script>');
                redirect('itemt?studytime');
            }
        }
    }



    if (isset($_POST['btnupdate'])) {

        $category = $_POST['txtcategory'];
        $qty = $_POST['txtcategory_qty'];
        $id = $_POST['txtcatid'];

        if (empty($category)) {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Study time Feild is Empty"
            });
           </script>');
            redirect('itemt?studytime');
        } else {

            $update = query("UPDATE tbl_studytime set sdi_name='$category',qty='$qty' where sdi_id=" . $id);
            confirm($update);

            if ($update) {
                set_message(' <script>
                Swal.fire({
                icon: "success",
                title: "Study time Update successfully"
                });
               </script>');
                redirect('itemt?studytime');
            } else {
                set_message(' <script>
                Swal.fire({
                icon: "warning",
                title: "Study time Update Failed"
                });
               </script>');
                redirect('itemt?studytime');
            }
        }
    }


    if (isset($_POST['btndelete'])) {

        $delete = query("DELETE from tbl_studytime where sdi_id=" . $_POST['btndelete']);
        confirm($delete);
        if ($delete) {
            set_message(' <script>
            Swal.fire({
            icon: "success",
            title: "Deleted"
            });
           </script>');
            redirect('itemt?studytime');
        } else {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Delete Failed"
            });
           </script>');
            redirect('itemt?studytime');
        }
    } else {
    }
}


function edit_studytime()
{
    if (isset($_POST['btnedit'])) {

        $select = query("SELECT * from tbl_studytime where sdi_id =" . $_POST['btnedit']);
        confirm($select);

        if ($select) {
            $row = $select->fetch_object();

            echo '<div class="col-md-4">

                <div class="form-group">
               <label for="exampleInputEmail1">Title</label>

               <input type="hidden" class="form-control" placeholder="Enter Title"  value="' . $row->sdi_id . '" name="txtcatid" >

               <input type="text" class="form-control" placeholder="Enter Qty"  value="' . $row->sdi_name   . '" name="txtcategory" >
               </div>
               <div class="form-group">
               <label for="exampleInputEmail1">ចំនួនម៉ោង</label>
               <input type="text" class="form-control" placeholder="Enter Category" value="' . $row->qty   . '" name="txtcategory_qty" >
               </div>

               <div class="card-footer">
               <button type="submit" class="btn btn-info" name="btnupdate">Update</button>
               </div>
               </div>';
        }
    } else {

        echo '<div class="col-md-4">

         <div class="form-group">
         <label for="exampleInputEmail1">Title</label>
         <input type="text" class="form-control" placeholder="Enter Title"  name="txtcategory" >
         </div>
         <div class="form-group">
         <label for="exampleInputEmail1">ចំនួនម៉ោង</label>
         <input type="text" class="form-control" placeholder="Enter Qty"  name="txtcategory_qty" >
         </div>
         <div class="card-footer">
         <button type="submit" class="btn btn-warning" name="btnsave">Save</button>
         </div>

         </div>';
    }
}



function query_studytime()
{
    $select = query("SELECT * from tbl_studytime order by sdi_id ASC");
    confirm($select);

    while ($row = $select->fetch_object()) {
        echo '
        <tr>
        <td>' . $row->sdi_id . '</td>
        <td>' . $row->sdi_name . '</td>
        <td>
        <button type="submit" class="btn btn-primary" value="' . $row->sdi_id . '" name="btnedit">Edit</button>
        </td>
        <td>
        <button type="submit" class="btn btn-danger" value="' . $row->sdi_id . '" name="btndelete">Delete</button>
       </td>
      </tr>';
    }
}


function insert_update_delete_car_price()
{
    if (isset($_POST['btnsave'])) {

        $category = $_POST['txtcategory'];
        $qty = $_POST['txtcategory_qty'];
        if (empty($category)) {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Car price Feild is Empty"
            });
           </script>');
            redirect('itemt?car_price');
        } else {

            $insert = query("INSERT into tbl_car_price (tit_price,price) values('{$category}','{$qty}')");
            confirm($insert);
            if ($insert) {
                set_message(' <script>
                Swal.fire({
                icon: "success",
                title: "Car price Added successfully"
                });
               </script>');
                redirect('itemt?car_price');
            } else {
                set_message(' <script>
                Swal.fire({
                icon: "warning",
                title: "Car price Added Failed"
                });
               </script>');
                redirect('itemt?car_price');
            }
        }
    }



    if (isset($_POST['btnupdate'])) {

        $category = $_POST['txtcategory'];
        $qty = $_POST['txtcategory_qty'];
        $id = $_POST['txtcatid'];

        if (empty($category)) {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Car price Feild is Empty"
            });
           </script>');
            redirect('itemt?car_price');
        } else {

            $update = query("UPDATE tbl_car_price set tit_price='$category',price='$qty' where id_cr_price=" . $id);
            confirm($update);

            if ($update) {
                set_message(' <script>
                Swal.fire({
                icon: "success",
                title: "Car price Update successfully"
                });
               </script>');
                redirect('itemt?car_price');
            } else {
                set_message(' <script>
                Swal.fire({
                icon: "warning",
                title: "Car price Update Failed"
                });
               </script>');
                redirect('itemt?car_price');
            }
        }
    }


    if (isset($_POST['btndelete'])) {

        $delete = query("DELETE from tbl_car_price where id_cr_price=" . $_POST['btndelete']);
        confirm($delete);
        if ($delete) {
            set_message(' <script>
            Swal.fire({
            icon: "success",
            title: "Deleted"
            });
           </script>');
            redirect('itemt?studytime');
        } else {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Delete Failed"
            });
           </script>');
            redirect('itemt?studytime');
        }
    } else {
    }
}

function edit_car_price()
{
    if (isset($_POST['btnedit'])) {

        $select = query("SELECT * from tbl_car_price where id_cr_price =" . $_POST['btnedit']);
        confirm($select);

        if ($select) {
            $row = $select->fetch_object();

            echo '<div class="col-md-4">

                <div class="form-group">
               <label for="exampleInputEmail1">Title</label>

               <input type="hidden" class="form-control" placeholder="Enter Title"  value="' . $row->id_cr_price . '" name="txtcatid" >

               <input type="text" class="form-control" placeholder="Enter Qty"  value="' . $row->tit_price   . '" name="txtcategory" >
               </div>
               <div class="form-group">
               <label for="exampleInputEmail1">តម្លៃ</label>
               <input type="text" class="form-control" placeholder="Enter Category" value="' . $row->price   . '" name="txtcategory_qty" >
               </div>

               <div class="card-footer">
               <button type="submit" class="btn btn-info" name="btnupdate">Update</button>
               </div>
               </div>';
        }
    } else {

        echo '<div class="col-md-4">

         <div class="form-group">
         <label for="exampleInputEmail1">Title</label>
         <input type="text" class="form-control" placeholder="Enter Title"  name="txtcategory" >
         </div>
         <div class="form-group">
         <label for="exampleInputEmail1">តម្លៃ</label>
         <input type="text" class="form-control" placeholder="Enter price"  name="txtcategory_qty" >
         </div>
         <div class="card-footer">
         <button type="submit" class="btn btn-warning" name="btnsave">Save</button>
         </div>

         </div>';
    }
}
function query_car_price()
{
    $select = query("SELECT * from tbl_car_price order by id_cr_price ASC");
    confirm($select);

    while ($row = $select->fetch_object()) {
        echo '
        <tr>
        <td>' . $row->id_cr_price . '</td>
        <td>' . $row->tit_price . '</td>
        <td>' . $row->price . '</td>
        <td>
        <button type="submit" class="btn btn-primary" value="' . $row->id_cr_price . '" name="btnedit">Edit</button>
        </td>
        <td>
        <button type="submit" class="btn btn-danger" value="' . $row->id_cr_price . '" name="btndelete">Delete</button>
       </td>
      </tr>';
    }
}


////////////////////////////////////////////////////////////////////////////////////////////////

function insert_update_delete_Classroom()
{
    if (isset($_POST['btnsave'])) {

        $category = $_POST['txtcategory'];
        $id_branch = branch_id();
        if (empty($category)) {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Classroom time Feild is Empty"
            });
           </script>');
            redirect('itemt?Classroom');
        } else {

            $insert = query("INSERT into tbl_classroom (cr_name,id_branch) values('{$category}','{$id_branch}')");
            confirm($insert);
            if ($insert) {
                set_message(' <script>
                Swal.fire({
                icon: "success",
                title: "Classroom time Added successfully"
                });
               </script>');
                redirect('itemt?Classroom');
            } else {
                set_message(' <script>
                Swal.fire({
                icon: "warning",
                title: "Classroom time Added Failed"
                });
               </script>');
                redirect('itemt?Classroom');
            }
        }
    }



    if (isset($_POST['btnupdate'])) {

        $category = $_POST['txtcategory'];
        $id = $_POST['txtcatid'];

        if (empty($category)) {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Classroom time Feild is Empty"
            });
           </script>');
            redirect('itemt?Classroom');
        } else {

            $update = query("UPDATE tbl_classroom set cr_name='$category' where cr_id=" . $id);
            confirm($update);

            if ($update) {
                set_message(' <script>
                Swal.fire({
                icon: "success",
                title: "Classroom time Update successfully"
                });
               </script>');
                redirect('itemt?Classroom');
            } else {
                set_message(' <script>
                Swal.fire({
                icon: "warning",
                title: "Classroom time Update Failed"
                });
               </script>');
                redirect('itemt?Classroom');
            }
        }
    }


    if (isset($_POST['btndelete'])) {

        $delete = query("DELETE from tbl_classroom where cr_id=" . $_POST['btndelete']);
        confirm($delete);
        if ($delete) {
            set_message(' <script>
            Swal.fire({
            icon: "success",
            title: "Deleted"
            });
           </script>');
            redirect('itemt?Classroom');
        } else {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Delete Failed"
            });
           </script>');
            redirect('itemt?Classroom');
        }
    } else {
    }
}




// ///////////////////////////////////////////



function insert_update_delete_Branch_Name()
{
    if (isset($_POST['btnsave'])) {

        $category = $_POST['txtcategory'];

        if (empty($category)) {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Branch Feild is Empty"
            });
           </script>');
            redirect('itemt?branch');
        } else {

            $insert = query("INSERT into tbl_branch (branch_name) values('{$category}')");
            confirm($insert);
            if ($insert) {
                set_message(' <script>
                Swal.fire({
                icon: "success",
                title: "Branch Added successfully"
                });
               </script>');
                redirect('itemt?branch');
            } else {
                set_message(' <script>
                Swal.fire({
                icon: "warning",
                title: "Branch Added Failed"
                });
               </script>');
                redirect('itemt?branch');
            }
        }
    }



    if (isset($_POST['btnupdate'])) {

        $category = $_POST['txtcategory'];
        $id = $_POST['txtcatid'];

        if (empty($category)) {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Branch Feild is Empty"
            });
           </script>');
            redirect('itemt?branch');
        } else {

            $update = query("UPDATE tbl_branch set branch_name='$category' where id=" . $id);
            confirm($update);

            if ($update) {
                set_message(' <script>
                Swal.fire({
                icon: "success",
                title: "Branch Update successfully"
                });
               </script>');
                redirect('itemt?branch');
            } else {
                set_message(' <script>
                Swal.fire({
                icon: "warning",
                title: "Branch Update Failed"
                });
               </script>');
                redirect('itemt?branch');
            }
        }
    }


    if (isset($_POST['btndelete'])) {

        $delete = query("DELETE from tbl_branch where id=" . $_POST['btndelete']);
        confirm($delete);
        if ($delete) {
            set_message(' <script>
            Swal.fire({
            icon: "success",
            title: "Deleted"
            });
           </script>');
            redirect('itemt?branch');
        } else {
            set_message(' <script>
            Swal.fire({
            icon: "warning",
            title: "Delete Failed"
            });
           </script>');
            redirect('itemt?branch');
        }
    } else {
    }
}





function edit_Classroom()
{
    if (isset($_POST['btnedit'])) {

        $select = query("SELECT * from tbl_classroom where cr_id =" . $_POST['btnedit']);
        confirm($select);

        if ($select) {
            $row = $select->fetch_object();

            echo '<div class="col-md-4">

                <div class="form-group">
               <label for="exampleInputEmail1">Category</label>

               <input type="hidden" class="form-control" placeholder="Enter Category"  value="' . $row->cr_id . '" name="txtcatid" >

               <input type="text" class="form-control" placeholder="Enter Category"  value="' . $row->cr_name     . '" name="txtcategory" >
               </div>


               <div class="card-footer">
               <button type="submit" class="btn btn-info" name="btnupdate">Update</button>
               </div>
               </div>';
        }
    } else {

        echo '<div class="col-md-4">

         <div class="form-group">
         <label for="exampleInputEmail1">Category</label>
         <input type="text" class="form-control" placeholder="Enter Category"  name="txtcategory" >
         </div>
         <div class="card-footer">
         <button type="submit" class="btn btn-warning" name="btnsave">Save</button>
         </div>

         </div>';
    }
}





function edit_branch()
{
    if (isset($_POST['btnedit'])) {

        $select = query("SELECT * from tbl_branch where id =" . $_POST['btnedit']);
        confirm($select);

        if ($select) {
            $row = $select->fetch_object();

            echo '<div class="col-md-4">

                <div class="form-group">
               <label for="exampleInputEmail1">ឈ្មោះសាខា</label>

               <input type="hidden" class="form-control" placeholder="Enter Category"  value="' . $row->id . '" name="txtcatid" >

               <input type="text" class="form-control" placeholder="Enter Category"  value="' . $row->branch_name  . '" name="txtcategory" >
               </div>


               <div class="card-footer">
               <button type="submit" class="btn btn-info" name="btnupdate">Update</button>
               </div>
               </div>';
        }
    } else {

        echo '<div class="col-md-4">

         <div class="form-group">
         <label for="exampleInputEmail1">ឈ្មោះសាខា</label>
         <input type="text" class="form-control" placeholder="Enter Category"  name="txtcategory" >
         </div>
         <div class="card-footer">
         <button type="submit" class="btn btn-warning" name="btnsave">Save</button>
         </div>

         </div>';
    }
}



function query_Classroom()
{
    $id_branch = branch_id();
    $select = query("SELECT * from tbl_classroom where id_branch= $id_branch order by cr_id ASC");
    confirm($select);

    while ($row = $select->fetch_object()) {
        echo '
        <tr>
        <td>' . $row->cr_id . '</td>
        <td>' . $row->cr_name . '</td>
        <td>
        <button type="submit" class="btn btn-primary" value="' . $row->cr_id . '" name="btnedit">Edit</button>
        </td>
        <td>
        <button type="submit" class="btn btn-danger" value="' . $row->cr_id . '" name="btndelete">Delete</button>
       </td>
      </tr>';
    }
}





function query_branch()
{
    $select = query("SELECT * from tbl_branch order by id ASC");
    confirm($select);

    while ($row = $select->fetch_object()) {
        echo '
        <tr>
        <td>' . $row->id . '</td>
        <td>' . $row->branch_name . '</td>
        <td>
        <button type="submit" class="btn btn-primary" value="' . $row->id . '" name="btnedit">Edit</button>
        </td>
        <td>
        <button type="submit" class="btn btn-danger" value="' . $row->id . '" name="btndelete">Delete</button>
       </td>
      </tr>';
    }
}

///////////////////////////////////////////////////





function branch()
{
    $query = query("SELECT * FROM tbl_branch");
    confirm($query);
    $moviss = '';
    while ($row = fetch_array($query)) {
        $id = $row['id'];
        $branch_name = $row['branch_name'];

        $moviss .= '
        <div class="col-md-2">
        <button id =' . $id . ' class="btn btn-success chang_branch">' . $branch_name . '</button>
        </div>
        
        ';
    }


    echo $moviss;
}


function branch_id()
{
    if (isset($_SESSION['userid'])) {
        $id = $_SESSION['userid'];
        $query =  query("SELECT * FROM tbl_user WHERE user_id =  $id ");
        confirm($query);
        $row = $query->fetch_assoc();
        $id_branch = $row['id_branch'];
    }
    return  $id_branch;
}
function show_branch_name($id)
{
    $query =  query("SELECT * FROM tbl_branch WHERE id =  $id ");
    confirm($query);
    $row = $query->fetch_assoc();
    $id_branch = $row['branch_name'];

    return  $id_branch;
}

function showtime_x($sdi_id){
    $select = query("SELECT * from tbl_studytime where sdi_id=$sdi_id");
    confirm($select);
    $row = $select->fetch_assoc();

    return $time = $row['qty'];
}


function timeago($date, $tense = 'ago')
{
    date_default_timezone_set("asia/phnom_penh");
    $time = date($date);
    static $periods = array('year', 'month', 'day', 'hour', 'minute', 'second');
    if (!(strtotime($time) > 0)) {
        return trigger_error("wrong time format: '$time'", E_USER_ERROR);
    }
    $now = new DateTime('now', new DateTimeZone('Asia/bangkok'));
    $time = new DateTime($time);
    $diff = $now->diff($time)->format('%y %m %d %h %i %s');
    $diff = explode(' ', $diff);
    $diff = array_combine($periods, $diff);
    $diff = array_filter($diff);

    $period = key($diff);
    $value = current($diff);
    if (!$value) {
        $period = '';
        $tense = '';
        $value = 'just now';
    } else {
        if ($period == 'day' && $value >= 7) {
            $period = 'week';
            $value = floor($value / 7);
        }
        if ($value > 1) {
            $period .= 's';
        }
    }
    return "$value $period $tense";
}


function show_online()
{
    $id = $_SESSION['userid'];
    $time = new DateTime('now', new DateTimeZone('Asia/bangkok'));
    $datee =  $time->format('Y-m-d H:i:s');
    $time = time();
    $select = query("SELECT * from tbl_user WHERE user_id =  $id ");
    confirm($select);

    while ($row = $select->fetch_assoc()) {

        $date = date($row['last_login']);
        $timeago = timeago($date);
        $status = $timeago;
        $class = "text-danger";

        if ($row['login_online'] > $time) {
            $status = 'Online';
            $class = "text-success";
        }
        echo $status;
    }
}

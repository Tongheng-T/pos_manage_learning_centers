<?php

require_once("../../config.php");

if (isset($_POST['date'])) {
    $datee = $_POST['date'];
    $date = date('Y-m-d', strtotime($datee));
    $_SESSION['dated'] = $date;
} else {
    $date = date('Y-m-d');
    $_SESSION['dated'] = $date;
}

$result = explode('-', $date);
$month = $result[1];
$year = $result[0];

$new = $year . '-' . $month;

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query_pay = query("SELECT * FROM tbl_employee_teacher WHERE tc_id = $id and date like '{$new}%' ");
    $query = query("SELECT * FROM tbl_teacher WHERE tc_id = $id");
    confirm($query);

    while ($row = fetch_array($query)) {
        $id = $row['tc_id'];
        $namekh = $row['tc_namekh'];
        $nameen = $row['tc_nameen'];
        $sex = $row['tc_sex'];
        $db = $row['tc_db'];
        $datedb = date('d-m-Y', strtotime($db));
        $phone = $row['tc_phone'];
        $subject_id = $row['tc_subjects_id'];

        $salary = $row['tc_salary'];

        $img = $row['tc_img'];
        $date_of_enrollment = $row['tc_date_of_employment'];
        $date_of = date('d-m-Y', strtotime($date_of_enrollment));
    }

    if (mysqli_num_rows($query_pay) > 0) {
        $total = 0;
        $money = 0;
        while ($row = fetch_array($query_pay)) {
            $dbe_date = $row['date'];
            $money +=  $row['money'];
            $total = $salary - $money;
            
        }

        if ($total == 0) {
            $text = 'បានបើករួច';
        } else {
            $text = 'ធ្លប់បើកចំនូន: ' . $money;
        }
        
    } else {
        $total = $salary;
        
        $text = '';
    }
}

function show_datepay($id,$new){
    $datedbe = '';
    $query_pay = query("SELECT * FROM tbl_employee_teacher WHERE tc_id = $id and date like '{$new}%' ");
    while ($row = fetch_array($query_pay)) {
        $money =  $row['money'];
        $dbe_date = $row['date'];
        echo $datedbe = '<h6> នៅថ្ងៃ: '. date('d-m-Y', strtotime($dbe_date)). ' ចំនួន '.$money.' </h6>';
        
    }
}

?>


<div class="card card-warning ">

    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label>ឈ្មោះជាភាសាខ្មែរ</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល ឈ្មោះជាភាសាខ្មែរ" name="txtnamekh" value="<?php echo $namekh; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>ថ្ងៃខែឆ្នាំកំណើត</label>
                        <div class="input-group date" id="date_1_edit" data-target-input="nearest">
                            <input type="text" class="form-control date_1_edit" data-target="#date_1_edit" name="txtdb" value="<?php echo $datedb; ?>" readonly>
                            <div class="input-group-append" data-target="#date_1_edit" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>មុខវិជ្ជា</label>
                        <?php
                        $select = query("SELECT * from tbl_subject");
                        confirm($select);

                        while ($row = $select->fetch_assoc()) {
                            if ($row['sj_id'] == $subject_id) {
                                $show = $row['sj_name'];
                            }
                        }
                        ?>
                        <input type="text" class="form-control" name="txtsubject" value="<?php echo $show; ?>" readonly>

                    </div>
                    <div class="form-group">
                        <label>ថ្ងៃខែចូលធ្វើការ</label>
                        <div class="input-group date" id="date_2_edit" data-target-input="nearest">
                            <input type="text" class="form-control date_2_edit" data-target="#date_2_edit" name="txt_date_of_employment" value="<?php echo $date_of; ?>" readonly>
                            <div class="input-group-append" data-target="#date_2_edit" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="col-md-4">

                    <div class="form-group">
                        <label>ឈ្មោះជាអក្សរឡាតាំង</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល ឈ្មោះជាអក្សរឡាតាំង" name="txtnameen" value="<?php echo $nameen; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>លេខទូរសព្ទ</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល លេខទូរសព្ទ" name="txtphone" required value="<?php echo $phone; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>ប្រាក់ខែ</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល ប្រាក់ខែ" name="txt_salary" value="<?php echo $salary; ?>" readonly>
                    </div>

                </div>


                <div class="col-md-4" style="border-left: 1px solid rgb(221 41 41 / 49%)">

                    <div class="form-group">
                        <label>ថ្ងៃខែឆ្នាំបើក</label>
                        <div class="input-group date" id="date_2" data-target-input="nearest">
                            <input type="text" class="form-control date_2" data-target="#date_2" id="datee" name="txtdatesalary" value="<?php echo date('d-m-Y', strtotime($_SESSION['dated'])); ?>">
                            <div class="input-group-append" data-target="#date_2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>ប្រាក់ត្រូវបើក: <?php echo $text; ?> </label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល ប្រាក់ខែ" name="txt_salary" id="txt_salary" value="<?php echo $total; ?>" autocomplete="off">
                    </div>

                    <buttone type="text" class="btn btn-danger sd ">ស្វែងរក​</buttone>
                    <div class="input-group date" id="date_2" data-target-input="nearest">

                    </div>
                    <br>

                     <?php show_datepay($id,$new); ?>

                </div>


            </div>
        </div>

        <div class="card-footer">
            <div class="text-center">
                <button type="submit" class="btn btn-danger id" name="submit" value="<?php echo $id; ?>">Save</button>
            </div>
        </div>

    </form>

</div>

<script>
    $(function() {

        $('.sd').on('click', function() {

            var date = $('.date_2').val();
            var id = $('.id').val();
            $.ajax({
                url: "../resources/templates/back/Payroll_pay.php",
                method: "Post",
                data: {
                    date: date,
                    id: id
                },
                success: function(data) {

                    $('#payroll').html(data);
                    $('#payroll').append(data.htmlresponse);

                }
            });
        });
    });




    //Date picker
    $('#date_2').datetimepicker({
        format: 'DD-MM-YYYY'
    });
</script>
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
$datenow = $_SESSION['dated'];
$result = explode('-', $date);
$month = $result[1];
$year = $result[0];



if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = query("SELECT * FROM tbl_students WHERE sd_id = $id");
    confirm($query);

    while ($row = fetch_array($query)) {
        $id = $row['sd_id'];
        $namekh = $row['sd_namekh'];
        $nameen = $row['sd_nameen'];
        $sex = $row['sd_sex'];
        $db = $row['sd_db'];
        $datedb = date('d-m-Y', strtotime($db));
        $phone = $row['sd_phone'];
        $subject_id = $row['sd_subject_id'];
        $sd_studytime = $row['sd_studytime'];

        $salary = show_price($row['sd_subject_id'], $id);


        $img = $row['sd_img'];
        $date_of_enrollment = $row['sd_date_of_enrollment'];
        $date_of = date('d-m-Y', strtotime($date_of_enrollment));
    }

    if($sd_studytime=='years'){
        $new = $year;
    }else{
        $new = $year . '-' . $month;
    }
    $query_pay = query("SELECT * FROM tbl_employee_students WHERE sd_id = $id and date like '{$new}%' ");
    if (mysqli_num_rows($query_pay) > 0) {

        $total = 0;
        $money = 0;
        while ($row = fetch_array($query_pay)) {
            $dbe_date = $row['date'];
            $money +=  $row['money'];
            $total = $salary - $money;
        }

        if ($total == 0) {
            $text = 'បានបង់រួច';
        } else {
            $text = 'ធ្លប់បង់ចំនួន: ' . $money;
        }
    } else {
        $total = $salary;
        $text = '';
    }

    $query_cddate = query("SELECT * FROM tbl_employee_students WHERE sd_id = $id ");

    if (mysqli_num_rows($query_cddate) > 0) {
        $query_date = query("SELECT date,MAX(date) as max_date FROM tbl_employee_students WHERE sd_id = $id  ");
        $roww = $query_date->fetch_assoc();
        $count_datee = $roww['max_date'];
    } else {
        $count_datee = $date_of_enrollment;
    }
}

function show_datepay($id, $new)
{
    $datedbe = '';
    $query_pay = query("SELECT * FROM tbl_employee_students WHERE sd_id = $id and date like '{$new}%' ");
    while ($row = fetch_array($query_pay)) {
        $money =  $row['money'];
        $dbe_date = $row['date'];
        $numdate = $row['numdate'];
        echo $datedbe = '<h6>ថ្ងៃ: ' . date('d-m-Y', strtotime($dbe_date)) . ' ចំនួន $' . $money . ' : ' . $numdate . 'ថ្ងៃ </h6>';
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
                        <label>ថ្ងៃខែចូលរៀន</label>
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
                        <label>រៀនជា: ខែ/ឆ្នាំ</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល លេខទូរសព្ទ" name="txtphone" required value="<?php echo $sd_studytime; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>តម្លៃសិក្សារ</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល ប្រាក់ខែ" name="txt_salary" value="<?php echo $salary; ?>" readonly>
                    </div>


                    <div class="form-group">
                        <label>ចំនួនថ្ងៃ</label><br>
                        <?php echo date('d-m-Y', strtotime($count_datee)) . ' ដល់ ' . date('d-m-Y', strtotime($datenow)); ?>
                        <br>
                        <?php
                        $datetime1 = new DateTime($count_datee);
                        $datetime2 = new DateTime($datenow);
                        $interval = $datetime1->diff($datetime2);
                        echo $interval->format('%a days'); ?>
                        <input type="hidden" name="txt_numdate" value="<?php echo $interval->format('%a'); ?>">
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
                        <label>ប្រាក់ត្រូវបង់: <?php echo $text; ?> </label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល ប្រាក់ខែ" name="txt_salary" id="txt_salary" value="<?php echo $total; ?>" autocomplete="off">
                    </div>

                    <buttone type="text" class="btn btn-danger sd ">ស្វែងរក​</buttone>
                    <div class="input-group date" id="date_2" data-target-input="nearest">

                    </div>
                    <br>

                    <?php show_datepay($id, $new); ?>

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
                url: "../resources/templates/back/Payroll_pay_tudents.php",
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
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
$neww = $year . '-' . $month;
$new = $year;



if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $debt_tit = '';
    $ggg = 0;
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
        $debt = $row['debt'];

        // $salary = show_price($row['sd_subject_id'], $id,$row['sd_time_id']);
        $salary =  $row['txtprice'];

        $img = $row['sd_img'];
        $date_of_enrollment = $row['sd_date_of_enrollment'];
        $date_of = date('d-m-Y', strtotime($date_of_enrollment));
    }


    $query_pay = query("SELECT * FROM tbl_employee_students WHERE sd_id = $id ");


    if (mysqli_num_rows($query_pay) == 0) {
        $total_order = $date = date('m-d');
    } elseif ($sd_studytime == 'years') {
        $roww = $query_pay->fetch_array();
        $newdate = $roww['date_new'];
        $total_order = $roww['date_new'];
    } elseif ($sd_studytime == '6month') {
        $roww = $query_pay->fetch_array();
        $newdate = $roww['date_new'];
        $total_order = $roww['date_new'];
    } else {
        $roww = $query_pay->fetch_array();
        $total_order = $roww['date'];
        $newdate = $roww['date_new'];
    }
    // if ($sd_studytime == 'years') {
    //     $new = $year . '-' . $month;
    //     $new_mont = date('Y-m-d', strtotime('+12 month', strtotime($total_order)));
    // } else {
    

    // }
    $result = explode('-', $total_order);
    $monthh = $result[1];
    $yearr = $result[0];
    $total_orderfc = $yearr . '-' . $monthh;
    $new_mont = '';
    $rr = time();

    // $query_pay = query("SELECT * FROM tbl_employee_students WHERE sd_id = $id and date like '{$new}%' OR date_new like '{$new}%'");
    if ($total_orderfc >= $neww) {


        $new_mont = 'ថ្ងៃបង់ម្ដងទៀត ' . date('d-m-Y', strtotime($newdate));

        $total = 0;
        $debtt = $debt;
        $total = $debtt;
        $debt_tit = 'នៅខ្វះ' . $debt;
        $ggg =  $debt;
    } else {
        if ($debt > 0) {
            $debtt = $debt;
            $debt_tit = 'ខ្វះខែមុន' . $debt;
        } else {

            $debtt = 0;
        }
        $ggg = $salary + $debt;
        $total = $salary + $debtt;
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

    $query_pay = query("SELECT * FROM tbl_employee_students WHERE sd_id = $id and date like '{$new}%'  order by sdpay_id DESC");
    while ($row = fetch_array($query_pay)) {
        $money =  $row['money'];
        $dbe_date = $row['date'];
        $numdate = $row['numdate'];
        echo $datedbe = '<h6>ថ្ងៃ: ' . date('d-m-Y', strtotime($dbe_date)) . ' ចំនួន ' . number_format($money) . '៛ : ' . $numdate . 'ថ្ងៃ </h6>';
    }
    
}






?>


<div class="card card-warning ">

    <form action="" method="POST" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" placeholder="បញ្ចូល លេខទូរសព្ទ" name="txtstudytime" required value="<?php echo $sd_studytime; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>តម្លៃសិក្សារ</label>
                        <input type="text" class="form-control txt_salary" placeholder="បញ្ចូល ប្រាក់ខែ" name="txt_salary" value="<?php echo $salary; ?>" readonly>
                        <input type="hidden" class="form-control txt_salaryr" placeholder="បញ្ចូល ប្រាក់ខែ" name="txt_salaryr" value="<?php echo $ggg; ?>">
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


                <div class="col-md-4" style="border-left: 1px solid rgb(221 41 41 / 49%);height: 378px;overflow: auto;">

                    <div class="form-group">
                        <label>ថ្ងៃខែឆ្នាំបង់</label>
                        <div class="input-group date" id="date_2" data-target-input="nearest">
                            <input type="text" class="form-control date_2" data-target="#date_2" id="datee" name="txtdatesalary" value="<?php echo date('d-m-Y', strtotime($_SESSION['dated'])); ?>">
                            <div class="input-group-append" data-target="#date_2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>ប្រាក់ត្រូវបង់: </label>
                        <input type="text" class="form-control txt_salaryy" placeholder="បញ្ចូល ប្រាក់ខែ" name="txt_salaryy" onkeyup="mult(this.value)" value="<?php echo $total; ?>" autocomplete="off">
                        <label><?php echo $debt_tit; ?></label>
                        <label><?php echo  $new_mont; ?></label>
                    </div>
                    <div class="form-group">
                        <label>ប្រាក់ជំពាក់: </label>
                        <input type="text" class="form-control txt_salarys" placeholder="បញ្ចូល ប្រាក់ខែ" name="txt_jompeak" id="txt_salarys" autocomplete="off">


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
    </form>
    <form action="" method="GET" enctype="multipart/form-data">
        <a href="invoice_80mm.php?id=<?php echo $id; ?>" class="btn btn-success " target="_blank" role="button"><span class="fa fa-print"></span> Print</a>
    </form>
</div>
</div>



</div>

<script>
    function mult(value) {
        var productid = $(".txt_salaryr").val();
        var x = productid - value;
        document.getElementById('txt_salarys').value = x;

    }


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
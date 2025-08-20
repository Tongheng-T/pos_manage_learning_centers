<?php require_once("../resources/config.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="../dist/css/print80mmm.css">

    <title>RECEIPT : <?php show_customer_name(); ?></title>
</head>

<style>
    .d-inline {
        display: inline !important;
    }

    .namee {
        display: inline !important;
    }

    [class*=icheck-]>label {

        line-height: 27px;
    }

    [class*=icheck-]>input:first-child+input[type=hidden]+label::before,
    [class*=icheck-]>input:first-child+label::before {
        width: 12px;
        height: 12px;
        margin-top: 5px;
    }

    [class*=icheck-]>input:first-child:checked+input[type=hidden]+label::after,
    [class*=icheck-]>input:first-child:checked+label::after {
        content: "";
        display: inline-block;
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 10px;
        border: 2px solid #fff;
        border-left: none;
        border-top: none;
        transform: translate(4.75px, 4.5px) rotate(45deg);
        -ms-transform: translate(7.75px, 4.5px) rotate(45deg)
    }

    [class*=icheck-]>input:first-child:checked+input[type=hidden]+label::after,
    [class*=icheck-]>input:first-child:checked+label::after {
        content: "";
        display: inline-block;
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 10px;
        border: 2px solid #0074d7;
        border-left: none;
        border-top: none;
        transform: translate(4.75px, 4.5px) rotate(45deg);
        -ms-transform: translate(7.75px, 4.5px) rotate(45deg);
    }

    [class*=icheck-]>input:first-child+input[type=hidden]+label::before,
    [class*=icheck-]>input:first-child+label::before {

        border: 1px solid #002060;

    }


    .icheck-primary>input:first-child:checked+input[type=hidden]+label::before,
    .icheck-primary>input:first-child:checked+label::before {
        background-color: rgb(255, 255, 255);
        border-color: #2e6da4
    }

    .icheck-danger>input:first-child:checked+input[type=hidden]+label::before,
    .icheck-danger>input:first-child:checked+label::before {
        background-color: rgb(255, 255, 255);
        border-color: #d43f3a
    }

    [class*=icheck-]>input:first-child+input[type=hidden]+label::before,
    [class*=icheck-]>input:first-child+label::before {

        margin-left: -16px;
    }

    [class*=icheck-]>label {
        padding-left: 16px !important;
    }
</style>
<?php


function show_pat($id)
{
    $query =  query("SELECT * from tbl_employee_students WHERE sd_id = $id");
    confirm($query);

    while ($row = $query->fetch_object()) {

        $date = $row->date;
    }
    return $date;
}




$id = $_GET['id'];
$select = query("SELECT * from tbl_employee_students where  sd_id =$id");
confirm($select);

while ($row = $select->fetch_object()) {

    $date = $row->date;
    $sdpay_id = $row->sdpay_id;

    $datee = date('d-m-Y', strtotime($date));;
    $result = explode('-', $datee);
    $day = $result[0];
    $month = $result[1];
    $year = $result[2];
    $new = $year . '-' . $month;
    $query_pay = query("SELECT sum(money) AS moneyy  FROM tbl_employee_students WHERE sd_id = $id and date like '{$new}%' ");
    $roww = $query_pay->fetch_object();
    $money = $roww->moneyy;

    $month_kh = convert_month_kh($month);
    $yearkh = convert_number_kh($year);
    $daykh = convert_number_kh($day);

}







function show_customer_name()
{
    $id = $_GET['id'];
    $select = query("SELECT * from tbl_employee_students where sd_id = $id");
    confirm($select);
    $row = $select->fetch_object();
    $order_date = show_pat($id);
    $invoice_id = $row->sdpay_id;
    echo 'N0 ' . $invoice_id . ' _ ' . $order_date;
}






$tbl_setting = query("SELECT * from tbl_setting");
confirm($tbl_setting);
$rowd = $tbl_setting->fetch_object();


$select = query("SELECT * from tbl_students where sd_id =$id");
confirm($select);
while ($item = $select->fetch_object()) {

    $salary = $item->txtprice;
    $sex = $item->sd_sex;
    $sd_namekh = $item->sd_namekh;
    $sd_nameen = $item->sd_nameen;
    $sd_phone = $item->sd_phone;
    $sd_address = $item->sd_address;
    $address = explode(" ", $sd_address);

    $Village = $address[1];
    $commune = $address[3];
    $district = $address[5];
    $province = $address[7];

    $sd_dbb = $item->sd_db;
    $sd_dbb = $item->sd_db;
    $subject = show_subject($item->sd_subject_id);
    $sd_db = date('d-m-Y', strtotime($sd_dbb));

    $sd_time_id = show_studytime($item->sd_time_id);
    // $price_car = $item->sd_car_id;
    $sd_studytime = $item->sd_studytime;
}

?>

<body>
    <div class="ticket">
        <div class="back"> <img src="../productimages/logo/<?php echo  $rowd->logo ?>" alt=""></div>

        <div class="logo">
            <!-- <img src="../productimages/logo/<?php echo  $rowd->logo ?>" alt="Logo" class="img-fluid"> -->
            <img src="../productimages/logo/loloAC.jpg" alt="Logo" class="img-fluid">
            <!-- <h5 class="h5" style="font-size: <?php echo  $rowd->font_RECEIPT ?>px"><?php echo  $rowd->name_receipt ?></h5> -->
        </div>
        <h1 class="tim blul">មានទទួលបណ្តុះបណ្តាលចំណេះដឹងកុំព្យូទ័រ គ្រប់ជំនាញ គ្រប់កម្រិត</h1>

        <!-- <p class="centered">
            <br>Address: <?php echo  $rowd->receipt_Address ?>

            <br>Phone: <?php echo  $rowd->receipt_Phone ?>
            <br>
        </p> 
        <hr> -->
        <!-- <h3 class="RECEIPT">RECEIPT</h3> -->

        <!-- <p class="h_p">INVOICE N0:</p>
        <p class="top_p"><?php echo $sdpay_id ?></p> -->

        <!-- <p class="top_l"><?php echo date('d-m-Y', strtotime($date)) ?></p> -->

        <div class="namee blul">នាមត្រគោល និងនាមខ្លួន..............<b class="bluln"><?php echo $sd_namekh ?></b>.................ឈ្មោះឡាតាំង........<b class="bluln"><?php echo $sd_nameen ?></b>...............ភេទភេទ</div>


        <div class="icheck-primary d-inline blul">
            <input type="checkbox" name="sex" value="ប្រុស" id="checkboxDanger1" <?php echo ($sex == 'ប្រុស') ? 'checked' : '' ?>>
            <label for="checkboxDanger1">
                ប្រុស /
            </label>
        </div>
        <div class="icheck-danger d-inline blul">
            <input type="checkbox" name="sex" value="ស្រី" id="checkboxDanger2" <?php echo ($sex == 'ស្រី') ? 'checked' : '' ?>>
            <label for="checkboxDanger2">
                ស្រី
            </label>
        </div><br>
        <div class="namee blul">លេខទំនាក់ទំនង......<b class="bluln"><?php echo $sd_phone ?></b>..............ថ្ងៃខែឆ្នាំកំណើត.....<b class="bluln"><?php echo $sd_db ?></b>........ទីលំនៅបច្ចុប្បន្ន ភូមិ.....<b class="bluln"><?php echo $Village ?></b>.......</div>
        <div class="namee blul">ឃុំ...<b class="bluln"><?php echo $commune ?></b>....ស្រុក...<b class="bluln"><?php echo $district ?></b>.....ខេត្ត <b class="bluln"><?php echo $province ?></b> ។</div><br>
        <div class="namee blul">-កម្រិតសិក្សា កម្រិតទី១ កម្រិតទី២ កម្រិតទី៣ កម្រិតទី៤ កម្រិតរចនារូបភាព កម្រិតកាត់តវីដេអូ កម្រិតស្រាវជ្រាវ</div><br>
        <div class="namee blul">-ម៉ោងសិក្សា
            <div class="icheck-primary d-inline">
                <input type="checkbox" name="tim" value="8:00-10:00" id="checkboxDanger3" <?php echo ($sd_time_id == '8:00-10:00') ? 'checked' : '' ?>>
                <label for="checkboxDanger3">
                    8:00-10:00<b>ព្រឹក</b>
                </label>
            </div>
            <div class="icheck-primary d-inline">
                <input type="checkbox" name="tim" value="10:00-12:00" id="checkboxDanger4" <?php echo ($sd_time_id == '10:00-12:00') ? 'checked' : '' ?>>
                <label for="checkboxDanger4">
                    10:00-12:00<b>ល្ងាច</b>
                </label>
            </div>
            <div class="icheck-primary d-inline">
                <input type="checkbox" name="tim" value="1:00-3:00" id="checkboxDanger5" <?php echo ($sd_time_id == '1:00-3:00') ? 'checked' : '' ?>>
                <label for="checkboxDanger5">1:00-3:00<b>ល្ងាច</b></label>
            </div>
            <div class="icheck-primary d-inline">
                <input type="checkbox" name="tim" value="3:00-5:00" id="checkboxDanger6" <?php echo ($sd_time_id == '3:00-5:00') ? 'checked' : '' ?>>
                <label for="checkboxDanger6">
                    3:00-5:00<b>ល្ងាច</b>
                </label>
            </div>
            <div class="icheck-primary d-inline">
                <input type="checkbox" name="tim" value="5:00-7:00" id="checkboxDanger7" <?php echo ($sd_time_id == '5:00-7:00') ? 'checked' : '' ?>>
                <label for="checkboxDanger7">
                    5:00-7:00<b>ល្ងាច</b>
                </label>
            </div>


            ( <b class="yellow">ផ្លាស់ប្តូរបាន</b> )
        </div><br>

        <div class="namee blul">តម្លៃសិក្សា......<b class="bluln"><?php echo $salary ?>$</b>......បង់ជាវគ្គ

            <div class="icheck-primary d-inline">
                <input type="checkbox" name="subject" value="Basic Computer" id="checkboxDanger8" <?php echo ($subject == 'Basic Computer') ? 'checked' : '' ?>>
                <label for="checkboxDanger8">
                    <b>វគ្គទី១</b>
                </label>
            </div>
            <div class="icheck-primary d-inline">
                <input type="checkbox" name="subject" value="Woed" id="checkboxDanger9" <?php echo ($subject == 'Woed') ? 'checked' : '' ?>>
                <label for="checkboxDanger9">
                    <b>វគ្គទី២</b>
                </label>
            </div>
            <div class="icheck-primary d-inline">
                <input type="checkbox" name="subject" value="Excel" id="checkboxDanger10" <?php echo ($subject == 'Excel') ? 'checked' : '' ?>>
                <label for="checkboxDanger10">
                    <b>វគ្គទី៣</b>
                </label>
            </div>
            <div class="icheck-primary d-inline">
                <input type="checkbox" name="subject" value="Point" id="checkboxDanger10" <?php echo ($subject == 'Point') ? 'checked' : '' ?>>
                <label for="checkboxDanger10">
                    <b>វគ្គទី៤</b>
                </label>
            </div>

            ថ្ងៃទី..<b class="bluln"><?php echo $day ?></b>..ខែ..<b class="bluln"><?php echo $month_kh ?></b>..ឆ្នាំ<b class="bluln"><?php echo $year ?></b> ។
        </div>
        <div class="namee molight" align="center">
            <h1>បញ្ជាក់៖ ប្រាក់បង់រួចហើយមិនអាចដកវិញបានទេ (IRRETRIEVABLY)</h1>
        </div>
        <div class="namee blul">លេខសម្រាប់ទាក់ទង ៖071 6 777 868 /096 502 9897 (Telegram)</div><br>
        <div class="nameer blul">ទីតាំង៖ ភូមិថ្នល់ ឃុំតំបែរ ស្រុកតំបែរ ខេត្តត្បូងឃ្មុំ ។</div>

        <div class="nameew">
            <div class="nameer blul">ភូមិថ្នល់ ថ្ងៃទី....<b class="bluln"><?php echo $daykh ?></b>.....ខែ...<b class="bluln"><?php echo $month_kh ?></b>...ឆ្នាំ..<b class="bluln"><?php echo $yearkh ?></b>...</div>
            <div class="nameer blul" align="center">
                <h1>អ្នកទទួលប្រាក់</h1>
            </div>
            <div class="signature"><img src="../productimages/logo/<?php echo $rowd->signature ?>"></div>

            <div class="nameerr blul" align="center">
                <b class="molight"> <?php echo $rowd->director ?></b>
            </div>
        </div>





    </div>

    <script>
        window.print();
    </script>

</body>

</html>
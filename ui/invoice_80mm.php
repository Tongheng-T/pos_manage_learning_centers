<?php require_once("../resources/config.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../dist/css/print80mn.css">

    <title>RECEIPT : <?php show_customer_name(); ?></title>
</head>
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
    $month = $result[1];
    $year = $result[2];
    $new = $year . '-' . $month;
    $query_pay = query("SELECT sum(money) AS moneyy  FROM tbl_employee_students WHERE sd_id = $id and date like '{$new}%' ");
    $roww = $query_pay->fetch_object();
    $money = $roww->moneyy;
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


?>

<body>
    <div class="ticket">
        <div class="back"> <img src="../productimages/logo/<?php echo  $rowd->logo ?>" alt=""></div>

        <div class="logo">
            <img src="../productimages/logo/<?php echo  $rowd->logo ?>" alt="Logo" class="img-fluid">
            <h5 class="h5" style="font-size: <?php echo  $rowd->font_RECEIPT ?>px"><?php echo  $rowd->name_receipt ?></h5>
        </div>

        <p class="centered">
            <br>Address: <?php echo  $rowd->receipt_Address ?>
            <br>Email Address: <?php echo  $rowd->receipt_Email ?>
            <!-- <br>fackbook: សហគមន៍កសិកម្មតំបែររុងរឿង -->
            <br>Phone: <?php echo  $rowd->receipt_Phone ?>
            <br>
        </p>
        <hr>
        <h3 class="RECEIPT">RECEIPT</h3>
        </p>
        <p class="h_p">INVOICE N0:</p>
        <p class="top_p"><?php echo $sdpay_id ?></p>

        <p class="h_p">Date:</p>
        <p class="top_l"><?php echo date('d-m-Y', strtotime($date)) ?></p>


        <div class="h_l">ថ្ងៃបង់ប្រាក់ម្តងទៀត:
            <p class="top_l"><?php echo  date('d-m-Y', strtotime('+1 month', strtotime($date))); ?></p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Subject</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select = query("SELECT * from tbl_students where sd_id =$id");
                confirm($select);
                while ($item = $select->fetch_object()) {

                    $salary = $item->txtprice;
                    $price_car = $item->sd_car_id;
                    $sd_studytime = $item->sd_studytime;

                    echo '
                  <tr>
                  <td>' . $item->sd_namekh . '</td>
                  <td>' . $item->sd_sex . '</td>
                  <td>' . show_subject($item->sd_subject_id) . '</td>
                  <td>' . $salary - $price_car . ' <b>៛</b></td>
                 </tr>
                 <tr>
                 <td></td>
                 <td colspan="2">តម្លៃឡាន</td>
                 <td>' . $price_car . ' <b>៛</b></td>
                </tr>
                <tr>
                <td></td>
                <th colspan="2">សរុប</td>
                <th>' . $salary . ' <b>៛</b></th>
               </th>
                 <tr>
                 <td></td>
                 <td colspan="2">ប្រាក់បានបង់</td>
                 <td>' . $money . ' <b>៛</b></td>
                </tr>
                <tr>
                <td></td>
                <td colspan="2">ប្រាក់ជំពាក់</td>
                <td>' . $salary - $money . ' <b>៛</b></td>
               </tr>
                    
                  ';
                }



                ?>


                <tr>
                    <td></td>
                    <th colspan="2">Learn as <?php echo $sd_studytime ?></th>

                </tr>

            </tbody>
        </table>
        <style>
            .signature img {
                width: 100px;
                margin-left: 100px;
                margin-top: -34px;
            }
        </style>
        <b>Importan Notice:</b> <br>
        <p class="notice"><?php echo  $rowd->Importan_Notice ?> </p>
        <p><b>Receiver... លោកគ្រូ <?php echo $rowd->director ?></b></p>
        <div class="signature"><img src="../productimages/logo/<?php echo $rowd->signature ?>"></div>
    </div>

    <script>
        window.print();
    </script>

</body>

</html>
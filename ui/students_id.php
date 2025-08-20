<?php require_once("../resources/config.php"); ?>
<?php check_login();
if ($_SESSION['useremail'] == "" or $_SESSION['role'] == "User") {
  header("Location: ../");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receipt - SaleID : <?php show_customer_name(); ?></title>
  <link rel='shortcut icon' href="../ui/logo/256.ico" type="image/x-icon">
  <link rel="icon" href="../ui/logo/32.ico" sizes="32x32">
  <link rel="icon" href="../ui/logo/48.ico" sizes="48x48">
  <link rel="icon" href="../ui/logo/96.ico" sizes="96x96">
  <link rel="icon" href="../ui/logo/256.ico" sizes="144x144">
  <link type="text/css" rel="stylesheet" href="../dist/css/receiptii.css" media="all">
  <link type="text/css" rel="stylesheet" href="../dist/css/no-printi.css" media="print">
  <!-- <link rel="stylesheet" media="print" href="../dist/css/receipti.css" /> -->
</head>

<body>
  <?php
  $id = $_GET['id'];
  $select = query("SELECT * from tbl_students where sd_id =$id");
  confirm($select);
  $row = $select->fetch_object();
  $dd = $row->sd_db;
  $sd_namekh = $row->sd_namekh;
  $sd_img = $row->sd_img;


  $tbl_setting = query("SELECT * from tbl_setting");
  confirm($tbl_setting);
  $rowd = $tbl_setting->fetch_object();


  function show_customer_name()
  {
    $id = $_GET['id'];
    $select = query("select * from tbl_students where sd_id = $id");
    confirm($select);
    $row = $select->fetch_object();
    $sd_namekh = $row->sd_namekh;
    $sd_db = $row->sd_db;
    echo  $sd_namekh . ' _ ' . $sd_db;
  }

  $tbl_setting = query("SELECT * from tbl_setting_id");
  confirm($tbl_setting);
  $rowdd = $tbl_setting->fetch_object();
  ?>

  <div id="wrapper">
    <div class="dowjpg">


      <div class="top_ba">
        <div class="top_nisome">
          <div class="img"><img src="../productimages/logo/<?php echo  $rowd->logo ?>" alt=""></div>
          <h3 class="hsdkh" style="font-size: <?php echo  $rowdd->fone_id_kh ?>px"><?php echo $rowd->name_receipt ?></h3>
          <h3 class="hsden" style="font-size: <?php echo  $rowdd->fone_id_en ?>px"><?php echo $rowd->name_receipt_en ?></h3>
        </div>
      </div>

      <div class="name">
        <h2 class="students" style="font-size: <?php echo  $rowdd->students ?>px">សិស្ស</h2>
        <h2 class="Stud">ID HSD 00<?php echo $id ?></h2>
        <h2 class="st_name_img"><img src="../productimages/students/<?php echo $sd_img ?>" alt=""></h2>

        <h2 class="st_name"><?php echo $sd_namekh ?></h2>
        <h2 class="qr"><img src="<?php qr(); ?>" alt="">ss</h2>


      </div>



      <div id="receipt-footer">
        <h2 class="footercad">អាសយដ្ឋានៈ <?php echo $rowd->receipt_Address ?> <br>
          ទូរស័ព្ទៈ <?php echo $rowd->receipt_Phone ?>
        </h2>
      </div>

    </div>

    <div id="buttons">
      <a href="itemt?tudentslist">
        <button class="btn btn-back">
          Back to Cashier
        </button>
      </a>
      <button class="btn btn-print" type="button" id="dw_bt">Download Image</button>
    </div>
  </div>
  <script src="dom-to-image.js"></script>

  <script>
    var ti = document.getElementsByClassName("dowjpg")[0];
    var ddd = document.getElementById("dw_bt");

    ddd.addEventListener("click", () => {
      domtoimage.toJpeg(ti).then((data) => {
        var link = document.createElement("a");
        link.download = "<?php show_customer_name() ?>.jpg";
        link.href = data;
        link.click();
      })
    })
  </script>
</body>

</html>

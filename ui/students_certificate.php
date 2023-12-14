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
  <!-- <link type="text/css" rel="stylesheet" href="../dist/css/receipti.css" media="all"> -->
  <link type="text/css" rel="stylesheet" href="../dist/css/style_certificatee.css" media="all">
  <link type="text/css" rel="stylesheet" href="../dist/css/no-printv.css" media="print">
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

  $date_y = date('Y', strtotime($dd));
  $date_d = date('d', strtotime($dd));
  $day_ykh = convert_number_kh($date_y);
  $day_dkh = convert_number_kh($date_d);

  $mon_kh = convert_date($dd);

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

  ?>


  <div class="containerr">
    <div class="dowjpg">
      <div class="top-form">
        <img src="../productimages/certificate/1.jpg" alt="">
        <div class="top-namelogo"><img src="../productimages/logo/<?php echo $rowd->logo ?>" alt=""></div>
        <div class="name_khmer"><?php echo $rowd->name_receipt ?>
        </div>
        <div class="name_english "><?php echo $rowd->name_receipt_en ?>
        </div>
        <div class="gender">&'
        </div>
        <div class="Status">វិញ្ញាបនបត្របញ្ជប់ការសិក្សា
        </div>
        <div class="ID_number">CERTIFICATE OF COMPLETETION
        </div>
        <div class="location">មជ្ឈមណ្ឌលសិក្សា ពត៌មានវិទ្យា(I.T.L.C.) សូមបញ្ជាក់ថា ៖
        </div>

        <div class="number">សិស្សឈ្មោះ៖ &nbsp;<p class="name_MoulLight"><?php echo $sd_namekh ?></p> &nbsp; ភេទ៖ &nbsp; <p class="name_MoulLight"><?php echo $row->sd_sex ?></p>
        </div>

        <div class="titil_left">ថ្ងៃខែឆ្នាំកំណើត៖ &nbsp; <p class="name_MoulLight"><?php echo "ថ្ងៃទី " . $day_dkh . " ខែ " . $mon_kh . " ឆ្នាំ " . $day_ykh ?></p>
        </div>

        <div class="date">ពិតជាបានបញ្ចប់ការសិក្សាដោយជោគជ័យនូវជំនាញកុំព្យូទ័រវគ្គ <?php echo show_subject($row->sd_subject_id) ?> នៅមជ្ឈមណ្ឌលសិក្សា ពត៌មានវិទ្យា នុងឆ្នាំសិក្សា ២០២២-២០២៣</div>
        <div class="date_k">នាយកសាលា</div>
        <div class="traimg"><img src="../productimages/logo/l2.png"></div>
        <div class="signature"><img src="../productimages/logo/signature.png"></div>
        <div class="name_dir">ខុម បញ្ញា</div>


        <!-- <div class="imgg"><img src="../productimages/students/<?php echo $sd_img ?>" alt=""></div> -->



        <div class="_date_k">ថ្ងៃអាទិត្យ ៩ រោច ខែភទ្របទ ឆ្នាំថោះបញ្ចស័ក ពុទ្ធសករាជ ២៥៦៧
          ភូមិស្ទឹងអង្កាញ់,ថ្ងៃទី៨ ខែតុលា ឆ្នាំ២០២៣

        </div>
        <!-- =============================================== -->

        <div class="top-titil">ព្រះរាជាណាចក្រកម្ពុជា</div>
        <div class="titil_right">KINGDOM OF CAMBODIA</div>
        <div class="Generation"> ជាតិ សាសនា ព្រះមហាក្សត្រ</div>

        <div class="Start_date">NATIONAL RELIGION KING</div>

        <div class="finish_date">&'
        </div>
        <!-- <div class="at">នៅ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p>{$row['att']}</p> -->
      </div>
      <!-- <div class="_date">ក្នុងឆ្នាំសិក្សា ២០២២-២០២៣ -->
    </div>


  </div>




  <div id="buttons">
    <a href="itemt?tudentslist">
      <button class="btn btn-back">
        Back to Cashier
      </button>
    </a>
    <button class="btn btn-print" type="button" id="dw_bt">Download Image</button>

    <button class="btn btn-print" type="button" onclick="window.print(); return false;">
      Print
    </button>
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
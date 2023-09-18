<?php require_once ("../resources/config.php"); ?>
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
  <link type="text/css" rel="stylesheet" href="../dist/css/teacherr.css" media="all">
  <link type="text/css" rel="stylesheet" href="../dist/css/no-printi.css" media="print">

  <link rel="stylesheet" media="print" href="../dist/css/receipti.css" />
</head>

<body>
  <?php
  $id = $_GET['id'];
  $select = query("SELECT * from tbl_teacher where tc_id =$id");
  confirm($select);
  $row = $select->fetch_object();
  $dd = $row->tc_db;
  $sd_namekh = $row->tc_namekh;
  $sd_img = $row->tc_img;

  function show_customer_name()
  {
    $id = $_GET['id'];
    $select = query("select * from tbl_teacher where tc_id = $id");
    confirm($select);
    $row = $select->fetch_object();
    $tc_namekh = $row->tc_namekh;
    $tc_db = $row->tc_db;
    echo  $tc_namekh . ' _ ' . $tc_db;
  }

  ?>

  <div id="wrapper">
    <div class="dowjpg">


      <div class="top_ba">
        <div class="top_nisome">
          <div class="img"><img src="../dist/img/c.png" alt=""></div>
          <h3 class="hsdkh">វិទ្យាល័យហ៊ុនសែនតំបែរ</h3>
          <h3 class="hsden">Hun Sen Dambae High School</h3>
        </div>
      </div>

      <div class="name">
        <h2 class="students">គ្រូ</h2>
        <h2 class="Stud">ID HSD TC 00<?php echo $id ?></h2>
        <h2 class="st_name_img"><img src="../productimages/teacher/<?php echo $sd_img?>" alt=""></h2>

        <h2 class="st_name"><?php echo $sd_namekh?></h2>
        <h2 class="qr"><img src="<?php qr_teacher_id(); ?>" alt=""></h2>


      </div>



    <div id="receipt-footer">
      <h2 class="footercad">អាសយដ្ឋានៈ ភូមិថ្នល់ ឃុំតំបែរ ស្រុកតំបែរ ខេត្តត្បូងឃ្មុំ <br>
      ទូរស័ព្ទៈ ០៧១ ៨៩ ៨៩ ៧២៦ /០៧១ ៨៩ ៨៩ ៧២៦
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
    var ti=document.getElementsByClassName("dowjpg")[0];
    var ddd=document.getElementById("dw_bt");

    ddd.addEventListener("click",()=>{
      domtoimage.toJpeg(ti).then((data)=>{
        var link =document.createElement("a");
        link.download = "<?php show_customer_name() ?>.jpg";
        link.href = data;
        link.click();
      })
    })
  </script>
</body>

</html>
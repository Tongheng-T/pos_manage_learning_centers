<?php require_once("resources/config.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receipt - SaleID : <?php show_customer_name(); ?></title>
  <link rel='shortcut icon' href="ui/logo/256.ico" type="image/x-icon">
  <link rel="icon" href="ui/logo/32.ico" sizes="32x32">
  <link rel="icon" href="ui/logo/48.ico" sizes="48x48">
  <link rel="icon" href="ui/logo/96.ico" sizes="96x96">
  <link rel="icon" href="ui/logo/256.ico" sizes="144x144">
  <link type="text/css" rel="stylesheet" href="dist/css/receipti.css" media="all">
  <link type="text/css" rel="stylesheet" href="dist/css/no-printi.css" media="print">
  <link rel="stylesheet" media="print" href="dist/css/receipti.css" />
</head>

<body>
  <?php
  $id = $_GET['id'];
  $select = query("SELECT * from tbl_students where sd_id =$id");
  confirm($select);
  $row = $select->fetch_object();
  $dd = $row->sd_db;
  $sd_namekh = $row->sd_namekh;
  $sd_sex = $row->sd_sex;
  $sd_phone = $row->sd_phone;
  $sd_img = $row->sd_img;

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

  <div id="wrapper">
    <div class="dowjpg">


      <div class="top_ba">
        <div class="top_nisome">
          <div class="img"><img src="dist/img/c.png" alt=""></div>
          <h3 class="hsdkh">វិទ្យាល័យហ៊ុនសែនតំបែរ</h3>
          <h3 class="hsden">Hun Sen Dambae High School</h3>
        </div>
      </div>

      <div class="name">
        <h2 class="students">សិស្ស</h2>
        <h2 class="Stud">ID HSD00<?php echo $id ?></h2>
        <h2 class="st_name"><img src="productimages/students/<?php echo $sd_img?>" alt=""></h2>

        <h2 class="st_name">ឈ្មោះ <?php echo $sd_namekh?></h2>
        <h2 class="st_name">ថ្ងៃកំណើត <?php echo date('d-m-Y', strtotime($dd)) ?></h2>
        <h2 class="st_name">ភេទ <?php echo $sd_sex ?></h2>
        <h2 class="st_name">ទូរស័ព្ទ <?php echo $sd_phone ?></h2>
        <!-- <h2 class="qr"><img src="<?php qr(); ?>" alt=""></h2> -->


      </div>

      
    <div id="receipt-footer">
      <h2 class="footercad">អាសយដ្ឋានៈ ភូមិថ្នល់ ឃុំតំបែរ ស្រុកតំបែរ ខេត្តត្បូងឃ្មុំ <br>
      ទូរស័ព្ទៈ ០៧១ ៨៩ ៨៩ ៧២៦ /០៧១ ៨៩ ៨៩ ៧២៦

      </h2>
    </div>
    </div>

    <div id="buttons">

      <!-- <button class="btn btn-print" type="button" id="dw_bt">Download Image</button> -->
    </div>
  </div>
  <script src="ui/dom-to-image.js"></script>

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
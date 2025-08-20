<?php require_once("../resources/config.php"); ?>
<?php
check_login();
if ($_SESSION['useremail'] == "" or $_SESSION['role'] == "User") {
    header("Location: ../");
}
?>

<?php
$id = $_GET['id'];
$select = query("SELECT * from tbl_students where sd_id =$id");
confirm($select);
$row = $select->fetch_object();

$dd = $row->sd_db;
$sd_namekh = $row->sd_namekh;
$sd_nameen = $row->sd_nameen;

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Certificate - <?php echo $sd_namekh; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../dist/css/no-print.css" media="print">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', serif;
            background: #f4f4f4;
        }

        .certificate {
            position: relative;
            width: 1123px;
            /* A4 landscape */
            height: 794px;
            margin: auto;
            background: url('../productimages/certificate/<?php echo $rowd->form_image ?>') no-repeat center;
            background-size: cover;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.4);
        }

        /* Logo ក្បាល */
        .logo-top {
            position: absolute;
            top: 28px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .logo-top img {
            width: 157px;
        }

        /* អក្សរ CERTIFICATE */
        .title {
            position: absolute;
            top: 200px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 42px;
            font-weight: bold;
            color: #0072bb;
            text-align: center;
            letter-spacing: 2px;
        }

        .sub-title {
            position: absolute;
            top: 250px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 18px;
            color: #444;
            text-align: center;
            letter-spacing: 3px;
        }

        /* ឈ្មោះសិស្ស */
        .fullname {
            position: absolute;
            top: 320px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 46px;
            color: #0072bb;
            font-weight: bold;
        }

        /* Course Name */
        .course {
            position: absolute;
            top: 427px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 38px;
            color: #0d60b3;
        }

        /* អ្នកចុះហត្ថលេខា */
        .teacher {
            position: absolute;
            bottom: 42px;
            left: 135px;
            text-align: center;
            font-size: 25px;
            color: #003366;
        }

        .date {
            position: absolute;
            bottom: 71px;
            right: 150px;
            font-size: 30px;
            color: #ffffffff;
        }

        .buttons {
            text-align: center;
            margin-top: 15px;
        }

        .buttons button {
            background: #0072bb;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin: 0 5px;
            border-radius: 5px;
        }

        /* Title Certificate */
        .title {
            position: absolute;
            top: 186px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 57px;
            font-weight: bold;
            color: #0072bb;
            text-align: center;
            letter-spacing: 2px;

            /* បន្ថែមបន្ទាត់ក្រោម */

            border-bottom: 5px solid #0072bb8c;
            display: inline-block;
        }

        .sub-title {
            position: absolute;
            top: 261px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 20px;
            font-weight: bold;
            color: #1f68b0;
            text-align: center;
            letter-spacing: 10px;

            /* ដាក់បន្ទាត់វែងក្រោមអក្សរ */
            display: inline-block;
        }

        .signature {
            position: absolute;
            bottom: 48px;
            /* ទីតាំងខាងលើឈ្មោះ Mr. */
            left: 133px;
            opacity: 0.8;
            /* កុំឲ្យស្រអាប់ពេក ដូចរូប */
            z-index: 2;
            /* នៅខាងលើផ្ទៃ */
        }

        .signature img {
            width: 173px;
            /* ទំហំត្រាប្រាក់ */
        }

        .traimg {
            position: absolute;
            bottom: 88px;
            /* ទីតាំងខាងលើឈ្មោះ Mr. */
            left: 78px;
            opacity: 0.8;
            /* កុំឲ្យស្រអាប់ពេក ដូចរូប */
            z-index: 2;
            /* នៅខាងលើផ្ទៃ */
        }

        .traimg img {
            width: 150px;
            /* ទំហំត្រាប្រាក់ */
        }

        .dowjpg {
            display: block;
            width: 1123px;
            height: 794px;
            margin: auto;
            background-color: #fff;
            /* ពណ៌សដើម្បីគ្រប់ទំហំនៅពេលស្ទាក់ */
        }
    </style>
</head>

<body>

    <div class="certificate dowjpg">
        <!-- Logo ខាងលើ -->
        <div class="logo-top">
            <img src="../productimages/logo/<?php echo $rowd->logo; ?>" alt="Logo">
        </div>
        <!-- Title -->
        <div class="title">CERTIFICATE</div>
        <div class="sub-title">OF COMPLETION</div>


        <!-- Fullname -->
        <div class="fullname"><?php echo $sd_nameen; ?></div>

        <!-- Course Name -->
        <div class="course">
            Has successfully completed the course on<br>
            “ Microsoft Office (
            <b><?php echo show_subject($row->sd_subject_id); ?></b> )”
        </div>

        <!-- Teacher & Date -->
        <div class="teacher"><?php echo $rowd->director; ?><br>Teacher</div>
        <!-- Traimg (ត្រាប្រាក់) -->
        <div class="traimg"><img src="../productimages/logo/<?php echo $rowd->traimg; ?>" alt="traimg"> </div>
        <div class="signature"><img src="../productimages/logo/<?php echo $rowd->signature ?>"></div>
        <div class="date"><?php echo date("M d, Y"); ?></div>
    </div>

    <div class="buttons" id="buttons">
        <a href="itemt?tudentslist"><button>Back</button></a>
        <button id="dw_bt">Download Image</button>
        <button onclick="window.print()">Print</button>
    </div>

    <!-- <script src="dom-to-image.js"></script> -->
    <script src="../dist/js/html2canvas.min.js"></script>

    <script>
        document.getElementById("dw_bt").addEventListener("click", () => {
            var node = document.getElementsByClassName("dowjpg")[0];

            html2canvas(node, {
                backgroundColor: "#ffffff",
                scale: 2, // កើនគុណភាព
                useCORS: true
            }).then(canvas => {
                var link = document.createElement("a");
                link.download = "<?php show_customer_name() ?>.jpg";
                link.href = canvas.toDataURL("image/jpeg", 1.0);
                link.click();
            });
        });
    </script>
</body>

</html>
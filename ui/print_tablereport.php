<?php require_once("../resources/config.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <xsl:attribute name="page-height">200cm</xsl:attribute> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="../dist/css/styleee.css">
    <link href="../dist/css/print.css" rel="stylesheet" media="print">

    <title>របាយការណ៍ការបង់ប្រាក់ប្រចាំខែ: <?php date_rank(); ?></title>
</head>
<?php $tbl_setting = query("SELECT * from tbl_setting");
confirm($tbl_setting);
$rowd = $tbl_setting->fetch_object(); ?>

<body>
    <div class="my-5 page" size="A4" id="example-table">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <img src="../productimages/logo/<?php echo  $rowd->logo ?>" alt="Logo" class="img-fluid">
                    <!-- <h5>ក្រសួងអប់រំ យុវជន និងកីឡា</h5> -->
                    <br>


                    <h5 class="h5"><?php echo  $rowd->name_receipt ?></h5>
                </div>
                <div class="top-left">
                    <div class="graphicc-path">
                        <?php $date_1 = $_SESSION['date_1'];
                        $date_2 = $_SESSION['date_2'];


                        function show_customer_name()
                        {
                            $id = $_GET['id'];
                            $select = query("select * from tbl_invoice where invoice_id = $id");
                            confirm($select);
                            $row = $select->fetch_object();
                            $customer_name = $row->customer_name;
                            $invoice_id = $row->invoice_id;
                            echo 'N0 ' . $invoice_id . ' _ ' . $customer_name;
                        } ?>
                        <!-- <h4>ព្រះរាជាណាចក្រកម្ពុជា</h4>
                        <h4 class="margino">ជាតិ សាសនា ព្រះមហាក្សត្រ</h4> -->
                        <b>ចាប់ពីថ្ងៃទី: <?php echo date('d-m-Y', strtotime($date_1)) ?><br> ដល់ថ្ងៃទី: <?php echo date('d-m-Y', strtotime($date_2)) ?></b>
                    </div>
                </div>
            </section>
            <div class="dddc">
                <h5>របាយការណ៍ការបង់ប្រាក់ប្រចាំខែ <?php date_rank(); ?></h5>
            </div>

            <section class="product-area mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ល.រ</th>
                            <th>ឈ្មោះ​</th>
                            <th>ភេទ</th>
                            <th>ថ្ងៃខែ</th>
                            <th>តម្លៃ</th>
                        </tr>
                    </thead>
                    <tbody id="orderlisttable">
                        <?php
                        $select = query("SELECT * from tbl_employee_students where date between '$date_1' AND '$date_2' ");
                        confirm($select);

                        $total = 0;
                        $no = 1;
                        while ($row = $select->fetch_object()) {
                            $id = $row->sd_id;
                            $total += $row->money;
                            $select2 = query("SELECT * from tbl_students where  sd_id = '$id'");
                            confirm($select2);
                            while ($rowin = $select2->fetch_object()) {
                                $sd_nameen = $rowin->sd_nameen;
                                $sex = $rowin->sd_sex;
                            }

                            echo '
                            <tr>
                            
                            <td>' . $no   . '</td>
                            <td>' . $sd_nameen   . '</td>
                            <td>' . $sex   . '</td>
                            <td>' . date('d-m-Y', strtotime($row->date))  . '</td>

                           
                            <th>' . number_format($row->money) . '</th> </tr>';
                            $no++;
                        }

                        echo '<tr>
                                 <td colspan="3"></td>
                                 <td>Total</td>
                                 <th>' . number_format($total) . ' ៛</th> </tr>';


                        ?>
                    </tbody>

                    </tbody>
                </table>
            </section>

            <script>
                window.print();
            </script>


        </div>
    </div>


</body>

</html>
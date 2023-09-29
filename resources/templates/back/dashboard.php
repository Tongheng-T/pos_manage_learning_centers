<?php


if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

    header('location:../');
}
$id_branch = branch_id();
$selectt = query("SELECT * from tbl_students where id_branch= $id_branch");
confirm($selectt);
$total_tudents = 0;
while ($row = $selectt->fetch_object()) {

    $total_tudents += show_price($row->sd_subject_id, $row->sd_id);
}



$select = query("SELECT count(sd_id) as invoice from tbl_students where id_branch= $id_branch");
confirm($select);
$row = $select->fetch_object();

$total_order = $row->invoice;
$grand_total = $total_tudents;


$select = query("SELECT count(tc_id) as pname from tbl_teacher where id_branch= $id_branch");
confirm($select);

$row = $select->fetch_object();

$total_teacher = $row->pname;

$select = query("SELECT count(sj_id) as cate from tbl_subject where id_branch= $id_branch");
confirm($select);

$row = $select->fetch_object();

$total_subject = $row->cate;




?>

<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li> -->
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">



                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $total_order; ?></h3>

                                <p>ចំនួនសិស្ស</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="itemt?tudentslist" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo number_format($grand_total, 2); ?></h3>

                                <p>សរុប តម្លៃសិក្សារ($)</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="itemt?students_pay" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $total_teacher; ?></h3>

                                <p>ចំនួនគ្រូ</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="itemt?teacher_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo $total_subject; ?></h3>
                                <p>ចំនួនមុខវិជ្ជា</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="itemt?subject" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-6 col-6">

                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Pie Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>




                    </div>
                    <!-- ./col -->


                </div>
                <!-- /.row -->

                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Users</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- New Users Section -->
                    <div class="new-users card-body">

                        <div class="user-list" id="user_grid">
                            <?php
                            $time = new DateTime('now', new DateTimeZone('Asia/bangkok'));
                            $datee =  $time->format('Y-m-d H:i:s');
                            $time = time();
                            $select = query("SELECT * from tbl_user ");
                            confirm($select);

                            while ($row = $select->fetch_assoc()) {
                                extract($row);
                                $date = date($row['last_login']);
                                $timeago = timeago($date);
                                $status = $timeago;
                                $class = "text-danger";

                                if ($row['login_online'] > $time) {
                                    $status = 'Online';
                                    $class = "text-success";
                                }
                            ?>

                                <div class="user">
                                    <img src="../productimages/user/<?php echo $row['img'] ?>">
                                    <h2><?php echo $row['username'] ?></h2>
                                    <p class="<?php echo $class ?>"><i class="fas fa-signal"></i> <?php echo $status ?></p>
                                </div>
                            <?php } ?>

                        </div>

                    </div>
                    <!-- End of New Users Section -->
                </div>

                <div class="card card-warning collapsed-card">

                    <div class="card-header">
                        <h5 class="card-title">Number of students By Date</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php
                        $date_1 = date("Y-n-j", strtotime("first day of previous month"));
                        $date_2 = date("Y-m-d", strtotime("last day of this month"));
                        $select = query("SELECT sd_date_of_enrollment , count(sd_date_of_enrollment) as total from tbl_students where id_branch= $id_branch and sd_date_of_enrollment between '$date_1' AND '$date_2' group by sd_date_of_enrollment");
                        confirm($select);
                        $ttl = [];
                        $datee = [];

                        while ($row = $select->fetch_assoc()) {
                            extract($row);

                            $ttl[] = $total;
                            $datee[] = date('d-m-Y', strtotime($sd_date_of_enrollment));
                        }

                        // echo json_encode($total);

                        ?>

                        <div>
                            <canvas id="myChart" style="height: 250px"></canvas>
                        </div>


                        <?php echo date('d-m-Y', strtotime($date_1)) . ' - ' . date('d-m-Y', strtotime($date_2)) ?>
                    </div>
                    <script>
                        const ctx = document.getElementById('myChart');

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: <?php echo json_encode($datee); ?>,
                                datasets: [{
                                    label: 'Total Earning',
                                    backgroundColor: 'rgb(255,99,132)',
                                    borderColor: 'rgb(255,99,132)',
                                    data: <?php echo json_encode($ttl); ?>,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true

                                    }
                                }
                            }
                        });
                    </script>


                </div>

            </div>


        </div>
        <!-- /.col-md-6 -->


        <div class="row">


            <div class="col-md-12">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">subject</h5>
                    </div>
                    <div class="card-body">
                        <div style="overflow-x:auto;">
                            <table class="table table-striped table-hover " id="table_bestsellingproduct">
                                <thead>
                                    <tr>

                                        <td>ល.រ</td>
                                        <td>ID</td>
                                        <td>មុខវិជ្ជា</td>
                                        <td>តម្លៃសិក្សារ/ខែ</td>
                                        <td>តម្លៃសិក្សារ/ឆ្មាំ</td>
                                        <td>តម្លៃឡាន/ខែ</td>
                                        <td>តម្លៃឡាន/ឆ្នាំ</td>

                                    </tr>

                                </thead>


                                <tbody>

                                    <?php

                                    $select = query("SELECT * FROM tbl_subject where id_branch= $id_branch");
                                    confirm($select);
                                    $no = 1;
                                    while ($row = $select->fetch_object()) {
                                        echo '
                                        <tr>
                                        
                                        <td>' . $no . '</td>
                                        <td>' . $row->sj_id . '</a></td>
                                        <td><span class="badge badgeth badge-dark">' . $row->sj_name . '</td></span>
                                        
                                        <td><span class="badge badgeth badge-success">' . $row->sj_price - $row->car_price_month   . '</span></td>
                                        <td><span class="badge badgeth badge-primary">' . $row->sj_price_year - $row->car_price_year   . '</span></td>
                                        <td><span class="badge badgeth badge-danger">' . $row->car_price_month . '</span></td>
                                        <td><span class="badge badgeth badge-danger">' . $row->car_price_year . '</span></td>
                                        ';
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>

            </div>


        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.content -->
<!-- <iframe src="https://www.pornhub.com/embed/ph6247b4eeded2a" frameborder="0" width="560" height="340" scrolling="no" allowfullscreen></iframe> -->
<!-- <iframe width="1280" height="720" src="https://www.eporner.com/embed/qD4qirqmTyO/" frameborder="0" allowfullscreen></iframe> -->

<?php

$selectt = query("SELECT sd_sex, count(sd_sex) as total FROM tbl_students  where sd_sex= 'ប្រុស'");
$select = query("SELECT sd_sex, count(sd_sex) as totalF FROM tbl_students  where sd_sex= 'ស្រី'");
confirm($selectt);

 $row = $selectt->fetch_assoc();

    $dd = $row['total'];

    $row = $select->fetch_assoc();

    $ddF = $row['totalF'];

?>
<script>
    var donutData = {
        labels: [
            'ប្រុស',
            'ស្រី',
        ],
        datasets: [{
            data:[ <?php echo $dd?> ,<?php echo $ddF?>],
            backgroundColor: ['#00c0ef','#f56954'],
        }]
    }
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = donutData;
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    })
</script>
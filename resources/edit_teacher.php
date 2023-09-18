<?php

if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

    header('location:../');
}



if (isset($_POST['id'])) {

    $query = query("SELECT * FROM tbl_teacher WHERE tc_id = " . escape_string($_POST['id']) . "");
    confirm($query);

    while ($row = fetch_array($query)) {

        $namekh = $row['tc_namekh'];
        $nameen = $row['tc_nameen'];
        $sex = $row['tc_sex'];
        $db = $row['tc_db'];
        $datedb = date('d-m-Y', strtotime($db));
        $phone = $row['tc_phone'];
        $subject_id = $row['tc_subjects_id'];

        $salary = $row['tc_salary'];

        $img = $row['tc_img'];
        $date_of_enrollment = $row['tc_date_of_employment'];
        $date_of = date('d-m-Y', strtotime($date_of_enrollment));
    }
    display_message();
    update_teacher();
}

?>
<input type="text" class="form-control date_1" data-target="#date_1" id="pp ">

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1 class="m-0">បញ្ចូលឈ្មោះសិស្ស</h1> -->
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


                <div class="card card-warning ">
                    <div class="card-header">
                        <h5 class="m-0 bg_warning">កែប្រែព័ត៌មានគ្រូ</h5>
                    </div>


                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label>ឈ្មោះជាភាសាខ្មែរ</label>
                                        <input type="text" class="form-control" placeholder="បញ្ចូល ឈ្មោះជាភាសាខ្មែរ" name="txtnamekh" value="<?php echo $namekh; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>ថ្ងៃខែឆ្នាំកំណើត</label>
                                        <div class="input-group date" id="date_1" data-target-input="nearest">
                                            <input type="text" class="form-control date_1" data-target="#date_1" name="txtdb" value="<?php echo $datedb; ?>">
                                            <div class="input-group-append" data-target="#date_1" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>មុខវិជ្ជា</label>
                                        <select class="form-control select2" data-dropdown-css-class="select2" name="txtsubject" required>
                                            <option value="" disabled selected>ជ្រើសរើសមុខវិជ្ជាដែលត្រូវរៀន</option>
                                            <?php
                                            $select = query("SELECT * from tbl_subject");
                                            confirm($select);

                                            while ($row = $select->fetch_assoc()) {
                                                extract($row);

                                            ?>
                                                <option value="<?php echo $row['sj_id'] ?>" <?php if ($row['sj_id'] == $subject_id) { ?> selected="selected" <?php } ?>><?php echo $row['sj_name']; ?></option>

                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>ថ្ងៃខែចូលធ្វើការ</label>
                                        <div class="input-group date" id="date_1" data-target-input="nearest">
                                            <input type="text" class="form-control date_1" data-target="#date_1" name="txt_date_of_employment" value="<?php echo $date_of; ?>">
                                            <div class="input-group-append" data-target="#date_1" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label>ឈ្មោះជាអក្សរឡាតាំង</label>
                                        <input type="text" class="form-control" placeholder="បញ្ចូល ឈ្មោះជាអក្សរឡាតាំង" name="txtnameen" value="<?php echo $nameen; ?>" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>លេខទូរសព្ទ</label>
                                        <input type="text" class="form-control" placeholder="បញ្ចូល លេខទូរសព្ទ" name="txtphone" required value="<?php echo $phone; ?>" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>ប្រាក់ខែ</label>
                                        <input type="text" class="form-control" placeholder="បញ្ចូល ប្រាក់ខែ" name="txt_salary" value="<?php echo $salary; ?>" autocomplete="off">
                                    </div>



                                </div>

                                <div class="col-md-4">
                                    <label>ភេទ</label>
                                    <div class="form-group" required>

                                        <div class="icheck-primary d-inline">
                                            <input type="radio" name="sex" value="ប្រុស" id="radioSuccess2" <?php echo ($sex == 'ប្រុស') ? 'checked' : '' ?>>
                                            <label for="radioSuccess2">
                                                ប្រុស
                                            </label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" name="sex" value="ស្រី" id="radioSuccess3" <?php echo ($sex == 'ស្រី') ? 'checked' : '' ?>>
                                            <label for="radioSuccess3">
                                                ស្រី
                                            </label>
                                        </div>
                                    </div><br>

                                    <div class="form-group">
                                        <label>រូបថត 4x6</label>
                                        <input type="file" class="input-group" name="myfile" onchange="displayImage(this)" id="profilImg">
                                        <img src="../productimages/teacher/<?php echo $img; ?>" onclick="triggerClick()" id="profiledisplay">
                                        <p>Upload image</p>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning" name="btnupdate">កែប្រែ</button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->



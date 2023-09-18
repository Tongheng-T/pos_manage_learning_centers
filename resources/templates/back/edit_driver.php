<?php

require_once("../../config.php");



if (isset($_GET['id'])) {

    $query = query("SELECT * FROM tbl_car_driver WHERE car_id = " . escape_string($_GET['id']) . "");
    confirm($query);

    while ($row = fetch_array($query)) {

        $id = $row['car_id'];
        $namekh = $row['car_namekh'];
        $nameen = $row['car_nameen'];
        $sex = $row['car_sex'];

        $db = $row['car_db'];
        $datedb = date('d-m-Y', strtotime($db));

        $phone = $row['car_phone'];

        $car_car_type = $row['car_car_type'];

        $car_license_plate = $row['car_license_plate'];
        $car_vehicle_id = $row['car_vehicle_id'];
        $salary = $row['car_salary'];
        $car_oil = $row['car_oil'];

        $date_of_enrollment = $row['car_date_of_employment'];
        $date_of = date('d-m-Y', strtotime($date_of_enrollment));

        $img = $row['car_img'];
    }
}

?>





<div class="card card-success">


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
                        <label>ប្រភេទរថយន្ត</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល ប្រភេទរថយន្ត" name="txtcar_type" value="<?php echo $car_car_type; ?>">
                    </div>
                    <div class="form-group">
                        <label>ប្រាក់ខែ</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល ប្រាក់ខែ" name="txt_salary" value="<?php echo $salary; ?>">
                    </div>

                    <div class="form-group">
                        <label>ថ្ងៃខែចូលធ្វើការ</label>
                        <div class="input-group date" id="date_2" data-target-input="nearest">
                            <input type="text" class="form-control date_2" data-target="#date_2" name="txt_date_of_employment" value="<?php echo $date_of; ?>">
                            <div class="input-group-append" data-target="#date_2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="col-md-4">

                    <div class="form-group">
                        <label>ឈ្មោះជាអក្សរឡាតាំង</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល ឈ្មោះជាអក្សរឡាតាំង" name="txtnameen" value="<?php echo $nameen; ?>">
                    </div>
                    <div class="form-group">
                        <label>លេខទូរសព្ទ</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល លេខទូរសព្ទ" name="txtphone" required value="<?php echo $phone; ?>">
                    </div>
                    <div class="form-group">
                        <label>ស្លាកលេខរថយន្ត</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល ស្លាកលេខរថយន្ត" name="txt_License_plate" required value="<?php echo $car_license_plate; ?>">
                    </div>
                    <div class="form-group">
                        <label>ចំនួនប្រេង</label>
                        <input type="number" class="form-control" placeholder="បញ្ចូល ចំនួនប្រេង" name="txt_car_oil" value="<?php echo $car_oil; ?>">
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
                        <img src="../productimages/driver/<?php echo $img; ?>" onclick="triggerClick()" id="profiledisplay">
                        <p>Upload image</p>
                    </div>

                    <div class="form-group">
                        <label>លេខសំគាល់រថយន្ត</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល ស្លាកលេខរថយន្ត" name="txt_Vehicle_ID" required value="<?php echo $car_vehicle_id; ?>">
                    </div>


                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="text-center">
                <button type="submit" class="btn btn-success" name="btnupdate" value="<?php echo $id; ?>">កែប្រែ</button>
            </div>
        </div>

    </form>

</div>
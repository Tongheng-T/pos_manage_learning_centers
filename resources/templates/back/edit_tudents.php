<?php
require_once("../../config.php");


if (isset($_GET['id'])) {

  $query = query("SELECT * FROM tbl_students WHERE sd_id = " . escape_string($_GET['id']) . "");
  confirm($query);

  while ($row = fetch_array($query)) {
    $id                 = $row['sd_id'];
    $namekh             = $row['sd_namekh'];
    $nameen             = $row['sd_nameen'];
    $sex                = $row['sd_sex'];
    $db                 = $row['sd_db'];
    $datedb             = date('d-m-Y', strtotime($db));
    $phone              = $row['sd_phone'];
    $subject_id         = $row['sd_subject_id'];
    $time_id            = $row['sd_time_id'];
    $teacher_id         = $row['sd_teacher_id'];
    $car_idd             = $row['sd_car_id'];
    $img                = $row['sd_img'];
    $class_id           = $row['sd_class_id'];
    $studytime          = $row['sd_studytime'];
    $date_of_enrollment = $row['sd_date_of_enrollment'];
    $date_of            = date('d-m-Y', strtotime($date_of_enrollment));
    $studyclose          = $row['studyclose'];
    $txtprice          = $row['txtprice'];
    $txtaddress          = $row['sd_address'];
  }
}

?>



<form action="" method="post" enctype="multipart/form-data">
  <div class="card-body">
    <div class="row">
      <div class="col-md-4">

        <div class="form-group">
          <label>ឈ្មោះជាភាសាខ្មែរ</label>
          <input type="text" class="form-control" placeholder="បញ្ចូល ឈ្មោះជាភាសាខ្មែរ" name="txtnamekh" value="<?php echo $namekh; ?>" autocomplete="off">
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
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>មុខវិជ្ជា</label>
              <select class="form-control select2 select2s subject" data-dropdown-css-class="select2" data-minimum-results-for-search="Infinity" name="txtsubject" required>
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
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>រៀនជា: ខែ/ឆ្នាំ</label>
              <select class="form-control select2 year select2s" data-dropdown-css-class="select2" data-minimum-results-for-search="Infinity" name="txtstudytime" required>

                <option value="month" <?php echo ($studytime == 'month') ? 'selected' : '' ?>>ខែ</option>
                <option value="years" <?php echo ($studytime == 'years') ? 'selected' : '' ?>>ឆ្នាំ</option>
                <option value="session" <?php echo ($studytime == 'session') ? 'selected' : '' ?>>វគ្គ</option>

              </select>
            </div>
          </div>
        </div>
        <div class="form-group" id="txtprice">
          <label>តម្លៃសិក្សារ</label>
          <input type="text" class="form-control" placeholder="តម្លៃសិក្សារ" name="txtprice" id="txtprice" value="<?php echo $txtprice; ?>">
        </div>

        <div class="form-group">
          <label>ថ្ងៃខែចូលរៀន</label>
          <div class="input-group date" id="date_2" data-target-input="nearest">
            <input type="text" class="form-control date_2" data-target="#date_2" name="txtdate_of_enrollment" value="<?php echo $date_of; ?>">
            <div class="input-group-append" data-target="#date_2" data-toggle="datetimepicker">
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
          <input type="text" class="form-control" placeholder="Enter Barcode" name="txtphone" value="<?php echo $phone; ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label>អាសយដ្ឋាន</label>
          <input type="text" class="form-control" placeholder="បញ្ចូល អាសយដ្ឋាន" name="txtaddress" value="<?php echo $txtaddress; ?>" required>
        </div>
        <div class="form-group">
          <label>ម៉ោងសិក្សារ</label>
          <select style="height: 46px;" class="form-control select2 select2s time" data-dropdown-css-class="select2-purple" data-minimum-results-for-search="Infinity" name="txttim" required>

            <?php
            $select = query("SELECT * from tbl_studytime");
            confirm($select);

            while ($row = $select->fetch_assoc()) {
              extract($row);

            ?>
              <option value="<?php echo $row['sdi_id'] ?>" <?php if ($row['sdi_id'] == $time_id) { ?> selected="selected" <?php } ?>><?php echo $row['sdi_name']; ?></option>

            <?php

            }

            ?>
          </select>
        </div>
        <div class="form-group">
          <label>គ្រូ</label>
          <select class="form-control select2" data-dropdown-css-class="select2-purple" data-minimum-results-for-search="Infinity" name="txtteacher" required>

            <?php
            $select = query("SELECT * from tbl_teacher");
            confirm($select);

            while ($row = $select->fetch_assoc()) {
              extract($row);

            ?>
              <option value="<?php echo $row['tc_id'] ?>" <?php if ($row['tc_id'] == $teacher_id) { ?> selected="selected" <?php } ?>><?php echo $row['tc_namekh']; ?></option>

            <?php

            }

            ?>
          </select>
        </div>
        <div class="form-group">
          <label>អំពីសិស្ស</label>
          <select class="form-control select2" data-dropdown-css-class="select2-purple" data-minimum-results-for-search="Infinity" name="studyclose" required>
            <option value="រៀនចប់" <?php echo ($studyclose == 'រៀនចប់') ? 'selected' : '' ?>>រៀនចប់</option>
            <option value="ឈប់រៀន" <?php echo ($studyclose == 'ឈប់រៀន') ? 'selected' : '' ?>>ឈប់រៀន</option>
            <option value="នៅរៀន" <?php echo ($studyclose == 'នៅរៀន') ? 'selected' : '' ?>>នៅរៀន</option>

          </select>
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
          <img src="../productimages/students/<?php echo $img; ?>" onclick="triggerClick()" id="profiledisplay">
          <p>Upload image</p>
        </div>

        <div class="form-group">
          <label>ថ្នាក់រៀន</label>
          <select class="form-control select2" data-dropdown-css-class="select2-purple" data-minimum-results-for-search="Infinity" name="txtclass" required>
            <option value="" disabled selected>ជ្រើសរើសថ្នាក់រៀន</option>

            <?php
            $select = query("SELECT * from tbl_classroom");
            confirm($select);

            while ($row = $select->fetch_assoc()) {
              extract($row);

            ?>
              <option value="<?php echo $row['cr_id'] ?>" <?php if ($row['cr_id'] == $class_id) { ?> selected="selected" <?php } ?>><?php echo $row['cr_name']; ?></option>

            <?php

            }

            ?>
          </select>
        </div>
        <div class="form-group">
          <label>រថយន្ត</label>
          <select class="form-control select2 car select2s" data-minimum-results-for-search="Infinity" name="txtcar" required>
            <option value="0" disabled selected>ជ្រើសរើសរថយន្ត/មធ្យោបាយធ្វើដំណើរ</option>
            <option value="0">Select</option>

            <?php
            $select = query("SELECT * from tbl_car_price");
            confirm($select);

            while ($row = $select->fetch_assoc()) {
              extract($row);
            ?>
              <option value="<?php echo $row['price'] ?>" <?php if ($row['price'] == $car_idd) { ?> selected="selected" <?php } ?>><?php echo $row['tit_price'] . $row['price']; ?></option>

            <?php

            }

            ?>

          </select>
        </div>

      </div>
    </div>
  </div>

  <div class="card-footer">
    <div class="text-center">
      <button type="submit" class="btn btn-primary" name="btnupdate" value="<?php echo $id; ?>">កែប្រែ</button>
    </div>
  </div>

</form>





<script>
  $(function() {

    $('.select2s').on('change', function() {

      var productid = $(".subject").val();
      var year = $(".year").val();
      var car = $(".car").val();
      var sdi_id = $(".time").val();


      $.ajax({
        url: "../resources/templates/back/getsubject_time.php",
        method: "get",
        data: {
          id: productid,
          sdi_id: sdi_id,
          year: year,
          car: car,
        },
        success: function(data) {

          $("#txtprice").html(data);
        }
      });
    })
  });



  // var productid = $(".subject").val();
  // var year = $(".year").val();
  // var car = $(".car").val();

  // $.ajax({
  //   url: "../resources/templates/back/getsubject.php",
  //   method: "get",
  //   dataType: "json",
  //   data: {
  //     id: productid,
  //     study: year,
  //     car: car
  //   },
  //   success: function(data) {

  //     // alert(data["sj_price"])
  //     if (year == "years") {
  //       var price = data["sj_price_year"] + car;

  //     } else if (year == "session") {
  //       var price = data["price_session"] + car;

  //     } else {
  //       var price = data["sj_price"] + car;

  //     }

  //     // $("#txtbarcode_id").val("");
  //     var show_price = document.getElementById('txtprice');
  //     show_price.value = price ;

  //   }
  // });
</script>

<script>
  $('#date_1').datetimepicker({
    format: 'DD-MM-YYYY'
  });


  //Date picker
  $('#date_2').datetimepicker({
    format: 'DD-MM-YYYY'
  });


  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })
</script>
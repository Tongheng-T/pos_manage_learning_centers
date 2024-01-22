<?php

require_once("../../config.php");

?>




<form action="" method="post" enctype="multipart/form-data">
  <div class="card-body">
    <div class="row">
      <div class="col-md-4">

        <div class="form-group">
          <label>ឈ្មោះជាភាសាខ្មែរ</label>
          <input type="text" class="form-control" placeholder="បញ្ចូល ឈ្មោះជាភាសាខ្មែរ" name="txtnamekh" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label>ថ្ងៃខែឆ្នាំកំណើត</label>
          <div class="input-group date" id="date_1" data-target-input="nearest">
            <input type="text" class="form-control date_1" data-target="#date_1" name="txtdb" value="<?php echo date('d-m-1996'); ?>">
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
                <?php echo fill_subject(); ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>ខែ/ឆ្នាំ</label>
              <select class="form-control select2 year select2s" data-dropdown-css-class="select2" data-minimum-results-for-search="Infinity" name="txtstudytime" required>
                <option value="month">ខែ</option>
                <option value="years">ឆ្នាំ</option>
                <option value="session">វគ្គ</option>

              </select>
            </div>
          </div>
        </div>
        <div class="form-group" id="txtprice">
          <label>តម្លៃសិក្សារ</label>
          <input type="text" class="form-control" placeholder="តម្លៃសិក្សារ" name="txtprice" id="txtprice">
        </div>

        <div class="form-group">
          <label>ថ្ងៃខែចូលរៀន</label>
          <div class="input-group date" id="date_2" data-target-input="nearest">
            <input type="text" class="form-control date_2" data-target="#date_2" name="txtdate_of_enrollment" value="<?php echo date('d-m-Y'); ?>">
            <div class="input-group-append" data-target="#date_2" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>
      </div>


      <div class="col-md-4">

        <div class="form-group">
          <label>ឈ្មោះជាអក្សរឡាតាំង</label>
          <input type="text" class="form-control" placeholder="បញ្ចូល ឈ្មោះជាអក្សរឡាតាំង" name="txtnameen" autocomplete="off">
        </div>
        <div class="form-group">
          <label>លេខទូរសព្ទ</label>
          <input type="text" class="form-control" placeholder="បញ្ចូល លេខទូរសព្ទ" name="txtphone" autocomplete="off">
        </div>
        <div class="form-group">
          <label>ម៉ោងសិក្សារ</label>
          <select style="height: 46px;" class="form-control select2 select2s time" data-dropdown-css-class="select2-purple" data-minimum-results-for-search="Infinity" name="txttim" required>
            <option value="" disabled selected>ជ្រើសរើសម៉ោង</option>
            <?php echo fill_studytime(); ?>
          </select>
        </div>
        <div class="form-group">
          <label>គ្រូ</label>
          <select class="form-control select2" data-dropdown-css-class="select2-purple" data-minimum-results-for-search="Infinity" name="txtteacher" required>
            <option value="" disabled selected>គ្រូបង្រៀន</option>
            <?php echo fill_teacher(); ?>
          </select>
        </div>



      </div>

      <div class="col-md-4">
        <label>ភេទ</label>
        <div class="form-group" required>

          <div class="icheck-primary d-inline">
            <input type="radio" name="sex" value="ប្រុស" id="radioSuccess2">
            <label for="radioSuccess2">
              ប្រុស
            </label>
          </div>
          <div class="icheck-danger d-inline">
            <input type="radio" name="sex" value="ស្រី" id="radioSuccess3">
            <label for="radioSuccess3">
              ស្រី
            </label>
          </div>
        </div><br>


        <div class="form-group">
          <label>រូបថត 4x6</label>
          <input type="file" class="input-group" name="myfile" onchange="displayImage(this)" id="profilImg">
          <img src="../productimages/display.jpg" onclick="triggerClick()" id="profiledisplay">
          <p>Upload image</p>
        </div>

        <div class="form-group">
          <label>ថ្នាក់រៀន</label>
          <select class="form-control select2" data-dropdown-css-class="select2-purple" data-minimum-results-for-search="Infinity" name="txtclass" required>
            <option value="" disabled selected>ជ្រើសរើសថ្នាក់រៀន</option>
            <?php echo fill_classroom(); ?>
          </select>
        </div>
        <div class="form-group">
          <label>រថយន្ត</label>
          <select class="form-control select2 select2s car" name="txtcar" data-minimum-results-for-search="Infinity" required>
            <option value="" disabled selected>ជ្រើសរើសរថយន្ត/មធ្យោបាយធ្វើដំណើរ</option>
            <?php echo fill_car_driver(); ?>
          </select>
        </div>

      </div>
    </div>
  </div>

  <div class="card-footer">
    <div class="text-center">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary" name="btnsave">ចុះឈ្មោះ</button>
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

  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })

  $('#date_1').datetimepicker({
    format: 'DD-MM-YYYY'
  });
  $('#date_2').datetimepicker({
    format: 'DD-MM-YYYY'
  });
</script>
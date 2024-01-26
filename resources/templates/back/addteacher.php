<?php

require_once("../../config.php");

?>

<!-- /.content-header -->




<div class="card card-danger ">

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

                    <div class="form-group">
                        <label>មុខវិជ្ជា</label>
                        <select class="form-control select2" data-dropdown-css-class="select2" data-minimum-results-for-search="Infinity" name="txtsubject" required>
                            <option value="" disabled selected>ជ្រើសរើសមុខវិជ្ជាដែលត្រូវរៀន</option>
                            <?php echo fill_subject(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ថ្ងៃខែចូលធ្វើការ</label>
                        <div class="input-group date" id="date_2" data-target-input="nearest">
                            <input type="text" class="form-control date_2" data-target="#date_2" name="txt_date_of_employment" value="<?php echo date('d-m-Y'); ?>" required>
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
                        <input type="text" class="form-control" placeholder="បញ្ចូល លេខទូរសព្ទ" name="txtphone" required>
                    </div>
                    <div class="form-group">
                        <label>អាសយដ្ឋាន</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល អាសយដ្ឋាន" name="txtaddress" required>
                    </div>
                    <div class="form-group">
                        <label>ប្រាក់ខែ</label>
                        <input type="text" class="form-control" placeholder="បញ្ចូល ប្រាក់ខែ" name="txt_salary" required>
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
                        <img src="../productimages/teacher/display.jpg" onclick="triggerClick()" id="profiledisplay">
                        <p>Upload image</p>
                    </div>


                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="text-center">
                <button type="submit" class="btn btn-warning" name="btnsave">ចុះឈ្មោះ</button>
            </div>
        </div>

    </form>

</div>

<script>
  //Date picker
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
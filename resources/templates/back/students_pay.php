<?php

if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

  header('location:../');
}


display_message();
?>



<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">


        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0 fones" style="float: left;">បញ្ជីឈ្មោះសិស្ស :</h5>

            <!-- <h5 style="text-align: center;"><button type="button" class="btn btn-primary btnadd" data-toggle="modal" data-target="#exampleModal" role="button"><span style="color:#ffffff" data-toggle="tooltip" title="ចុះឈ្មោះសិស្សថ្មី">ចុះឈ្មោះសិស្សថ្មី</span></button></h5> -->
          </div>
          <div class="card-body">

            <table class="table table-striped table-hover " id="">
              <thead class="bg_color">
                <tr>
                  <th>N0</th>
                  <th>id</th>
                  <th>ឈ្មោះខ្មែរ</th>
                  <th>ឈ្មោះឡាតាំង</th>
                  <th>ភេទ</th>
                  <th>ថ្ងៃខែឆ្នាំកំណើត</th>
                  <th>មុខវិជ្ជា</th>
                  <th>តម្លៃសិក្សារ</th>
                  <th>ប្រាក់បានបង់</th>
                 
                  <th>ថ្ងៃខែ</th>

                  <th>ActionIcons</th>

                </tr>

              </thead>


              <tbody>

                <?php students_pay(); ?>

              </tbody>

            </table>


          </div>
        </div>

      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->






<script>


  $('.btn-delete').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href')
    Swal.fire({
      title: "លុបអព័ត៌មានបង់ប្រាក់!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.location.href = href;
      }
    })
  })
</script>


</script>
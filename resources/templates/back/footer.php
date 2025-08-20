<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    POS TELA INVENTORY SYSTEM V-2.0
  </div>
  <!-- Default to the left -->
  <strong>BY: <a href="https://web.facebook.com/TonghengCoding " target="_blank">Tongheng-T</a></strong>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- <script src="../dist/js/timee.js"></script> -->
<!-- SweetAlert2 -->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>

<script src="../plugins/chart.js/Chart.min.js"></script>



<script>
  $(document).ready(function() {
    $('#table_category').DataTable();
  });
</script>
<script>
  $(document).ready(function() {
    $('#table_product').DataTable();
  });
</script>
<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>



<!-- ........//////////////////productlist -->

<script>
  $(document).ready(function() {
    $('.btndelete').click(function() {
      var tdh = $(this);
      var id = $(this).attr("id");

      Swal.fire({
        title: 'Do you want to delete?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {

          $.ajax({
            url: '../resources/templates/back/productdelete.php',
            type: 'post',
            data: {
              pidd: id
            },
            success: function(data) {
              tdh.parents('tr').hide();
            }

          });

          Swal.fire(
            'Deleted!',
            'Your Product has been deleted.',
            'success'
          )
        }
      })

    });

  });
</script>


<!-- taxdis -->

<script>
  $(document).ready(function() {
    $('#table_tax').DataTable();
  });
</script>



<!-- tablereport -->

<!-- InputMask -->
<script src="../plugins/moment/moment.min.js"></script>

<!-- date-range-picker -->
<script src="../plugins/daterangepicker/daterangepicker.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
  $('#print-btn').click(function() {
    var nw = window.open("print_category", "_blank", "height=500,width=800")
    setTimeout(function() {
      nw.print()
      setTimeout(function() {
        nw.close()
      }, 500)
    }, 1000)
  })
  $('#print-btnre_repot').click(function() {
    var nw = window.open("print_tablereport", "_blank", "height=500,width=800")
    setTimeout(function() {
      nw.print()
      setTimeout(function() {
        nw.close()
      }, 500)
    }, 1000)
  })




  //Date picker
  $('#date_1').datetimepicker({
    format: 'DD-MM-YYYY'
  });


  //Date picker
  $('#date_2').datetimepicker({
    format: 'DD-MM-YYYY'
  });

  $('#date_22').datetimepicker({
    format: 'YYYY-MM-DD'
  });
  $('#date_11').datetimepicker({
    format: 'YYYY-MM-DD'
  });
</script>

<script>
  $(document).ready(function() {
    $('#table_report').DataTable({

      "order": [
        [0, "desc"]
      ]
    });
  });
</script>

<!-- dashboard -->
<script>
  $(document).ready(function() {
    $('#table_recentorder').DataTable({

      "order": [
        [0, "desc"]
      ]
    });
  });







  // $(document).ready(function() {
  //     $('#table_bestsellingproduct').DataTable({


  //     });
  // });

  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })




  $(".search").keyup(function() {

    var search = $(this).val();
    var perPage = $('.search').val();

    $.ajax({
      url: '../resources/templates/back/studen_search.php',
      method: 'get',
      data: {
        search: search

      },
      success: function(data) {

        $('#content_show').html(data);
        $('#content_show').append(data.htmlresponse);
      }
    })
  })

  $('.perpage').change('click', function() {

    var perPage = $(this).val();
    $("#search").val('');

    $.ajax({
      url: '../resources/templates/back/studen_search.php',
      method: 'get',
      data: {
        perPage: perPage

      },
      success: function(data) {
        $('#content_show').html(data);
        $('#content_show').append(data.htmlresponse);

      }
    });
  });
</script>

</body>

</html>
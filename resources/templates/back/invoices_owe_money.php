<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">សងប្រាក់</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-8">
                                <div align="center">
                                    <?php display_message(); ?>

                                    <?php
                                    if (isset($_GET['id'])) {

                                        $query =  query("SELECT * FROM debtors WHERE id= " . escape_string($_GET['id']) . "");
                                        confirm($query);

                                        while ($row = fetch_array($query)) {

                                            $id       = escape_string($row['id']);
                                            $name       = escape_string($row['name']);
                                            $product      = escape_string($row['product']);
                                            $owe_money      = escape_string($row['owe_money']);
                                            $date      = escape_string($row['date']);
                                        }
                                    }
                                    ?>
                                    <h2 style=" font-family:Khmer OS Muol Light;"> <img src="../productimages/download.png" style="width: 77px; padding: 10px ;" alt="">ស្ថានីយ៍ប្រេងឥន្ធនៈ TELA ស្វាយកាំបិត</h2>
                                </div>


                                <div class="col-md-12 nameoder">

                                    <br><br>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ល.រ</th>
                                                <th>ឈ្មោះអតិថិជន</th>
                                                <th>ប្រភេទ</th>
                                                <th>ប្រាក់ជំពាក់</th>
                                                <th>ថ្ងៃខែ</th>

                                            </tr>
                                        </thead>

                                        <tbody>
     
                                            <?php show_invoices_owe(); ?>


                                        </tbody>


                                    </table>


                                </div>

                            </div>

                            <div class="co-md-4">
                                <button type="button" class="btn btn-primary owe_money" id="print-btn">សងប្រាក់</button></td>
                            </div>

                            <div class="co-md-4">

                                <table class="table table-bordered table-striped table-owe" id="print-btn">
                                    <thead>
                                        <tr>
                                            <th colspan='2'>
                                                <p style="text-align: center;">ប្រវត្តសងប្រាក់</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>ថ្ងៃខែ</th>
                                            <th>ចំនួនប្រាក់</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>
                                    <?php show_repayment_owe() ?>

                                    </tbody>


                                </table>
                            </div>

                            <?php repayment(); ?>
                            <!-- Modal -->
                            <div class="modal fade" id="deitmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" style="font-family:Khmer OS Battambang;">សងប្រាក់</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="" method="post" enctype="multipart/form-data">

                                                <div class="form-group">

                                                    <input type="text" name="Repayment" class="form-control" required>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="repayment" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                // សងប្រាក់
                                $(document).ready(function() {
                                    $('.owe_money').on('click', function() {
                                        $('#deitmodal').modal('show');

                                        $tr = $(this).closest('tr');
                                        var data = $tr.children("th").map(function() {
                                            return $(this).text();
                                        }).get();

                                        console.log(data);
                                        $('#riel').val(data[1]);
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
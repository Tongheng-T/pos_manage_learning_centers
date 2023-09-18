<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">ព័ត៌មានអ្នកជំពាក់ប្រាក់</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <button onclick="history.back()" class="btn-info"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Go Back</button>
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

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">ព័ត៌មានអ្នកជំពាក់ប្រាក់</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">

                            <?php display_message(); ?>

                            <div class="col-md-8">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="background: #97ecff;">
                                            <th>ល.រ</th>
                                            <th>id</th>
                                            <th>ឈ្មោះអតិថិជន</th>
                                            <th>ទំនិញ</th>
                                            <th>ប្រាក់ជំពាក់</th>
                                            <th>ថ្ងៃខែ</th>
                                            <th>សងប្រាក់</th>
                                            <th style="font-family:Khmer OS Battambang;">លុប</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php owe_money_all(); ?>

                                    </tbody>
                                </table>

                            </div>


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
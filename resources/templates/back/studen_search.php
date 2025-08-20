<?php

require_once("../../config.php");


display_message();


if (isset($_GET['search'])) {

    $search = $_GET['search'];
    $_SESSION['search'] = $search;
} else {

    $search = '';
    $_SESSION['search'] = $search;
}

if (isset($_GET['perPage'])) {

    $perPage = $_GET['perPage'];
    $_SESSION['perPage'] = $perPage;
} else {

    $perPage = 10;
    $_SESSION['perPage'] = $perPage;
}


?>




<table class="table table-striped table-hover ">
    <thead class="bg_color">
        <tr>
            <th>N0</th>
            <th>id</th>
            <th>ឈ្មោះខ្មែរ</th>
            <th>ឈ្មោះឡាតាំង</th>
            <th>ភេទ</th>
            <th>ថ្ងៃខែឆ្នាំកំណើត</th>
            <!-- <th>លេខទូរសព្ទ</th> -->
            <th>មុខវិជ្ជា</th>
            <th>គ្រូបង្រៀន</th>
    
            <th>គិតជា</th>
            <th>ថ្ងៃខែចូលរៀន</th>
            <th>ActionIcons</th>

        </tr>

    </thead>


    <tbody>

        <?php tudentslist($search); ?>



        <script>
            $(function() {

                $('.view').on('click', function() {
                    var id = $(this).attr("id");
                    $.ajax({
                        url: "../resources/templates/back/viewtudents.php",
                        method: "get",
                        data: {
                            id: id
                        },
                        success: function(data) {

                            $('#view').html(data);
                            $('#view').append(data.htmlresponse);

                        }

                    });
                })


            });

            $('.payroll').on('click', function() {
                var id = $(this).attr("id");
                $.ajax({
                    url: "../resources/templates/back/Payroll_pay_tudents.php",
                    method: "post",
                    data: {
                        id: id
                    },
                    success: function(data) {

                        $('#payroll').html(data);
                        $('#payroll').append(data.htmlresponse);

                    }

                });
            })


            $('.btnedit').on('click', function() {
                var id = $(this).attr("id");
                $.ajax({
                    url: "../resources/templates/back/edit_tudents.php",
                    method: "get",
                    data: {
                        id: id
                    },
                    success: function(data) {

                        $('#teacheredit').html(data);
                        $('#teacheredit').append(data.htmlresponse);

                    }

                });
            })

            $('.btnadd').on('click', function() {

                $.ajax({
                    url: "../resources/templates/back/pos.php",
                    success: function(data) {
                        $('#showadd').html(data);
                        $('#showadd').append(data.htmlresponse);
                    }
                });
            })

            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                const href = $(this).attr('href')
                Swal.fire({
                    title: "លុបឈ្មោះសិស្ស!",
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



            $('.sd_page').on('click', function() {
                var page = $(this).attr("page");
                var perPage = $('.perpage').val();


                $.ajax({
                    url: '../resources/templates/back/studen_search.php',
                    method: 'get',
                    data: {
                        page: page,
                        perPage: perPage

                    },
                    success: function(data) {

                        $('#content_show').html(data);
                        $('#content_show').append(data.htmlresponse);
                    }
                })
            })
        </script>
<?php

include_once '../../config.php';

$productid = $_GET["id"];
$year = $_GET["year"];
// $car = $_GET["car"];
// if (!empty($_GET['car'])) {
//     $car = $_GET["car"];
// }else{
//     $car = 0;
// }



$selectt = query("SELECT * from tbl_subject where sj_id=$productid");
confirm($selectt);

$roww = $selectt->fetch_assoc();


// if (!empty($_GET['sdi_id'])) {
//     $sdi_id = $_GET["sdi_id"];
//     $select = query("SELECT * from tbl_studytime where sdi_id=$sdi_id");
//     confirm($select);
//     $row = $select->fetch_assoc();

//     $time = $row['qty'];
// } else {
//     $time = 1;
// }


 
if($year == "session") {
    $price = $roww['price_session'] ;
    
}else {
    $price = $roww['sj_price'] ; 
    
}
$show_price  = $price ;
// $("#txtbarcode_id").val("");
echo ' <label>តម្លៃសិក្សារ</label>
          <input type="text" class="form-control" placeholder="តម្លៃសិក្សារ" value="' . $show_price . '" name="txtprice" >';

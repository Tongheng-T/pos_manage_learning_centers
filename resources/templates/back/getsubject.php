<?php

include_once '../../config.php';

$productid = $_GET["id"];


$select = query("SELECT * from tbl_subject where sj_id=$productid");
confirm($select);

$row = $select->fetch_assoc();

$response = $row;

header('Content-Type: application/json');

echo json_encode($response);

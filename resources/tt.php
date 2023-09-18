<?php
require_once("config.php");


if (isset($_POST["From"])) {
    $id_name = ($_POST['id_name']);
    $From = ($_POST['From']);
    $result = explode('-',$From);
    $date =$result[2];
    $month =$result[1];
    $year =$result[0];

    $new = $year.'-'.$month;
    $query = query("SELECT * FROM employee_salar WHERE id_name =  $id_name and date like '{$new}%' ");
    $query_staff = query("SELECT * FROM staff WHERE id_staff =  $id_name");
    while ($row = fetch_array($query_staff)) {
        $query_stafff =  $row['Salary'];
    }
    if (mysqli_num_rows($query) > 0) {
            $total=0;
            while ($row = fetch_array($query)) {
                $money =  $row['money'];
                $total = $query_stafff - $money;
            }
            $result = <<<DELIMETER
                <div class="col-md-4 top" >
                    <input type="text" name="money" class="form-control" value="$total">
                  </div>
                  <div class="col_md_8">
                  <button type="submit" name="submit" class="btn btn-success">
                      <i class="fas fa-cloud-download-alt"></i>
                  </button>
               </div>
             DELIMETER;
        
    }else{
        $result = <<<DELIMETER
                <div class="col-md-4 top" >
                    <input type="text" name="money" class="form-control" value="$query_stafff">
                </div>
                <div class="col_md_8">
                <button type="submit" name="submit" class="btn btn-success">
                      <i class="fas fa-cloud-download-alt"></i>
                </button>
                </div>

     DELIMETER;
    }
    echo $result;
}

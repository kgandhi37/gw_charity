<?php

include "db_connect.php";

$result = mysqli_query($connect, "select * from suggestions ORDER BY id DESC");

$data = array();

while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
    print json_encode($data);

?>
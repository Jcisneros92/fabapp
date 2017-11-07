<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/header.php');
if (!$staff || $staff->getRoleID() < 7){
    //Not Authorized to see this Page
    header('Location: index.php');

}
?>

<div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <i class="fa fa-linode fa-fw"></i> Inventory

                </div>

            <div class="panel panel-default">
                <div class="panel-heading">

<?php


$conn = new mysqli('localhost', 'root', '', 'fabapp-v0.9');

echo "---30 days---"."<br>"."<br>";
$sql = "SELECT unit_used FROM  mats_used WHERE date BETWEEN '2017-09-03 00:00:01' AND '2017-10-03 00:00:01'";
$result = $conn->query($sql);

$sql2 =  "SELECT * FROM  materials WHERE m_parent = 1";
$result2 = $conn->query($sql2);

$a = 0.00;
while($row2 = $result2->fetch_assoc()) {
  $name = $row2["m_name"];
  $name_id = $row2["m_id"];


$sql = "SELECT * FROM  mats_used WHERE date BETWEEN '2017-09-03 00:00:01' AND '2017-10-03 00:00:01'";
$result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
      if(($row["m_id"] == $name_id) && ($row["unit_used"] < 0.00))
      {
        $a += $row["unit_used"];
      }
    }
    $a = $a*-1;
    echo $name." = ".$a." gram(s)"."<br>";
    $a = 0.00;
}

$sql = "SELECT * FROM  mats_used WHERE date BETWEEN '2017-09-03 00:00:01' AND '2017-10-03 00:00:01'";
$result = $conn->query($sql);

$sql2 =  "SELECT * FROM  materials WHERE m_parent = 7";
$result2 = $conn->query($sql2);

$a = 0.00;
while($row2 = $result2->fetch_assoc()) {
  $name = $row2["m_name"];
  $name_id = $row2["m_id"];

$sql = "SELECT * FROM  mats_used WHERE date BETWEEN '2017-09-03 00:00:01' AND '2017-10-03 00:00:01'";
$result = $conn->query($sql);


    while($row = $result->fetch_assoc()) {
      if(($row["m_id"] == $name_id) && ($row["unit_used"] < 0.00))
      {
        $a += $row["unit_used"];
      }
    }
    $a = $a*-1;
    echo $name." = ".$a." gram(s)"."<br>";
    $a = 0.00;
}






echo "<br>"."<br>"."---90 days---"."<br>"."<br>";

$sql = "SELECT unit_used FROM  mats_used WHERE date BETWEEN '2017-07-05 00:00:01' AND '2017-10-10 00:00:01'";
$result = $conn->query($sql);

$sql2 =  "SELECT * FROM  materials WHERE m_parent = 1";
$result2 = $conn->query($sql2);

$a = 0.00;
while($row2 = $result2->fetch_assoc()) {
  $name = $row2["m_name"];
  $name_id = $row2["m_id"];


$sql = "SELECT * FROM  mats_used WHERE date BETWEEN '2017-07-05 00:00:01' AND '2017-10-10 00:00:01'";
$result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
      if(($row["m_id"] == $name_id) && ($row["unit_used"] < 0.00))
      {
        $a += $row["unit_used"];
      }
    }
    $a = $a*-1;
    $a = $a/90;
    $a = $a*30;
    echo $name." = ".(int)$a." gram(s)"."<br>";
    $a = 0.00;
}

$sql = "SELECT * FROM  mats_used WHERE date BETWEEN '2017-07-05 00:00:01' AND '2017-10-10 00:00:01'";
$result = $conn->query($sql);

$sql2 =  "SELECT * FROM  materials WHERE m_parent = 7";
$result2 = $conn->query($sql2);

$a = 0.00;
while($row2 = $result2->fetch_assoc()) {
  $name = $row2["m_name"];
  $name_id = $row2["m_id"];

$sql = "SELECT * FROM  mats_used WHERE date BETWEEN '2017-07-05 00:00:01' AND '2017-10-10 00:00:01'";
$result = $conn->query($sql);


    while($row = $result->fetch_assoc()) {
      if(($row["m_id"] == $name_id) && ($row["unit_used"] < 0.00))
      {
        $a += $row["unit_used"];
      }
    }
    $a = $a*-1;
    $a = $a/90;
    $a = $a*30;
    echo $name." = ".(int)$a." gram(s)"."<br>";
    $a = 0.00;
}










echo "<br>"."<br>"."---180 days---"."<br>"."<br>";

$sql = "SELECT unit_used FROM  mats_used WHERE date BETWEEN '2017-04-05 00:00:01' AND '2017-10-10 00:00:01'";
$result = $conn->query($sql);

$sql2 =  "SELECT * FROM  materials WHERE m_parent = 1";
$result2 = $conn->query($sql2);

$a = 0.00;
while($row2 = $result2->fetch_assoc()) {
  $name = $row2["m_name"];
  $name_id = $row2["m_id"];


$sql = "SELECT * FROM  mats_used WHERE date BETWEEN '2017-04-05 00:00:01' AND '2017-10-10 00:00:01'";
$result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
      if(($row["m_id"] == $name_id) && ($row["unit_used"] < 0.00))
      {
        $a += $row["unit_used"];
      }
    }
    $a = $a*-1;
    $a = $a/180;
    $a = $a*30;
    echo $name." = ".(int)$a." gram(s)"."<br>";
    $a = 0.00;
}

$sql = "SELECT * FROM  mats_used WHERE date BETWEEN '2017-04-05 00:00:01' AND '2017-10-10 00:00:01'";
$result = $conn->query($sql);

$sql2 =  "SELECT * FROM  materials WHERE m_parent = 7";
$result2 = $conn->query($sql2);

$a = 0.00;
while($row2 = $result2->fetch_assoc()) {
  $name = $row2["m_name"];
  $name_id = $row2["m_id"];

$sql = "SELECT * FROM  mats_used WHERE date BETWEEN '2017-04-05 00:00:01' AND '2017-10-10 00:00:01'";
$result = $conn->query($sql);


    while($row = $result->fetch_assoc()) {
      if(($row["m_id"] == $name_id) && ($row["unit_used"] < 0.00))
      {
        $a += $row["unit_used"];
      }
    }
    $a = $a*-1;
    $a = $a/180;
    $a = $a*30;
    echo $name." = ".(int)$a." gram(s)"."<br>";
    $a = 0.00;
}

$conn->close();






?>
</div>
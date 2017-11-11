<?php
//connect to server
$servername ="localhost";
$username="root";
$password="";
$dbname="fabapp-v0.9";
//connect to server
$conn= mysqli_connect($servername, $username, $password, $dbname);
//check connection
if(!$conn) {
  die("Connection failed: ".mysqli_connect_error());
}
//grab values from inventory_edit (New Materials Window)
$type=$_POST["type"];
$color=$_POST["color"];
$serial=$_POST["serial"];
$qty=$_POST["qty"];
$unit="";
$m_parent=0;
$m_name=$type." ".$color;
if ($type=="ABS") {
  $unit="grams(s)";
  $m_parent=1;
}
else if ($type=="Vinyl") {
  $unit="inch(es)";
  $m_parent=7;
}
else {
  $unit =" ";
  $m_parent=0;
}
$sql = "INSERT INTO materials (m_name, m_parent, unit) VALUES ('$m_name', '$m_parent', '$unit')";
if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
 ?>
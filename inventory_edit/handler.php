<?php
$conn = new mysqli('localhost', 'root', '', 'fabapp-v0.9');
$query = "INSERT INTO `materials` (m_name, m_parent, price, unit, color_hex, measurable)VALUES ('tape', 1, NULL, 'gram(s)', NULL, 'Y')";

$quantity = $_GET['quantity'];

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if($quantity < 100)
{
	if(mysqli_query($conn, $query))
	{
		echo "Records inserted successfully.";
	} 
	else
	{
		echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
	}
	
	echo $quantity;
}

else
{
	header("Location: http://localhost/inventory_edit/index.php");
}

mysqli_close($conn);
?>
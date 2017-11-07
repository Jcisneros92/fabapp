<?php
/*
 *   CC BY-NC-AS UTA FabLab 2016-2017
 *   FabApp V 0.9
 */
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/header.php');
if (!$staff || $staff->getRoleID() < 7){
    //Not Authorized to see this Page
    header('Location: index.php');
}
?>



<!-- ##### connection and list array creation #####-->
<?php
$arr = array();

$conn = new mysqli('localhost', 'root', '', 'fabapp-v0.9');
$sql = "SELECT m_name FROM  materials WHERE m_parent = 1";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
  $name = $row["m_name"];
  array_push($arr, $name);
}
?>
<!-- ##### end of connection and list array creation #####-->


<html>


<script>
function validate() {
	
	var quantityNum = document.getElementById('quan');
	
	if(quan.value == '')
	{
		alert('please enter a quantity');
		return false;
	}
}
</script>





<head>
</head>
<body>

</form>
<div style= "text-align: center">
<form method="get" action="handler.php">

<!-- ##### color name and list #####-->
<label>Color: </label>
<?php
echo '<select name = "color">';
for($i = 0; $i < count($arr); $i++)
{
	echo '<option>'.$arr[$i].'</option>';
}
echo '</select>';
?>
<!-- ##### end of color name and list #####-->



<label>Quantity: </label>
<input type="text" id="quan" name="quantity" />
<br/>

<input type="submit" name="submit" id="submit" value="submit here">


</form>




</body>
</html>



<?php
//Standard call for dependencies
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
?>
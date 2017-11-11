<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/header.php');
if (!$staff || $staff->getRoleID() < 7){
    //Not Authorized to see this Page
    header('Location: index.php');

}
?>



<html>


<script>
function validate() {
	
	var dateCheck = document.getElementById('date').value;
	
	//if(!date.parse(dateCheck))
	if(!dateCheck)
	{
		alert('Please enter a date');
		return false;
	}
	
	
}
</script>



<head>
</head>
<body>
<title><?php echo $sv['site_name'];?> Add Inventory</title>
<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
			<h1 class="page-header">Future Inventory Estimation</h1>
        </div>
        <!-- /.col-md-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-8">
		<div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-ticket fa-fw"></i> 1.Select material/color <br /> 2.Select end date <br /> 3.Enter amount of days before end date
                </div>
                <div class="panel-body">
					<form method="post" action="" onsubmit="return validate()" autocomplete='off'>

					<!-- ##### color name and list #####-->
					<label>Material/Color: </label>
					<select name = "select_value_comes_from_option's_value">
						<option hidden disabled selected>Select</option>
						<?php
						$arr = array();
						//you need to request both the unique identifier and the description
						$sql = "SELECT `m_id`, `m_name` FROM  `materials` WHERE `m_parent` = 1 OR `m_parent` = 7 ORDER BY `m_name`";
						$result = $mysqli->query($sql);

						while($row = $result->fetch_assoc()) {
							echo "<option value=$row[m_id]>$row[m_name]</option>";
						}
						?>
					</select>
					<!-- ##### end of color name and list #####-->
					<br/>
					<label>End Date: </label>
					<input type="date" id="date" name="dateName" />
					<br/>
					<label>Enter Days: </label>
					<input type="number" id= "numberID" name="numberName" />
					<br/>

					<input type="submit" name="submitButton" id="submit" value="submit here">
					</form>
				</div>
            </div>
        </div>
	</div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
</body>
</html>


<div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <i class="fa fa-linode fa-fw"></i> RESULT

                </div>

            <div class="panel panel-default">
                <div class="panel-heading">


				
<?php				
	if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submitButton"]) ){
	//  At this point you need to decide where you want to scrub the user input
	//	You must be aware that they user could have malicious intent, see SQL injection
	//	Here I can already assume that this value must be an integar and it must already
	//	exist in the device_group table.  I will call a static function to verify this.
	//$quantity = filter_input(INPUT_POST,'quantity');
	$endDate = filter_input(INPUT_POST,"dateName");
	$selection = filter_input(INPUT_POST,"select_value_comes_from_option's_value");
	$numberSelection = filter_input(INPUT_POST,"numberName");
	
	
	$finalNumber = "$numberSelection"." days";
	
	$subtractedDate = date_create("$endDate");
	date_sub($subtractedDate, date_interval_create_from_date_string($finalNumber));
	

	$startDate = $subtractedDate->format('Y-m-d');

	$finalEndDate = $endDate.' 00:00:01';
	$finalStartDate = $startDate.' 00:00:01';
		

	
$conn = new mysqli('localhost', 'root', '', 'fabapp-v0.9');

echo "<strong>Date= $startDate to $endDate</strong>"."<br>"."<br>";

$a = 0.00;
$sql = "SELECT * FROM  mats_used WHERE date BETWEEN '$finalStartDate' AND '$finalEndDate' AND m_id = '$selection'";




$matNameQuery = "SELECT m_name FROM  materials WHERE m_id = '$selection'";
$resultt = mysqli_query($conn, $matNameQuery);
$row = mysqli_fetch_row($resultt);
$materialName = $row[0];







$result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
      if($row["unit_used"] < 0.00)
      {
        $a += $row["unit_used"];
      }
    }
    $a = $a*-1;
    echo "<strong>$materialName = $a gram(s)</strong>"."<br>";
    $a = 0.00;
	
	
	$conn->close();
}
	

?>
				
				
</div>
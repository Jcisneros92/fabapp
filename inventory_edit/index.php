<?php
/*
 *   CC BY-NC-AS UTA FabLab 2016-2017
 *   FabApp V 0.9
 */
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/header.php');
if (!$staff || $staff->getRoleID() < 7){
    //Not Authorized to see this Page
    header('Location: /index.php');
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["maybe_don't_use_generic_names_for_btns"]) ){
	//  At this point you need to decide where you want to scrub the user input
	//	You must be aware that they user could have malicious intent, see SQL injection
	//	Here I can already assume that this value must be an integar and it must already
	//	exist in the device_group table.  I will call a static function to verify this.
	$quantity = filter_input(INPUT_POST,'quantity');
	$selection = filter_input(INPUT_POST,"select_value_comes_from_option's_value");

	//if someone types in a string what will happen to your code?
	if($quantity < 100)
	{
		echo "<script> alert('Qty = $quantity, Material ID = $selection')</script>";
	}

	else
	{
		header("Location:/inventory_edit/index.php");
	}
}
	
?>



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
<title><?php echo $sv['site_name'];?> Add Inventory</title>
<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
			<h1 class="page-header">Page Name</h1>
        </div>
        <!-- /.col-md-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-8">
		<div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-ticket fa-fw"></i> refer to the base.php file that I sent you.
                </div>
                <div class="panel-body">
					<form method="post" action="" onsubmit="return validate()" autocomplete='off'>

					<!-- ##### color name and list #####-->
					<label>Color: </label>
					<select name = "select_value_comes_from_option's_value">
						<option hidden disabled selected>Select</option>
						<?php
						$arr = array();
						//you need to request both the unique identifier and the description
						$sql = "SELECT `m_id`, `m_name` FROM  `materials` WHERE `m_parent` = 1";
						$result = $mysqli->query($sql);

						while($row = $result->fetch_assoc()) {
							echo "<option value=$row[m_id]>$row[m_name]</option>";
						}
						?>
					</select>
					<!-- ##### end of color name and list #####-->
					<label>Quantity: </label>
					<input type="text" id="quan" name="quantity" />
					<br/>

					<input type="submit" name="maybe_don't_use_generic_names_for_btns" id="submit" value="submit here">
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



<?php
//Standard call for dependencies
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
?>
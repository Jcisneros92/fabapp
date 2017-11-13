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
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel ="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.tab {display:none}
</style>
<title><?php echo $sv['site_name'];?> Inventory</title>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Inventory</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-linode fa-fw"></i> Inventory
                    <!-- Code for the button and the modal STARTS HERE -->
                    <div class ="pull-right"> <!--  direction of button -->
                      <div class="btn-group">
                        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-default btn-xs">Add Material</button>

                        <div id="id01" class="w3-modal">
                          <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
                            <header class="w3-container w3-light-blue">
                              <span onclick="document.getElementById('id01').style.display='none'"
                              class="w3-button w3-blue w3-large w3-display-topright">&times;</span>
                              <h2>Add Inventory</h2>
                            </header>

                            <div class="w3-bar w3-border-bottom">
                              <button class="tablink w3-bar-item w3-button" onclick="openTab(event, 'New')">New Material</button>
                              <button class="tablink w3-bar-item w3-button" onclick="openTab(event, 'Existing')">Existing Inventory</button>
                            </div>
                            <!-- The body of the container modal -->
                            <!-- Existing Material -->

                            <div id="Existing" class="w3-container tab w3-center">
                              <h1>Existing</h1>
                              <form class "w3-container" action="action2_page.php" method="post">
                              <div class ="w3-section">
                                  <select name="type">
                                    <option value="abs">ABS</option>
                                    <option value="vinyl">Vinyl</option>
                                  </select>
                                  <br><br>
                                <br><label><b>Color</b></label><br>
                                <input class"w3-input w3-border w3-margin-bottom" type="text" placeholder="Color" name="color" required><br>

                                <label><b>Qty of Material</b></label><br>
                                <input class"w3-input w3-border w3-margin-bottom" type="amount" placeholder="Amount (grams)" name="qty" required><br>

                                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Add</button>
                              </form>
                              </div>
                            </div>
                            <!-- End of Existing Material -->
                            <!-- New Material-->

                            <div id="New" class="w3-container tab w3-center">
                              <h1>New</h1>
                              <form class="w3-container" action="actions_page.php" method="post">
                              <div class ="w3-section">
                                <label><b>Type:</b></label><br>
                                <input class"w3-input w3-border w3-margin-bottom" type="text" placeholder="Type" name="type" required><br>

                                <label><b>Color:</b></label><br>
                                <input class "w3-input w3-border w3-margin-bottom" type="text" placeholder="Color" name="color" required><br>

                                <label><b>Serial #:</b></label><br>
                                <input class"w3-input w3-border w3-margin-bottom" type="serial" placeholder="Serial Number" name="serial" required><br>

                                <label><b>Qty of Material:</b></label><br>
                                <input class"w3-input w3-border w3-margin-bottom" type="amount" placeholder="Amount (grams)" name="qty" required><br>

                                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Add</button>
                              </div>
                            </form>
                            </div>

                            <!-- End of New Material -->
                            <!-- End of body of the modal container -->

                            <! -- Code for the look of the modal container -->
                            <div class="w3-container w3-light-grey w3-padding">
                              <button class="w3-button w3-right w3-white w3-border"
                              onclick="document.getElementById('id01').style.display='none'">Close</button>
                            </div>
                          </div>
                        </div>

                        <!--- java script for the multtiple tab for the modal container -->
                        <script>
                        document.getElementByClassName("tablink")[0].click();

                        function openTab(evt, tabName) {
                          var i, x, tablinks;
                          x = document.getElementsByClassName("tab");
                          for (i=0; i < x.length;i++) {
                            x[i].style.display = "none";
                          }
                          tablinks = document.getElementsByClassName("tablink");
                          for (i=0; i < x.length; i++) {
                          tablinks[i].classList.remove("w3-light-grey");
                          }
                          document.getElementById(tabName).style.display="block";
                          evt.currentTarget.classList.add("w3-light-grey");
                        }
                        </script>

                        <!---------- Modal Button Ends Here ------------>

                      </div>
                    </div>
                </div>
                <div class="panel-body">
                  <table class="table table-condensed">

                    <thead>
                      <tr>
                        <th>Material</th>
                        <th><i class="fa fa-paint-brush fa-fw"></i></th>

                        <?php if ($staff && $staff->getRoleID() >= $sv['LvlOfStaff']){
                        ?>
                           <th>Qty on Hand</th>
                         <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                    <?php //Display Inventory Based on device group
                    if($result = $mysqli->query("
                        SELECT `m_name`, SUM(unit_used) as `sum`, `color_hex`, `unit`
                        FROM `materials`
                        LEFT JOIN `mats_used`
                        ON mats_used.m_id = `materials`.`m_id`
                        WHERE `m_parent` = 1
                        GROUP BY `m_name`, `color_hex`, `unit`
                        ORDER BY `m_name` ASC;
                    ")){
                        while ($row = $result->fetch_assoc()){
                            if ($staff && $staff->getRoleID() >= $sv['LvlOfStaff']){ ?>
                                <tr>
                                    <td><?php echo $row['m_name']; ?></td>
                                    <td><div class="color-box" style="background-color: #<?php echo $row['color_hex'];?>;"/></td>
                                    <td><?php echo number_format($row['sum'])." ".$row['unit']; ?></td>
                                </tr>
                            <?php } else {?>
                                <tr>
                                    <td><?php echo $row['m_name']; ?></td>
                                    <td><div class="color-box" style="background-color: #<?php echo $row['color_hex'];?>;"/></td>
                                </tr>
                            <?php }
                        }
                    } else { ?>
                        <tr><td colspan="3">None</td></tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
            <!-- /.panel-body -->
          </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-md-10 -->
    </div>
    <!-- /.row -->
</div>
<!-- end code for ABS TABLE -->

<!-- start code for VINYL TABLE -->
<div id="page-wrapper">
<div class="row">
<div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <i class="fa fa-linode fa-fw"></i> Inventory

                    <!-- Code for the button and the modal STARTS HERE -->
                    <div class ="pull-right"> <!--  direction of button -->
                      <div class="btn-group">
                        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-default btn-xs">Add Material</button>

                        <div id="id01" class="w3-modal">
                          <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
                            <header class="w3-container w3-light-blue">
                              <span onclick="document.getElementById('id01').style.display='none'"
                              class="w3-button w3-blue w3-large w3-display-topright">&times;</span>
                              <h2>Add Inventory</h2>
                            </header>

                            <div class="w3-bar w3-border-bottom">
                              <button class="tablink w3-bar-item w3-button" onclick="openTab(event, 'New')">New Material</button>
                              <button class="tablink w3-bar-item w3-button" onclick="openTab(event, 'Existing')">Existing Inventory</button>
                            </div>
                            <!-- The body of the container modal -->
                            <!-- Existing Material -->

                            <div id="Existing" class="w3-container tab w3-center">
                              <h1>Existing</h1>
                              <form class "w3-container" action="action2_page.php" method="post">
                              <div class ="w3-section">
                                  <select name="type">
                                    <option value="abs">ABS</option>
                                    <option value="vinyl">Vinyl</option>
                                  </select>
                                  <br><br>
                                <br><label><b>Color</b></label><br>
                                <input class"w3-input w3-border w3-margin-bottom" type="text" placeholder="Color" name="color" required><br>

                                <label><b>Qty of Material</b></label><br>
                                <input class"w3-input w3-border w3-margin-bottom" type="amount" placeholder="Amount (grams)" name="qty" required><br>

                                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Add</button>
                              </form>
                              </div>
                            </div>
                            <!-- End of Existing Material -->
                            <!-- New Material-->

                            <div id= "New" class="w3-container tab w3-center">
                              <h1>New</h1>
                              <form class="w3-container" action="actions_page.php" method="post">
                              <div class ="w3-section">
                                <label><b>Type:</b></label><br>
                                <input class"w3-input w3-border w3-margin-bottom" type="text" placeholder="Type" name="type" required><br>

                                <label><b>Color:</b></label><br>
                                <input class "w3-input w3-border w3-margin-bottom" type="text" placeholder="Color" name="color" required><br>

                                <label><b>Serial #:</b></label><br>
                                <input class"w3-input w3-border w3-margin-bottom" type="serial" placeholder="Serial Number" name="serial" required><br>

                                <label><b>Qty of Material:</b></label><br>
                                <input class"w3-input w3-border w3-margin-bottom" type="amount" placeholder="Amount (grams)" name="qty" required><br>

                                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Add</button>
                              </div>
                            </form>
                            </div>

                            <!-- End of New Material -->
                            <!-- End of body of the modal container -->

                            <! -- Code for the look of the modal container -->
                            <div class="w3-container w3-light-grey w3-padding">
                              <button class="w3-button w3-right w3-white w3-border"
                              onclick="document.getElementById('id01').style.display='none'">Close</button>
                            </div>
                          </div>
                        </div>

                        <!--- java script for the multtiple tab for the modal container -->
                        <script>
                        document.getElementByClassName("tablink")[0].click();

                        function openTab(evt, tabName) {
                          var i, x, tablinks;
                          x = document.getElementsByClassName("tab");
                          for (i=0; i < x.length;i++) {
                            x[i].style.display = "none";
                          }
                          tablinks = document.getElementsByClassName("tablink");
                          for (i=0; i < x.length; i++) {
                          tablinks[i].classList.remove("w3-light-grey");
                          }
                          document.getElementById(tabName).style.display="block";
                          evt.currentTarget.classList.add("w3-light-grey");
                        }
                        </script>

                        <!---------- Modal Button Ends Here ------------>
                      </div>
                    </div>

                </div>
                <div class="panel-body">
                    <table class="table table-condensed">


                        <thead>
                            <tr>
                                <th>Material</th>
                                <th><i class="fa fa-paint-brush fa-fw"></i></th>
                                <?php if ($staff && $staff->getRoleID() >= $sv['LvlOfStaff']){?>
                                        <th>Qty on Hand</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php //Display Inventory Based on device group
                        if($result = $mysqli->query("
                            SELECT `m_name`, SUM(unit_used) as `sum`, `color_hex`, `unit`
                            FROM `materials`
                            LEFT JOIN `mats_used`
                            ON mats_used.m_id = `materials`.`m_id`
                            WHERE `m_parent` = 7
                            GROUP BY `m_name`, `color_hex`, `unit`
                            ORDER BY `m_name` ASC;
                        ")){
                            while ($row = $result->fetch_assoc()){
                                if ($staff && $staff->getRoleID() >= $sv['LvlOfStaff']){ ?>
                                    <tr>
                                        <td><?php echo $row['m_name']; ?></td>
                                        <td><div class="color-box" style="background-color: #<?php echo $row['color_hex'];?>;"/></td>
                                        <td><?php echo number_format($row['sum'])." ".$row['unit']; ?></td>
                                    </tr>
                                <?php } else {?>
                                    <tr>
                                        <td><?php echo $row['m_name']; ?></td>
                                        <td><div class="color-box" style="background-color: #<?php echo $row['color_hex'];?>;"/></td>
                                    </tr>
                                <?php }
                            }
                        } else { ?>
                            <tr><td colspan="3">None</td></tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
</div>
</div>





<!-- /#page-wrapper -->
<?php
//Standard call for dependencies
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
?>
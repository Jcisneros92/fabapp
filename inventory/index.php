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

<title><?php echo $sv['site_name'];?> Inventory</title>

<!-- /.col-lg-8 -->
<div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <i class="fa fa-linode fa-fw"></i> Inventory
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
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>






<div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <i class="fa fa-linode fa-fw"></i> Inventory
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










<!-- /#page-wrapper -->
<?php
//Standard call for dependencies
include_once ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
?>
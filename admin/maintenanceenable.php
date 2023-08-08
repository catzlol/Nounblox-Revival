<?php include('include.php'); ?>
<?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maintenance = addslashes($_POST['maintenance']);
    $enabled3 = addslashes($_POST['enabled3']);
    $banq = mysqli_query($link, "UPDATE `global` SET `maintenanceEnabled` = '".$enabled3."', `maintenance` = '".$maintenance."' WHERE `global`.`id` = '1'; ") or die(mysqli_error($link));
} ?>
<?php header('location: maintenance.php'); ?>
<?php include('finclude.php'); ?>
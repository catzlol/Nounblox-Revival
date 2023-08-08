<?php include('include.php'); ?>
<?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert1 = addslashes($_POST['sitealert1']);
    $enabled1 = addslashes($_POST['enabled1']);
    if($_USER['USER_PERMISSIONS'] == 'Administrator'){
    $banq = mysqli_query($link, "UPDATE `global` SET `ShowingSiteAlert1` = '".$enabled1."', `SiteAlert1` = '".$sitealert1."' WHERE `global`.`id` = '1'; ") or die(mysqli_error($link));
    }
} ?>
<?php header('location: sitealerts.php'); ?>
<?php include('finclude.php'); ?>
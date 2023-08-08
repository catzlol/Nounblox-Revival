<?php include('include.php'); ?>
<?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert4 = addslashes($_POST['sitealert4']);
    $enabled4 = addslashes($_POST['enabled4']);
    if($_USER['USER_PERMISSIONS'] == 'Administrator'){
    $banq = mysqli_query($link, "UPDATE `global` SET `ShowingSiteAlert4` = '".$enabled4."', `SiteAlert4` = '".$sitealert4."' WHERE `global`.`id` = '1'; ") or die(mysqli_error($link));
    }
} ?>
<?php header('location: sitealerts.php'); ?>
<?php include('finclude.php'); ?>
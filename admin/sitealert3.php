<?php include('include.php'); ?>
<?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert3 = addslashes($_POST['sitealert3']);
    $enabled3 = addslashes($_POST['enabled3']);
    if($_USER['USER_PERMISSIONS'] == 'Administrator'){
    $banq = mysqli_query($link, "UPDATE `global` SET `ShowingSiteAlert3` = '".$enabled3."', `SiteAlert3` = '".$sitealert3."' WHERE `global`.`id` = '1'; ") or die(mysqli_error($link));
    }
} ?>
<?php header('location: sitealerts.php'); ?>
<?php include('finclude.php'); ?>
<?php include('include.php'); ?>
<?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert2 = addslashes($_POST['sitealert2']);
    $enabled2 = addslashes($_POST['enabled2']);
    if($_USER['USER_PERMISSIONS'] == 'Administrator'){
    $banq = mysqli_query($link, "UPDATE `global` SET `ShowingSiteAlert2` = '".$enabled2."', `SiteAlert2` = '".$sitealert2."' WHERE `global`.`id` = '1'; ") or die(mysqli_error($link));
    }
} ?>
<?php header('location: sitealerts.php'); ?>
<?php include('finclude.php'); ?>
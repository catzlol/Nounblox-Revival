<?php include('include.php'); ?>
<?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert5 = addslashes($_POST['sitealert5']);
    $enabled5 = addslashes($_POST['enabled5']);
    if($_USER['USER_PERMISSIONS'] == 'Administrator'){
    $banq = mysqli_query($link, "UPDATE `global` SET `ShowingSiteAlert5` = '".$enabled5."', `SiteAlert5` = '".$sitealert5."' WHERE `global`.`id` = '1'; ") or die(mysqli_error($link));
    }
} ?>
<?php header('location: sitealerts.php'); ?>
<?php include('finclude.php'); ?>
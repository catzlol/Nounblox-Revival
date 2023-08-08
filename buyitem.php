<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/core/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/core/config.php';
//sets the item id
$id = (int)$_GET["id"];
//being able to do $item
$itemq = mysqli_query($link, "SELECT * FROM catalog WHERE id='".$id."'") or die(mysqli_error($link));
$item = mysqli_fetch_assoc($itemq);
//being able to do $owneditems
$owneditemsq = mysqli_query($link, "SELECT * FROM owned_items WHERE itemid='".$id."' AND ownerid='".$_USER['id']."'") or die(mysqli_error($link));
$owneditems = mysqli_fetch_assoc($owneditemsq);
//set $owned yes/no
if($owneditems) {$owned = 'yes';} else {$owned = 'no';}
//check if user already owns item, if yes then redirect
if($owned == 'yes') {header('location: /item.aspx?id='.$id); die();}

//do transaction
if($item['buywith'] == 'tix') {$currency = 'tix';} else {$currency = 'robux';}
if($currency == 'Tickets') {
    if($_USER['tix'] >= $item['price']) {
        $tixafterpurchase = $_USER['tix'] - $item['price'];
        mysqli_query($link, "UPDATE `users` SET `tix` = '".$tixafterpurchase."' WHERE `users`.`id` = ".$_USER['id']."; ") or die(mysqli_error($link));
        mysqli_query($link, "INSERT INTO `owned_items` (`id`, `itemid`, `ownerid`, `type`) VALUES (NULL, '".$id."', '".$_USER['id']."', '".$item['type']."'); ") or die(mysqli_error($link));
    } else {
        die('<h1>You don\'t have enough '.$tixname.'!</h1>');
    }
} else {
    if($_USER['robux'] >= $item['price']) {
        $buxafterpurchase = $_USER['robux'] - $item['price'];
        mysqli_query($link, "UPDATE `users` SET `robux` = '".$buxafterpurchase."' WHERE `users`.`id` = ".$_USER['id']."; ") or die(mysqli_error($link));
        mysqli_query($link, "INSERT INTO `owned_items` (`id`, `itemid`, `ownerid`, `type`) VALUES (NULL, '".$id."', '".$_USER['id']."', '".$item['type']."'); ") or die(mysqli_error($link));
    } else {
        die('<h1>You don\'t have enough '.$robuxname.'!</h1>');
    }
}
header('location: /item.aspx?id='.$id);
?>
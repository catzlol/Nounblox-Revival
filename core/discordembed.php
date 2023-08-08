<?php $embedurl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; ?>
<?php if(!$embedtitle){ $embedtitle = $title; } ?>
<?php if(!$embeddescription){ $embeddescription = $defaultdescription; } ?>
<?php if(!$embedimage){ $embedimage = $embedurl."/images/embedicon.png"; } ?>


                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="Content-Language" content="en-us"/>
		<meta name="author" content="<?=$company;?>"/>
		<meta name="description" content="<?=$embeddescription;?>"/>
		<meta name="keywords" content="game, video game, building game, contstruction game, online game, LEGO game, LEGO, MMO, MMORPG, virtual world, avatar chat"/>
		<meta name="robots" content="all">
		<meta name="theme-color" content="#FF0000"/>
		<meta property="og:title" content="<?=$embedtitle;?>"/>
		<meta property="og:site_name" content="<?=$sitename;?> - <?=$motto;?>"/>
		<meta property="og:url" content="<?=$embedurl;?>"/>
		<meta property="og:description" content="<?=$embeddescription;?>"/>
		<meta property="og:type" content="website"/>
		<meta property="og:image" content="<?=$embedimage;?>"/>
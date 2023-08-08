<?php
require_once 'core/config.php';



$mthing = "Most Popular";

if($_GET['m'] == "TopFavorites"){
$mthing = "Top Favorites";
}

if($_GET['m'] == "RecentlyUpdated"){
$mthing = "Recently Updated";
}



$tthing = "Now";

if($_GET['t'] == "PastDay"){
$tthing = "Past Day";
}

if($_GET['t'] == "PastWeek"){
$tthing = "Past Week";
}

if($_GET['t'] == "PastMonth"){
$tthing = "Past Month";
}

if($_GET['t'] == "AllTime"){
$tthing = "All Time";
}

if($mthing != "Recently Updated"){
$tthingfortitle = " (".$tthing.")";
}

$title = $sitename." Games - ".$mthing.$tthingfortitle;
include 'core/header.php';
include 'core/nav.php';


$czech = mysqli_query($link, "SELECT * FROM games");
$ohyea = mysqli_num_rows($czech);


$embeddescription = $sitename." currently has ".$ohyea." exciting games you can play!";

include 'core/discordembed.php';



$resultsperpage = 15;

$check = mysqli_query($link, "SELECT * FROM games");
                    $usercount = mysqli_num_rows($check);

                    $numberofpages = ceil($usercount/$resultsperpage);

if(!isset($_GET['p'])) {
                        $page = 1;
                    }else{
                        $page = (int)addslashes($_GET['p']);
                    }
$prev = $page - 1; $next = $page + 1;
?>
<br>

    <div id="GamesContainer">
        
<div id="ctl00_cphRoblox_rbxGames_GamesContainerPanel">
  <?php $sel = '<img id="ctl00_cphRoblox_rbxGames_MostPopularBullet" class="GamesBullet" src="/images/games_bullet.png" border="0"/>'; ?>
    <div class="DisplayFilters">
      <h2>Games&nbsp;<a id="ctl00_cphRoblox_rbxGames_hlNewsFeed" href="/games.aspx?feed=rss"><img src="/images/feed-icon-14x14.png" border="0"/></a></h2>
      <div id="BrowseMode">
        <h4>Browse</h4>
        <ul>
          <li><?php if($mthing == "Most Popular"){ echo $sel; }?><a id="ctl00_cphRoblox_rbxGames_hlMostPopular" href="Games.aspx?m=MostPopular&t=Now"><?php if($mthing == "Most Popular"){?><b><?}?>Most Popular<?php if($mthing == "Most Popular"){?></b><?}?></a></li>
          <li><?php if($mthing == "Top Favorites"){ echo $sel; }?><a id="ctl00_cphRoblox_rbxGames_hlTopFavorites" href="Games.aspx?m=TopFavorites&t=AllTime"><?php if($mthing == "Top Favorites"){?><b><?}?>Top Favorites<?php if($mthing == "Top Favorites"){?></b><?}?></a></li>
          <li><?php if($mthing == "Recently Updated"){ echo $sel; }?><a id="ctl00_cphRoblox_rbxGames_hlRecentlyUpdated" href="Games.aspx?m=RecentlyUpdated"><?php if($mthing == "Recently Updated"){?><b><?}?>Recently Updated<?php if($mthing == "Recently Updated"){?></b><?}?></a></li>
          <li><a id="ctl00_cphRoblox_rbxGames_hlFeatured" href="/User.aspx?ID=1">Featured Games</a></li>
        </ul>
      </div>
      <div id="ctl00_cphRoblox_rbxGames_pTimespan">
    <?php if($mthing != "Recently Updated"){?>
        <div id="Timespan">
          <h4>Time</h4>
          <ul>
<?php $sel2 = '<img id="ctl00_cphRoblox_rbxGames_TimespanNowBullet" class="GamesBullet" src="/images/games_bullet.png" border="0"/>'; ?>

            <li><?php if($tthing == "Now"){ echo $sel2; }?><a id="ctl00_cphRoblox_rbxGames_hlTimespanNow" href="Games.aspx?m=MostPopular&amp;t=Now"><?php if($tthing == "Now"){?><b><?}?>Now<?php if($tthing == "Now"){?></b><?}?></a></li>
            <li><?php if($tthing == "Past Day"){ echo $sel2; }?><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastDay" href="Games.aspx?m=<?=str_replace(' ', '', $mthing);?>&t=PastDay"><?php if($tthing == "Past Day"){?><b><?}?>Past Day<?php if($tthing == "Past Day"){?></b><?}?></a></li>
            <li><?php if($tthing == "Past Week"){ echo $sel2; }?><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastWeek" href="Games.aspx?m=<?=str_replace(' ', '', $mthing);?>&t=PastWeek"><?php if($tthing == "Past Week"){?><b><?}?>Past Week<?php if($tthing == "Past Week"){?></b><?}?></a></li>
            <li><?php if($tthing == "Past Month"){ echo $sel2; }?><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastMonth" href="Games.aspx?m=<?=str_replace(' ', '', $mthing);?>&t=PastMonth"><?php if($tthing == "Past Month"){?><b><?}?>Past Month<?php if($tthing == "Past Month"){?></b><?}?></a></li>
            <li><?php if($tthing == "All Time"){ echo $sel2; }?><a id="ctl00_cphRoblox_rbxGames_hlTimespanAllTime" href="Games.aspx?m=<?=str_replace(' ', '', $mthing);?>&t=AllTime"><?php if($tthing == "All Time"){?><b><?}?>All-time<?php if($tthing == "All Time"){?></b><?}?></a></li>
          </ul>
        </div>
      <?}?>
  </div>
    </div>
    
            <div id="Games">
                <span id="ctl00_cphRoblox_rbxGames_lGamesDisplaySet" class="GamesDisplaySet"><?=$mthing;?> (<?=$tthing;?>)</span>
          <div id="ctl00_cphRoblox_rbxGames_HeaderPagerPanel" class="HeaderPager">

<?php if($page > 1){if($numberofpages > 0){?><a id="ctl00_cphRoblox_rbxGames_hlHeaderPager_Next" href="Games.aspx?m=MostPopular&t=Now&p=<?=$prev;?>"><span class="NavigationIndicators">&lt;&lt;</span> Previous</a><?}}?>

            <span id="ctl00_cphRoblox_rbxGames_HeaderPagerLabel">Page <?=$page;?> of <?=$numberofpages;?>:</span>
            
            <?php if($page < $numberofpages){?><a id="ctl00_cphRoblox_rbxGames_hlHeaderPager_Next" href="Games.aspx?m=MostPopular&t=Now&p=<?=$next;?>">Next <span class="NavigationIndicators">&gt;&gt;</span></a><?}?>
        </div>
          <table id="ctl00_cphRoblox_rbxGames_dlGames" cellspacing="0" align="Center" border="0" width="550">
    <tr>
      
    </tr>
  </table>
<div id="Games">
      
          <div style="display:inline-block;cursor:pointer;">
            <?php
            $thispagefirstresult = ($page-1)*$resultsperpage;
            $sql = "SELECT * FROM games ORDER BY id DESC LIMIT ".$thispagefirstresult.",".$resultsperpage;
            $result = mysqli_query($link, $sql);
            $resultCheck = mysqli_num_rows($result);
              
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $visitq = mysqli_query($link, "SELECT * FROM `gamesvisits` WHERE gameid = '".$row['id']."'");
                  $visits = mysqli_num_rows($visitq);
                  $creatorq = mysqli_query($link, "SELECT * FROM users WHERE id='".$row['creator_id']."'") or die(mysqli_error($link));
                  $creator = mysqli_fetch_assoc($creatorq);
                      ?>


            <span class="Game" valign="top">
            <div style="display:inline-block;">
              <div class="GameThumbnail">
                <a id="ctl00_cphRoblox_rbxGames_dlGames_ctl00_ciGame" title="<?=htmlentities($row['name']);?>" href="/Place.aspx?id=<?=htmlentities($row['id']);?>" style="display:inline-block;cursor:pointer;"><img src="/thumbs/index.php?id=<?=htmlentities($row['id']);?>" width="160" height="100" border="0" id="img" alt="<?=htmlentities($row['name']);?>" onerror="this.onerror=null;this.src='/thumbs/default/game.png';"></a>
              </div>
              <div class="GameDetails">
                <div class="GameName" style="white-space: nowrap;"><a id="ctl00_cphRoblox_rbxGames_dlGames_ctl00_hlGameName" href="/Place.aspx?id=<?=htmlentities($row['id']);?>"><?=mb_strimwidth(htmlentities($row['name']), 0, 29, "...");?></a></div>
                <div class="GameLastUpdate"><span class="Label">Updated:</span> <span class="Detail">Soon</span></div>
                <div class="GameCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxGames_dlGames_ctl00_hlGameCreator" href="/User.aspx?ID=<?=htmlentities($row['creator_id']);?>"><?=$creator['username'];?></a></span></div>
                <div class="GamePlays"><span class="Label">Played:</span> <span class="Detail"><?=number_format($visits);?> times</span></div>
                <div id="ctl00_cphRoblox_rbxGames_dlGames_ctl00_pGameCurrentPlayers">
        
                  <div class="GameCurrentPlayers"><span class="DetailHighlighted"><?php if($row['players'] > 0){?><?=htmlentities($row['players']);?> player<?php if($row['players'] != 1){?>s<?}?> online<?}?></span></div>
                
                  </div>
                  </div>
                  </div>
            </span>              
      





<?
              
                }
            }
          
            ?>
              </div>


</div>

      

</div>
      
        <div style="clear: both;">
        </div>
    </div>

        </div>

<? include 'core/footer.php'; ?>
<div class="Navigation">
<?php if($_USER){?>
            <span><a id="ctl00_hlMyRoblox" class="MenuItem" href="/my/home.aspx">My <?=$sitename?></a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlGames" class="MenuItem" href="/Games.aspx">Games</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlCatalog" class="MenuItem" href="/Catalog.aspx">Catalog</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlBrowse" class="MenuItem" href="/Browse.aspx">People</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlForum" class="MenuItem" href="/Upgrades/BuildersClub.aspx">Builders Club</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
<?}?>
            <span><a id="ctl00_hlForum" class="MenuItem" href="/Forum/Default.aspx">Forum</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlNews" class="MenuItem" href="/blog" target="_blank">News</a>&nbsp;<a id="ctl00_hlNewsFeed"><img src="/images/feed-icon-14x14.png" border="0"/></a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlMyRoblox" class="MenuItem" href="#">Help</a></span>
            <?php if($_USER['USER_PERMISSIONS'] == 'Administrator') {echo '<span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlMyRoblox" class="MenuItem" href="/admin">Admin</a></span>';} ?>
           </div>
        </div>

        <?php
$qa = "SELECT * FROM alerts ORDER BY id ASC";
$ra = mysqli_query($link,$qa);
while($alertrow = mysqli_fetch_array($ra)){
$one = $alertrow['text'];
$one = htmlspecialchars(str_replace('{domain}',$sitedomain,$one));
$cullah = htmlspecialchars($alertrow['color']);
?>
<div class="SystemAlert">
          <div class="SystemAlertText" style="background-color: <?=$cullah;?>">
            <div class="Exclamation">
            </div>
            <div><?=$one;?></div>
          </div>
        </div>
<?}?>   
        
<?php if($_GLOBAL['maintenanceEnabled'] == 'yes') {header('location: /maintenance');} ?>

<?php
if ($ipbansresultCheck > 0) {
    while ($ipbansrow = mysqli_fetch_assoc($ipbansresult)) {?>

<style>.Navigation{display:none!important;}#Alerts{display:none!important;}#Authentication{display:none!important;}#Settings{display:none!important;}</style>

       <div style="margin: 100px auto 100px auto; width: 500px; border: black thin solid; padding: 22px; color: black;">
  <h2 style="text-align:center;">Access Denied</h2>
  <p>
    Your behavior on <?=$sitename ?> has resulted in a permanent removal from our services. You are forbidden from creating new accounts.
  </p>
<p>Reviewed: <span style="font-weight: bold"><?=$ipbansrow['banned_at'] ?></span></p>
  <!--<p>
    Ban Reason: </span><span style="font-weight: bold"><?php echo $_USER['banreason']; ?></span></p>
  </p>-->
  <p>
    Please abide by the <?=$sitename ?> Community Guidelines so that <?=$sitename ?> can be fun for users of all ages.
  </p>
</div>
    <?php ; die();}
}
?>

<?php if($isloggedin == 'yes') {if($_USER['bantype'] !== 'None') { // $title = $sitename." | Disabled Account"; ?>

<script>document.title = "<?=$sitename;?> | Disabled Account"</script>

<style>.Navigation{display:none!important;}#Alerts{display:none!important;}#Authentication{display:none!important;}#Settings{display:none!important;}</style>

  <div style="margin: 100px auto 100px auto; width: 500px; border: black thin solid; padding: 22px; color: black;">
  <h2 style="text-align:center;"><?php if($_USER['bantype'] == 'Reminder') {echo 'Reminder';} elseif($_USER['bantype'] == 'Warning') {echo 'Warning';} elseif($_USER['bantype'] == 'Ban') {echo 'Account Deleted';} ?></h2>
  <p>
    Our content monitors have determined that your behaviour at <?=$sitename ?> has been in violation of our Terms of Service. We will terminate your account if you do not abide by the rules.
  </p>
<p>Reviewed: <span style="font-weight: bold"><?php echo date("n/j/Y g:i A",$_USER['bantime']); ?></span></p>
  <p>
    Moderator Note: </span><span style="font-weight: bold"><?php echo $_USER['banreason']; ?></span></p>
  </p>
  <p>
    Please abide by the <a href="#"><?=$sitename ?> Community Guidelines</a> so that <?=$sitename ?> can be fun for users of all ages.
  </p>

  
  <p><?php if($_USER['bantype'] == 'Ban') {?>Your account has been terminated.<?}?>
    <!--<a href='/logout.aspx'>Log out</a>-->
    <?php if($_USER['bantype'] !== 'Ban') {echo '<a href=\'/reactivate_account.aspx\'>Reactivate account</a>';} ?>  </p>
</div>
<?php include($_SERVER["DOCUMENT_ROOT"]."/core/footer.php"); die(); }} ?>
        


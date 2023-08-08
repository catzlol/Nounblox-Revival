<?php
require_once 'core/config.php';
$title = "Catalog - ".$sitename;
include 'core/header.php';
include 'core/nav.php';
?>
<div id="CatalogContainer" style="margin-top: 10px;">
    <div id="SearchBar" class="SearchBar">
        <span class="SearchBox"><input name="ctl00$cphRoblox$rbxCatalog$SearchTextBox" type="text" maxlength="100" id="ctl00_cphRoblox_rbxCatalog_SearchTextBox" class="TextBox"/></span>
        <span class="SearchButton"><input type="submit" name="ctl00$cphRoblox$rbxCatalog$SearchButton" value="Search" id="ctl00_cphRoblox_rbxCatalog_SearchButton"/></span>
    </div>
    <div class="DisplayFilters">
      <h2>Catalog</h2>
      <div id="BrowseMode">
        <h4>Browse</h4>
        <ul>
          <li><img id="ctl00_cphRoblox_rbxCatalog_BrowseModeFeaturedBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0"/><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeFeaturedSelector" href="/Catalog.aspx?sorttype=featured"><b>Featured</b></a></li>
          <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeForSaleSelector" href="/Catalog.aspx?sorttype=forsale">For Sale</a></li>
          <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeBestSellingSelector" href="/Catalog.aspx?sorttype=bestselling">Best Selling</a></li>
          <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeRecentlyUpdatedSelector" href="/Catalog.aspx?sorttype=recentlyupdated">Recently Updated</a></li>
        </ul>
      </div>
      <div id="Category">
        <h4>Category</h4>
        
            <ul>
          
            <li>
              <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0"/>
              <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="/Catalog.aspx?type=hat">Hats</a>
            </li>
          
            <li>
              
              <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="/Catalog.aspx?type=shirt">Shirts</a>
            </li>
          
            </ul>
          
      </div>
      
    </div>
    <div class="Assets">
        <span id="ctl00_cphRoblox_rbxCatalog_AssetsDisplaySetLabel" class="AssetsDisplaySet">Featured Hats, All-time</span>
      <div id="ctl00_cphRoblox_rbxCatalog_HeaderPagerPanel" class="HeaderPager">
        <span id="ctl00_cphRoblox_rbxCatalog_HeaderPagerLabel">Page 1 of 1:</span>
        
        <a id="ctl00_cphRoblox_rbxCatalog_HeaderPagerHyperLink_Next" href="/Catalog?hat&sorttype=recentlyupdated&page=1">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
      </div>
      <table id="ctl00_cphRoblox_rbxCatalog_AssetsDataList" cellspacing="0" align="Center" border="0" width="735">
    <?php
            $sql = "SELECT * FROM catalog;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
              
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $creatorq = mysqli_query($link, "SELECT * FROM users WHERE id='".$row['creatorid']."'") or die(mysqli_error($link));
                  $creator = mysqli_fetch_assoc($creatorq); ?>
                  
<a href="/item.aspx?id=<?php echo $row['id']; ?>">
<td valign="top">
            <div class="Asset">
              <div class="AssetThumbnail">
                <a id="ctl00_cphRoblox_rbxCatalog_AssetsDataList_ctl00_AssetThumbnailHyperLink" title="" href="/item.aspx?id=<?php echo $row['id']; ?>" style="display:inline-block;cursor:pointer;"><img src="<?php echo $row['thumbnail']; ?>" width="120" height="120" border="0" id="img" alt="" blankurl="http://t6.roblox.com:80/blank-120x120.gif"/></a>
              </div>
              <div class="AssetDetails">
                
                <strong><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl06_AssetNameHyperLink" href="/item.aspx?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></strong>
                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxCatalog_AssetsDataList_ctl00_GameCreatorHyperLink" href="/user.aspx?id=<?php echo $creator['id']; ?>"><?php echo $creator['username']; ?></a></span></div>
                
                
                <div id="ctl00_cphRoblox_rbxCatalog_AssetsDataList_ctl00_Div3" class="AssetPrice"><span class="PriceInRobux"><?php if($row['buywith'] == 'tix') {echo $tixname;} else {echo $robuxname;} ?>: <?php echo $row['price']; ?></span></div>
              </div>
          </div>
        </td>
</a>
<?php }} ?>
</table>
        <div id="ctl00_cphRoblox_rbxCatalog_FooterPagerPanel" class="HeaderPager">
            <span id="ctl00_cphRoblox_rbxCatalog_FooterPagerLabel">Page 1 of 1:</span>
            
            <a id="ctl00_cphRoblox_rbxCatalog_FooterPagerHyperLink_Next" href="Catalog.aspx?m=Featured&amp;c=8&amp;t=AllTime&amp;d=All&amp;q=&amp;p=2">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
        </div>
    </div>
    <div style="clear: both;"/>
</div>

        </div>

<? include 'core/footer.php'; ?>
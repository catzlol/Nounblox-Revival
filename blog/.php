<?php 
// shitty blog system i made based on 2012 roblox blog
require_once($_SERVER['DOCUMENT_ROOT'].'/blog/api/conf/config.php'); 
include("api/site/header.php"); // error_reporting(E_ALL);
?>
            <div id="primary">
                <div id="content" role="main" class="content">
			<?php
				$sql = "SELECT * FROM blog ORDER BY id DESC";
				if ($result = mysqli_query($db, $sql)) {
				// Fetch one and one row
				while ($row = mysqli_fetch_row($result)) { 

$theuserq = mysqli_query($link, "SELECT * FROM users WHERE id='$row[2]'");

$author = mysqli_fetch_assoc($theuserq);


?>
				<div class="post" style="width: 29.5rem;" id="post-<?=$row[4];?>">

	 <span class="posted-by">December 18th 2008</span>

	 <h2 class="storytitle"><a href="/blog/?p=<?=$row[4];?>" rel="bookmark"><?=$row[0];?></a></h2>

	

	<div class="storycontent">

		<?=$row[1];?>

<p align="right">-<?=$author['username'];?></p>

<!-- AddThis Bookmark Post Button BEGIN -->

<div><a href="https://web.archive.org/web/20090120101317/http://www.addthis.com/bookmark.php?pub=Telamon&amp;url=http://blog.roblox.com/?p=<?=$row[5];?>&amp;title=Trying to Get A Head…" title="Bookmark using any bookmark manager!" target="_blank"><img src="https://web.archive.org/web/20090120101317im_/http://s9.addthis.com/button1-bm.gif" width="125" height="16" border="0" alt="AddThis Social Bookmark Button"></a></div>
<!-- AddThis Bookmark Post Button END -->

<br>

	</div>

	

	<div class="post-footer">

		<div class="meta">Posted in: <a href="https://web.archive.org/web/20090120101317/http://blog.roblox.com/?cat=1" title="View all posts in News" rel="category">News</a>, <a href="https://web.archive.org/web/20090120101317/http://blog.roblox.com/?cat=4" title="View all posts in Release Notes" rel="category">Release Notes</a> </div>

		<div class="feedback">

	            
	            <a href="https://web.archive.org/web/20090120101317/http://blog.roblox.com/?p=<?=$row[4];?>#comments" title="Comment on Trying to Get A Head…">Comments (1)</a>
		</div>

		<div class="clear"></div>

	</div>



</div>
				<?php 			
				}
					mysqli_free_result($result);
				}
				?>
                    <nav id="nav-below">
                        <h3 class="assistive-text">Post navigation</h3>
                        <div class="nav-previous"><a href="page/2/"><span class="meta-nav">&larr;</span> Older posts</a></div>
                        <div class="nav-next"></div>
                    </nav>
                    <!-- #nav-above -->
                </div>
                <!-- #content -->
            </div>
 <?php include("api/site/footer.php"); ?>
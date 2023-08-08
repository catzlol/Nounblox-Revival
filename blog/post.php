<?php 
// shitty blog system i made based on 2012 roblox blog
require_once(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/confdirectory.txt').'/api/conf/config.php'); 
if(isset($_GET['id'])) {
	mysqli_real_escape_string($db, $getid = $_GET['id']);
	$SQL = "SELECT * FROM blog WHERE id='$getid'";
	$query1 = mysqli_query($db, $SQL);
	if (mysqli_num_rows($query1) == 0) { 
	die("Blog post doesn't exist");
	}
	$row1 = mysqli_fetch_row($query1);
} else {
	die('GET aint set');
}
include("$baseurl/api/site/header.php");
?>
<div id="primary">
    <div id="content" role="main">

        <div id="fb-root"></div>
        <script type="text/javascript">
            window.fbAsyncInit = function()
            						{
            							FB.init({appId: 138850326224710, status: true, cookie: true, xfbml: true});
            						};
            						(function()
            						{
            							var e = document.createElement('script'); e.async = true;
            							e.src = document.location.protocol + '//web.archive.org/web/20120109075233/http://connect.facebook.net/en_US/all.js';
            							document.getElementById('fb-root').appendChild(e);
            						}());
        </script>

        <nav id="nav-single">
            <h3 class="assistive-text">Post navigation</h3>
            <span class="nav-previous"><a href="https://web.archive.org/web/20120109075233/http://community.roblox.com/archives/6660" rel="prev"><span class="meta-nav">←</span> Previous</a>
            </span>
            <span class="nav-next"></span>
        </nav>
        <!-- #nav-single -->

        <article id="post-6717" class="post-6717 post type-post status-publish format-standard hentry category-announcements category-news category-release-notes">
            <header class="entry-header">
                <h1 class="entry-title"><?php echo $row1[0]?></h1>

                <div class="entry-meta">
                    <span class="by-author"><span class="sep"> By </span> <span class="author vcard"><a class="url fn n" href="" title="View all posts by Telamon" rel="author"><?php echo $row1[2]?></a></span></span> - <time class="entry-date" datetime="2012-01-06T16:12:04+00:00" pubdate=""><?php echo date("F d, Y", strtotime($row1[3])); // damn, time is really fucking useful?></time> </div>
                <!-- .entry-meta -->
            </header>
            <!-- .entry-header -->

            <div class="entry-content">
                <p>
				<?php echo $row1[1]?>
                    <!-- PHP 5.x -->
                </p>
                <div class="wpfblike">
                    
                </div>
            </div>
            <!-- .entry-content -->

            <footer class="entry-meta">
                This entry was posted in <a href="/category?c=announcements" title="View all posts in Announcements" rel="category tag">Announcements</a>, <a href="/category?c=news" title="View all posts in News" rel="category tag">News</a>, <a href="" title="View all posts in Release Notes" rel="category tag">Release Notes</a> by <a href="/author.php?author=<?php echo $row1[2]?>"><?php echo $row1[2]?></a>. Bookmark the <a href="" title="Permalink to ROBLOX Studio for MAC–The BETA is Live!" rel="bookmark">permalink</a>.
            </footer>
            <!-- .entry-meta -->
        </article>
        <!-- #post-6717 -->

        <div id="comments">

            <h2 id="comments-title">
                0 thoughts on “<span><?php echo $row1[0]?></span>” </h2>

            <nav id="comment-nav-above">
                <h1 class="assistive-text">Comment navigation</h1>
                <div class="nav-previous"><a href="https://web.archive.org/web/20120109075233/http://community.roblox.com/archives/6717/comment-page-2#comments">← Older Comments</a></div>
                <div class="nav-next"></div>
            </nav>

            <ol class="commentlist">
                <li class="comment even thread-even depth-1" id="li-comment-53040">
                    <article id="comment-53040" class="comment">
                        <footer class="comment-meta">
                            <div class="comment-author vcard">
                                <img alt="" src="https://web.archive.org/web/20120109075233im_/http://community.roblox.com/wp-includes/images/blank.gif" class="avatar avatar-68 photo avatar-default" width="68" height="68"><span class="fn">coolguy61803</span> on <a href="https://web.archive.org/web/20120109075233/http://community.roblox.com/archives/6717/comment-page-3#comment-53040"><time pubdate="" datetime="2012-01-08T18:40:42+00:00">January 8, 2012 at 6:40 pm</time></a> <span class="says">said:</span>
                            </div>
                            <!-- .comment-author .vcard -->

                        </footer>

                        <div class="comment-content">
                            <p>Looks better than ROBLOX studio before.</p>
                        </div>

                        <div class="reply">
                            <a class="comment-reply-link" href="/web/20120109075233/http://community.roblox.com/archives/6717?replytocom=53040#respond" onclick="return addComment.moveForm(&quot;comment-53040&quot;, &quot;53040&quot;, &quot;respond&quot;, &quot;6717&quot;)">Reply <span>↓</span></a> </div>
                        <!-- .reply -->
                    </article>
                    <!-- #comment-## -->

                </li>
            </ol>

            <nav id="comment-nav-below">
                <h1 class="assistive-text">Comment navigation</h1>
                <div class="nav-previous"><a href="https://web.archive.org/web/20120109075233/http://community.roblox.com/archives/6717/comment-page-2#comments">← Older Comments</a></div>
                <div class="nav-next"></div>
            </nav>

            <div id="respond">
                <h3 id="reply-title">Leave a Reply <small><a rel="nofollow" id="cancel-comment-reply-link" href="/web/20120109075233/http://community.roblox.com/archives/6717#respond" style="display:none;">Cancel reply</a></small></h3>
                <form action="https://web.archive.org/web/20120109075233/http://community.roblox.com/wp-comments-post.php" method="post" id="commentform">
                    <p class="comment-form-author"><label for="author">Name</label> <input id="author" name="author" type="text" value="" size="30"></p>

                    <p class="comment-form-comment"><label for="comment">Comment</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>
                    <p class="form-allowed-tags">You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: <code>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;strike&gt; &lt;strong&gt; </code></p>
                    <p class="form-submit">
                        <input name="submit" type="submit" id="submit" value="Post Comment">
                        <input type="hidden" name="comment_post_ID" value="6717" id="comment_post_ID">
                        <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                    </p>
                </form>
            </div>
            <!-- #respond -->
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    jQuery('#commentform').submit(function() {
                        _gaq.push(
                            ['_setAccount','UA-486632-6'],
                            ['_trackEvent','comment']
                        );
                    });
                });
            </script>
        </div>
        <!-- #comments -->

    </div>
    <!-- #content -->
</div>
 <?php include("$baseurl/api/site/footer.php"); ?>
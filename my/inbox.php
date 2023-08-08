<?php // to do (on this page): pagination
include $_SERVER["DOCUMENT_ROOT"].'/core/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/core/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/core/config.php';
if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}


if($_POST['read']){
$ok = mysqli_query($conn, "SELECT * FROM messages WHERE `id` = '".(int)$_POST['read']."'");
$okletsgo = mysqli_fetch_array($ok);

if($okletsgo['user_to'] == $_USER['id']){
$yeet = mysqli_query($conn, "UPDATE messages SET `readto` = '1' WHERE `id` = '".(int)$_POST['read']."'");
header("Location: /my/inbox");
}

}


if($_POST['readall']){

$yeet = mysqli_query($conn, "UPDATE messages SET `readto` = '1' WHERE `user_to` = '".$_USER['id']."'");

header("Location: /my/inbox");

}










$check = mysqli_query($conn, "SELECT * FROM messages WHERE (`user_from` = {$_USER['id']} ) ") or die(mysqli_error($conn));

$usercount = mysqli_num_rows($check);

                    $numberofpages = ceil($usercount/$resultsperpage);

                    if(!isset($_GET['page'])) {
                        $page = 1;
                    }else{
                        $page = (int)addslashes($_GET['page']);
                    }

$resultsperpage = 20;

                    $thispagefirstresult = ($page-1)*$resultsperpage;

?>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}</script>




<form action="" method="POST">


<div id="Body">
					
	<div id="InboxContainer">
	    <div id="InboxPane">
            <h2>Inbox</h2>



<?php
$msgnew = mysqli_query($conn, "SELECT * FROM messages WHERE readto='0' AND user_to='{$_USER['id']}'") or die(mysqli_error($conn));
$msgcountm = mysqli_num_rows($msgnew);

if ($msgcountm < 1) {
              echo "<p style=\"padding: 10px 10px 10px 10px;\">You don't have any incoming messages.</p>";
              include("../core/footer.php"); die();
            }
?>



		    <div id="Inbox">

			    <div>
	<table cellspacing="0" cellpadding="3" border="0" id="ctl00_cphRoblox_InboxGridView" style="width:726px;border-collapse:collapse;">
		<tr class="InboxHeader">
			<th align="left" scope="col">
							    <input onclick="toggle(this);" type="checkbox" name="readall"/>
						    </th><th align="left" scope="col"><a href="javascript:__doPostBack('ctl00$cphRoblox$InboxGridView','Sort$m.[Subject]')">Subject</a></th><th align="left" scope="col"><a href="javascript:__doPostBack('ctl00$cphRoblox$InboxGridView','Sort$u.[userName]')">From</a></th><th align="left" scope="col"><a href="javascript:__doPostBack('ctl00$cphRoblox$InboxGridView','Sort$m.[Created]')">Date</a></th>
		</tr>



<?php $data = mysqli_query($conn, "SELECT * FROM messages WHERE readto='0' AND user_to='{$_USER['id']}' ORDER BY `id` DESC");
while($build = mysqli_fetch_array($data)){ 

$userq = mysqli_query($conn, "SELECT * FROM users WHERE id='".$build['user_from']."'") or die(mysqli_error($conn));

$user = mysqli_fetch_assoc($userq);

?>

<tr class="InboxRow">
			<td>
							    <span style="display:inline-block;width:25px;"><input type="checkbox" name="read" value="<?=$build['id'];?>" /></span>
						    </td><td align="left"><a href="PrivateMessage.aspx?MessageID=<?=$build['id'];?>" style="display:inline-block;width:325px;"><?=htmlspecialchars($build['subject']);?></a></td><td align="left">
							    <a id="ctl00_cphRoblox_InboxGridView_ctl02_hlAuthor" title="Visit <?=htmlspecialchars($user['username']);?>'s Home Page" href="../User.aspx?ID=<?=$user['id'];?>" style="display:inline-block;width:175px;"><?=htmlspecialchars($user['username']);?></a>
						    </td><td align="left"><?=date("n/j/Y g:i:s A",$build['datesent']);?></td>
		</tr>

<? } ?>

<tr class="InboxPager">
			<td colspan="4"><table border="0">
				<tr>
					<td><span>1</span></td><td><a href="javascript:__doPostBack('ctl00$cphRoblox$InboxGridView','Page$2')">2</a></td>
				</tr>
			</table></td>
		</tr>















<!--<?php
echo "
                        <tr class='GridPager'>
                            <td colspan='4'>
                                <table border='0'>
                                    <tbody>
                        ";
                     
                    if($page <= $page) {  
                    $pagefix = $page + 9;
                    }
                    if($pagefix > $numberofpages) {
                    $pagefix = $numberofpages;
                    }
                    $page2 = $page - 1;
                    $page3 = $page - 2;
                    $page4 = $page - 3;
                    $page5 = $page - 4;
                    $page6 = $page - 5;
                    
                    
                    if($page == 1 OR $page == 2 OR $page == 3 OR $page == 4 OR $page == 5) {
                    }else{
                    echo"<td>
                            <a href='Browse.aspx?page=".$page6."'>".$page6." </a>
                        </td>
                    <td>
                            <a href='Browse.aspx?page=".$page5."'>".$page5." </a>
                        </td>
                    <td>
                            <a href='Browse.aspx?page=".$page4."'>".$page4." </a>
                        </td>
                    <td>
                            <a href='Browse.aspx?page=".$page3."'>".$page3." </a>
                        </td>
                    <td>
                            <a href='Browse.aspx?page=".$page2."'>".$page2." </a>
                        </td>
                    ";
                    }
                    
                    $pager = $page - 1;
                    $pager1 = $page - 2;
                    $pager2 = $page - 3;
                    $pager3 = $page - 4;
                    if($page == 5) {
                    echo"<td>
                            <a href='Browse.aspx?page=".$pager3."'>".$pager3." </a>
                        </td>
                    <td>
                            <a href='Browse.aspx?page=".$pager2."'>".$pager2." </a>
                        </td>
                    <td>
                            <a href='Browse.aspx?page=".$pager1."'>".$pager1." </a>
                        </td>
                    <td>
                            <a href='Browse.aspx?page=".$pager."'>".$pager." </a>
                        </td>
                    ";
                    }else{
                    }
                    
                    $pagej = $page - 1;
                    $pagej1 = $page - 2;
                    $pagej2 = $page - 3;
                    if($page == 4) {
                    echo"<td>
                            <a href='Browse.aspx?page=".$pagej2."'>".$pagej2." </a>
                        </td>
                    <td>
                            <a href='Browse.aspx?page=".$pagej1."'>".$pagej1." </a>
                        </td>
                    <td>
                            <a href='Browse.aspx?page=".$pagej."'>".$pagej." </a>
                        </td>
                    ";
                    }else{
                    }
                    
                    $pagey = $page - 1;
                    $pagey1 = $page - 2;
                    if($page == 3) {
                    echo"<td>
                            <a href='Browse.aspx?page=".$pagey1."'>".$pagey1." </a>
                        </td>
                    <td>
                            <a href='Browse.aspx?page=".$pagey."'>".$pagey." </a>
                        </td>
                    ";
                    }else{
                    }
                    
                    $paget = $page - 1;
                    if($page == 2) {
                    echo"<td>
                            <a href='Browse.aspx?page=".$paget."'>".$paget." </a>
                        </td>
                    ";
                    }else{
                    }
                    

                    for ($page<=$pagefix;$page<=$pagefix;$page++) {

                        echo "
                        <td>
                            <a href='Browse.aspx?page=".$page."'>".$page." </a>
                        </td>
                        ";
                    }

                    echo "
<td><a href='Browse.aspx?page=$numberofpages'>...</a></td>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    ";
                    ?>-->






















	</table>
</div>
		    </div>
		    <div class="Buttons">
			    <input type="submit" id="ctl00_cphRoblox_DeleteButton" class="Button" value="Delete">
			    <a id="ctl00_cphRoblox_CancelHyperLink" class="Button" href="/User.aspx">Cancel</a>
		    </div>
		</div>
</div>
		<div style="clear: both;"></div>
	</div>
</div>

</form>


<?php include("../core/footer.php"); ?>
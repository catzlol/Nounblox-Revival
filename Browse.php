<?php
include 'core/header.php';
include 'core/nav.php';
include 'core/discordembed.php';
?>
<div id="Bodyy">
	<div id="BrowseContainer" style="text-align:center">
<br>
  <div>
<form action="" method="POST">
<div id="SearchBar" class="SearchBar">
			<span class="SearchBox"><input name="search" type="text" maxlength="100" id="ctl00_cphRoblox_SearchTextBox" class="TextBox" value="<?=htmlspecialchars($_POST['search']);?>"></span>
			<span class="SearchButton"><input type="submit" name="ctl00$cphRoblox$SearchButton" value="Search" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions('ctl00$cphRoblox$SearchButton', '', true, '', '', false, false))" id="ctl00_cphRoblox_SearchButton"></span>
			<span class="SearchLinks"><sup><a id="ctl00_cphRoblox_ResetSearchButton" href="/Browse.aspx">Reset</a>&nbsp;|&nbsp;</sup><a href="#" class="tips"><sup>Tips</sup>
			<span>Exact Phrase: "red brick"<br>
			Find ALL Terms: red and brick =OR=  red + brick<br>
			Find ANY Term: red or brick =OR= red | brick<br>
			Wildcard Suffix: tel* (Finds teleport, telamon, telephone, etc.)<br>
			Terms Near each other: red near brick =OR= red ~ brick<br>
			Excluding Terms: red and not brick =OR= red - brick<br>
			Grouping operations: brick and (red or blue) =OR= brick + (red | blue)<br>
			Combinations: "red brick" and not (tele* or tower) =OR= "red brick" - (tele* | tower)<br>
			Wildcard Prefix is NOT supported: *port will not find teleport, airport, etc.
			</span></a>
			</span> 
		</div>
</form>

	<br><br>
  	    <table class="Grid" cellspacing="0" cellpadding="4" border="0" style="border-collapse:collapse;">
      <tbody>
        <tr class="GridHeader">
                    <th scope="col">Avatar</th>
          <th scope="col"><a href="/Browse.aspx?Sort=Name">Name</a></th>
          <th scope="col">Status</th>
          <th scope="col" style="text-align: right;">Location / Last Seen</th>
      	          </tr>
                <?php
                    $search = mysqli_real_escape_string($link,$_POST['search']);
                    if($_GET['Sort'] == "Name"){$sortthing = "username";}else{$sortthing = "visittick DESC";}
                    $resultsperpage = 10;
                    $check = mysqli_query($conn, "SELECT * FROM users WHERE LOWER(username) LIKE LOWER('%".$search."%')");
                    $usercount = mysqli_num_rows($check);

                    $numberofpages = ceil($usercount/$resultsperpage);

                    if(!isset($_GET['page'])) {
                        $page = 1;
                    }else{
                        $page = (int)addslashes($_GET['page']);
                    }

                    $thispagefirstresult = ($page-1)*$resultsperpage;

                    $check = mysqli_query($conn, "SELECT * FROM users WHERE LOWER(username) LIKE LOWER('%".$search."%') ORDER BY ".$sortthing." LIMIT ".$thispagefirstresult.",".$resultsperpage);

                    while($row = mysqli_fetch_assoc($check)) {

    $id = htmlspecialchars($row['id']);
    $name = htmlspecialchars($row['username']);


$wrroebucks = $row['robux'];
$ticks = $row['tix'];


$blurbington = $row['blurb'];

$wow1 = str_replace("{robux}", $wrroebucks, $blurbington);

$newblurb = str_replace("{tix}", $ticks, $wow1);

		$description = mb_strimwidth(htmlspecialchars($newblurb), 0, 100, "...");

        echo "
		<tr class='GridItem'>
    <td>
    <img height='60' width='60' src='/api/avatar/getthumb.php?id=$id'>
    </td>
    <td href='/User.aspx?ID=$id' style='word-break: break-all;'>
    <a href='/User.aspx?ID=$id'>$name</a><br>
		<span>".$description."</span>
    </td>
    <td><span>
    "; 
    if($row['expiretime'] < $now) {
    echo"Offline";
    $lastseen = date("n/j/Y g:i A",$row['visittick']);
    }else{
    echo"Online";
    $lastseen = "Website";
    }
    echo"</span><br></td>
    <td><span id='ctl00_cphRoblox_gvUsersBrowsed_ctl02_lblUserLocationOrLastSeen'>".$lastseen."</span></td>
    </tr>";

    $_GET['username'] = $username;
                    }

// $numberofpages = 10;
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
                    ?>
      </tbody>
    </table>
    <style>
    table {
    display: table;
    border-collapse: separate;
    box-sizing: border-box;
    border-spacing: 2px;
    border-color: grey;
}
.GridPager {
    color: White;
    background-color: #b0c4de;
    text-align: center;
    font-weight: bold;
}
    </style>

</div></div></div></div></div></div></div></div></div></div></div></div></div>
		<?php require 'core/footer.php'; ?>
	  </div>
</div>

</div>
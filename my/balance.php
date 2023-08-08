<?php
include '../core/config.php';
if(!$loggedIn) {
	// header("Location: /");
}
?>
<?php require '../core/header.php'; ?>
<?php require '../core/nav.php'; ?>
<div id="Body">
<div id="MyAccountBalanceContainer">
	<h2>My Account Balance</h2>
	<div id="AboutRobux">


		<h3>What are <?=$robuxname;?>?</h3>
		<p><?=$robuxname;?> are the principle currency of <?=$sitename;?>. Citizens in the Builders Club receive a daily allowance of <?=$robuxname;?> to help them live a comfortable life of leisure. For this and other benefits, consider joining <a href="/Upgrades/BuildersClub.aspx">Builders Club (Only for Vip-Members)</a>! Alternately, you can <a href="/Upgrades/Robux.aspx">get <?=$robuxname;?></a> if you wish by wait for <?=$robuxname;?> and <?=$tixname;?>.</p>
		<h3>What are <?=$tixname;?>?</h3>
		<p><?=$sitename;?> <?=$tixname;?> are similar to tickets you win in an arcade. You play the game, get tickets, and are rewarded with fabulous prizes. <?=$tixname;?> are granted to citizens who are helping to expand and improve <?=$sitename;?>. The primary way to get <?=$tixname;?> is to make a cool place, and then get people to visit it. You can also get the daily login bonus, just by showing up!</p>
		<h3>Where do I buy things?</h3>
		<p>Browse the <a id="ctl00_cphRoblox_CatalogHyperLink" href="/Catalog.aspx"><?=$sitename;?> Catalog</a></p>
	</div>
	<div id="Earnings">
		<h3>Earnings</h3>
		<div>
      <br>
			<div class="Label"></div>
			<div class="Field"><img id="ctl00_cphRoblox_RobuxIcon" src="/images/Robux.png" alt="<?=$robuxname;?>" style="border-width:0px;"></div>
			<div class="Field"><img id="ctl00_cphRoblox_TicketsIcon" src="/images/Tickets.png" alt="<?=$tixname;?>" style="border-width:0px;"></div>
		</div>
		<div class="Earnings_Period">
			<h4>Past Day</h4>
			<div class="Earnings_LoginAward">
				<div class="Label">Login Award</div>
				<div class="Field">0</div>
				<div class="Field">0</div>
			</div>
			<div class="Earnings_PlaceTrafficAward">
				<div class="Label">Place Traffic Award</div>
				<div class="Field">0</div>
				<div class="Field">0</div>
			</div>
			<div class="Earnings_SaleOfRobux">
				<div class="Label">?</div>
				<div class="Field">0</div>
				<div class="Field">0</div>
			</div>
			<div class="Earnings_SaleOfRobux">
				<div class="Label"></div>
				<div class="Field">0</div>
				<div class="Field">0</div>
			</div>
			<div class="Earnings_PeriodTotal">
				<div class="Label">Total:</div>
				<div class="Field">0</div>
				<div class="Field">0</div>
			</div>
		</div>
		<div class="Earnings_Period">
			<h4>All Time</h4>
			<div class="Earnings_LoginAward">
				<div class="Label">Login Award</div>
				<div class="Field">0</div>
				<div class="Field">0</div>
			</div>
			<div class="Earnings_PlaceTrafficAward">
				<div class="Label">Place Traffic Award</div>
				<div class="Field">0</div>
				<div class="Field">0</div>
			</div>
			<div class="Earnings_SaleOfRobux">
				<div class="Label"><br></div>
				<div class="Field">0</div>
				<div class="Field">0</div>
			</div>
			<div class="Earnings_SaleOfRobux">
				<div class="Label"><br></div>
				<div class="Field">0</div>
				<div class="Field">0</div>
			</div>
			<div class="Earnings_PeriodTotal">
				<div class="Label">Total:</div>
				<div class="Field"><?php echo $_USER['robux']; ?></div>
				<div class="Field"><?php echo $_USER['tix']; ?></div>
			</div>
		</div>
	</div>
</div>
<div style="clear:both;"></div>
<?php require '../core/footer.php'; ?>
</div>

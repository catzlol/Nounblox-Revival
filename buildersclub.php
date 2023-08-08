<?php
include 'core/config.php';
$title = $sitename." - Builders Club";
include 'core/header.php';
include 'core/nav.php';
?>
<div id="Body">
            <div id="info" style="position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(100,100,100,0.25);">
    <div style="position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
        <div id="UserBadgesPane" style="width: 400px;">
            <div id="UserBadges">
                <h4><font size="3" face="Comic sans MS">Builders Club</font></h4>
                <p style="margin-top: 15px;">This page is just for show and is non-functional</p>
                <p>We are not actually selling any form of membership or currency</p>
                <p>We apologize for any inconvenience</p>
                <div style="margin-bottom: 20px;" id="PurchaseButton">
                    <a class="Button" onclick="document.getElementById('info').hidden = true">OK</a>
                </div>
                <table cellspacing="0" border="0" align="Center"> 
                </table>
            </div>
        </div>
    </div>
</div>
<font face="Verdana">
    <br><br>
    </font><div id="BuildersClubContainer" style="border:1px solid black;"><font face="Verdana">
    <div id="JoinBuildersClubNow"><img src="/images/JoinBuildersClubNow.png" alt="Join Builders Club Now!" style="margin-bottom:-2px;"></div>
    <div id="MembershipOptions">
        <div id="OneMonth">
            <div class="BuildersClubButton"><a href="#" onclick="document.getElementById('info').hidden = false"><img src="https://goodbloxarchive.pizzaboxer.xyz/images/BuyBC/BuyBCMonthly.png" style="border-width:0px;"></a></div>
            <div class="Label"><a href="#" onclick="document.getElementById('info').hidden = false">Join Monthly</a></div>
        </div>
        <div id="SixMonths">
            <div class="BuildersClubButton"><a href="#" onclick="document.getElementById('info').hidden = false"><img src="https://goodbloxarchive.pizzaboxer.xyz/images/BuyBC/BuyBC6Months.png" style="border-width:0px;"></a></div>
            <div class="Label"><a href="#" onclick="document.getElementById('info').hidden = false">Join for 6 Months</a></div>
        </div>
        <div id="TwelveMonths">
            <div class="BuildersClubButton"><a href="#" onclick="document.getElementById('info').hidden = false"><img src="https://goodbloxarchive.pizzaboxer.xyz/images/BuyBC/BuyBC12Months.png" style="border-width:0px;"></a></div>
            <div class="Label"><a href="#" onclick="document.getElementById('info').hidden = false">Join for 12 Months</a></div>
        </div>
    </div>
    <div id="WhyJoin">
        <h3>Why Join Builders Club?</h3>
        <ul class="MembershipBenefits">
            <li class="Benefit_MultiplePlaces">Create up to 10 places on a single account</li>
            <li class="Benefit_RobuxAllowance">Earn a daily income of 15 <?=$robuxname;?></li>
            <li class="Benefit_SuppressAds">Never see any outside ads on <?=strtoupper($_SERVER['SERVER_NAME']);?></li>
            <li class="Benefit_ExclusiveHat">Receive the exclusive Builders Club construction hard hat</li>
        </ul>
        <p>Product is Windows-only. For more information, read our <a href="../Parents/BuildersClub.aspx">Builders Club FAQs</a>.</p>
        <h3>Not Ready Yet?</h3>
        <ul class="MembershipBenefits">
          <li class="Benefit_RobuxAllowance">You can also <a href="Robux.aspx">grab <?=$robuxname;?></a> by donating us. We will offer you some as our way of saying thank you. </li>
        <ul>
    </ul></ul></div>
    <div style="clear:both;"></div>
</font>
          </div>
          <div style="clear:both"></div>
          <?php
include 'core/footer.php';
?>

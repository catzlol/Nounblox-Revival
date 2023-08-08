<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/core/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/core/config.php';
if($_SESSION["loggedin"] != 'true'){
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
header("Location: /Login/Default.aspx?ReturnUrl=".$yourl); exit;}
?>
<style>
#EditProfileContainer {
    background-color: #eeeeee;
    border: 1px solid #000;
    color: #555;
    margin: 0 auto;
    width: 620px;
}
fieldset {
    font-size: 1.2em;
    margin: 15px 0 0 0;
}
</style>
<form method="POST" action="editprofile.aspx">
<div id="EditProfileContainer">
    <h2>Edit Profile</h2>
    <div><span id="WrongOldPW" style="color:Red;"></span></div>
    <div id="Blurb">
        <fieldset title="Update your personal blurb">
            <legend>Update your personal blurb</legend>
            <div class="Suggestion">
                Describe yourself here (max. 1000 characters).  Make sure not to provide any details that can be used to identify you outside <?=$sitename ?>.
            </div>
            <div class="Validators">

            </div>
            <div class="BlurbRow">
                <textarea rows="8" name="desc"  cols="2" id="Blurb" tabindex="3" class="MultilineTextBox"></textarea>
            </div>
        </fieldset>
    </div>
    <div class="Buttons">
        <input id="Submit" tabindex="4" class="Button" type="submit" name="descupd" value="Update">&nbsp;<a id="Cancel" tabindex="5" class="Button" href="/my/home">Cancel</a>
    <h3>More Options</h3>
     <form method="POST" action="deleteaccount.php">
    <div class="Buttons">
        <input id="Delete your account" tabindex="4" class="Button" type="submit" name="cancelsub" value="Delete your account">
    </div>
    </form>
    </div>
</div>

</form>

<?php if($_USER['BC'] == 'BC') {    ?>
<br>
<form method="POST" action="builderscluboptions.aspx">
<div id="EditProfileContainer">
    <h2>Builders Club Options</h2>
    <div><span id="WrongOldPW" style="color:Red;"></span></div>
    
    <div class="Buttons">
        <input id="Cancel Subscription" tabindex="4" class="Button" type="submit" name="cancelsub" value="Cancel Subscription">
    </div>
</div>
</form>
<?php } ?>

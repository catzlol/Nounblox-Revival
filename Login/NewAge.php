<?php
// Include config file
require_once $_SERVER["DOCUMENT_ROOT"]."/core/config.php";


if(empty(trim($_GET["ReturnUrl"]))){ $returnurl = "/"; }else{ $returnurl = htmlspecialchars(trim($_GET["ReturnUrl"])); }



// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ".$returnurl);
    exit;
}


 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } elseif(strlen(trim($_POST["username"])) < 3){
        $username_err = "Username must be atleast 3 characters.";
} elseif(strlen(trim($_POST["username"])) > 20){
        $username_err = "Username must be under 20 characters.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE LOWER(username) = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim(strtolower($_POST["username"])); // die($param_username);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) != 0){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 4){
        $password_err = "Password must have atleast 4 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){


            // Chat mode
            if ($_POST['chatmode'] == 'true'){
            $chat = "1";
            }else{
            $chat = "0";
            }


            // Verify age
            if ($_POST['age'] == 'under13'){
            $age = "1";
            $chat = "1"; // override user's chat choice to the supersafe chat because coppa
            }else{
            $age = "0";
            }

        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, age, chatMode) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_age, $param_chat);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_age = $age;
            $param_chat = $chat;

            $key = $_POST['key'];
            // $invitekeyq = mysqli_query($link, "SELECT * FROM invitekeys WHERE invkey='$key'") or die(mysqli_error($link));
                                
            // $getkeydata = mysqli_fetch_assoc($invitekeyq);
                         
              if ($_POST['key'] == null) {
              // die("enter an key");
              }
                                
              if ($_POST['key'] !== $getkeydata['invkey']) {
              // die("invalid invite key");
              }
              if ($getkeydata['isredeemed'] == "yes") {
                // die("key is already redeemed");
              }
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username;
                $user = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM users WHERE username = '".addslashes($username)."'"));
                $_SESSION["id"] = $user['id'];
                header("location: /api/render.php?returnUrl=".$returnurl);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<?php
include '../core/header.php';
include '../core/nav.php';
include '../core/discordembed.php';
?>
<style>.Navigation{display:none!important;}#Alerts{display:none!important;}#Authentication{display:none!important;}</style>
<div id="Registration">
      <div id="ctl00_cphRoblox_upAccountRegistration">
  
          <h2>Sign Up and Play</h2>
          <h3>Step 1 of 2: Create Account</h3>
          <form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
          <div id="EnterAgeGroup">
            <fieldset title="Provide your age-group">
              <legend>Provide your age-group</legend>
              <div class="Suggestion">
                This will help us to customize your experience.  Users under 13 years will only be shown pre-approved images.
              </div>
              <div class="AgeGroupRow">
                <span id="ctl00_cphRoblox_rblAgeGroup"><input id="ctl00_cphRoblox_rblAgeGroup_0" type="radio" name="age" value="under13" checked="checked" tabindex="5"/><label for="ctl00_cphRoblox_rblAgeGroup_0">Under 13 years</label><br/><input id="ctl00_cphRoblox_rblAgeGroup_1" type="radio" name="age" value="above13" onclick="javascript:setTimeout('__doPostBack(\'ctl00$cphRoblox$rblAgeGroup$1\',\'\')', 0)" tabindex="5"/><label for="ctl00_cphRoblox_rblAgeGroup_1">13 years or older</label></span>
              </div>
            </fieldset>
          </div>
          <div id="EnterUsername">
            <fieldset title="Choose a name for your <?=$sitename ?> character">
              <legend>Choose a name for your <?=$sitename ?> character</legend>
              <div class="Suggestion">
                Use 3-20 alphanumeric characters: A-Z, a-z, 0-9, no spaces
              </div>
              <div class="Validators">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
              </div>
              <div class="UsernameRow">
                <label for="ctl00_cphRoblox_UserName" id="ctl00_cphRoblox_UserNameLabel" class="Label">Character Name:</label>&nbsp;<input name="username" type="text" id="ctl00_cphRoblox_UserName" tabindex="1" class="TextBox"/>
              </div>
            </fieldset>
          </div>
          <div id="EnterPassword">
            <fieldset title="Choose your <?=$sitename ?> password">
              <legend>Choose your <?=$sitename ?> password</legend>
              <div class="Suggestion">
                4-10 characters, no spaces
              </div>
              <div class="Validators">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
              </div>
              <div class="PasswordRow">
                <label for="ctl00_cphRoblox_Password" id="ctl00_cphRoblox_LabelPassword" class="Label">Password:</label>&nbsp;<input name="password" type="password" id="ctl00_cphRoblox_Password" tabindex="2" class="TextBox"/>
              </div>
              <div class="ConfirmPasswordRow">
                <label for="ctl00_cphRoblox_TextBoxPasswordConfirm" id="ctl00_cphRoblox_LabelPasswordConfirm" class="Label">Confirm Password:</label>&nbsp;<input name="confirm_password" type="password" id="ctl00_cphRoblox_TextBoxPasswordConfirm" tabindex="3" class="TextBox"/>
              </div>
            </fieldset>
          </div>
          <!--<div id="EnterPassword">
            <fieldset title="Enter an Invite Key">
              <legend>Enter an Invite Key</legend>
              <div class="Suggestion">
                Ignore this step, This site is currently public.
              </div>
              <div class="PasswordRow">
                <label for="ctl00_cphRoblox_Password" id="ctl00_cphRoblox_LabelPassword" class="Label">Invite Key:</label>&nbsp;<input name="key" type="password" id="ctl00_cphRoblox_Password" tabindex="2" class="TextBox"/>
              </div>
            </fieldset>
          </div>-->
          <div id="EnterChatMode">
            <fieldset title="Choose your chat mode">
              <legend>Choose your chat mode</legend>
              <div class="Suggestion">
                All in-game chat is subject to moderation.  For enhanced chat safety, choose SuperSafe Chat; only chat from pre-approved menus will be shown to you.
              </div>
              <div class="ChatModeRow">
                <span id="ctl00_cphRoblox_rblChatMode"><input id="ctl00_cphRoblox_rblChatMode_0" type="radio" name="chatmode" value="false" checked="checked" tabindex="6"/><label for="ctl00_cphRoblox_rblChatMode_0">Safe Chat</label><br/><input id="ctl00_cphRoblox_rblChatMode_1" type="radio" name="chatmode" value="true" tabindex="6"/><label for="ctl00_cphRoblox_rblChatMode_1">SuperSafe Chat</label></span>
              </div>
            </fieldset>
          </div><!--
          <div id="EnterEmail">
            <fieldset title="Provide your parent's email address">
              <legend>Provide your parent's email address</legend>
              <div class="Suggestion">
                This will allow you to recover a lost password
              </div>
              <div class="Validators">
                <div></div>
                <div></div>
                <div></div>
              </div>
              <div class="EmailRow">
                <label for="ctl00_cphRoblox_TextBoxEMail" id="ctl00_cphRoblox_LabelEmail" class="Label">Your Parent's Email:</label>&nbsp;<input name="ctl00$cphRoblox$TextBoxEMail" type="text" id="ctl00_cphRoblox_TextBoxEMail" tabindex="4" class="TextBox"/>
              </div>
            </fieldset>
          </div>-->
          <div class="Confirm">
            <input type="submit" name="ctl00$cphRoblox$ButtonCreateAccount" value="Register" id="ctl00_cphRoblox_ButtonCreateAccount" tabindex="5" class="BigButton"/>
          </div></form>
        
</div>
    </div>
    <div id="Sidebars">
      <div id="AlreadyRegistered">
        <h3>Already Registered?</h3>
        <p>If you just need to login, go to the <a id="ctl00_cphRoblox_HyperLinkLogin" href="/Login/Default.aspx">Login</a> page.</p>
        <p>If you have already registered but you still need to download the game installer, go directly to <a id="ctl00_cphRoblox_HyperLinkDownload" href="/Install/Default.aspx">download</a>.</p>
      </div>
      <div id="TermsAndConditions">
        <h3>Terms &amp; Conditions</h3>
        <p>Registration does not provide any guarantees of service. See our <a id="ctl00_cphRoblox_HyperLinkToS" href="/Info/TermsOfService.aspx?layout=null" target="_blank">Terms of Service</a> and <a id="ctl00_cphRoblox_HyperLinkEULA" href="/Info/EULA.htm" target="_blank">Licensing Agreement</a> for details.</p>
        <p><?=$sitename ?> will not share your email address with 3rd parties. See our <a id="ctl00_cphRoblox_HyperLinkPrivacy" href="/Info/Privacy.aspx?layout=null" target="_blank">Privacy Policy</a> for details.</p>
      </div>
    </div>
    <div id="ctl00_cphRoblox_ie6_peekaboo" style="clear: both"></div>

        </div>
                <?php
include '../core/footer.php';
?>
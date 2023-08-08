<?php



if(empty(trim($_GET["ReturnUrl"]))){ $returnurl = "/"; }else{ $returnurl = htmlspecialchars(trim($_GET["ReturnUrl"])); }



// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ".$returnurl);
    exit;
}
 
// Include config file
require_once $_SERVER["DOCUMENT_ROOT"]."/core/config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: ".$returnurl);
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
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
<div id="FrameLogin" style="margin: 50px auto 150px auto; width: 500px; border: black thin solid; padding: 21px; z-index: 8; background-color: white;">
    <div id="PaneNewUser">
      <h3>New User?</h3>
      <p>You need an account to play <?=$sitename?>.</p>
      <p>If you aren't a <?=$sitename?> member then <a id="ctl00_cphRoblox_HyperLink1" href="/Login/NewAge.aspx">register</a>. It's easy and we do <em>not</em> share your personal information with anybody.</p>
    </div>
    <div id="PaneLogin">
      <h3>Log In</h3>
      
<div class="AspNet-Login"><form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
  <div class="AspNet-Login-UserPanel">
    <label for="ctl00_cphRoblox_lRobloxLogin_UserName" class="TextboxLabel"><em>U</em>ser Name:</label>
    <input type="text" id="ctl00_cphRoblox_lRobloxLogin_UserName" name="username" value="" accesskey="u">&nbsp;
  </div>
  <div class="AspNet-Login-PasswordPanel">
    <label for="ctl00_cphRoblox_lRobloxLogin_Password" class="TextboxLabel"><em>P</em>assword:</label>
    <input type="password" id="ctl00_cphRoblox_lRobloxLogin_Password" name="password" value="" accesskey="p">&nbsp;
  </div>
  <div class="AspNet-Login-SubmitPanel">
    <input type="submit" value="Log In" id="ctl00_cphRoblox_lRobloxLogin_LoginButton" name="ctl00$cphRoblox$lRobloxLogin$LoginButton" onclick="WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$lRobloxLogin$LoginButton&quot;, &quot;&quot;, true, &quot;ctl00$cphRoblox$lRobloxLogin&quot;, &quot;&quot;, false, false))">
  </div>
  <div class="AspNet-Login-PasswordRecoveryPanel">
				<a disabled="disabled" title="Forgot your password?" onclick="return false" style="display:inline-block;">
					<img src="/images/forgotpwdspeech.png" id="img" alt="Forgot your password?" border="0" onclick="window.location.href='ResetPasswordRequest.aspx'" style="position:absolute;margin-left:200px;cursor:pointer;">
					<img src="/images/loginfig.png" id="img" alt="Figure" border="0" style="margin-left: 80px;position:absolute;z-index:-1;margin-top:-50px;">
				</a>
			</div></form>
</div>
    </div>
  </div>
<?php
include '../core/footer.php';
?>
<?php include("../core/config.php"); ?>
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Save</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <style>
body {
	background-color: #dfd8df;
	padding: 10px;
	font: normal 9pt/normal Verdana, sans-serif;
}
button {
	width: 115px;
}
.awsome {
	padding-left: 133px;
	margin-top: 0px !important;
}</style>
        <script>
            function upload(gid){
                try
                {
                    $("#gamesDiv").hide();
                    $("#pickplaces").hide();
                    $("#uploading").show();
                    $("#info").html("Gathering information..");
                    $.post("https://nounblx.cf/client/up/game/getKey", {}, function(data) {
                        if(data.length > 16) {
                            $("#uploading").hide();
                            $("#error").show();
                            $("#errinfo").html(data);
                        } else {
                            $("#info").html("Working..");
                            try
                            {
                                window.external.Write().Upload('https://nounblx.cf/client/up/game/?gameid=' + gid + '&key=' + data);
                                $("#uploading").hide();
                                $("#done").show();
                            }
            				catch (ex)
            				{
                                alert("Oh no, an exception occured and your game failed to upload.");
                                $("#uploading").hide();
                                $("#gamesDiv").hide();
                                $("#error").show();
                                $("#errinfo").html(ex.name + "<br /><br />" + ex.message);
            				}
                        }
                    });
    			}
				catch (ex)
				{
                    $("#uploading").hide();
                    $("#gamesDiv").hide();
                    $("#error").show();
                    $("#errinfo").html(ex);
				}
            }
            function fix() {
                $("#gamesDiv").hide();
                $("#uploading").show();
                $("#info").html("Attempting fix...");
                setTimeout(function() {
                    try
                    {
                        window.external.Write().Upload('https://nounblx.cf/client/up/game/');
                        window.external.WriteSelection().Upload('https://nounblx.cf/client/up/game/');
                        alert("Done, click OK for more information");
                        $("#info").html("Close the client and try joining a game.<br /><small>This window will close in 5 seconds.</small>");
                        setTimeout(function() {
                            window.close();
                        }, 5000);
                    }
    				catch (ex)
    				{
                        alert("Oh no, an exception occured and attempting a fix did not work.");
                        $("#uploading").hide();
                        $("#gamesDiv").hide();
                        $("#error").show();
                        $("#errinfo").html(ex.name + "<br /><br />" + ex.message);
    				}
                }, 100);
            }
            function test() {
                window.external.Close()
            }
        </script>
    </head>
    <body> 
        <div>
            <div id="gamesDiv">
                <div style="display:inline;float:right;"></div>
                
                You are about to publish this place to <?=$sitename;?>. Please choose how you would like to save your work:
                <br />
                <br />
                <button onclick="$('#gamesDiv').hide();$('#pickplaces').show();">Create</button> <strong style="padding-left: 15px;">Create a new place on <?=$sitename;?>.</strong>&nbsp;
                <p class="awsome">Choose this to create a brand new Place. Your existing places will not be changed.</p>
                <button onclick="$('#gamesDiv').hide();$('#pickplaces').show();">Update</button> <strong style="padding-left: 15px;">Update an existing place on <?=$sitename;?>.</strong>&nbsp;
                <p class="awsome">Choose this to make changes to a Place you have previously created. You will have the oppritunity to select which Place you wish to update.</p>
                <button onclick="test()">Don\'t Save</button> <strong style="padding-left: 15px;">Exit without saving changes.</strong><br /><br />
                <button onclick="window.close();">Cancel</button> <strong style="padding-left: 15px;">Keep playing and exit later.</strong><br /><br />
                <button onclick="location.reload()" style="width:65px;">Reload</button> <button onclick="fix()" style="width:50px;">Fix</button>
                            </div>
            <div id="pickplaces" style="display:none;">
                Log in.            </div>
            <div id="uploading" style="display:none;color:blue;">
                Uploading. Please wait...<br /><br /><span id="info"></span>
            </div>
            <div id="done" style="display:none;">
                Your game has finished uploading to <?=$sitename;?>!<br /><br /><button onclick="window.close();">Close</button><br/><br/>
                <button onclick="test()">Exit</button>
            </div>
            <div id="error" style="display:none;">
                <big style="color:red;">There was an error while uploading the game. If there is no network error, please notify an administrator and screenshot the error information below.</big><br /><br /><span id="errinfo"></span>
            </div>
        </div>
    </body>
</html>
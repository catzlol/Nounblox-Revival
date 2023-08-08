<?php

header("Content-Type: text/xml");

session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/core/config.php";


$servah = DB_SERVER;

$nayme = DB_NAME;

$port = 3306;

$connected = false;

$logged = false;

try {

    $db = new PDO("mysql:host=$servah;port=$port;dbname=$nayme", DB_USERNAME, DB_PASSWORD, array(

    PDO::ATTR_PERSISTENT => true

));

    // set the PDO error mode to exception

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $connected = true;

    }

catch(PDOException $e)

    {

    echo "An error occured. For Developers: " . $e->getMessage();

    }



    if($connected)

    {

       $userId = $_GET['userId'];

       $userq1 = $db->query("SELECT * FROM users WHERE id = '$userId'");

       $user = $userq1->fetch();



       if($user){

       $logged = true;

       if($user['HeadColor'] == "1"){

    $head = "#F2F3F2";

    $HeadColor = 1;

    }elseif($user['HeadColor'] == "2"){

    $head = "#E5E4DE";

    $HeadColor = 208;

    }elseif($user['HeadColor'] == "3"){

    $head = "#A3A2A4";

    $HeadColor = 194;

    }elseif($user['HeadColor'] == "4"){

    $head = "#635F61";

    $HeadColor = 199;

    }elseif($user['HeadColor'] == "5"){

    $head = "#1B2A34";

    $HeadColor = 26;

    }elseif($user['HeadColor'] == "6"){

    $head = "#C4281B";

    $HeadColor = 21;

    }elseif($user['HeadColor'] == "7"){

    $head = "#F5CD2F";

    $HeadColor = 24;

    }elseif($user['HeadColor'] == "8"){

    $head = "#FDEA8C";

    $HeadColor = 226;

    }elseif($user['HeadColor'] == "9"){

    $head = "#0D69AB";

    $HeadColor = 23;

    }elseif($user['HeadColor'] == "10"){

    $head = "#008F9B";

    $HeadColor = 107;

    }elseif($user['HeadColor'] == "11"){

    $head = "#6E99C9";

    $HeadColor = 102;

    }elseif($user['HeadColor'] == "12"){

    $head = "#80BBDB";

    $HeadColor = 11;

    }elseif($user['HeadColor'] == "13"){

    $head = "#B4D2E3";

    $HeadColor = 45;

    }elseif($user['HeadColor'] == "14"){

    $head = "#74869C";

    $HeadColor = 135;

    }elseif($user['HeadColor'] == "15"){

    $head = "#DA8540";

    $HeadColor = 106;

    }elseif($user['HeadColor'] == "16"){

    $head = "#E29B3F";

    $HeadColor = 105;

    }elseif($user['HeadColor'] == "17"){

    $head = "#27462C";

    $HeadColor = 141;

    }elseif($user['HeadColor'] == "18"){

    $head = "#287F46";

    $HeadColor = 28;

    }elseif($user['HeadColor'] == "19"){

    $head = "#4B974A";

    $HeadColor = 37;

    }elseif($user['HeadColor'] == "20"){

    $head = "#A4BD46";

    $HeadColor = 119;

    }elseif($user['HeadColor'] == "21"){

    $head = "#A1C48B";

    $HeadColor = 29;

    }elseif($user['HeadColor'] == "22"){

    $head = "#A1C48B";

    $HeadColor = 151;

    }elseif($user['HeadColor'] == "23"){

    $head = "#A05F34";

    $HeadColor = 38;

    }elseif($user['HeadColor'] == "24"){

    $head = "#694027";

    $HeadColor = 192;

    }elseif($user['HeadColor'] == "25"){

    $head = "#6B327B";

    $HeadColor = 104;

    }elseif($user['HeadColor'] == "26"){

    $head = "#E8BAC7";

    $HeadColor = 9;

    }elseif($user['HeadColor'] == "27"){

    $head = "#DA8679";

    $HeadColor = 101;

    }elseif($user['HeadColor'] == "28"){

    $head = "#D7C599";

    $HeadColor = 5;

    }elseif($user['HeadColor'] == "29"){

    $head = "#957976";

    $HeadColor = 153;

    }elseif($user['HeadColor'] == "30"){

    $head = "#7C5C45";

    $HeadColor = 217;

    }elseif($user['HeadColor'] == "31"){

    $head = "#CC8E68";

    $HeadColor = 18;

    }elseif($user['HeadColor'] == "32"){

    $head = "#EAB891";

    $HeadColor = 125;

    }

    

    if($user['TorsoColor'] == "1"){

    $torso = "#F2F3F2";

    $TorsoColor = 1;

    }elseif($user['TorsoColor'] == "2"){

    $torso = "#E5E4DE";

    $TorsoColor = 208;

    }elseif($user['TorsoColor'] == "3"){

    $torso = "#A3A2A4";

    $TorsoColor = 194;

    }elseif($user['TorsoColor'] == "4"){

    $torso = "#635F61";

    $TorsoColor = 199;

    }elseif($user['TorsoColor'] == "5"){

    $torso = "#1B2A34";

    $TorsoColor = 26;

    }elseif($user['TorsoColor'] == "6"){

    $torso = "#C4281B";

    $TorsoColor = 21;

    }elseif($user['TorsoColor'] == "7"){

    $torso = "#F5CD2F";

    $TorsoColor = 24;

    }elseif($user['TorsoColor'] == "8"){

    $torso = "#FDEA8C";

    $TorsoColor = 226;

    }elseif($user['TorsoColor'] == "9"){

    $torso = "#0D69AB";

    $TorsoColor = 23;

    }elseif($user['TorsoColor'] == "10"){

    $torso = "#008F9B";

    $TorsoColor = 107;

    }elseif($user['TorsoColor'] == "11"){

    $torso = "#6E99C9";

    $TorsoColor = 102;

    }elseif($user['TorsoColor'] == "12"){

    $torso = "#80BBDB";

    $TorsoColor = 11;

    }elseif($user['TorsoColor'] == "13"){

    $torso = "#B4D2E3";

    $TorsoColor = 45;

    }elseif($user['TorsoColor'] == "14"){

    $torso = "#74869C";

    $TorsoColor = 135;

    }elseif($user['TorsoColor'] == "15"){

    $torso = "#DA8540";

    $TorsoColor = 106;

    }elseif($user['TorsoColor'] == "16"){

    $torso = "#E29B3F";

    $TorsoColor = 105;

    }elseif($user['TorsoColor'] == "17"){

    $torso = "#27462C";

    $TorsoColor = 141;

    }elseif($user['TorsoColor'] == "18"){

    $torso = "#287F46";

    $TorsoColor = 28;

    }elseif($user['TorsoColor'] == "19"){

    $torso = "#4B974A";

    $TorsoColor = 37;

    }elseif($user['TorsoColor'] == "20"){

    $torso = "#A4BD46";

    $TorsoColor = 119;

    }elseif($user['TorsoColor'] == "21"){

    $torso = "#A1C48B";

    $TorsoColor = 29;

    }elseif($user['TorsoColor'] == "22"){

    $torso = "#A1C48B";

    $TorsoColor = 151;

    }elseif($user['TorsoColor'] == "23"){

    $torso = "#A05F34";

    $TorsoColor = 38;

    }elseif($user['TorsoColor'] == "24"){

    $torso = "#694027";

    $TorsoColor = 192;

    }elseif($user['TorsoColor'] == "25"){

    $torso = "#6B327B";

    $TorsoColor = 104;

    }elseif($user['TorsoColor'] == "26"){

    $torso = "#E8BAC7";

    $TorsoColor = 9;

    }elseif($user['TorsoColor'] == "27"){

    $torso = "#DA8679";

    $TorsoColor = 101;

    }elseif($user['TorsoColor'] == "28"){

    $torso = "#D7C599";

    $TorsoColor = 5;

    }elseif($user['TorsoColor'] == "29"){

    $torso = "#957976";

    $TorsoColor = 153;

    }elseif($user['TorsoColor'] == "30"){

    $torso = "#7C5C45";

    $TorsoColor = 217;

    }elseif($user['TorsoColor'] == "31"){

    $torso = "#CC8E68";

    $TorsoColor = 18;

    }elseif($user['TorsoColor'] == "32"){

    $torso = "#EAB891";

    $TorsoColor = 125;

    }

    

    if($user['LeftArmColor'] == "1"){

    $leftarm = "#F2F3F2";

    $LeftArmColor = 1;

    }elseif($user['LeftArmColor'] == "2"){

    $leftarm = "#E5E4DE";

    $LeftArmColor = 208;

    }elseif($user['LeftArmColor'] == "3"){

    $leftarm = "#A3A2A4";

    $LeftArmColor = 194;

    }elseif($user['LeftArmColor'] == "4"){

    $leftarm = "#635F61";

    $LeftArmColor = 199;

    }elseif($user['LeftArmColor'] == "5"){

    $leftarm = "#1B2A34";

    $LeftArmColor = 26;

    }elseif($user['LeftArmColor'] == "6"){

    $leftarm = "#C4281B";

    $LeftArmColor = 21;

    }elseif($user['LeftArmColor'] == "7"){

    $leftarm = "#F5CD2F";

    $LeftArmColor = 24;

    }elseif($user['LeftArmColor'] == "8"){

    $leftarm = "#FDEA8C";

    $LeftArmColor = 226;

    }elseif($user['LeftArmColor'] == "9"){

    $leftarm = "#0D69AB";

    $LeftArmColor = 23;

    }elseif($user['LeftArmColor'] == "10"){

    $leftarm = "#008F9B";

    $LeftArmColor = 107;

    }elseif($user['LeftArmColor'] == "11"){

    $leftarm = "#6E99C9";

    $LeftArmColor = 102;

    }elseif($user['LeftArmColor'] == "12"){

    $leftarm = "#80BBDB";

    $LeftArmColor = 11;

    }elseif($user['LeftArmColor'] == "13"){

    $leftarm = "#B4D2E3";

    $LeftArmColor = 45;

    }elseif($user['LeftArmColor'] == "14"){

    $leftarm = "#74869C";

    $LeftArmColor = 135;

    }elseif($user['LeftArmColor'] == "15"){

    $leftarm = "#DA8540";

    $LeftArmColor = 106;

    }elseif($user['LeftArmColor'] == "16"){

    $leftarm = "#E29B3F";

    $LeftArmColor = 105;

    }elseif($user['LeftArmColor'] == "17"){

    $leftarm = "#27462C";

    $LeftArmColor = 141;

    }elseif($user['LeftArmColor'] == "18"){

    $leftarm = "#287F46";

    $LeftArmColor = 28;

    }elseif($user['LeftArmColor'] == "19"){

    $leftarm = "#4B974A";

    $LeftArmColor = 37;

    }elseif($user['LeftArmColor'] == "20"){

    $leftarm = "#A4BD46";

    $LeftArmColor = 119;

    }elseif($user['LeftArmColor'] == "21"){

    $leftarm = "#A1C48B";

    $LeftArmColor = 29;

    }elseif($user['LeftArmColor'] == "22"){

    $leftarm = "#A1C48B";

    $LeftArmColor = 151;

    }elseif($user['LeftArmColor'] == "23"){

    $leftarm = "#A05F34";

    $LeftArmColor = 38;

    }elseif($user['LeftArmColor'] == "24"){

    $leftarm = "#694027";

    $LeftArmColor = 192;

    }elseif($user['LeftArmColor'] == "25"){

    $leftarm = "#6B327B";

    $LeftArmColor = 104;

    }elseif($user['LeftArmColor'] == "26"){

    $leftarm = "#E8BAC7";

    $LeftArmColor = 9;

    }elseif($user['LeftArmColor'] == "27"){

    $leftarm = "#DA8679";

    $LeftArmColor = 101;

    }elseif($user['LeftArmColor'] == "28"){

    $leftarm = "#D7C599";

    $LeftArmColor = 5;

    }elseif($user['LeftArmColor'] == "29"){

    $leftarm = "#957976";

    $LeftArmColor = 153;

    }elseif($user['LeftArmColor'] == "30"){

    $leftarm = "#7C5C45";

    $LeftArmColor = 217;

    }elseif($user['LeftArmColor'] == "31"){

    $leftarm = "#CC8E68";

    $LeftArmColor = 18;

    }elseif($user['LeftArmColor'] == "32"){

    $leftarm = "#EAB891";

    $LeftArmColor = 125;

    }

    

    if($user['RightArmColor'] == "1"){

    $rightarm = "#F2F3F2";

    $RightArmColor = 1;

    }elseif($user['RightArmColor'] == "2"){

    $rightarm = "#E5E4DE";

    $RightArmColor = 208;

    }elseif($user['RightArmColor'] == "3"){

    $rightarm = "#A3A2A4";

    $RightArmColor = 194;

    }elseif($user['RightArmColor'] == "4"){

    $rightarm = "#635F61";

    $RightArmColor = 199;

    }elseif($user['RightArmColor'] == "5"){

    $rightarm = "#1B2A34";

    $RightArmColor = 26;

    }elseif($user['RightArmColor'] == "6"){

    $rightarm = "#C4281B";

    $RightArmColor = 21;

    }elseif($user['RightArmColor'] == "7"){

    $rightarm = "#F5CD2F";

    $RightArmColor = 24;

    }elseif($user['RightArmColor'] == "8"){

    $rightarm = "#FDEA8C";

    $RightArmColor = 226;

    }elseif($user['RightArmColor'] == "9"){

    $rightarm = "#0D69AB";

    $RightArmColor = 23;

    }elseif($user['RightArmColor'] == "10"){

    $rightarm = "#008F9B";

    $RightArmColor = 107;

    }elseif($user['RightArmColor'] == "11"){

    $rightarm = "#6E99C9";

    $RightArmColor = 102;

    }elseif($user['RightArmColor'] == "12"){

    $rightarm = "#80BBDB";

    $RightArmColor = 11;

    }elseif($user['RightArmColor'] == "13"){

    $rightarm = "#B4D2E3";

    $RightArmColor = 45;

    }elseif($user['RightArmColor'] == "14"){

    $rightarm = "#74869C";

    $RightArmColor = 135;

    }elseif($user['RightArmColor'] == "15"){

    $rightarm = "#DA8540";

    $RightArmColor = 106;

    }elseif($user['RightArmColor'] == "16"){

    $rightarm = "#E29B3F";

    $RightArmColor = 105;

    }elseif($user['RightArmColor'] == "17"){

    $rightarm = "#27462C";

    $RightArmColor = 141;

    }elseif($user['RightArmColor'] == "18"){

    $rightarm = "#287F46";

    $RightArmColor = 28;

    }elseif($user['RightArmColor'] == "19"){

    $rightarm = "#4B974A";

    $RightArmColor = 37;

    }elseif($user['RightArmColor'] == "20"){

    $rightarm = "#A4BD46";

    $RightArmColor = 119;

    }elseif($user['RightArmColor'] == "21"){

    $rightarm = "#A1C48B";

    $RightArmColor = 29;

    }elseif($user['RightArmColor'] == "22"){

    $rightarm = "#A1C48B";

    $RightArmColor = 151;

    }elseif($user['RightArmColor'] == "23"){

    $rightarm = "#A05F34";

    $RightArmColor = 38;

    }elseif($user['RightArmColor'] == "24"){

    $rightarm = "#694027";

    $RightArmColor = 192;

    }elseif($user['RightArmColor'] == "25"){

    $rightarm = "#6B327B";

    $RightArmColor = 104;

    }elseif($user['RightArmColor'] == "26"){

    $rightarm = "#E8BAC7";

    $RightArmColor = 9;

    }elseif($user['RightArmColor'] == "27"){

    $rightarm = "#DA8679";

    $RightArmColor = 101;

    }elseif($user['RightArmColor'] == "28"){

    $rightarm = "#D7C599";

    $RightArmColor = 5;

    }elseif($user['RightArmColor'] == "29"){

    $rightarm = "#957976";

    $RightArmColor = 153;

    }elseif($user['RightArmColor'] == "30"){

    $rightarm = "#7C5C45";

    $RightArmColor = 217;

    }elseif($user['RightArmColor'] == "31"){

    $rightarm = "#CC8E68";

    $RightArmColor = 18;

    }elseif($user['RightArmColor'] == "32"){

    $rightarm = "#EAB891";

    $RightArmColor = 125;

    }

    

    if($user['LeftLegColor']== "1"){

    $leftleg = "#F2F3F2";

    $LeftLegColor = 1;

    }elseif($user['LeftLegColor']== "2"){

    $leftleg = "#E5E4DE";

    $LeftLegColor = 208;

    }elseif($user['LeftLegColor']== "3"){

    $leftleg = "#A3A2A4";

    $LeftLegColor = 194;

    }elseif($user['LeftLegColor']== "4"){

    $leftleg = "#635F61";

    $LeftLegColor = 199;

    }elseif($user['LeftLegColor']== "5"){

    $leftleg = "#1B2A34";

    $LeftLegColor = 26;

    }elseif($user['LeftLegColor']== "6"){

    $leftleg = "#C4281B";

    $LeftLegColor = 21;

    }elseif($user['LeftLegColor']== "7"){

    $leftleg = "#F5CD2F";

    $LeftLegColor = 24;

    }elseif($user['LeftLegColor']== "8"){

    $leftleg = "#FDEA8C";

    $LeftLegColor = 226;

    }elseif($user['LeftLegColor']== "9"){

    $leftleg = "#0D69AB";

    $LeftLegColor = 23;

    }elseif($user['LeftLegColor']== "10"){

    $leftleg = "#008F9B";

    $LeftLegColor = 107;

    }elseif($user['LeftLegColor']== "11"){

    $leftleg = "#6E99C9";

    $LeftLegColor = 102;

    }elseif($user['LeftLegColor']== "12"){

    $leftleg = "#80BBDB";

    $LeftLegColor = 11;

    }elseif($user['LeftLegColor']== "13"){

    $leftleg = "#B4D2E3";

    $LeftLegColor = 45;

    }elseif($user['LeftLegColor']== "14"){

    $leftleg = "#74869C";

    $LeftLegColor = 135;

    }elseif($user['LeftLegColor']== "15"){

    $leftleg = "#DA8540";

    $LeftLegColor = 106;

    }elseif($user['LeftLegColor']== "16"){

    $leftleg = "#E29B3F";

    $LeftLegColor = 105;

    }elseif($user['LeftLegColor']== "17"){

    $leftleg = "#27462C";

    $LeftLegColor = 141;

    }elseif($user['LeftLegColor']== "18"){

    $leftleg = "#287F46";

    $LeftLegColor = 28;

    }elseif($user['LeftLegColor']== "19"){

    $leftleg = "#4B974A";

    $LeftLegColor = 37;

    }elseif($user['LeftLegColor']== "20"){

    $leftleg = "#A4BD46";

    $LeftLegColor = 119;

    }elseif($user['LeftLegColor']== "21"){

    $leftleg = "#A1C48B";

    $LeftLegColor = 29;

    }elseif($user['LeftLegColor']== "22"){

    $leftleg = "#A1C48B";

    $LeftLegColor = 151;

    }elseif($user['LeftLegColor']== "23"){

    $leftleg = "#A05F34";

    $LeftLegColor = 38;

    }elseif($user['LeftLegColor']== "24"){

    $leftleg = "#694027";

    $LeftLegColor = 192;

    }elseif($user['LeftLegColor']== "25"){

    $leftleg = "#6B327B";

    $LeftLegColor = 104;

    }elseif($user['LeftLegColor']== "26"){

    $leftleg = "#E8BAC7";

    $LeftLegColor = 9;

    }elseif($user['LeftLegColor']== "27"){

    $leftleg = "#DA8679";

    $LeftLegColor = 101;

    }elseif($user['LeftLegColor']== "28"){

    $leftleg = "#D7C599";

    $LeftLegColor = 5;

    }elseif($user['LeftLegColor']== "29"){

    $leftleg = "#957976";

    $LeftLegColor = 153;

    }elseif($user['LeftLegColor']== "30"){

    $leftleg = "#7C5C45";

    $LeftLegColor = 217;

    }elseif($user['LeftLegColor']== "31"){

    $leftleg = "#CC8E68";

    $LeftLegColor = 18;

    }elseif($user['LeftLegColor']== "32"){

    $leftleg = "#EAB891";

    $LeftLegColor = 125;

    }

    

    if($user['RightLegColor'] == "1"){

    $rightleg = "#F2F3F2";

    $RightLegColor = 1;

    }elseif($user['RightLegColor'] == "2"){

    $rightleg = "#E5E4DE";

    $RightLegColor = 208;

    }elseif($user['RightLegColor'] == "3"){

    $rightleg = "#A3A2A4";

    $RightLegColor = 194;

    }elseif($user['RightLegColor'] == "4"){

    $rightleg = "#635F61";

    $RightLegColor = 199;

    }elseif($user['RightLegColor'] == "5"){

    $rightleg = "#1B2A34";

    $RightLegColor = 26;

    }elseif($user['RightLegColor'] == "6"){

    $rightleg = "#C4281B";

    $RightLegColor = 21;

    }elseif($user['RightLegColor'] == "7"){

    $rightleg = "#F5CD2F";

    $RightLegColor = 24;

    }elseif($user['RightLegColor'] == "8"){

    $rightleg = "#FDEA8C";

    $RightLegColor = 226;

    }elseif($user['RightLegColor'] == "9"){

    $rightleg = "#0D69AB";

    $RightLegColor = 23;

    }elseif($user['RightLegColor'] == "10"){

    $rightleg = "#008F9B";

    $RightLegColor = 107;

    }elseif($user['RightLegColor'] == "11"){

    $rightleg = "#6E99C9";

    $RightLegColor = 102;

    }elseif($user['RightLegColor'] == "12"){

    $rightleg = "#80BBDB";

    $RightLegColor = 11;

    }elseif($user['RightLegColor'] == "13"){

    $rightleg = "#B4D2E3";

    $RightLegColor = 45;

    }elseif($user['RightLegColor'] == "14"){

    $rightleg = "#74869C";

    $RightLegColor = 135;

    }elseif($user['RightLegColor'] == "15"){

    $rightleg = "#DA8540";

    $RightLegColor = 106;

    }elseif($user['RightLegColor'] == "16"){

    $rightleg = "#E29B3F";

    $RightLegColor = 105;

    }elseif($user['RightLegColor'] == "17"){

    $rightleg = "#27462C";

    $RightLegColor = 141;

    }elseif($user['RightLegColor'] == "18"){

    $rightleg = "#287F46";

    $RightLegColor = 28;

    }elseif($user['RightLegColor'] == "19"){

    $rightleg = "#4B974A";

    $RightLegColor = 37;

    }elseif($user['RightLegColor'] == "20"){

    $rightleg = "#A4BD46";

    $RightLegColor = 119;

    }elseif($user['RightLegColor'] == "21"){

    $rightleg = "#A1C48B";

    $RightLegColor = 29;

    }elseif($user['RightLegColor'] == "22"){

    $rightleg = "#A1C48B";

    $RightLegColor = 151;

    }elseif($user['RightLegColor'] == "23"){

    $rightleg = "#A05F34";

    $RightLegColor = 38;

    }elseif($user['RightLegColor'] == "24"){

    $rightleg = "#694027";

    $RightLegColor = 192;

    }elseif($user['RightLegColor'] == "25"){

    $rightleg = "#6B327B";

    $RightLegColor = 104;

    }elseif($user['RightLegColor'] == "26"){

    $rightleg = "#E8BAC7";

    $RightLegColor = 9;

    }elseif($user['RightLegColor'] == "27"){

    $rightleg = "#DA8679";

    $RightLegColor = 101;

    }elseif($user['RightLegColor'] == "28"){

    $rightleg = "#D7C599";

    $RightLegColor = 5;

    }elseif($user['RightLegColor'] == "29"){

    $rightleg = "#957976";

    $RightLegColor = 153;

    }elseif($user['RightLegColor'] == "30"){

    $rightleg = "#7C5C45";

    $RightLegColor = 217;

    }elseif($user['RightLegColor'] == "31"){

    $rightleg = "#CC8E68";

    $RightLegColor = 18;

    }elseif($user['RightLegColor'] == "32"){

    $rightleg = "#EAB891";

    $RightLegColor = 125;

    }

?>


<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.roblox.com/roblox.xsd" version="4">
<External>null</External>
<External>nil</External>
<Item class="BodyColors">
<Properties>
<int name="HeadColor"><?=$user['HeadColor'];?></int>
<int name="LeftArmColor"><?=$user['LeftArmColor'];?></int>
<int name="LeftLegColor"><?=$user['LeftLegColor'];?></int>
<string name="Name">Body Colors</string>
<int name="RightArmColor"><?=$user['RightArmColor'];?></int>
<int name="RightLegColor"><?=$user['RightLegColor'];?></int>
<int name="TorsoColor"><?=$user['TorsoColor'];?></int>
<bool name="archivable">true</bool>
</Properties>
</Item>
<?php /*<Item class="ShirtGraphic" referent="RBX0">
<Properties>
<Content name="Graphic">
<url>http://<?=$_SERVER['SERVER_NAME'];?>/asset/?id=0</url>
</Content>
<string name="Name">Shirt Graphic</string>
<bool name="archivable">true</bool>
</Properties>
</Item> */ ?>
</roblox>



<?

    }

}
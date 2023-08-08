<?php // die("adding cooldown wait"); // die(print_r($_FILES));
include('../core/header.php');
?>
<?php require '../core/nav.php'; ?>
<?php
if (mysqli_connect_errno()) 
{
    printf("Connect failed: %s\n", mysqli_connect_error());
}

if($_USER['gamesflood'] + 60 > time()){die("Error creating place."); exit;}

// print_r($_FILES);

$antiexploitpart1 = $link->query("SELECT * FROM games WHERE ip = '".mysqli_real_escape_string($link, $_POST['ip'])."' AND port = '".mysqli_real_escape_string($link, $_POST['port'])."'");

$antiexploitpart2 = $antiexploitpart1->num_rows;

if($antiexploitpart2 > 0){die("Error creating place."); exit;}

if(!$_USER){die("Error creating place."); exit;}

$currentDirectory = getcwd();
    $uploadDirectory = "../thumbs/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png','gif']; // These will be the only file extensions allowed 

    $fileName = $_FILES['thumb']['name'];
    $fileSize = $_FILES['thumb']['size'];
    $fileTmpName  = $_FILES['thumb']['tmp_name'];
    $fileType = $_FILES['thumb']['type'];
    $fileExtension = strtolower(end(explode('.',htmlentities(mysqli_real_escape_string($link, $fileName)))));

    $uploadPath = $uploadDirectory . time() . "." . $fileExtension; 
    $jelly = time() . "." . $fileExtension;

    //print_r($_FILES);
if($fileSize > 0)
{ 
    $errors=array();
    $allowed_ext= array('jpg','jpeg','png','gif');
    $file_name =$_FILES['thumb']['name']; // die(print_r($_FILES));
 //   $file_name =$_FILES['image']['tmp_name'];
    $file_ext = strtolower(end(explode('.',htmlentities(mysqli_real_escape_string($link, $file_name)))));


    $file_size=$_FILES['thumb']['size'];
    $file_tmp= $_FILES['thumb']['tmp_name'];
    // echo $file_tmp;echo "<br>";

    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
    $data = file_get_contents($file_tmp);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    // echo "Base64 is ".$base64; die();



    if (! in_array($file_ext,$allowed_ext))
    {
        $errors[]='Extension not allowed';
    }

    if($file_size > 8388608)
    {
        $errors[]= 'File size must be under 8mb';

    }
    if(empty($errors))
    {
       if( move_uploaded_file($file_tmp, 'images/'.$file_name));
       {
        header("Location: /Games.aspx");
       }
    }
    else
    {
        foreach($errors as $error)
        {
          // die("Error creating place."); 
          echo $error , '<br/>'; 
        }
    }
   //  print_r($errors);

}else{
  header("Location: /Games.aspx");
  }
  
$namefixed = mysqli_real_escape_string($link,$_POST['name']);
$player = $_USER['id'];
$ipcrypt = mysqli_real_escape_string($link, $_POST['ip']);
$port = mysqli_real_escape_string($link, $_POST['port']);
// print_r($_FILES); file_get_contents($_FILES['tmp_name']); die();
  
$okthing = base64_encode($data);

$sql="INSERT INTO games (name, description, ip, port, creator_id, thumbnail)

VALUES

('$namefixed','$_POST[map]','$ipcrypt','$port','$player','$okthing')";

$antispam="update users set gamesflood = '".time()."' where id = '".$_USER['id']."'";

if (!$link->query($sql))
{
  printf("Error: %s\n", $link->error);
}

if (!$link->query($antispam))
{
  printf("Error: %s\n", $link->error);
}

$port=$_POST['port'];
$playerlimit=$_POST['playerlimit']; die();
?>
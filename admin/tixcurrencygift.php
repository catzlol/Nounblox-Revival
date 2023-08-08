<?php include('include.php'); ?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $usertogift = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM users WHERE username = '".addslashes(mysqli_real_escape_string($link, $_POST["username"]))."';"));
    $sql = "UPDATE users SET tix = tix + '".mysqli_real_escape_string($link, $_POST["count"])."' WHERE username = '".addslashes(mysqli_real_escape_string($link, $usertogift["username"]))."';";
    mysqli_query($link, $sql);
    echo "<h1>Successfully gifted ".htmlspecialchars($usertogift['username'])." ".mysqli_real_escape_string($link, $_POST['count'])." Tickets</h1>";
}
?>
<center>
<a href="currencygift.php"><h1 style="color: black;">< Back</h1></a>
<form method="POST" action="">
    <input type="text" name="username" placeholder="Username to gift">
    <input type="text" name="count" placeholder="How many">
    <input type="submit" name="submit" value="Gift">
</form>
</center>
<?php include('finclude.php'); ?>
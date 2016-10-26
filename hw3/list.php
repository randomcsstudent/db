<html>
<body>
<?php
$dbhost='dbase.cs.jhu.edu';
$dbuser='cs41515_***';
$dbpass='***';
$conn=mysql_connect($dbhost, $dbuser, $dbpass);
if(!$conn){
	die('Error connecting to mysql');
}

$dbname='cs41515_***_db';
if(!mysql_select_db($dbname, $conn)){
	echo 'Could not select db';
	exit;
}

$pass=$_POST["password"];
$accessSql='SELECT * FROM Passwords WHERE CurPasswords="'.$pass.'"';
$listSql='SELECT * FROM Rawscores WHERE Rawscores.ssn != "0001" and Rawscores.ssn != "0002" 
		  ORDER BY Section, Lname, Fname;';

$passOk = mysql_query($accessSql);
$numRows = mysql_num_rows($passOk);
if($numRows > 0){
	$list = mysql_query($listSql);
	if(!$list) {
		echo 'couldn\'t query db for some reason <br/>';
		break;
	} else {
		echo 'SNN LName FName Section HW1 HW2a HW2b Midterm HW3 FExam <br/>';
		while($row = mysql_fetch_assoc($list)){
			foreach($row as $cell){
				echo $cell + ', ';
			} 
			echo '<br/>';
		}
	}
} else {
	echo 'access denied, incorrect pass';
}
?>
</body>

</html>
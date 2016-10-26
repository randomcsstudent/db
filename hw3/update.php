<html>
<body>
<?php
	$dbhost='dbase.cs.jhu.edu';
	$dbuser='cs41515_***';
	$dbpass='***';
	$dbname='cs41515_***_db';

	$conn=new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	// Check connection
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s<br>", mysqli_connect_error());
	    exit();
	}

	
	$pass=$_POST["password"];
	$ssn=$_POST["ssn"];
	$score=intval($_POST["new"]);
	if($conn->multi_query("CALL UpdateMidterm('".$pass."','".$ssn."','".$score."');")){
		if($result = mysqli_store_result($conn)){
			while($row = mysqli_fetch_row($result)){
				echo $row[0];
			}
			mysqli_free_result($result);
		}
	} else {
		echo "Error: " + $conn->error;	
	}
	mysqli_close($conn);

?>
</body>
</html>
<!DOCTYPE html>

<html>

<head>
<meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<title>Title</title>
<style>
.highlight {
background-color: skyblue; }

h2{
	color:red;
}
</style>

</head>

<body>

<form name="form_update" method="post" action="exercise-city-school.php">

<?php

$a = $b = $c = $d = "";
session_start(); 
//var_dump($_SESSION);

if(!isset($_SESSION['sess_username'])) {
	echo "<script type= 'text/javascript'>alert('User not logged in.');</script>";
	header("Location: login.php"); 
}
// 1 - preparer  connexion
$connectionDb = new PDO('mysql:host=localhost:3306;dbname=exam_php;charset=utf8','root','');
// 2 – prepare the query
$result = $connectionDb->prepare("select * from user");
// 3 – add the parameters (inutil)
// 4 - run the query and retrieve thecursor
$result->execute();
// 5 fetch data line by line
//drop down 
echo "Prof<select name= 'prenom'>";
echo '<option value="">'.'--- Please Select Professor ---'.'</option>';

//fetch the data from database
while($row= $result->fetch())
{

$a = $row['id'];
echo "<option value='". $row['id']."'>".$row['prenom'].'</option>';
}
echo '</select><br><br>';

//--------------------------------------
// 1 - preparer  connexion
//$connectionDb = new PDO('mysql:host=localhost:3306;dbname=exam_php;charset=utf8','root','');
// 2 – prepare the query
$resulta = $connectionDb->prepare("select * from room");
// 3 – add the parameters (inutil)
// 4 - run the query and retrieve thecursor
$resulta->execute();
// 5 fetch data line by line
//drop down 
echo "Room<select name= 'rdescription'>";
echo '<option value="">'.'--- Please Select Room ---'.'</option>';

//fetch the data from database
while($row= $resulta->fetch())
{
	$b = $row['id'];


echo "<option value='". $row['id']."'>".$row['description'].'</option>';
}
echo '</select><br><br>';


//--------------------------------------
// 1 - preparer  connexion
$connectionDb = new PDO('mysql:host=localhost:3306;dbname=exam_php;charset=utf8','root','');
// 2 – prepare the query
$resultb = $connectionDb->prepare("select * from course");
// 3 – add the parameters (inutil)
// 4 - run the query and retrieve thecursor
$resultb->execute();
// 5 fetch data line by line
//drop down 
echo "Course<select name= 'description'>";
echo '<option value="">'.'--- Please Select Course ---'.'</option>';

//fetch the data from database
while($row= $resultb->fetch())
{
	$c = $row['id'];


echo "<option value='". $row['id']."'>".$row['description'].'</option>';
}
echo '</select><br><br>';


//--------------------------------------
// 1 - preparer  connexion
$connectionDb = new PDO('mysql:host=localhost:3306;dbname=exam_php;charset=utf8','root','');
// 2 – prepare the query
$result = $connectionDb->prepare("select * from month");
// 3 – add the parameters (inutil)
// 4 - run the query and retrieve thecursor
$result->execute();
// 5 fetch data line by line
//drop down 
echo "Month<select name= 'description'>";
echo '<option value="">'.'--- Please Select Month ---'.'</option>';

//fetch the data from database
while($row= $result->fetch())
{
	$d = $row['id'];


echo "<option value='". $row['description']."'>".$row['description'].'</option>';
}
echo '</select>';

?>
<br><br><button name="submitAdd" >Add</button>
<?php
if(isset($_POST["submitAdd"])) 
{
					
	$result_0 = $connectionDb->prepare("INSERT INTO schedule (iduser, idcourse, idroom, idmonth) VALUES ('".$a."','".$b."', '".$c."', '".$d."')");
	// 3 – add the parameters (inutil)
	// 4 - run the query and retrieve thecursor

		if ($result_0->execute()) {
			echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
		}
		else{
			echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
		}
}
?>
</form>



<form name="form_update" method="post" action="exercise-school-teacher.php">

<?php

// 1 - prepare the connection
$connectionDb = new PDO('mysql:host=localhost:3306;dbname=exam_php;charset=utf8','root','');

// 2 – prepare the query
$result = $connectionDb->prepare("SELECT schedule.id as id, user.prenom as prenom, course.description as cdescription, room.description as rdescription, month.description as mdescription
FROM `user`,`schedule`,`course`,`room`, `month` 
where `user`.`id`=`schedule`.`iduser` and
`schedule`.`idcourse`=`course`.`id` and 
`room`.`id` = `schedule`.`idroom` and 
`month`.`id`=`schedule`.`idmonth`");


// 3 – add the parameters (inutil)

echo "<div class='container'>
  <h2>Current User : ".$_SESSION['sess_username']."</h2> 
  <p>List of all users</p>";

echo "<table border='1' class='table table-hover'>
<tr>
<th>Prof</th>
<th>Course</th>
<th>Room</th>
<th>Month</th>
<th>Remove</th>
</tr>";
////*<th>Action</th>*/

// 4 - run the query and retrieve thecursor
$result->execute();
// 5 fetch data line by line
//drop down
while($line=$result->fetch())
{
//	if($line['id']==$_SESSION['sess_user_id']){
		echo "<tr>";
		echo "<td>" . $line['prenom'] . "</td>";
		echo "<td>" . $line['cdescription'] . "</td>";
		echo "<td>" . $line['rdescription'] . "</td>";
		echo "<td>" . $line['mdescription'] . "</td>";
		echo "<td>" . $line['mdescription'] . "</td>";
		echo "<td>";
		// echo "<a href='read.php?id=". $line['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
		// echo "<a href='update.php?id=". $line['id'] .'&firstName='. $line['firstName'] .'&lastName='. $line['lastName'] .'&email='. $line['email'] .'&userName='. $line['userName'] .'&userPassword='. $line['userPassword'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
		echo "<a href='delete.php?id=". $line['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
		echo "</td>";
		echo "</tr>";
}
echo "</table>";
echo "</div>";
?>




</form>

<br><a href="signout.php">Log Out</a>
<br><a href="form.php" >Courses List</a>
<br><a href="form.php" >Admin</a>


</body>
</html>

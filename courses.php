<!DOCTYPE html>

<html>

<head>
<meta charset="UTF-8">
<title>Title</title>
</head>

<body>

<!--<form name="form_update" method="post" action="courses.php">-->

<?php

session_start(); 
//var_dump($_SESSION);

if(!isset($_SESSION['sess_username'])) {
	echo "<script type= 'text/javascript'>alert('User not logged in.');</script>";
	header("Location: login.php"); 
}

// 1 - prepare the connection
$connectionDb = new PDO('mysql:host=localhost:3306;dbname=exam_php;charset=utf8','root','');

// 2 – prepare the query
$result = $connectionDb->prepare("SELECT user.prenom as prenom, course.description as cdescription, room.description as rdescription, month.description as mdescription
FROM `user`,`schedule`,`course`,`room`, `month` 
where `user`.`id`=`schedule`.`iduser` and 
`schedule`.`idcourse`=`course`.`id` and 
`room`.`id` = `schedule`.`idroom` and 
`month`.`id`=`schedule`.`idmonth` and 
`user`.`prenom`='".$_SESSION['sess_username']."'
");


// 3 – add the parameters (inutil)

echo "<div class='container'>
  <h2>Current User : ".$_SESSION['sess_username']."</h2> 
  <p>Courses List for current user</p>";

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
		// echo "<td>";
		// echo "<a href='read.php?id=". $line['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
		// echo "<a href='update.php?id=". $line['id'] .'&firstName='. $line['firstName'] .'&lastName='. $line['lastName'] .'&email='. $line['email'] .'&userName='. $line['userName'] .'&userPassword='. $line['userPassword'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
		// echo "<a href='delete.php?id=". $line['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
		// echo "</td>";
		echo "</tr>";
}
echo "</table>";
echo "</div>";
?>

<form name="form_update" method="post" action="courses.php">

<?php
// 1 - preparer  connexion
$connectionDb = new PDO('mysql:host=localhost:3306;dbname=exam_php;charset=utf8','root','');
// 2 – prepare the query
$result = $connectionDb->prepare("select DISTINCT(description) from course");
// 3 – add the parameters (inutil)
// 4 - run the query and retrieve thecursor
$result->execute();
// 5 fetch data line by line
//drop down 
echo "<select name= 'description'>";
echo '<option value="">'.'--- Please Select the Course Name ---'.'</option>';

//fetch the data from database
while($row= $result->fetch())
{

echo "<option value='". $row['description']."'>".$row['description'].'</option>';
}
echo '</select>';


?>
<button name="submit" >Submit</button>


<?php
if(isset($_POST["submit"])) 
{
	//$result_1 = $connectionDb->prepare('select * from profs where ville="'.$_POST['ville'].'"');

$result_1 = $connectionDb->prepare("SELECT user.prenom as prenom, course.description as cdescription, room.description as rdescription, month.description as mdescription
FROM `user`,`schedule`,`course`,`room`, `month` 
where `user`.`id`=`schedule`.`iduser` and 
`schedule`.`idcourse`=`course`.`id` and 
`room`.`id` = `schedule`.`idroom` and 
`month`.`id`=`schedule`.`idmonth` and 
`user`.`prenom`='".$_SESSION['sess_username']."' and 
`course`.`description`='".$_POST['description']."' 
");

// 3 – add the parameters (inutil)
// 4 - run the query and retrieve thecursor
// $result_1->execute();
// while($line= $result_1->fetch())
// {
	// echo '</br>'.$line['prenom'];
// }

//--------------
echo "<br><br><br><table border='1' class='table table-hover'>
<tr>
<th>Prof</th>
<th>Course</th>
<th>Room</th>
<th>Month</th>
<th>Remove</th>
</tr>";
////*<th>Action</th>*/

// 4 - run the query and retrieve thecursor
$result_1->execute();
// 5 fetch data line by line
//drop down
while($line=$result_1->fetch())
{
//	if($line['id']==$_SESSION['sess_user_id']){
		echo "<tr>";
		echo "<td>" . $line['prenom'] . "</td>";
		echo "<td>" . $line['cdescription'] . "</td>";
		echo "<td>" . $line['rdescription'] . "</td>";
		echo "<td>" . $line['mdescription'] . "</td>";
		echo "<td>" . $line['mdescription'] . "</td>";
		// echo "<td>";
		// echo "<a href='read.php?id=". $line['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
		// echo "<a href='update.php?id=". $line['id'] .'&firstName='. $line['firstName'] .'&lastName='. $line['lastName'] .'&email='. $line['email'] .'&userName='. $line['userName'] .'&userPassword='. $line['userPassword'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
		// echo "<a href='delete.php?id=". $line['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
		// echo "</td>";
		echo "</tr>";
}
echo "</table>";

}
?>
</form>

</body>
</html>

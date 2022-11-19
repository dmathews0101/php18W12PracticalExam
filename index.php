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

<form name="form_update" method="post" action="exercise-school-teacher.php">

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
$result = $connectionDb->prepare("select  id , prenom, nom, login, password, id_role from user");
// 3 – add the parameters (inutil)

echo "<div class='container'>
  <h2>Current User : ".$_SESSION['sess_username']."</h2> 
  <p>List of all users</p>";

// 4 - run the query and retrieve thecursor
$result->execute();
// 5 fetch data line by line
//drop down
while($line=$result->fetch())
{	
	if($line['id']==$_SESSION['sess_user_id'])
	{
		if($line['id_role']=="1")
		{
			echo "<br><a href='signout.php'>Log Out</a>";
			echo "<br><a href='courses.php' >Courses List</a>";
			echo "<br><a href='admin.php' >Admin</a>";
		}
		else
		{
			echo "<br><a href='signout.php'>Log Out</a>";
			echo "<br><a href='courses.php' >Courses List</a>";
		}
	}
}
echo "</table>";
echo "</div>";
?>




</form>




</body>
</html>

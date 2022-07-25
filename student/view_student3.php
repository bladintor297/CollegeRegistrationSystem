<?php
session_start(); // Start up your PHP Session



if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: ../index.php");

if ($_SESSION["LEVEL"] == 1 || $_SESSION["LEVEL"] == 2) {   //only user with access level 1 and 2 can view

?>

	<html>

	<head>
		<title>Viewing Student Data</title>
		<link rel="stylesheet" href="../.css/viewstyle.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>
	<ul class="navi">
    	<li id="active-link" class="navi" style="float:left"><a href="../main.php"><img src="../.css/image/home.png" alt="Home" style = "width: auto;height:25px; "></a></li>
    	<!-- Dropdown hover -->
    	<li class="navi"><a>College Registration System</a></li>
    	<li id="active-link" class="navi" style="float:right"><a href="../logout.php"><img src="../.css/image/whitelogout.png" alt="try" style = "width:default;height:25px;"></a></li>
    	<li class="navi" style="float:right"><a href="#about"><img src="../.css/image/user.png" alt="try" style = "width:default;height:24px;"></a></li>
    	<li class="navi" style="float:right"><a href="#about"><?php echo $_SESSION['USER'] ?></a></li>
    </ul>
	<div class="parent">

		<!-- <div class="div2"> -->
		<h1 class="tajuk">Update Student Details</h1>

		<!-- </div> -->


		<div class="div1">

		<?php
	     require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

	     $sql = "SELECT * FROM Student ORDER BY name" ;
		 $result = mysqli_query($conn, $sql);

		 if (mysqli_num_rows($result) > 0) {
			 $var = 0
			 ?>
		<br>
		<!-- Search field -->
		<form class="search-bar" name="form1" method ="POST" action="view_search.php">
			<input class="search-box"type="text"  name="studentMatric" placeholder="Insert Matric Number" size="30">
			<button type="submit"><i class="fa fa-search" class="button2"></i></button>
		</form>

		<!-- Start table tag -->
		<table class="table2" border="1" cellspacing="0" cellpadding="3">

		<!-- Print table heading -->
		
		<tr class="header">
		<th>No</th>
		<th>Name</th> <!--Student table-->
		<th>IC</th>
		<th>Matric</th>
		<th>College</th>
		<th>Application Status</th>

		<?php if ($_SESSION["LEVEL"] == 1) {?><!--Application Manager and Admin edit report-->

			<th>Update</th>
		<th>Delete</th>
		<?php } ?>

		</tr>

		<?php
		$var=0;
			// output data of each row
			while($rows = mysqli_fetch_assoc($result)) {
		?>

        <tr class="dalam">
			<td align="center"><?php echo $var=$var+1; ?></td>
			<td ><?php echo $rows['name']; ?></td>
			<td align="center"><?php echo $rows['ic']; ?></td>
			<td align="center"><?php echo $rows['matric']; ?></td>
			<td align="center"><?php 
			if ($rows['college']== '')
			{
				echo 'N/A';
			}

			else {
				echo $rows["college"];
			}
			
			?></td>


		<?php
			if($rows['approvalstatus']=='1')
				{
					echo "<TD align=center>Approved</TD>";
				}
				else if($rows['approvalstatus']=='0')
				{
					echo "<TD align=center>Pending</TD>";
				}
				else{
					echo "<TD align=center>Rejected</TD>";

				}
		?>

		<?php if ($_SESSION["LEVEL"] == '1') {?>
			<!--only user with access level 1 can view update and delete button-->
			<!-- <td class="dalam2" align="center"> <a href="../student/update_student_form.php" target="_blank"><img src="../.css/image/Update user.svg" alt="Update Icon" style="width:42px;height:42px;"></a> </td>
			<td class="dalam2" align="center"> <a href="../student/delete_student_form.php" target="_blank"><img src="../.css/image/delete.svg" alt="Delete Icon" style="width:42px;height:42px;"></a> </td> -->
			<td align="center" > <a href="../student/update_student_form.php?name=<?php echo urlencode($rows['matric'])?>" target="_blank"><img src="../.css/image/Update user.svg" alt="Update Icon" style="width:42px;height:42px;"></a></td>
			<td align="center" > <a href="../student/delete_student_form.php?name=<?php echo urlencode($rows['matric'])?>" target="_blank" ><img src="../.css/image/delete.svg" alt="Delete Icon" style="width:42px;height:42px;"></a> </td>
		</tr>

		<!-- <form name="form1" method ="POST" action="delete_student_form.php">
	 	<tr>
		<php if ($_SESSION["LEVEL"] == '1') {?>
			<td align="center"> <a href="../student/update_student_form.php" target="_blank">Update</a> </td>
			<td align="center"> <a href="../student/delete_student_form.php" target="_blank">Delete</a> </td>
		</tr>
	    </form>	 -->

		<?php }

			}
		} else {
			echo "<h3>There are no records to show</h3>";
			}

	     mysqli_close($conn);
	   ?>

	    </table>


		<?php if ($_SESSION["LEVEL"] == '1'  ) {?>
		
		<a>**N/A College means students have not yet make any applications</a><br><br><br>
		<a href="../student/student_form.php" class="button">
		Insert New Student
		</a>

		<?php } ?>

		<br>
		<!-- <a href="../student/view_student.php">Click here to view all applications</a> <br/><br/> --><br/>
	    <!-- <div class="logout" ><a href="../logout.php">LOGOUT</a></div> -->

 	<?php } // If the user is not correct level
	else if ($_SESSION["LEVEL"] == 3 ) {

    $sql="SELECT * FROM Student WHERE id=".$_SESSION["ID"];//change ID later



 echo "<h2>Viewing ".$_SESSION["USER"]."'s Data</h2>";

 echo "<h2>View Details</h2>";

 require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

 $result = mysqli_query($conn, $sql);

 if (mysqli_num_rows($result) > 0) {

    echo "<table width='600' border='1' cellspacing='0' cellpadding='3'>";

			//Print table heading
	echo "<tr>
			<td align='center'><strong>Name</strong></td> <!--Student table-->
			<td align='center'><strong>IC</strong></td>
			<td align='center'><strong>Matric</strong></td>
			<td align='center'><strong>Application Status</strong></td>
			</tr>";

    // output data of each row
    while($rows = mysqli_fetch_assoc($result)) {

    echo    "<tr>
				<td align='center'>".$rows['name']."</td>
				<td align='center'>".$rows['ic']."</td>
				<td align='center'>".$rows['matric']."</td>
				<td align='center'>".$rows['approvalstatus']."</td>
			</tr>";

    }
    }
    else {
        echo "<h3>There are no records to show</h3>";
        }

     mysqli_close($conn);


    echo "</table>
            <br><br>
            <a href='view_student.php'>Click here to view application</a> <br/><br/>";
            //<a href="search_form.php">Search applications</a>
    echo "<br/><br/>
	<a href='logout.php'>LOGOUT</a>";
 	}

  	?>
		</div>
	</div>




	</body>
	</html>

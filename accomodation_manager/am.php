<?php session_start();
if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: ../index.php");
 ?>

<html>
	<head>
		<title>Accomodation Manager Page</title>
		<link rel="stylesheet" href="../.css/menu_style.css">
	</head>

	<body>

		<div class="menu-main-container">
			<ul class="navi">
	    	<li id="active-link" class="navi" style="float:left"><a href="../main.php"><img src="../.css/image/home.png" alt="Home" style = "width: auto;height:25px; "></a></li>
	    	<!-- Dropdown hover -->
	        <li class="navi"><a>College Registration System</a></li>
	    	<li id="active-link" class="navi" style="float:right"><a href="../logout.php"><img src="../.css/image/whitelogout.png" alt="try" style = "width:default;height:25px;"></a></li>
	    	<li class="navi" style="float:right"><a href="#about"><img src="../.css/image/user.png" alt="try" style = "width:default;height:24px;"></a></li>
	    	<li class="navi" style="float:right"><a id="username" href="#about"></a></li>
	    </ul>
			<h2 class="menu-title">Accomodation Manager page</h2>

		<div class="menu-container one">

			<div class="menu-item approve">
				<a href= "../approve/approve_form.php"><img class="menu-item-image" src="../.css/image/approve.svg" alt="Add"></a>
				<p class="menu-item-title">Approve/Reject Applications</p>
			</div>

			<div class="menu-item update">
			  <a href="update_am_form.php"><img class="menu-item-image" src="../.css/image/Update user.svg" alt="Edit"></a>
				<p class="menu-item-title">Update My Data</p>
			</div>


		</div>

		<div class="menu-container two">

			<div class="menu-item view">
				<a href="../student/view_student3.php"><img class="menu-item-image" src="../.css/image/View user.svg" alt="View"></a>
				<p class="menu-item-title">View Sorted <br>Report</p>
			</div>

		</div>

		</div>

		<script>


	const xhr = new XMLHttpRequest();
	xhr.open("GET", "http://localhost/CollegeRegistrationSystem/api/accom", true);
    xhr.send();
    xhr.onload = function () {
        var item = JSON.parse(xhr.responseText);

        for (let i = 0; i < item.length; i++) {
			// alert(item[i])
            document.getElementById("username").innerHTML = item[i].name;
        }
    
	// alert (document.getElementById("username").value);
	}
</script>



	</body>
	</html>

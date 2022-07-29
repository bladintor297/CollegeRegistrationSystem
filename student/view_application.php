<?php
session_start(); // Start up your PHP Session

// echo $_SESSION["Login"]; //for session tracking purpose, can delete
// echo $_SESSION["LEVEL"]; //for session tracking purpose, can delete
//echo $_SESSION["ID"];
//echo $_SESSION["USER"];

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: index.php");

?>

<HTML>

<HEAD>
    <TITLE>View College Application</TITLE>
    <link rel="stylesheet" href="../.css/styleupdate.css">

   


</HEAD>

<BODY>

    

  <ul class="navi">
    <li id="active-link" class="navi" style="float:left"><a href="../main.php"><img src="../.css/image/home.png" alt="Home" style = "width: auto;height:25px; "></a></li>
    <!-- Dropdown hover -->
    <li class="navi"><a>College Registration System</a></li>
    <li id="active-link" class="navi" style="float:right"><a href="../logout.php"><img src="../.css/image/whitelogout.png" alt="try" style = "width:default;height:25px;"></a></li>
    <li class="navi" style="float:right"><a href="#about"><img src="../.css/image/user.png" alt="try" style = "width:default;height:24px;"></a></li>
    <li class="navi" style="float:right"><a id="username" href="#about"></a></li>
  </ul>

  <script>


const xhr = new XMLHttpRequest();

    xhr.open('get', 'https://college-registration-system.herokuapp.com/api/studentinfo', true);
    xhr.send();
    xhr.onload = function () {
        var item = JSON.parse(xhr.responseText);
        var content = '';

        for (let i = 0; i < item.length; i++) {
            for (let i = 0; i < item.length; i++) {

						if(item[i].college == null){
							item[i].college = "N/A";
						}

						if (item[i].approvalstatus == '1'){
							item[i].approvalstatus = "Approved";
						}
						else if(item[i].approvalstatus == '0'){
							item[i].approvalstatus = "Pending";
						}
						else{
							item[i].approvalstatus = "Rejected";
						}


                        // content += "<tr class ='dalam'><td>" + [i + 1]+ "</td>" + "<td>" + item[i].name + "</td>" + "<td>" + item[i].ic + "</td>" + "<td>" + item[i].matric + "</td>" + "<td>" + item[i].college + "</td>" + "<td>" 
						// + item[i].approvalstatus + "</td>";
                        // console.log(item);
                    }
            document.getElementById("username").innerHTML = item[i].name;
            document.getElementById("nameVal").value = item[i].name;
            document.getElementById("icVal").value = item[i].ic;
            document.getElementById("matricVal").value = item[i].matric;
            document.getElementById("appVal").value = item[i].approvalstatus;
        }
    }

</script>


    <div class="profile-card">

    <div class="card-header">

    <h1>Application Details</h1><br><br>


      

    <form name="form1" method="POST" action="">
        <table class="update-table" >
            <TR>
                <TD id="td1"><strong>Student's Name:</strong></TD>
                <TD ><INPUT id="nameVal" class="update-box" type="text" name="studentName1" size="40"  disabled></TD>
            </TR>
            <TR>
                <TD id="td1"><strong>IC Number:</strong> </TD>
                <TD><INPUT class="update-box" type="text" name="studentIC1" size="15" id="icVal" disabled></TD>
            </TR>
            <TR>
                <TD id="td1"><strong> Matric Number: </strong></TD>
                <TD id="matricn"><INPUT class="update-box" type="" name="studentMatric1" size="10" style="text-transform:uppercase;" id="matricVal" disabled></TD>
            </TR>
            <TR>
                <TD id="td1"><strong> College:</strong></TD>
                <TD><select class="update-box" id="studentcollege" name="studentCollege1" disabled>
                <?php
                    $student_college = array(
                        'KTDI',
                        'KTC'
                    );

                    foreach ($student_college as $index => $value) {
                        if($result['college'] == $value) {
                            echo "<option value=\"{$value}\" selected>{$value}</option>";
                        }else{
                            echo "<option value=\"{$value}\">{$value}</option>";
                        }
                    }
                ?>
                </TD>
                </select>
            </TR>
            <TR>
                    <TD><strong>Approval Status:</strong> </TD>
                    <TD><INPUT class="update-box" type="text" name="approvalstatus2" size="5" style="text-transform:uppcercase;" id="appVal" disabled></TD>
            </TR>
            <!-- <TR>
		<TD>Room Type:</TD>
		<TD><select id = "studentroomtype" name = "studentRoomType">
			<option value="ST">Single with toilet (ST)</option>
			<option value="S">Single Room (S)</option>
			<option value="DB">Double Room (DB)</option></TD>
			</select>
	        </TR> -->


        </TABLE>

    </FORM>


    </div>
    </div>

    <!-- <script>


const xhr = new XMLHttpRequest();

    xhr.open('get', 'http://localhost/CollegeRegistrationSystem/api/studentinfo', true);
    xhr.send();
    xhr.onload = function () {
        var item = JSON.parse(xhr.responseText);

        for (let i = 0; i < item.length; i++) {
            document.getElementById("username").innerHTML = item[i].name;
        }
    }

</script> -->
</BODY>

</HTML>

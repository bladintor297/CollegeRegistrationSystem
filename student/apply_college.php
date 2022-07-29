<?php
session_start(); // Start up your PHP Session

// echo $_SESSION["Login"]; //for session tracking purpose, can delete
// echo $_SESSION["LEVEL"]; //for session tracking purpose, can delete
// echo $_SESSION["USER"];
// echo $_SESSION["ID"];

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: ../index.php");



?>

<HTML>
<HEAD>
	<TITLE>Inserting Data Into table 'student'</TITLE>
	<link rel="stylesheet" href="../.css/form_style.css">

</HEAD>
<BODY>
<div class="form-fullview">

	<ul class="navi">
    <li id="active-link" class="navi" style="float:left"><a href="../main.php"><img src="../.css/image/home.png" alt="Home" style = "width: auto;height:25px; "></a></li>
    <!-- Dropdown hover -->
      <li class="navi"><a>College Registration System</a></li>
    <li id="active-link" class="navi" style="float:right"><a href="../logout.php"><img src="../.css/image/whitelogout.png" alt="try" style = "width:default;height:25px;"></a></li>
    <li class="navi" style="float:right"><a href="#about"><img src="../.css/image/user.png" alt="try" style = "width:default;height:24px;"></a></li>
    <li class="navi" style="float:right"><a href="#about" id="username"></a></li>
  </ul>



<div class="form-table_container">



<h2 class="form_title">Available colleges:<br><br></h2>

<TABLE class="form-table" BORDER="1">
	   <TR align=center><TH class="form-table-th">No</TH><TH class="form-table-th"	>College Name</TH><TH class="form-table-th">Quota</TH><TH class="form-table-th">Available</TH></TR>

       <tbody align=center id ="item">
                   
                
                   </tbody>
</TABLE>
</div>

<br><br>
<h2 class="form_title">Please fill in the following information:<br><br></h2>

<div class="form_container">

	<div class="avatar_container">
		<img class="form_image" src="../.css/image/avatar.svg" alt="Avatar" class="avatar">
	</div>


<FORM name="form1" >

<TABLE border="0">
	<TR>
      <TD><b>Student's Name:</b></TD>
      <td><INPUT id="name" class="form_text" type="text" name="studentName" size="20" style="text-transform:uppercase" value="" disabled></td>
    </TR>
    <TR>
		<TD><b>IC Number:</b></TD>
		<TD><INPUT  id="ic" class="form_text" type="text" name="studentIC" size="15" style="text-transform:uppercase" value="" disabled></TD>
	</TR>
	<TR>
		<TD><b>Matric Number:</b></TD>
		<TD><INPUT id="matric" class="form_text" type="text" name="studentMatric" size="8"  disabled ></TD>
	</TR>
	<TR>
		<TD><b>College:</b></TD>
		<TD><select class="form_select" id = "studentcollege" name = "studentCollege">
			<option value="- Please choose a college -" style="font-style:italic" disabled selected>- Please choose a college -</option>
			<option id = "opt" name = 'studentCollege'></option>
            
           
            </select>

	</TR>

	<TR>
		<TD colspan="2"><BR><INPUT class="form_submit"type="submit" name="button1" value="Submit"></TD>
	</TR>
</TABLE>
</FORM>
</div>
</div>

<script>
    let opt = "";
    let name;
    let studentID;
    let id;
    let quota;
    let collegename; let available;
    let approvalStatus; let college;

    // let name = "", college="", matric="", ic="";

    document.addEventListener("DOMContentLoaded",function(){
            //step 1
            var xht = new XMLHttpRequest();

            //step 2
            xht.open("GET", "https://college-registration-system.herokuapp.com/api/studentinfo", true);

            //step 3
            xht.send();

            //step 4 - we do the process upon receving the response with status 200
            xht.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    // alert(this.responseText);
                    var item = JSON.parse(this.responseText);

                    var content = '';
                    for (let i = 0; i < item.length; i++) {
                        document.getElementById("username").innerHTML = item[i].name;    
                        document.getElementById("name").value = item[i].name;
                        document.getElementById("ic").value = item[i].ic;
                        document.getElementById("matric").value = item[i].matric;
                        studentID = item[i].id;
                        approvalStatus = item[i].approvalstatus;
                        name  = item[i].name;
                        college = item[i].college;
                        // matric = item[i].matric;

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
                    }
                  
                }

                //step 4, with status == 404
                else if(this.readyState == 4 && this.status == 404){
                    alert(this.status + ' resource not found');
                }
            };
        }
    )	
    
    document.addEventListener("DOMContentLoaded",function(){
    
            //step 1
            var xht = new XMLHttpRequest();
            // let collegename="", quota =0; available=0;

            //step 2
            xht.open("GET", "https://college-registration-system.herokuapp.com/api/college_list", true);

            //step 3
            xht.send();

            //step 4 - we do the process upon receving the response with status 200
            xht.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    // alert(this.responseText);
                    var item = JSON.parse(this.responseText);

                    var content = '';
                    for (let i = 0; i < item.length; i++) {
                        collegename = item[i].collegename;
                        quota = item[i].quota;
                        // alert(quota);
                        available = item[i].available;

                        content += "<td>" + item[i].id + "</td>" + "<td>" + item[i].collegename + "</td>" + "<td>" + item[i].quota + "</td>"+ "<td>" + item[i].available + "</td>" 
                        console.log(item);
                        // content2 += "<option value ="+ item[i].collegename + "name = 'studentCollege'>KTDI</option>'";
                        opt = item[i].collegename;
                        id = item[i].id;
                        // quota = item[i].quota;
                    }
                    // document.getElementById("opt").innerHTML = content2;
                    document.getElementById("item").innerHTML = content;
                    document.getElementById("opt").innerHTML = opt;
                    

                }

                //step 4, with status == 404
                else if(this.readyState == 4 && this.status == 404){
                    alert(this.status + ' resource not found');
                }
            };
        }
    )

    form1.addEventListener("submit",function(e){
    e.preventDefault();
    // var collegename = collegename;
    // alert (quota);
   
    // const data = new FormData(form1);

    // available = 2;
    // alert(id);
    // alert(collegename);
    // alert(quota);
    // alert(available);
    if (college == null || college == " "){
        if (available > 0){
        var xht = new XMLHttpRequest();

    xht.open("PUT","https://college-registration-system.herokuapp.com/api/updatequota/" + name + "/"+ studentID + "/" + approvalStatus + "/" + id + "/" + collegename + "/" + quota + "/" + (available-1),true);
    xht.send();
            
            xht.onreadystatechange = function () {
                // alert(this.responseText);
                if (this.readyState == 4 && this.status == 200) {
                    const objects = JSON.parse(this.responseText);
                    
                }
            };
            alert('College Applied Succesfully !');
            window.location.href = 'https://college-registration-system.herokuapp.com/student/view_application.php';
    } else alert (collegename + " is fully occupied.");
    } else 
    alert (" You have already applied for " + collegename);
    

})
    

    
</script>
</BODY>


</HTML>

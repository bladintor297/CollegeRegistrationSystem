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
	<!-- <sc></sc> -->
    </head>

	<body>
	<ul class="navi">
    	<li id="active-link" class="navi" style="float:left"><a href="../main.php"><img src="../.css/image/home.png" alt="Home" style = "width: auto;height:25px; "></a></li>
    	<!-- Dropdown hover -->
    	<li class="navi"><a>College Registration System</a></li>
    	<li id="active-link" class="navi" style="float:right"><a href="../logout.php"><img src="../.css/image/whitelogout.png" alt="try" style = "width:default;height:25px;"></a></li>
    	<li class="navi" style="float:right"><a href="#about"><img src="../.css/image/user.png" alt="try" style = "width:default;height:24px;"></a></li>
    	<li class="navi" style="float:right"><a id="username" href="#about"><?php echo $_SESSION['USER'] ?></a></li>
    </ul>
	<div class="parent">

		<h1 class="tajuk">Approve Student Application</h1>	

		<div class="div1">
<!-- 
		
		<br>
		<!-- Search field -->
		<!-- <form class="search-bar" id ="form" name="form1" method ="post">
			<input class="search-box"type="text"  name="studentMatric" id ="matric" placeholder="Insert Matric Number" size="30">
			<button type="submit"><i class="fa fa-search" class="button2"></i></button>
		</form> -->


		<!-- Start table tag -->
        <form id = formuser>
		<table  class="table2" border="1" cellspacing="0" cellpadding="3">

		<!-- Print table heading -->
		<thead>
		<tr class="header">
		<th>No</th>
		<th>Name</th> <!--Student table-->
		<th>IC</th>
		<th>Matric</th>
		<th>College</th>
		<th colspan="2">Action</th>

		<?php if ($_SESSION["LEVEL"] == 1) {?><!--Application Manager and Admin edit report-->

		<th>Update</th>
		<th>Delete</th>
		<?php } ?>

		</tr>

		</thead>

		<tbody id ="item">
                   
                
        </tbody>



		<?php if ($_SESSION["LEVEL"] == '1') {?>
			<!--only user with access level 1 can view update and delete button-->
			<!-- <td class="dalam2" align="center"> <a href="../student/update_student_form.php" target="_blank"><img src="../.css/image/Update user.svg" alt="Update Icon" style="width:42px;height:42px;"></a> </td>
			<td class="dalam2" align="center"> <a href="../student/delete_student_form.php" target="_blank"><img src="../.css/image/delete.svg" alt="Delete Icon" style="width:42px;height:42px;"></a> </td> -->
			<td align="center" > <a href="../student/update_student_form.php?name=<?php echo urlencode($rows['matric'])?>" target="_blank"><img src="../.css/image/Update user.svg" alt="Update Icon" style="width:42px;height:42px;"></a></td>
			<td align="center" > <a href="../student/delete_student_form.php?name=<?php echo urlencode($rows['matric'])?>" target="_blank" ><img src="../.css/image/delete.svg" alt="Delete Icon" style="width:42px;height:42px;"></a> </td>
		</tr>


		<?php }

			}
		

	   
	   ?>

	    </table>
        </form>

	
		</div>
	</div>


<script>
    
    let college;
    let approvalstatus;
    let id;
    let matric;
    let ic;
    let _id;
    document.addEventListener("DOMContentLoaded",function(){
            //step 1
            var xht = new XMLHttpRequest();

            //step 2
            xht.open("GET", "https://college-registration-system.herokuapp.com/api/students_detail_list", true);

            //step 3
            xht.send();

            //step 4 - we do the process upon receving the response with status 200
            xht.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    // alert(this.responseText);
                    var item = JSON.parse(this.responseText);
                    // var href = 
                        
                    var content = '';
                    for (let i = 0; i < item.length; i++) {
                        id =item[i].id;
                        ic = item[i].ic;
                        name = item[i].name;
                        matric = item[i].matric;
                        

						if(item[i].college == null || item[i].college == ''){
							item[i].college = "N/A";
                            content += "<tr class ='dalam'><td>" + item[i].id + "</td>" + "<td>" + item[i].name + "</td>" + "<td>" + item[i].ic + "</td>" + "<td>" + item[i].matric + "</td>" + "<td>" + item[i].college + "</td>" + 
                        "<td>N/A</td>" +
                        "<td>N/A</td>"
						}
                        else{
                            if (item[i].approvalstatus == '1'){
							item[i].approvalstatus = "Approved";
                            content += "<tr class ='dalam'><td>" + item[i].id + "</td>" + "<td>" + item[i].name + "</td>" + "<td>" + item[i].ic + "</td>" + "<td>" + item[i].matric + "</td>" + "<td>" + item[i].college + "</td>" + 
                        "<td><input id='" + item[i].id +  "' type='submit' name='button' value='Approve' onclick='ApproveStatus(this.id);'></td>" +
                        "<td><input id='" + item[i].id +  "' type='submit' name='button' value='Reject' onclick='RejectStatus(this.id);'></td>"
						}
						else if(item[i].approvalstatus == '0'){
							item[i].approvalstatus = "Pending";
                            content += "<tr class ='dalam'><td>" + item[i].id + "</td>" + "<td>" + item[i].name + "</td>" + "<td>" + item[i].ic + "</td>" + "<td>" + item[i].matric + "</td>" + "<td>" + item[i].college + "</td>" + 
                        "<td><input id='" + item[i].id +  "' type='submit' name='button' value='Approve' onclick='ApproveStatus(this.id);'></td>" +
                        "<td><input id='" + item[i].id +  "' type='submit' name='button' value='Reject' onclick='RejectStatus(this.id);'></td>"
						}
						else{
							item[i].approvalstatus = "Rejected";
                            content += "<tr class ='dalam'><td>" + item[i].id + "</td>" + "<td>" + item[i].name + "</td>" + "<td>" + item[i].ic + "</td>" + "<td>" + item[i].matric + "</td>" + "<td>" + item[i].college + "</td>" + 
                        "<td><input id='" + item[i].id +  "' type='submit' name='button' value='Approve' onclick='ApproveStatus(this.id);'></td>" +
                        "<td><input id='" + item[i].id +  "' type='submit' name='button' value='Reject' onclick='RejectStatus(this.id);'></td>"
						}
                        }

						

                        college = item[i].college;

                        
                       
                        // "<td id='reject-accept-btn'><input type='submit' id = 'reject-btn' name='button2' value='Reject'></td>" 
                        // "<td id='approve-reject-btn'><a href = '#' role='button'><input type='image' src='../.css/image/times-solid.svg' width='25px' height='25px'></a></td>"
                        console.log(item);

                        


                           }
                    document.getElementById("item").innerHTML = content;
                    document.getElementById("username").innerHTML = name;
//                     document.getElementById('button').onclick = function() {
//                     alert("button was clicked");
// }​;​
                    
                }

                //step 4, with status == 404
                else if(this.readyState == 4 && this.status == 404){
                    alert(this.status + ' resource not found');
                }
            };
        
        }
        
    )

    function ApproveStatus(id){
        // alert(id);

        var _name;
        var _id;
        var _college;
        var _approvalstatus;
        
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "https://college-registration-system.herokuapp.com/api/students_apprej_list/" + id, true);
        xhr.send();
        xhr.onload = function () {
            var item = JSON.parse(xhr.responseText);
            alert(this.responseText);
            for (let i = 0; i < item.length; i++) {
                // alert(item[i])
                _name =item[i].name;
                document.getElementById("refID").innerHTML = item[i].id;
                document.getElementById("college").innerHTML = item[i].college;
                document.getElementById("approvalstatus").innerHTML = item[i].approvalstatus;
           
            }
        
        // alert (document.getElementById("username").value);
        }

        // var _name = document.getElementById("name").value; 
        // var _id = document.getElementById("refID").value; 
        // var _college = document.getElementById("college").value; 
        // var _approvalstatus = 1;

        alert(_name +""+ id);
        const xhx = new XMLHttpRequest();
        xhx.open("PUT", "https://college-registration-system.herokuapp.com/api/updateapprove/" + _name + "/" + _id + "/" + _college + "/" + _approvalstatus, true);
        xhx.send();
            
            xhx.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const objects = JSON.parse(this.responseText);
                    
                }
            };

        

    };

    document.addEventListener("DOMContentLoaded",function(){
            // alert(_id);
            _id = 1;
            //step 1
            var xht = new XMLHttpRequest();
            

            //step 2
            xht.open("GET", "https://college-registration-system.herokuapp.com/api/college_list/" + _id, true);
            
            //step 3
            xht.send();

            //step 4 - we do the process upon receving the response with status 200
            xht.onreadystatechange = function(){
                // alert(_id);
                if(this.readyState == 4 && this.status == 200){
                    // alert(name);
                    var item = JSON.parse(this.responseText);
                    // var href = 
                        
                    var content = '';
                    for (let i = 0; i < item.length; i++) {
                        id =item[i].id;
                        collegename = item[i].collegename;
                        quota = item[i].quota;
                        available = item[i].available;
                        college = item[i].college;
                        // console.log(item);

                           }

                           
                }

                //step 4, with status == 404
                else if(this.readyState == 4 && this.status == 404){
                    alert(this.status + ' resource not found');
                }
                // alert (collegename);
            };
        
        }
        
    )
    
    
    function RejectStatus(id){
                            alert(id);
                        
                        };
    

 
</script>

	</body>
	</html>

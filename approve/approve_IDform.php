<?php session_start();
if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: ../index.php");
 ?>

<HTML>
<HEAD><TITLE>Approving Students Data</TITLE>
<link rel="stylesheet" href="../.css/styles_approve.css">
</HEAD>

<BODY>
	<div class="approve-main-container">

	<ul class="navi">
		<li id="active-link" class="navi" style="float:left"><a href="../main.php"><img src="../.css/image/home.png" alt="Home" style = "width: auto;height:25px; "></a></li>
		<li class="navi"><a>College Registration System</a></li>
		<li id="active-link" class="navi" style="float:right"><a href="../logout.php"><img src="../.css/image/whitelogout.png" alt="try" style = "width:default;height:25px;"></a></li>
		<li class="navi" style="float:right"><a href="#about"><img src="../.css/image/user.png" alt="try" style = "width:default;height:24px;"></a></li>
		<li class="navi" style="float:right"><a href="#about"><?php echo $_SESSION['USER'] ?></a></li>
	</ul>

<div class="approve-student-page">

<div class = "approve-header"><h1>Approve Student Data</h1></div>

<TABLE name ="table-approve" id="tableapprove">
	<TR>
        <TH>ID</TH>
        <TH>Student Name</TH>
        <TH>Matric Number</TH>
        <TH>IC Number</TH>
        <TH>College</TH>
    </TR>
	  
    </thead>
                <tbody id ="item">
                   
                
                </tbody>

	</TABLE>

<script>


document.addEventListener("DOMContentLoaded",function(){
            //step 1
            var xht = new XMLHttpRequest();
            // var id; 

            //step 2
            xht.open("GET", "https://college-registration-system.herokuapp.com/api/students_apprej_list", true);

            //step 3
            xht.send();

            //step 4 - we do the process upon receving the response with status 200
            xht.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    // alert(this.responseText);
                    
                    var item = JSON.parse(this.responseText);

                    var content = '';
                    for (let i = 0; i < item.length; i++) {
                        content += "<tr><td>" + item[i].id + "</td>" + "<td>" + item[i].name + "</td>" + "<td>" + item[i].matric + "</td>" + "<td>" + item[i].ic + "</td>" + "<td>" + item[i].college + "</td>";
                        console.log(item);
                        
                    }
                    document.getElementById("item").innerHTML = content;
                }

                //step 4, with status == 404
                else if(this.readyState == 4 && this.status == 404){
                    alert(this.status + ' resource not found');
                }
            };
        }
        
)


</script>

<FORM name="getID"  method="GET" action="approve_form.php">
<TABLE name="approveIDtable" border="0">
	<TR>
        <TD>Which <b>ID</b> do you want to select?</TD>

  </TR>

	<TR>
				<TD><INPUT class="approve-box" type="text" name="id" id="id" size="8" id="id_input"></TD>

 </TR>



<script type="text/javascript">
	var id_input = document.getElementById("id_input");

	document.getElementById('approve_btn').onclick =  (function(e){
		if(id_input.value.length == 0)
		{
			e.preventDefault();
			alert('Pleae insert a valID ID.');
			//return false;
		}
		else{
			alert('Action is successful!')
		}
	});



</script>

<tr>
	<TD><INPUT class="approve-button" type="submit" name="button1" id="approve-button" value="Confirm"></TD>
</tr>
<!--  -->

</TABLE>
</FORM>

</div>
</div>
</BODY>
</HTML>

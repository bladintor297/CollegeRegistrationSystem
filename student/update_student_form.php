<?php session_start();
if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
    header("Location: ../index.php");
?>

<html>

<HEAD>
    <TITLE>Update Student Form</TITLE>
    <link rel="stylesheet" href="../.css/styleupdate.css">
</HEAD>

<BODY>

    <div class="update-main-container">

        <ul class="navi">
            <li id="active-link" class="navi" style="float:left"><a href="../main.php"><img src="../.css/image/home.png" alt="Home" style="width: auto;height:25px; "></a></li>
            <li class="navi"><a>College Registration System</a></li>
            <li id="active-link" class="navi" style="float:right"><a href="../logout.php"><img src="../.css/image/whitelogout.png" alt="try" style="width:default;height:25px;"></a></li>
            <li class="navi" style="float:right"><a href="#about"><img src="../.css/image/user.png" alt="try" style="width:default;height:24px;"></a></li>
            <li class="navi" style="float:right"><a id="username" href="#about"></a></li>
        </ul>

        <div class="profile-card">
            <div class="card-header">
                <h2>Update Student Info</h2>
                <p>Please fill in the following information:<br><br>

                <form id="updateform" name="form1" method="POST" onsubmit="return validate() & alert('New data has been updated!');">
                    <table class="update-table" border="0">
                    <tr>
                <td><INPUT id="id" class="update-box" type="hidden" name="id" size="20" value=""></td>
            </tr>
                        <tr>
                            <td><strong>Name: </strong></td>

                            <td><INPUT id="name" class="update-box" type="text" name="studentName" size="20" style="text-transform:uppercase" value=""></td>
                        </tr>
                        <tr>
                            <td><strong>IC: </strong></td>
                            <td><INPUT id="ic" class="update-box" type="text" name="studentIC" size="15" value=""></td>
                        </tr>
                        <tr>
                            <td><strong>Matric ID: </strong< /td>
                            <td><input id="matric" class="update-box" type="" name="studentMatric" size="10" style="text-transform:uppercase;" value=""></td>
                        </tr>
                        <TR>
                            <TD><strong>College: </strong></TD>
                            <TD><select class="update-box" id="studentcollege" name="studentCollege" disabled>
                
                            </TD>
                            </select>
                        </TR>
                        <TR>
                            <TD><strong>Approval Status: </strong></TD>
                            <TD><INPUT id="as" class="update-box" type="text" name="approvalstatus" size="6" style="text-transform:uppercase" value="" disabled></TD>
                        </TR>
                        <tr>

                            <td colspan="2"><br /><input type="submit" id="update-btn" name="button1" value="Update"></td>

                        </tr>
                    </table>
                </form>

            </div>
        </div>
    </div>

    <script>
        function validate() {
            if (document.form1.studentName.value == "") {
                alert("Please provide your name!");
                document.form1.studentName.focus();
                return false;
            }

            var x = document.form1.studentIC.value;

            if (x == "") {
                alert("Please provide your IC number!");
                document.form1.studentIC.focus();
                return false;
            }

            if (typeof x !== 'number' && (x % 1) !== 0) {
                alert("Please enter a correct format of the IC number!");
                document.form1.studentIC.focus();
                return false;
            }


            if (document.form1.studentMatric.value == "") {
                alert("Please provide your student matrics number!");
                document.form1.studentMatric.focus();
                return false;
            }

        }
        const xhr = new XMLHttpRequest();

        xhr.open('GET', 'https://college-registration-system.herokuapp.com/api/studentinfo', true);
        xhr.send();
        xhr.onload = function() {
            var item = JSON.parse(xhr.responseText);

            for (let i = 0; i < item.length; i++) {
                document.getElementById("username").innerHTML = item[i].name;
                document.getElementById("id").value = item[i].id;
                document.getElementById("name").value = item[i].name;
                document.getElementById("ic").value = item[i].ic;
                document.getElementById("matric").value = item[i].matric;
                if (item[i].college == '' || item[i].college == null){
                   document.getElementById("studentcollege").value = null; 
                }else{
                    document.getElementById("studentcollege").value = item[i].college; 
                }
                    
                if (item[i].approvalstatus == '0')
                    document.getElementById("as").value = "Pending";
                if (item[i].approvalstatus == '1')
                    document.getElementById("as").value = "Approved";
                if (item[i].approvalstatus == '2')
                    document.getElementById("as").value = "Rejected";
            }
        }

    form1.addEventListener("submit",function(e){
    e.preventDefault();

    var id = document.getElementById("id").value;
    var name = document.getElementById("name").value;
    var ic = document.getElementById("ic").value;
    var matric= document.getElementById("matric").value;

    var xht = new XMLHttpRequest();

    xht.open("PUT","https://college-registration-system.herokuapp.com/api/updatestudentinfo/" + id + "/" + name + "/" + ic + "/" + matric,true);
    xht.send();
            
            xht.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const objects = JSON.parse(this.responseText);
                    
                }
            };
    
    window.location.href = 'https://college-registration-system.herokuapp.com/logout.php';
    alert("Please relogin to update new data");

})
    </script>

</body>

</html>
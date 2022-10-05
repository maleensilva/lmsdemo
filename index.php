<?php
//ADD COMMENTS HERE
include "config.php";


if(isset($_POST['but_submit'])){

    $uname = mysqli_real_escape_string($con,$_POST['txt_uname']);
    $password = mysqli_real_escape_string($con,$_POST['txt_pwd']);

	//ADD COMMENTS HERE
	if ($uname != "" && $password != ""){
			
			//ADD COMMENTS HERE
			$sql_query = "select count(*) as lmsUser from users where username='".$uname."' and password='".$password."'";
			$result = mysqli_query($con,$sql_query);
			$row = mysqli_fetch_array($result);

			$count = $row['lmsUser'];

			//ADD COMMENTS HERE
			if($count > 0){
				$_SESSION['uname'] = $uname;
				
				//ADD COMMENTS HERE
				$sql = "SELECT user_type FROM users WHERE username = '".$uname."'";

				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_row($result);

				//ADD COMMENTS HERE
				if ($row[0]=="admin") {
					header("location:admin_dashboard.php");
				} else {
					header("location:student_dashboard.php"); 
				}
			}else{
				echo "invalid username or password";
			}
				
	}else{
		echo "username password cannot be empty";
	}
}
?>
<html>
    <head>
        <title>Create simple login page with PHP and MySQL</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <form method="post" action="">
                <div id="div_login">
                    <h1>Login</h1>
                    <div>
                        <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" />
                    </div>
                    <div>
                        <input type="password" class="textbox" id="txt_uname" name="txt_pwd" placeholder="Password"/>
                    </div>
                    <div>
                        <input type="submit" value="Submit" name="but_submit" id="but_submit" />
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>


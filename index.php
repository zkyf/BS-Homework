<html>
<head>
	<script src="/js/tabdisplay.js">
	</script>
	<script>
	function checkp1p2(p1,p2)
	{
		pw1=document.getElementById(p1).value;
		pw2=document.getElementById(p2).value;
		if(pw1==pw2)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function pwchange(p1, p2, r)
	{
		rr = document.getElementById(r);
		if(checkp1p2(p1,p2))
		{
			rr.innerHTML="√";
			return true;
		}
		else
		{
			rr.innerHTML="×";
			return false;
		}
	}
	function reg()
	{
		var p1_id = document.forms["registerform"].pw1.id;
		var p2_id = document.forms["registerform"].pw2.id;
		if(!checkp1p2(p1_id, p2_id))
		{
			alert("Two passwords are not the same!");
			return false;
		}
		var pw=document.forms["registerform"].pw1.value;
		var name=document.forms["registerform"].name.value;
		if(pw.length<6 || pw.length>20)
		{
			alert("The length of password must lies between 6 and 20.");
			return false;
		}
		if(name.length>10 || name.length<1)
		{
			alert("The length of name must lies between 1 and 10.");
			return false;
		}
		var xmlhttp;
		if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
 		}
		else
  	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
  	xmlhttp.onreadystatechange=function()
  	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
    		var response = xmlhttp.responseText;
    		if(response == "database failure")
    		{
    			alert('Cannot connect to server... Please check your network.');
    		}
    		else if(response == "failure")
    		{
    			alert('Register failed.');
    		}
    		else if(response == "succeed")
    		{
    			top.location="chat.php";
    		}
    	}
  	}
  	xmlhttp.open("POST","register.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("name="+name+"&password="+pw);
	}
	function login()
	{
		var id = document.forms["loginform"].id.value;
		var password = document.forms["loginform"].password.value;
		var xmlhttp;
		if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
 		}
		else
  	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
  	xmlhttp.onreadystatechange=function()
  	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
    		var response = xmlhttp.responseText;
    		if(response == "database failure")
    		{
    			alert('Cannot connect to server... Please check your network.');
    		}
    		else if(response == "failure")
    		{
    			alert('Wrong id or password.');
    		}
    		else if(response == "succeed")
    		{
    			top.location="chat.php";
    		}
    	}
  	}
  	xmlhttp.open("POST","login.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("id="+id+"&password="+password);
	}
	</script>
</head>
<body>
	<?php
	session_start();
	?>
	<div id = "mainwrapper">
		<div id = "loginwindow">
			<table id="loginwrapper" border="1" class="navitable">
				<tr>
					<td onclick="Display(login.id);">Login</td>
					<td onclick="Display(register.id);">Register</td>
				</tr>
				<tr>
					<td colspan="2">
						<div id = "login">
							<form id = "loginform" method="post">
								<table id = "logininfo">
									<tr>
										<td>UserID:</td>
										<td><input type="text" name="id"/></td>
									</tr>
									<tr>
										<td>Password:</td>
										<td><input type ="password" name="password" /></td>
									</tr>
									<tr>
										<td><input type="button" value="login" onclick="login()"/></td>
									</tr>
								</table>
							</form>
						</div>
						<div id="register" style="display: none">
							<form id="registerform">
								<table>
									<tr>
										<td>Name:</td>
										<td><input type="text" name="name"/></td>
									</tr>
									<tr>
										<td>Input<br/>password</td>
										<td><input type="password" id="pw1" name="pw1"/></td>
									</tr>
									<tr>
										<td>Password<br/>again</td>
										<td><input type="password" id="pw2" name="pw2" onchange="pwchange(pw1.id,this.id,pwcheckresult.id)"/></td>
										<td id="pwcheckresult"></td>
									</tr>
									<tr>
										<td><input type="button" value="register" onclick="reg()"/></td>
									</tr>
								</table>
							</form>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<script>
	addItem(login.id,"login");
	addItem(register.id,"register");
	</script>
</body>
</html>
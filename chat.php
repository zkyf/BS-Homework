<html>
<head>
	<script src="/js/checkLogin.js">
	</script>
	<script>

	grouplist = new Array();

	function exit()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				top.location="index.php";
			}
		}
		xmlhttp.open("GET", "exit.php", false);
		xmlhttp.send();
	}
	function grDisplay(gname)
	{
		cname = "friinfo_f_"+gname;
		var flist = document.getElementsByClassName(cname);
		for (i=0;i<flist.length;i++)
		{
			friend = flist[i];
			console.log(friend);
			friend.style.width="100%";
			if(friend.style.display=="none")
			{
				friend.style.display="block";
			}
			else
			{
				friend.style.display="none";
			}
		}
	}
	function edit_ginfo(gname)
	{
		var gtabname = "friinfo_g_tab_"+gname;
		var gtab= document.getElementById(gtabname);
		for(i=0;i<grouplist.length;i++)
		{
			if(grouplist[i].name==gname)
			{
				grouplist[i].edit=!grouplist[i].edit;
			}
			if(grouplist[i].edit)
			{
				gtab.innerHTML="<input type='text' width='100%' id='edit_gn_"+gname+"' value='"+gname+"'/>";
				break;
			}
			else
			{
				console.log(gtab);
				console.log(grouplist);
				oldname = gname;
				//newname = document.getElementById("edit_gn_"+gname).value;
				var ajax_editgroupname;
				if (window.XMLHttpRequest)
 				{// code for IE7+, Firefox, Chrome, Opera, Safari
			 		ajax_editgroupname=new XMLHttpRequest();
				}
  			else
  		 	{// code for IE6, IE5
  		 		ajax_editgroupname=new ActiveXObject("Microsoft.XMLHTTP");
  		 	}
  		 	ajax_editgroupname.onreadystatechange = function()
  		 	{
  		 		if(ajax_editgroupname.readyState==4 && ajax_editgroupname.status==200)
  		 		{
						top.location = top.location;
  		 		}
  		 	}
  		 	ajax_editgroupname.open("POST","editGroupInfo.php",false);
  		 	ajax_editgroupname.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  		 	//ajax_editgroupname.send("oldname="+password);
				break;
			}
		}
	}

	</script>
</head>
<body>
	<script>
		var status_login = checklogin();
		if(status_login!=0)
		{
			alert("Please log in!");
			top.location="index.php";
		}
	</script>
	<div id="mainwrapper">
		<table border="1" width="100%" height="100%">
			<tr>
				<td rowspan="2" width="200px" valign="top">
					<table width="100%" height="100%" border="1">
						<tr height="100px">
							<td>
								<div id="userinfo">
								</div>
								<button onclick="exit()">Exit</button>
							</td>
						</tr>
						<tr height="0">
							<td>
								<div id="finduser">
									<form id="findsb" method="post" width="100%">
										<input type="text" name="id" value="Input Id to find" style="width: 120px;"/>
										<input type="submit" value="Find"/>
									</form>
								</div>
							</td>
						</tr>
						<tr>
							<td valign="top">
								<div id="friendlist" width="100%" height="100%">
									<table border='1' width='100%' height='100%'>
										<tr>
											<td colspan="2" width="100%">
												<button>Add group</button>
											</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
					</table>
				</td>
				<td>
					<div id="mainfunc">
						<div id="chatwindow">
							chatwindow
						</div>
						<div id="changeinfo">
							changeinfo
						</div>
						<div id="friinfo">
							friinfo
						</div>
					</div>
				</td>
			</tr>
			<tr height="150px">
				<td valign="top">
					<div id="inputwindow">
						<form>
							<input type="text" name="text" style="width: 100%; height: 110px"/>
							<input type="submit" value="Send"/>
						</form>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<script>
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
   		document.getElementById("userinfo").innerHTML = response;
   	}
 	}
 	xmlhttp.open("POST","/getUserInfo.php",true);
	xmlhttp.send();

	var ajax_getfriinfo;
	if (window.XMLHttpRequest)
 	{// code for IE7+, Firefox, Chrome, Opera, Safari
 		ajax_getfriinfo=new XMLHttpRequest();
	}
	else
 	{// code for IE6, IE5
 		ajax_getfriinfo=new ActiveXObject("Microsoft.XMLHTTP");
 	}
 	ajax_getfriinfo.onreadystatechange=function()
 	{
 		if (ajax_getfriinfo.readyState==4 && ajax_getfriinfo.status==200)
   	{
   		var response = ajax_getfriinfo.responseText;
   		grouplist = eval("("+response+")");
   		var table = "<table border='1'width='100%' height='100%'>";
   		for(i=0;i<grouplist.length;i++)
   		{
   			grouplist[i].edit=false;
   			table+="<tr class='friinfo_g'>";
   			table+="<td width='130px' onclick='grDisplay(this.innerHTML);'";
   			table+=" id='friinfo_g_tab_"+grouplist[i].name+"'>";
   			table+=grouplist[i].name;
   			table+="</td><td><button onclick='edit_ginfo(\""+grouplist[i].name+"\")'>Edit</button></td></tr>";
   			var flist = grouplist[i].list;
   			//console.log(flist);
   			for(j=0;j<flist.length;j++)
   			{
   				table+="<tr";
   				table+=" class='friinfo_f friinfo_f_"+grouplist[i].name+"'";
   				table+=" id='friinfo_f_f_"+flist[j].name+"'";
   				table+="><td width='130px'>";
   				table+=flist[j].name;
   				table+="</td><td><button>Edit</button></td></tr>";
   			}
   		}
   		table+="<tr><td colspan='2'>";
   		table+="<button>Add group</button>";
   		table+="</td></tr></table";
   		console.log(grouplist);
   		document.getElementById("friendlist").innerHTML = table;
   	}
 	}
 	ajax_getfriinfo.open("GET","getFriendInfo.php",false);
	ajax_getfriinfo.send();


	</script>
</body>
</html>
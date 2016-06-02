<html>
<head>
	<script src="/js/checkLogin.js">
	</script>
	<script>
	userinfo=0;
	now_fri_id = -1;
	grouplist = new Array();
	friend_to_show = -1;
	user_edit = false;
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
		console.log(gname);
		var gtabname = "friinfo_g_tab_"+gname;
		var gtab= document.getElementById(gtabname);
		for(i=0;i<grouplist.length;i++)
		{
			if(grouplist[i].name==gname)
			{
				grouplist[i].edit=!grouplist[i].edit;
			}
			else
			{
				continue;
			}
			console.log(grouplist);
			if(grouplist[i].edit)
			{
				gtab.innerHTML="<input type='text' width='100%' id='edit_gn_"+gname+"' value='"+gname+"'/>";
				break;
			}
			else
			{
				console.log(gtab);
				oldname = gname;
				newname = document.getElementById("edit_gn_"+gname).value;
				if(newname.indexOf(" ")!=-1)
				{
					alert("The group name cannot contain space.");
					top.location = top.location;
					return;
				}
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
						var response = ajax_editgroupname.responseText;
						console.log(response);
  		 		}
  		 	}
  		 	ajax_editgroupname.open("POST","editGroupInfo.php",false);
  		 	ajax_editgroupname.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  		 	ajax_editgroupname.send("oldname='"+oldname+"'&newname='"+newname+"'");
  		 	console.log("oldname='"+oldname+"'&newname='"+newname+"'");
				break;
			}
		}
	}
	function showFriInfo(fid)
	{
		console.log(fid);
		for(i=0;i<grouplist.length;i++)
		{
			for(j=0;j<grouplist[i].list.length;j++)
			{
				if(grouplist[i].list[j].id==fid)
				{
					now_fri_id = grouplist[i].list[j].id;
					document.getElementById("friinfo_table_id").innerHTML=grouplist[i].list[j].id;
					document.getElementById("friinfo_table_name").innerHTML=grouplist[i].list[j].name;
					if(grouplist[i].list[j].desp!=null)
					{
						document.getElementById("friinfo_table_desp").innerHTML=grouplist[i].list[j].desp;
					}
					if(grouplist[i].list[j].group==null)
					{
						document.getElementById("friinfo_table_group").innerHTML="DefaultGroup";
					}
					else
					{
						document.getElementById("friinfo_table_group").innerHTML=grouplist[i].list[j].group;
					}
					
				}
			}
		}
	}
	function editUserInfo()
	{
		user_edit=!user_edit;
		console.log(user_edit);
		if(user_edit)
		{
			document.getElementById("info_name").innerHTML =
			"<input type='text' value='"+userinfo.name+"'>";
			document.getElementById("info_desp").innerHTML =
			"<input type='text' value='"+userinfo.desp+"'>";
		}
		else
		{
			var ajax_edituserinfo;
			var name=document.getElementById("info_name").childNodes[0].value;
			var desp=document.getElementById("info_desp").childNodes[0].value;
			if(window.XMLHttpRequest)
			{
				ajax_edituserinfo = new XMLHttpRequest();
			}
			else
			{
				ajax_edituserinfo = new ActiveXObject("Microsoft.XMLHTTP");
			}
			ajax_edituserinfo.onreadystatechange=function()
			{
				if(ajax_edituserinfo.readyState==4 && ajax_edituserinfo.status==200)
				{
					top.location=top.location;
				}
			}
			ajax_edituserinfo.open("POST", "editUserInfo.php", false);
			ajax_edituserinfo.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			ajax_edituserinfo.send("name='"+name+"'&desp='"+desp+"'");
		}
	}
	function delFriend()
	{
		fid= now_fri_id;
		console.log(fid);
		var ajax_delf;
		if(window.XMLHttpRequest)
		{
			ajax_delf = new XMLHttpRequest;
		}
		else
		{
			ajax_delf = new ActiveXObject("Microsoft.XMLHTTP");
		}
		ajax_delf.onreadystatechange = function()
		{
			if(ajax_delf.readyState==4 && ajax_delf.status==200)
			{
				response = ajax_delf.responseText;
				console.log(response);
				top.location=top.location;
			}
		}
		ajax_delf.open("POST","delFriend.php", false);
		ajax_delf.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		ajax_delf.send("fid="+fid);
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
					<table width="100%" height="100%" border="0">
						<tr height="100px">
							<td>
								<div id="userinfo">
									<table>
										<tr>
											<td>ID</td>
											<td id="info_id"></td>
										</tr>
										<tr>
											<td>Name</td>
											<td id="info_name"></td>
										</tr>
										<tr>
											<td>Memo</td>
											<td id="info_desp"></td>
										</tr>
										<tr>
											<td>IP</td>
											<td id="info_ip"></td>
										</tr>
									</table>
								</div>
								<button onclick="exit()">Exit</button>
								<button onclick="editUserInfo()">Edit</button>
								<button>Msgs</button>
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
				<td valign="top">
					<div id="mainfunc" width="100%" height="100%">
						<div id="friinfo" width="100%" height="50px">
							<table id="friinfo_table" border="0" width="100%" height="50px">
								<tr>
									<td>ID</td>
									<td>Name</td>
									<td>Memo</td>
									<td>Group</td>
									<td>Operations</td>
								</tr>
								<tr>
									<td id="friinfo_table_id">　</td>
									<td id="friinfo_table_name">　</td>
									<td id="friinfo_table_desp">　</td>
									<td id="friinfo_table_group">　</td>
									<td id="friinfo_table_op">
										<button onclick="delFriend()">Delete</button>
									</td>
								</tr>
							</table>
						</div>
						<div id="chatwindow">
							chatwindow
						</div>
					</div>
					<div id="application">
						applications
					</div>
				</td>
			</tr>
			<tr height="150px">
				<td valign="top">
					<div id="inputwindow">
						<form width="100%" height="100%">
							<input type="text" name="text"/>
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
   		//document.getElementById("userinfo").innerHTML = response;
   		userinfo=eval("("+response+")");
   		document.getElementById("info_id").innerHTML=userinfo.id;
   		document.getElementById("info_name").innerHTML=userinfo.name;
   		document.getElementById("info_desp").innerHTML=userinfo.desp;
   		document.getElementById("info_ip").innerHTML=userinfo.ip;
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
   		var table = "<table border='0'width='100%' height='100%'>";
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
   				table+=" id='"+flist[j].id+"'";
   				table+="><td width='130px' colspan='2'";
   				table+=" onclick='showFriInfo("+flist[j].id+")'";
   				table+=">";
   				table+=flist[j].name;
   				table+="</td>";
   				table+="</tr>";
   			}
   		}
   		table+="<tr><td colspan='2'>";
   		table+="<button>Add group</button>";
   		table+="</td></tr></table";
   		//console.log(grouplist);
   		document.getElementById("friendlist").innerHTML = table;
   	}
 	}
 	ajax_getfriinfo.open("GET","getFriendInfo.php",false);
	ajax_getfriinfo.send();


	</script>
</body>
</html>
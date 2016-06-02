function checklogin()
{
	var xmlhttp;
	if (window.XMLHttpRequest)
 	{// code for IE7+, Firefox, Chrome, Opera, Safari
 		xmlhttp=new XMLHttpRequest();
	}
	else
 	{// code for IE6, IE5
 		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 	}
  var status;
 	xmlhttp.onreadystatechange=function()
 	{
 		if (xmlhttp.readyState==4 && xmlhttp.status==200)
   	{
   		var response = xmlhttp.responseText;
   		if(response == "succeed")
   		{
   			status = 0;
   		}
   		else if(response == "failure")
   		{
   			status = 1;
   		}
   		else if(response == "database failure")
   		{
   			status = 2;
   		}
      else
      {
        status = 3;
      }
   	}
 	}
 	xmlhttp.open("POST","/config.php",false);
	xmlhttp.send();
  return status;
}


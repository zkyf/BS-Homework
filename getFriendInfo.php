<?php
class Friend
{
	public $id;
	public $name;
}

class Group
{
	public $name = array();
	public $list;
}

$glist = array();

session_start();
$connect = mysql_connect("localhost","root","liujiaxin");
if(!$connect)
{
	echo "database failure";
	exit;
}
mysql_select_db("bshw");
$id=$_SESSION['id'];
//$id=4;
//echo $id."<br/>";
$groupresult=mysql_query("select * from tgroup where userid=".$id);
$grouprows=mysql_fetch_assoc($groupresult);
//echo "<table border='1'width='100%' height='100%'>";

$group = new Group();
$group->name="Default Group";
$friendresult=mysql_query("select * from friend where userid=".$id." and groupname is NULL;");
$friendrow=mysql_fetch_assoc($friendresult);
while($friendrow)
{
	$fid=$friendrow['friendid'];
	$friendinforesult=mysql_query("select * from user where id=".$fid.";");
	$friendinforow=mysql_fetch_assoc($friendinforesult);
	$fn=$friendinforow['name'];
	$friend = new Friend();
	$friend->id= $fid;
	$friend->name=$fn;
	$group->list[]=$friend;
	$friendrow=mysql_fetch_assoc($friendresult);
}
$glist[] = $group;
while($grouprows)
{
	$gn = $grouprows['gname'];
	$group=new Group();
	$group->name=$gn;
	//echo "<tr class='friinfo_g'><td width='130px' onclick='grDisplay(this.innerHTML);'>";
	//echo $gn;
	//echo "</td><td><button value='".$gn."'>Edit</button></td></tr>";
	if(1)
	{
		$list = array();
		$friendresult=mysql_query("select * from friend where userid=".$id." and groupname='".$gn."';");
		$friendrow=mysql_fetch_assoc($friendresult);
		while($friendrow)
		{
			$fid=$friendrow['friendid'];
			$friendinforesult=mysql_query("select * from user where id=".$fid.";");
			$friendinforow=mysql_fetch_assoc($friendinforesult);
			$fn=$friendinforow['name'];
			//echo "<tr class='friinfo_f friinfo_f_".$gn."'><td width='130px'>";
			//echo $fn;
			//echo "</td><td><button>Edit</button></td></tr>";
			$friend = new Friend();
			$friend->id= $fid;
			$friend->name=$fn;
			$list[]=$friend;
			$friendrow=mysql_fetch_assoc($friendresult);
		}
		$group->list=$list;
	}
	$grouprows=mysql_fetch_assoc($groupresult);
	$glist[] = $group;
}
//echo "<tr><td colspan='2'>";
//echo "<button>Add group</button>";
//echo "</td></tr>";
//echo "</table>";

$json_group_info = json_encode($glist);
echo $json_group_info;

?>
var ItemIdList = new Array();
var ItemCount = 0;

function addItem(id, idname)
{
	ItemIdList[id]=document.getElementById(idname);
	ItemCount++;
	return ItemCount-1;
}

function setNotDisplay(id)
{
	item = ItemIdList[id];
	item.style.display="none";
}

function setDisplay(id)
{
	item = ItemIdList[id];
	item.style.display="block";
}

function setNotDisplayAll()
{
	for(item in ItemIdList)
	{
		setNotDisplay(item);
	}
}

function Display(id)
{
	setNotDisplayAll();
	setDisplay(id);
}
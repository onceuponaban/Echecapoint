














function SelectionCase(element)
{
	ResetColor();
	element.style.background = 'yellow';
	document.getElement
}


function ResetColor()
{
	for(var i = 0 ; i<8 ; i+=1)
	{
		for(var j = 0 ; j < 8 ; j+=1)
		{
			var element = document.getElementById(String(i)+String(j));
			if( ((i+j) % 2) == 0)
			{
				element.style.background = 'silver';
			}
			else
			{
				element.style.background = 'white';
			}
		}
	}
}

function NotationFromId(id)
{
	var arrayId = id.split("");
	
	var notation = "";
	
	switch(arrayId[0])
	{
	case "0":
		notation = notation+"a";
		break;
	case "1":
		notation = notation+"b";
		break;
	case "2":
		notation = notation+"c";
		break;
	case "3":
		notation = notation+"d";
		break;
	case "4":
		notation = notation+"e";
		break;
	case "5":
		notation = notation+"f";
		break;
	case "6":
		notation = notation+"g";
		break;
	case "7":
		notation = notation+"h";
		break;
	}
	
	return notation = notation+String(parseInt(arrayId[1])+1);
	
}
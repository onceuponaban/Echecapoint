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
			if( ((i+j) % 2) != 0)
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
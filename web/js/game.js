var xhr = new XMLHttpRequest();

function getXMLHttpRequest() { 
    var xhr = null; 
    if (window.XMLHttpRequest || window.ActiveXObject) { 
        if (window.ActiveXObject) { 
            try { 
                    xhr = new ActiveXObject("Msxml2.XMLHTTP"); 
            } catch(e) { 
                    xhr = new ActiveXObject("Microsoft.XMLHTTP"); 
            } 
        } else { 
                xhr = new XMLHttpRequest(); 
        } 
    } else { 
            alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest..."); 
            return null; 
    } 
    return xhr; 
}

function request(callBack,element) {
	
    //On récupère la valeur rentrée par l'utilisateur
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function () {
        //réponse arrivé
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {
            callBack(xhr.responseText);
        }
    };
    
    //Ajustement de la couleur
	ResetColor();
	element.style.background = 'yellow';
	
	//Récupération de la coordonnée de la case
	var coord = NotationFromId(element.id);
    
    
    var notationCase = encodeURIComponent(coord);
    var partie = encodeURIComponent(document.getElementById("partie").textContent); 
    xhr.open("GET", "../../src/AppBundle/Service/Ajax/Game.php?Case="+notationCase+"&Partie="+partie, true);
    xhr.send(null);
   
}

function readData(oData) {
    if(oData != "")
    {
    	var arrayCoord = oData.split(" ");
    }
    else{
    	alert("Pas de Mouvement possible");
    }
    alert(oData);
    //document.getElementById("error").value = oData;
}

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
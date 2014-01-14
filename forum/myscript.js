
//SCRIPT FÖR FORUMET
//funktion som validerar inputen för skapandet av ny tråd

function validate1(){
	
	//säger ifrån om användaren inte skriver ämnet tråden ska handla om
	
	var form = document.forms["wizard"]["threadID"].value;
	if (form == "Enter input!" || form == "Null" || form == ""){
	window.alert("Enter thread subject!");
	return false;
	}
	
	//säger ifrån om användaren inte skriver sitt namn
	
	var form = document.forms["wizard"]["creator"].value;
	if (form == "Enter input!" || form == "Null" || form == ""){
	window.alert("Enter creators name!");
	return false;
	}
	
	return true;
}

//funktion som validerar inputen för skapandet av post i befintlig tråd

function validate2(){
	
	//säger ifrån om användaren inte skriver sitt namn
	
	var form = document.forms["wizard2"]["username"].value;
	if (form == "Enter input!" || form == "Null" || form == ""){
	window.alert("Enter your username!");
	return false;
	}
	
	//säger ifrån om användaren inte skriver sitt meddelande
	
	var form = document.forms["wizard2"]["post"].value;
	if (form == "Enter input!" || form == "Null" || form == ""){
	window.alert("Enter your message!");
	return false;
	}
	
	return true;
}

//funktion som ritar boll under headern i forumet
//bollen följer musens rörelser i sidled

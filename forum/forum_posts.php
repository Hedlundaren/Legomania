<?php 

include "header.php";


	$threadID = $_GET["threadID"];


  	print("<div id='postheadline'><h2>");
   	echo $threadID;
	print("</h2></div>");

	// Anslut till MySQL-server via binero
	$connection =  mysql_connect("forum-188949.mysql.binero.se", "188949_lv47601", "hustler1993") or
			die("connection failed!");

	// Välj databas (egenskapad databas som ligger på egen domän)
	mysql_select_db("188949-forum");
	 
	//Det som användaren skrivit in sparas i variabler
	$username = $_POST["username"];
	$post = $_POST ["post"];
	//tiden tas med datetime funktion från webbläsaren
	$time = date('Y-m-d H:i:s');
	
	//Om användaren skickat inskrivna värden med submit
	//skickas dem i en Mysql-fråga som sparar dem i given databas
	if(isset($_POST['submit']))
	{		
		$insertquery = "INSERT INTO `posts`(
		`username` ,
		`threadID` ,
		`post` ,
		`time`
		)
		VALUES (
		'$username', '$threadID', '$post' ,'$time'
		)
		";
		mysql_query($insertquery) or die(mysql_error());
	}
	
	//Därefter skickas en ny fråga till MySQL för att uppdatera sidan
	$query = "SELECT username, post, date(time), time(time)
	FROM posts
	WHERE threadID = '$threadID'
	";

	//Spara (en referens till) resultatet i variabeln $contents
	$contents = mysql_query($query);
	
	//Skriv ut svaret i en tabell
	print("<table>\n");
	
	//Skriv ut alla rader i tabellen
	//$row blir FALSE när raderna är slut
	while ($row = mysql_fetch_row($contents))
	{
		print("<tr>");
		//varje post skrivs i en rad där alla värden är samlade i en kolumn
		
		//användarnamn och tid skrivs ut
		print("<td class='usernametd'><p class='usernamefont'>$row[0]</p>
		<p class='datefont'>$row[2]<br>$row[3]</br></p></td>");
		
		//posten skrivs ut
		print("<td><p class='postfont'>$row[1]</p></td>");
		print("</tr>\n");
	}
	   
	   print("</table>\n");
	   mysql_close($connection);
	?>
	
	<!--wizard form för att skapa nya postar till trådar-->
	<div id="postform">
	<form id="wizard2" name="wizard" action="" method="post" onsubmit="return validate2()">
	<p id="input"><label>
	Create new post: &nbsp;
	
	<br>
	
	<!--input element för att skriva in användarnamn-->
	<input type ="text" name ="username" placeholder = "Username" size ="20"/>
	</label></p>
	
	<!--input element för att skriva in meddelandet (posten-->
	<p id="input2">
	<input type ="textarea" name ="post" placeholder = "Enter post..." />
	
	<br/>
	
	<input type = "submit" name="submit" value = "Create"/>
	<input type = "reset" value = "Clear"/>
	</p>
	</form>
	</div>

	
	
	</body>
	</html>

<?php 
include "header.php";


	// Anslut till MySQL-server via binero
	$connection =  mysql_connect("forum-188949.mysql.binero.se", "188949_lv47601", "") or
	                    die("connection failed!");

	// Välj databas (egenskapad databas som ligger på egen domän)
	mysql_select_db("188949-forum");
 
	//Det som användaren skrivit in sparas i variabler
	$threadID = $_POST ["threadID"];
	$creator = $_POST["creator"];
	//tiden tas med datetime funktion från webbläsaren
	$time = date('Y-m-d H:i:s');
	
	//Om användaren skickat inskrivna värden med submit
	//skickas dem i en Mysql-fråga som sparar dem i given databas
	if(isset($_POST['submit']))
	{	
		$insertquery = "INSERT INTO `thread`(
		`threadID` ,
		`creator` ,
		`time`
		)
		VALUES (
		'$threadID',  '$creator',  '$time'
		)";
		mysql_query($insertquery) or die(mysql_error());
	}
	
	//Därefter skickas en ny fråga till MySQL för att uppdatera sidan
	$query = "SELECT threadID AS Subject, creator AS Creator, date(time) AS Time
	FROM thread
	ORDER BY threadnumb DESC
	";
   

 /*
 	Försök till att få trådarna att ordnas efter vilken som uppdaterades senast:
 	
 	$query = "
	SELECT threadID 
  	MAX(posts.postID) AS latest_reply 
	FROM thread AS t
    	LEFT JOIN posts AS m ON t.threadID = m.threadID
	WHERE t.child_id = ".$board_id."
	GROUP BY t.threadID
	ORDER BY latest_reply DESC 
	LIMIT ".$starting.";
   */
   
	// Spara (en referens till) resultatet i variabeln $contents
	$contents = mysql_query($query);
	
	// Skriv ut svaret i en tabell
	print("<table>\n");
	
	// Skriv ut kolumnnamn 
	print("<tr>");
	$fieldname = mysql_field_name($contents, 0);
	print("<th>$fieldname</th>");
	print "</tr>\n";

	// Skriv ut alla rader i tabellen
	// $row blir FALSE när raderna är slut
	while ($row = mysql_fetch_row($contents))
	{
		print("<tr>");
		//varje tråd skrivs i en rad där alla värden är samlade i en kolumn
		
		//ämne, skaparen och datumet skrivs ut
		print("<td class='subjecttd'><a href='posts.php?threadID=".$row[0]."'>
		<p class='subjectfont'>$row[0]</p></a>\n<p class='creatorfont'>Created by: $row[1]<br>$row[2]</p></td>");
		print("</tr>\n");
	}
	print("</table>\n");
	   
	//stäng uppkoppling till mysql
	mysql_close($connection);
?>
	<!--stämningsmusik-->
	<embed height="0" width="0" src="cantina.mp3">

</body>
</html>

<?php 
include "header.php";


   // Anslut till MySQL-server vid ITN
   // IP-adress = "mysql.itn.liu.se"
   // Användarnamn = "spdb"
   // Lösenord = ""
   $connection =  mysql_connect("forum-188949.mysql.binero.se", "188949_lv47601", "") or
	                    die("connection failed!");

   // Välj databas
   mysql_select_db("188949-forum");
 
   
$threadID = $_POST ["threadID"];
$creator = $_POST["creator"];
$time = date('Y-m-d H:i:s');

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

	
   $query = "SELECT threadID AS Subject, creator AS Creator, date(time) AS Time
   FROM thread
   ORDER BY time DESC
   ";
   
 /*	$query = "
	SELECT threadID 
  	MAX(posts.postID) AS latest_reply 
	FROM thread AS t
    	LEFT JOIN posts AS m ON t.threadID = m.threadID
	WHERE t.child_id = ".$board_id."
	GROUP BY t.threadID
	ORDER BY latest_reply DESC 
	LIMIT ".$starting.";
   */
   // Skicka frågan till MySQL
   // Spara (en referens till) resultatet i variabeln $contents
   $contents = mysql_query($query);

   // Skriv ut svaret som en XHTML-tabell (för tydlighets skull)
   print("<table border='border' cellpadding='6' cellspacing='3'>\n");

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
      	print("<td class='subjecttd'><a href='posts.php?threadID=$row[0]'>
      	<p class='subjectfont'>$row[0]</p></a>\n<p class='creatorfont'>Created by: $row[1]<br>$row[2]</p></td>");

      print("</tr>\n");
   }
   
   print("</table>\n");
?>
</p>

<?php
   // Pja, inte n�dv�ndigt h�r men god vana
   mysql_close($connection);
?>


<embed height="0" width="0" src="horse.mp3">

</body>
</html>

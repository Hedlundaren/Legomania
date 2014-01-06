<?php 

include "header.php";


$threadID = $_GET["threadID"];

  	print("<div id='postheadline'><h2>");
   	echo $threadID;
	print("</h2></div>");

   // Anslut till MySQL-server vid ITN
   // IP-adress = "mysql.itn.liu.se"
   // Användarnamn = "spdb"
   // Lösenord = ""
   $connection =  mysql_connect("forum-188949.mysql.binero.se", "188949_lv47601", "") or
	                    die("connection failed!");

   // Välj databas "spdb"
   mysql_select_db("188949-forum");
 
   
$username = $_POST["username"];
$post = $_POST ["post"];
$time = date('Y-m-d H:i:s');


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

   $query = "SELECT username, post, date(time), time(time)
   	FROM posts
  	WHERE threadID = '$threadID'
 	";
 	

  
   // Skicka frågan till MySQL
   // Spara (en referens till) resultatet i variabeln $contents
   $contents = mysql_query($query);

   // Skriv ut svaret som en XHTML-tabell (för tydlighets skull)
   print("<table  border='border' cellpadding='6' cellspacing='3'>\n");

   // Skriv ut kolumnnamn 


   // Skriv ut alla rader i tabellen
   // $row blir FALSE när raderna är slut
   while ($row = mysql_fetch_row($contents))
   {
 
      print("<tr>");
  		 

         print("<td class='usernametd'><p class='usernamefont'>$row[0]</p><p class='datefont'>$row[2]<br>$row[3]</br></p></td>");
         print("<td><p class='postfont'>$row[1]</p></td>");
      
      print("</tr>\n");
   }
   
   print("</table>\n");
?>
</p>

<?php
   mysql_close($connection);
?>

<div id="postform">
<form id="wizard2" name="wizard" action="" method="post" onsubmit="return validate()">
<p id="input"><label>
Create new post: &nbsp;
<br>
<input type ="text" name ="username" placeholder = "Username" size ="20"/>
</label></p>

<!--sökfält-->
<p id="input2">
<input type ="textarea" name ="post" placeholder = "Enter post..."/>
<br/>
<input type = "submit" name="submit" value = "Create"/>
<input type = "reset" value = "Clear"/>
</p>
</form>
</div>


<embed height="0" width="0" src="baby.mp3">


</body>
</html>

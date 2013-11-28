<?php print ("<!DOCTYPE html>");?>
<html>
<head>
<meta charset="utf-8">
<title>Legomania</title>


</head>

<body>
<!-- Fixa en lista med alternativen för vad man ska söka-->
<form id="wizard" action="" method="post">
<p class ="input"><label>
Search: &nbsp;
<input type ="text" name ="search" size ="10">
</label></p>

<input type = "submit" value = "Find lego!"/>
<input type = "reset" value = "Clear"/>
</form>

<?php
if($_POST)
{
$connection = mysql_connect ("mysql.itn.liu.se", "lego", "") 
				or die ("Connection failed!");

mysql_select_db ("lego");

$search = $_POST["search"];

// Alternativ 1: Sök på SetID

$query = "
(SELECT parts.PartID, parts.Partname
FROM 
WHERE sets.SetID = '$search')";

// Alternativ 2: Sök på CategoryID

$query = "
(SELECT categories.Categoryname, 
FROM s, p
WHERE 1)";

// Alternativ 3: Sök på Categoryname

$query = "
(SELECT categories.Categoryname, 
FROM s, p
WHERE 1)";

// Alternativ 4: Sök på Setname

$query = "
(SELECT categories.Categoryname, 
FROM s, p
WHERE 1)";

// Alternativ 5: Sök på SetYear 

$query = "
(SELECT categories.Categoryname, 
FROM s, p
WHERE 1)";



$contents = mysql_query("$query");


print("<table border='border' cellpadding='6' cellspacing='3'>\n");
print("<tr>");

for($i = 0; $i < mysql_num_fields($contents); $i++)
{
		$fieldname = mysql_field_name($contents, $i);
			print("<th>$fieldname</th>");
}
print("</tr>\n");

while($row = mysql_fetch_row($contents))
{
print("<tr>");
for($i = 0;$i < mysql_num_fields($contents); $i++)
{
print("<td>$row[$i]</td>");
}
print("</tr>\n");
}
print("</table>\n");





mysql_close($connection);
}
?>

</body>
</html>

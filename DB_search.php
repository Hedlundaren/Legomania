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
<br>
<select name="alternativ">
  <option value="SetID">SetID</option>
  <option value="Setname">Setname</option>
  <option value="Year">Year</option>
  <option value="Categoryname">Categoryname</option>
</select>
<br>
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

$value = $_POST ["alternativ"];

$search = $_POST["search"];


// Alternativ 1: Sök på SetID
if ($value == "SetID")
{
$query = "
(SELECT sets.Setname, sets.SetID, sets.Year
FROM sets
WHERE sets.SetID = '$search')";
}
// Alternativ 2: Sök på Categoryname

if ($value == "Categoryname")
{
$query = "
(SELECT sets.Setname, sets.SetID, sets.Year
FROM sets
WHERE sets.CatID IN
						(SELECT categories.CatID
						FROM categories
						WHERE categories.Categoryname = '$search'))";
}


// Alternativ 3: Sök på Setname

if ($value == "Setname")
{
$query = "
(SELECT sets.Setname, sets.SetID, sets.Year
FROM sets
WHERE sets.setname = '$search')";
}

// Alternativ 4: Sök på SetYear

if ($value == "Year")
{
$query = "
(SELECT sets.Setname, sets.SetID, sets.Year
FROM sets
WHERE sets.Year = '$search')";
}

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
/*
   $img_dir = "http://webstaff.itn.liu.se/~stegu76/img.bricklink.com/";
   $gif_url = $img_dir . "S/" . '$row[1]' . ".gif";
   $jpg_url = $img_dir . "S/" . '$row[1]' . ".jpg";

   if (fclose(fopen($gif_url, "r")))
   {
      print("<p>" . "gif-bild" . "</p>");
      print("<p><img src='$gif_url' alt='gif-image' /></p>");
   }
   else if (fclose(fopen($jpg_url, "r")))
   {
      print("<p>" . "jpg-bild" . "</p>"); 
      print("<p><img src='$jpg_url' alt='jpg-image' /></p>");
   }
   else
   {
      print("<p>" . "bild saknas" . "</p>"); 
   }
*/
print("</tr>\n");
}
print("</table>\n");


mysql_close($connection);
}
?>

</body>
</html>

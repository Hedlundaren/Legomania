<?php print ("<!DOCTYPE html>");?>
<html>
<head>
<meta charset="utf-8">
<title>Legomania</title>

</head>

<body>

<!--en lista med alternativen för vad man ska söka--> 
<form name="wizard" action="" method="post" onsubmit="validate()">
<p class ="input"><label>
Search sets by: &nbsp;
<br>
<select name="alternativ">
<option value="SetID">SetID</option>
<option value="Setname">Setname</option>
<option value="Year">Year</option>
<option value="Categoryname">Categoryname</option>
</select>
</label></p>

<!--sökfält-->
<input type ="text" name ="search" placeholder = "Enter input!" size ="20"/>
<br/>
<input type = "submit" value = "Find lego!"/>
<input type = "reset" value = "Clear"/>
<br>
Show images: <input type = "radio" name = "image" value = "Show"> 
Hide images: <input type = "radio" name = "image" value = "Hide"> 
</form>


<!-- Fråga hur man bäst validerar, och hur man gör för att det inte ska gå vidare! -->
<script>
   function validate(){
	
	var form = document.forms["wizard"]["search"].value;

    if (form == "Enter input!" || form == "Null" || form == "")
		{
			window.alert("Please enter input!");
			break;
		}
	}
</script>

<?php 	
if($_POST)
{
$connection = mysql_connect ("mysql.itn.liu.se", "lego", "")
                                or die ("Connection failed!");

mysql_select_db ("lego");

$value = $_POST ["alternativ"];
$value_image = $_POST["image"];

$search = $_POST["search"];


// Alternativ 1: Sök på SetID
if ($value == "SetID")
{
$query = "
(SELECT sets.Setname, sets.SetID, sets.Year
FROM sets
WHERE sets.SetID LIKE '%$search%')";
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
                     WHERE categories.Categoryname LIKE '%$search%'))";
}


// Alternativ 3: Sök på Setname

if ($value == "Setname")
{
$query = "
(SELECT sets.Setname, sets.SetID, sets.Year
FROM sets
WHERE sets.setname LIKE '%$search%')";
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
if ($value_image == "Show"){
 print("<th>Image</th>");
}
print("</tr>\n");

while($row = mysql_fetch_row($contents))
{
print("<tr>");
print("<td><a href='suppliers.php?setID=$row[1]'>$row[0]</a></td>");
for($i = 1;$i < mysql_num_fields($contents); $i++)
{
print("<td>$row[$i]</td>");
}
if ($value_image == "Show"){
$img_dir = "http://webstaff.itn.liu.se/~stegu76/img.bricklink.com/";
$gif_url = $img_dir . 'S/' . $row[1] . '.gif';  //'$row[1]'
$jpg_url = $img_dir . 'S/' . $row[1] . '.jpg';

if(@fclose(@fopen($gif_url, "r"))){
//print("<td>" . "" . "</td>");

print("<td><a href='$gif_url'> <img src='$gif_url' alt='gif-image' /></a></td>");

}
else if(@fclose(@fopen($jpg_url, "r"))){
//print("<p>" . "jpg-bild" . "</p>");
print("<td><a href='$jpg_url'><img src='$jpg_url' alt='jpg-image' /></a></td>");
}
else{
print("<td>" . "bild saknas" . "</td>");
}
}

print("</tr>\n");
}
print("</table>\n");


mysql_close($connection);
}
?>

</body>
</html>

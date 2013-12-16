<?php

$connection = mysql_connect ("mysql.itn.liu.se", "lego", "")
              or die ("Connection failed!");

mysql_select_db ("lego");


//var_dump($_GET);
$setID = $_GET["setID"];
//print "$setID";



// Visa alla delar i valt set 

$query = "
(SELECT DISTINCT parts.partname, parts.PartID, inventory.Quantity, colors.Colorname, colors.ColorID
FROM parts, inventory, colors
WHERE  inventory.SetID = '$setID'
AND parts.PartID = inventory.ItemID
AND colors.ColorID = inventory.ColorID)";

$contents = mysql_query("$query");

print("<table border='border' cellpadding='6' cellspacing='3'>\n");
print("<tr>");
print("<th>Image</th>");
for($i = 0; $i < mysql_num_fields($contents) - 1; $i++)
{
                $fieldname = mysql_field_name($contents, $i);
                        print("<th>$fieldname</th>");
}
print("</tr>\n");

while($row = mysql_fetch_row($contents))
{
print("<tr>");
 $img_dir = "http://webstaff.itn.liu.se/~stegu76/img.bricklink.com/";
 $gif_url = $img_dir . 'P/' . $row[4] . '/' . $row[1] . '.gif'; 
$jpg_url = $img_dir . 'P/' . $row[4] . '/' . $row[1] . '.jpg';


if(@fclose(@fopen($gif_url, "r"))){

print("<td><a href='$gif_url'> <img src='$gif_url' alt='gif-image' /></a></td>");
}


else if(@fclose(@fopen($jpg_url, "r"))){

print("<td><a href='$jpg_url'><img src='$jpg_url' alt='jpg-image' /></a></td>");
}


else{
print("<td>" . "bild saknas" . "</td>");
}


for($i = 0;$i < mysql_num_fields($contents) -1; $i++)
{
print("<td>$row[$i]</td>");
}

print("</tr>\n");
}
print("</table>\n");


mysql_close($connection);

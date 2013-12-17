<?php
include "header.php";

    //Fråga: w3c validering
        
if($_POST)
{
        $value = $_POST ["alternativ"];
        $search = $_POST["search"];

        // Alternativ 1: Sök på SetID
        if ($value == "SetID"){
                $query = "
                        (SELECT sets.Setname, sets.SetID, sets.Year
                        FROM sets
                        WHERE sets.SetID LIKE '%$search%')";
        }
        
        // Alternativ 2: Sök på Categoryname
        if ($value == "Categoryname"){
                $query = "
                        (SELECT sets.Setname, sets.SetID, sets.Year
                        FROM sets
                        WHERE sets.CatID IN
                                        (SELECT categories.CatID
                                         FROM categories
                                         WHERE categories.Categoryname LIKE '%$search%'))";
        }


        // Alternativ 3: Sök på Setname
        if ($value == "Setname"){
                $query = "
                        (SELECT sets.Setname, sets.SetID, sets.Year
                        FROM sets
                        WHERE sets.setname LIKE '%$search%')";
        }

        // Alternativ 4: Sök på SetYear
        if ($value == "Year"){
                $query = "
                        (SELECT sets.Setname, sets.SetID, sets.Year
                        FROM sets
                        WHERE sets.Year = '$search')";
        }

        $contents = mysql_query("$query");


        print("<table border='border' cellpadding='6' cellspacing='3'>\n");
                print("<tr>");

                        for($i = 0; $i < mysql_num_fields($contents); $i++){
                                $fieldname = mysql_field_name($contents, $i);
                                print("<th>$fieldname</th>");
                        }
                        print("<th class='pictureColumn'>Image</th>");

                print("</tr>\n");

        while($row = mysql_fetch_row($contents)){
                print("<tr>");
                        print("<td><a href='setinfo.php?setID=$row[1]'>$row[0]</a></td>");
                        
                        for($i = 1;$i < mysql_num_fields($contents); $i++){
                                print("<td>$row[$i]</td>");
                        }

                        $img_dir = "http://webstaff.itn.liu.se/~stegu76/img.bricklink.com/";
                        $gif_url = $img_dir . 'S/' . $row[1] . '.gif';
                        $jpg_url = $img_dir . 'S/' . $row[1] . '.jpg';
                        
                                $gifbig_url = $img_dir . 'SL/' . $row[1] . '.gif';
                                $jpgbig_url = $img_dir . 'SL/' . $row[1] . '.jpg';

                        if(@fclose(@fopen($gif_url, "r"))){
                                if(@fclose(@fopen($gifbig_url, "r"))){
                                        print("<td class='pictureColumn'><a href='$gifbig_url'>
                                        <img src='$gif_url' alt='gif-image' /></a></td>");
                                }
                                else if(@fclose(@fopen($jpgbig_url, "r"))){
                                        print("<td class='pictureColumn'><a href='$jpgbig_url'>
                                        <img src='$gif_url' alt='gif-image' /></a></td>");
                                }
                                else{
                                        print("<td class='pictureColumn'><img src='$gif_url' alt='gif-image' /></td>");
                                }
                        }
                        
                        else if(@fclose(@fopen($jpg_url, "r"))){
                                if(@fclose(@fopen($gifbig_url, "r"))){
                                        print("<td class='pictureColumn'><a href='$gifbig_url'>
                                        <img src='$jpg_url' alt='jpg-image' /></a></td>");
                                }
                                else if(@fclose(@fopen($jpgbig_url, "r"))){
                                        print("<td class='pictureColumn'><a href='$jpgbig_url'>
                                        <img src='$jpg_url' alt='jpg-image' /></a></td>");
                                }
                                else{
                                        print("<td class='pictureColumn'><img src='$jpg_url' alt='jpg-image' /></td>");
                                }
                        }
                        
                        else{
                                print("<td class='pictureColumn'>" . "bild saknas" . "</td>");
                        }


                print("</tr>\n");
        }
        print("</table>\n");


        mysql_close($connection);
}

include "footer.php";

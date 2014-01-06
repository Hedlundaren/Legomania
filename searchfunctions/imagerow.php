<?php

//Visa bild på setet ifall det finns. Länka, om möjligt, till den stora versionen av bilden. 

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
					print("<td class='pictureColumn' ><img src='$gif_url' alt='gif-image' /></td>");
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
			print("<td class='pictureColumn'>" . "No image" . "</td>");
	}

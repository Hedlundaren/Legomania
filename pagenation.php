<?php

/***pagination***/

		//Räkna resultat
		$queryCount = $queryStartCount . $query . ')';
		
		$rs_result = mysql_query($queryCount);
		$row = mysql_fetch_row($rs_result);
		$total_records = $row[0];
		$total_pages = ceil($total_records/20);

		//Några definitioner för kommande uträkningar
		$First = 1;
		$Prev = $page-1;
		$Next = $page+1;
		$Last = $total_pages;
		
		print "<div id = 'pagenumber'>";
		
			switch ($page){
				
				//Alternativ för första sidan. Du ska inte kunna klicka dig till en sida som inte finns! 
				//Sidan du är på ska vara vitmarkerad. Visa bara fem sidnummer i taget.
				case $First:
					
					print "<a class=false>First</a> ";
					print "<a class=false>Previous</a> ";
			
					if ($total_pages >= 5){
						for ($i = 1; $i <= 5; $i++) {
							if ($i == $page)
								echo"<a class='page' href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
							
							else
								echo"<a href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
						}
					}
					else {
						for ($i = 1; $i <= $total_pages; $i++) {
							if ($i == $page)
								echo"<a class='page' href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
							
							else
								echo"<a href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
						}
					}
					
					if ($total_pages == 1){
					print "<a class=false>Next</a> ";
					print "<a class=false>Last</a> ";
					}
					
					else{
					print "<a href='search.php?page=".$Next."&alternativ=".$value."&search=".$search."'>Next</a> ";
					print "<a href='search.php?page=".$Last."&alternativ=".$value."&search=".$search."'>Last</a> ";	
					}
					
				break;
				
				//Samma uträkningar fast för sista sidan.
				case $total_pages;
					
					print "<a href='search.php?page=".$First."&alternativ=".$value."&search=".$search."'>First</a> ";
					print "<a href='search.php?page=".$Prev."&alternativ=".$value."&search=".$search."'>Previous</a> ";
					
					if ($total_pages >= 5){
						for ($i = $total_pages -4; $i <= $total_pages; $i++) {
							if ($i == $page)
								echo"<a class='page' href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
							
							else
								echo"<a href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
						}
					}
					else {
						for ($i = 1; $i <= $total_pages; $i++) {
							if ($i == $page)
								echo"<a class='page' href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
							
							else
								echo"<a href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
						}
					}
			
					print "<a class=false>Next</a> ";
					print "<a class=false>Last</a> ";	
					
				break;
				
				//Generell uträkning. Lite speciell för näst första samt näst sista sidan för att undvika buggar.
				default:
				
					print "<a href='search.php?page=".$First."&alternativ=".$value."&search=".$search."'>First</a> ";
					print "<a href='search.php?page=".$Prev."&alternativ=".$value."&search=".$search."'>Previous</a> ";
			
					if ($total_pages >= 5){
						switch ($page){
							case 2:
								for ($i = $page-1; $i <= $page+3; $i++) {
									if ($i == $page)
										echo"<a class='page' href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
									
									else
										echo"<a href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
								}
							break;
							
							case $total_pages-1:
								for ($i = $page-3; $i <= $page+1; $i++) {
									if ($i == $page)
										echo"<a class='page' href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
									
									else
										echo"<a href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
								}
							break;
							
							default:
								for ($i = $page-2; $i <= $page+2; $i++) {
									if ($i == $page)
										echo"<a class='page' href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
									
									else
										echo"<a href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
								}
							break;
						}
					}
					else {
						for ($i = 1; $i <= $total_pages; $i++) {
							if ($i == $page)
								echo"<a class='page' href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
							
							else
								echo"<a href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
						}
					}
			
					print "<a href='search.php?page=".$Next."&alternativ=".$value."&search=".$search."'>Next</a> ";
					print "<a href='search.php?page=".$Last."&alternativ=".$value."&search=".$search."'>Last</a> ";	
				break;
			}
		print "</div>";

<?php print ("<!DOCTYPE html>");?>
<html>
<head>
<meta charset="utf-8">
<title>Legoforum</title>
<link rel="stylesheet" type="text/css" href="style_forum.css">
<script type="text/javascript" src="myscript.js"></script>
   <script src="follower.js"></script>
</head>

<body>
<img src="stormtroopers_talking.jpg" alt="background picture" id="background">


<header>


<form id="wizard" name="wizard" action="index.php" method="post" onsubmit="return validate()">
<p id="input"><label>
Create new thread: &nbsp;
<br>
<input type ="text" name ="threadID" placeholder = "Thread subject" size ="20"/>
</label></p>
<!--sökfält-->

<input type ="text" name ="creator" placeholder = "Username" size ="20"/>
<br/>

<input id="submit" type = "submit" name="submit" value = "Create"/>

<input id="reset" type = "reset" value = "Clear"/>


</form>

<div id="home">
<a href="http://www.student.itn.liu.se/~adaal265/TNMK30/Projekt/Legomania-master/Legomania-master/main.php">
<img src="homebutton.png" alt="home link picture">
</a>
</div>

<div id="headline">
<h1>FORUM</h1>
</div>

<div id="forum">
<a href="http://sermon.se/legoforum/">
<img src="forumbutton12.png" alt="forum link picture">
</a>
</div>


</header>

<div id="spacing"></div>

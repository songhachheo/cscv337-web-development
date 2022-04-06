<!DOCTYPE html>
<html>
<!--
    This assignment is based on one from the Web Programming Step by Step textbook by Marty Stepp.
-->
	<head>
		<title>My CSCV 337 Internet Movie Database (MyMDb)</title>

		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="en-us" />

		<link rel="shortcut icon" href="http://u.arizona.edu/~lxu/cscv337/sp18/hw6/images/mymdb_icon.gif" type="image/gif" />
		<link rel="stylesheet" href="mymdb.css" type="text/css" />

		<script src="http://u.arizona.edu/~lxu/cscv337/sp18/hw6/js/prototype.js" type="text/javascript"></script>
		<script src="http://u.arizona.edu/~lxu/cscv337/sp18/hw6/js/scriptaculous.js" type="text/javascript"></script>
		<script src="mymdb.js" type="text/javascript"></script>
	</head>

	<body>
		<div id="bannerarea">
            <a href="mymdb.php"><h2>CSCV337 Assignment 6</h2></a>
		</div>

		<form id="searchform" method="get">
			<fieldset>
				<span class="label">Actor's first/last name: </span>
				<input id="first_name" type="text" name="first_name" size="10" /> 
				<input id="last_name" type="text" name="last_name" size="10" /> 
				<input type="submit" value="go" />
			</fieldset>
		</form>
		
		<div id="main">

			<!-- a place to inject the results from actors.php -->
			<div id="matches"></div>

			<h1>The One Degree of Kevin Bacon</h1>

			<p>
				Type in an actor's name to see if he/she was ever in a movie with Kevin Bacon!
			</p>

			<p>
				<img src="http://u.arizona.edu/~lxu/cscv337/sp18/hw6/images/kevin_bacon.jpg" alt="Kevin Bacon" />
			</p>

		</div>


		<div id="footer">
			<p>
				Copyright &copy; 2000-2018 Internet Movie Database Inc. <br />
				An Amazon.com company.
			</p>
		</div>

		
	</body>
</html>

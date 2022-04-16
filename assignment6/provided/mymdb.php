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

		
	<!-- Code injected by live-server -->
<script type="text/javascript">
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script></body>
</html>

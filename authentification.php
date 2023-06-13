<html>
	<header>
		<link rel="stylesheet" href="/include/styles/style.css"/>
		<link rel="stylesheet" href="/include/styles/authentification.css"/>
		<title> Authentification </title>
	</header>
	<body>
		<div class="site_content">
			<h1 class="title_auth">Authentification</h1>
			<p>Enter passphrase below</p>
			<?php
				include "/var/www/html/include/modules/pass.php";

				displayPassInput($_GET["request"], $_GET["request_location"]);
			?>
		</div>
	</body>
</html>
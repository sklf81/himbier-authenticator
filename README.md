# himbier-authenticator
An authentification system for php-webservers

##How to set it up
For an example see "index.php":
```
<?php
	include "/var/www/html/include/modules/pass.php";
	if(auth_checkPass("pass_request") === false)
	{
		header("Location: /authentification.php?request=pass_request&request_location=index.php");
	}
	else
	{
		include $config["root_dir"]."/include/modules/gradient_editor.php";
	}
?>
```

The `auth_checkPass("pass_request")` function checks if the current session is authenticated, if not, it sends an authentification request:
>GET *"/authentification.php?request=pass_request&request_location=index.php"*

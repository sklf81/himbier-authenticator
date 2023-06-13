# himbier-authenticator
An authentification system for php-webservers

## How to set it up

### On your Homepage
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

### Generating the session file
The Authenticator looks inside the storage location for the passes ( **pass.php**: `$passes_location = "/yourpasses"`) for the stored session_id.
The Session-ID is a Hash generated on request and is saved inside a JSON-File and also on your browser as a Cookie which expires after 5 Minutes.
For this to be set up, you'll need to send a GET-Request to provoke the authenticator to create the JSON-File.
>GET *"/authentification.php?request=pass_request&request_location=index.php&save_session=1"*

### Generate Hash for your passphrase
To let the authenticator know, which password is the correct one, you'll need to generate a hash from your passphrase (Seed) and store it inside the directory where you store your passes (`$passes_location`).
This hash needs to be generated like this: SHA256(MD5(<your_passphrase>))
>Passphrase: pass

>Generated Hash (try https://hashgenerator.de): 1caa6a8885bc2f0442bdb06815e3176545a8b8d63822c851d815c5cb1c2ef014

### Correctly set up your file's permissions
I can't suggest any kind of permission-setup but I can broadly explain how I've configured it.


The file-permission for the `$passes_location` folder is ** 777 ** and the owner of the folder is the user-account for web-clients (in my case "www-data").

|	File	|	Description	|	Permission	|	Owner	|
|---|---|---|---|
|`pass_request` | Storage of pass-hash | 644 | root:root|
|`pass_request.json`| Storage of session-id| 644|www-data:www-data|

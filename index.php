<!-- This is the page which ought to be locked by the authenticator -->
<?php
	include "/var/www/html/include/modules/pass.php";
	if(auth_checkPass("lights") === false)
	{
		header("Location: /authentification.php?request=pass_request&request_location=index.php");
	}
	else
	{
		include $config["root_dir"]."/include/modules/gradient_editor.php";
	}
?>
<div class="site_container">
	<p>
		Here's some content!
	</p>
</div>

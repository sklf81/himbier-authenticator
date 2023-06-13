<div class="ideapool_container">
<h2>Ideapool</h2>
	<div id="ideapool_content" class="ideapool_content">
		<?php
			$ideas_dir = "./ideas";
			$filenames = scandir($ideas_dir);
			
			for($i = 2; $i < count($filenames); $i++){
				echo("<div class='idea_container'>");
				echo(file_get_contents($ideas_dir."/".$filenames[$i]));
				echo("</div>");
			}
		?>
	</div>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="sidebar">
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : ?>
 
<?php endif; ?>

</div>
</body>
</html>
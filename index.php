<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<?php 
		while( have_posts() ) {
			the_post(); ?>
			<article>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
			<?php 
		}
	?>
</body>
</html>
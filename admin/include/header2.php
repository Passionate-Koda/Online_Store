<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title ?></title>
	<link rel="stylesheet" type="text/css" href="style/styles.css">
</head>
<body>
	<section>
			<div class="mast">
				<h1>T<span>SSB</span></h1>
				<nav>
					<ul class="clearfix">
						<li><a href="<?php echo $selectedLnk ?>" class="selected"><?php echo $selected_name  ?></a></li>
						<li><a href="<?php echo $firstLnk ?>"><?php echo $first_name ?></a></li>
						<li><a href="<?php echo $secondLnk ?>"><?php echo $second_name?></a></li>
						<li><a href="<?php echo $thirdLnk ?>"><?php echo $third_name ?></a></li>
						<li><a href="<?php echo $forthLnk ?>"><?php echo $forth_name ?></a></li>
						<li><a href="#">logout</a></li>
					</ul>
				</nav>
			</div>
		</section>

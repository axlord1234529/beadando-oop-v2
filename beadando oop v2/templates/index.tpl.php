<?php //session_start(); ?>
<?php if(file_exists('./logicals/'.$search['file'].'.php')) { include("./logicals/{$search['file']}.php"); } ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $pageTitle['cim'] ?></title>
	<script src="https://kit.fontawesome.com/ecfd83b295.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="./styles/style.css" type="text/css"> 
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
	<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
	
	<?php if(file_exists('./styles/'.$search['file'].'.css')) { ?><link rel="stylesheet" href="./styles/<?= $search['file']?>.css" type="text/css"><?php } ?>
</head>
<body>
	<header>
		<div class="container container-nav"> 
			<div class="logo">
				<a href="?page=/">LOGO</a>
				<!-- <img src=".\images\logo.jpg" alt="savage goat barbershop logo"> -->
			</div>
			<nav class="primary-pages" id="navbar">
			<ul class="nav-links">
				<?php foreach ($pages as $url => $page) { ?>
					<?php if(!$user->isLoggedIn() && $page['menu'][0] || $user->isLoggedIn() && $page['menu'][1]) { ?>
						<li<?= (($page == $search) ? ' class="active"' : '') ?>>
						<a href="<?= ($url == '/') ? '.' : ('?page=' . $url) ?>">
						<?= $page['text'] ?></a>
						</li>
					<?php } ?>
				<?php } ?>
				
			</ul>
			</nav>
			<nav class="secondary-pages">
				<ul class="nav-links" id="correct">
					<?php foreach ($buttons as $url => $page) { ?>
						<?php if(!$user->isLoggedIn() && $page['menu'][0] || $user->isLoggedIn() && $page['menu'][1]) { ?>
							<li<?= (($page == $search) ? ' class="active_2"' : '') ?>>
							<a href="<?= ($url == '/') ? '.' : ('?page=' . $url) ?>">
							<?= $page['text'] ?></a>
							</li>
						<?php } ?>
					<?php } ?>
				</ul>
			</nav>
			<button data-open="false" class="burger"><span class="sr-only">Menu</span></button>
		</div>
	</header>
	<div id="be"  ><?php if($user->isLoggedIn()) { ?>Welcome: <strong><?= $user->data()->name; ?></strong><?php } ?></div>
	
	<div class="content"> 
		<?php include("./templates/pages/{$search['file']}.tpl.php"); ?>
	</div> 
	<script src="./scripts/main.js"></script>
	<?php if(file_exists('./scripts/'.$search['file'].'.php')) { include("./scripts/{$search['file']}.php"); } ?>
</body>
<footer>
        &copy;&nbsp; <?php echo $footer['copyright']; ?>
		&nbsp;
        Created By: <?php echo $footer['created_by']; ?>
</footer>
</html>
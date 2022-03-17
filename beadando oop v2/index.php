<?php
require_once 'includes/init.inc.php';//include_once will throw a warning, but will not stop PHP from executing the rest of the script.
//include('./includes/init.inc.php');//require_once will throw an error and will stop PHP from executing the rest of the script

$pages = Config::get('pages');
$search = current($pages);  //Array ( [file] => cimlap, [szoveg] => Címlap ,[menun] => Array ( [0] => 1, [1] => 1 ) )
if (isset($_GET['page'])) {
	if (isset($pages[$_GET['page']]) && file_exists("./templates/pages/{$pages[$_GET['page']]['file']}.tpl.php")) 
	{
		$search = $pages[$_GET['page']];
	}
	else if(isset($buttons[$_GET['page']]) && file_exists("./templates/pages/{$buttons[$_GET['page']]['file']}.tpl.php")) 
	{
		$search = $buttons[$_GET['page']];
	}
	else 
	{ 
		$search = $page_not_found;
		header("HTTP/1.0 404 Not Found");
	}
}

include('./templates/index.tpl.php'); 
?>
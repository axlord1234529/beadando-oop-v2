<?php
require_once 'functions/sanatize.php';
session_start();

spl_autoload_register('myAutoLoder');

function myAutoLoder($className){
    $path = 'classes/';
    $extension = '.class.php';
    $fullPath = $path . $className .  $extension;
    
    if(!file_exists($fullPath)){
        return false;
    }
    include_once $fullPath;
}

$GLOBALS['config'] = array(
    'mysql'=>array(
        'host'=>'127.0.0.1', // this why the dns table look up isn't gonna happen.(faster)
        'username' => 'root',
        'password' => '',
        'db' => 'users'
    ),
    'remember'=>array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session'=>array(
        'session_name' => 'user',
        'token_name' => 'token'
    ),
    'pages' =>array(
        '/' => array('file' => 'home', 'text' => 'Home', 'menu' => array(1,1)), // (1,1) (visible when signed out,visible when signed in)
        'contact' => array('file' => 'contact', 'text' => 'Contact us', 'menu' => array(1,1)),
        'gallery' => array('file' => 'gallery', 'text' => 'Gallery', 'menu' => array(1,1)),
        'book_now' => array('file' => 'book_now','text' => 'Bok now', 'menu' => array(1,1))
    ),
    'footer' => array(
        'copyright' => 'Copyright '.date("Y").'.',
        'created_by' => 'Kalmár Sándor'
    )
    );
$buttons = array(
    'log_out' => array('file' => 'log_out', 'text' => 'Log out', 'menu' => array(0,1)),
    'register' => array('file' => 'register', 'text' => 'Register', 'menu' => array(1,0)),
    'log_in' => array('file' => 'log_in', 'text' => 'Log in', 'menu' => array(1,0))
);
$pageTitle = array(
    'cim' => 'Barbershop',
);

$header = array(
    'img' => 'logo.png',
    'alt' => 'logo',
	
);

$footer = array(
        'copyright' => 'Copyright '.date("Y").'.',
        'created_by' => 'Kalmár Sándor'
);
/*
$oldalak = array(
	'/' => array('file' => 'cimlap', 'text' => 'Címlap', 'menu' => array(1,1)), // (1,1) (visible when signed out,visible when signed in)
	'promocio' => array('file' => 'promocio', 'text' => 'Promóció', 'menu' => array(1,1)),
	'kapcsolat' => array('file' => 'kapcsolat', 'text' => 'Kapcsolat', 'menu' => array(1,1)),
	'galeria' => array('file' => 'galeria', 'text' => 'Galéria', 'menu' => array(1,1)),
    'elkuld' => array('file' => 'elkuld', 'text' => '', 'menu' => array(0,0)),
    'belepes' => array('file' => 'belepes', 'text' => 'Belépés', 'menu' => array(1,0)),
    'kilepes' => array('file' => 'kilepes', 'text' => 'Kilépés', 'menu' => array(0,1)),
    'belep' => array('file' => 'belep', 'text' => '', 'menu' => array(0,0)),
    'regisztral' => array('file' => 'regisztral', 'text' => 'Register', 'menu' => array(1,0))
);

'pages' =>array(
        '/' => array('file' => 'home', 'text' => 'Home', 'menu' => array(1,1)), // (1,1) (visible when signed out,visible when signed in)
        'contact' => array('file' => 'contact', 'text' => 'Contact us', 'menu' => array(1,1)),
        'gallery' => array('file' => 'gallery', 'text' => 'Gallery', 'menu' => array(1,1)),
        'book_now' => array('file' => 'book_now','text' => 'Bok now', 'menu' => array(1,1)),
        'log_out' => array('file' => 'log_out', 'text' => 'Log out', 'menu' => array(0,0)),
        'register' => array('file' => 'register', 'text' => 'Register', 'menu' => array(0,0)),
        'log_in' => array('file' => 'log_in', 'text' => 'Log in', 'menu' => array(0,0))
    ),
*/
$page_not_found = array ('file' => '404', 'text' => 'A keresett oldal nem található!');
    
$MAPPA = './kepek/';
$TIPUSOK = array ('.jpg', '.png');
$MEDIATIPUSOK = array('image/jpeg', 'image/png');
$DATUMFORMA = "Y.m.d. H:i";
$MAXMERET = 500*1024;


$user = new User();

//Sign in user if he clicked remember!
if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name')))
{
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = Db::getInstance()->get('users_session',array('hash','=',$hash));

    if($hashCheck->count())
    {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }

}

?>

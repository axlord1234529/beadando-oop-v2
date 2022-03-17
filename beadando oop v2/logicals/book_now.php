<?php
$db = Db::getInstance();

$appointments = $db->get('appointments')->results();
if(!$db->error())
{
    var_dump($appointments);
}
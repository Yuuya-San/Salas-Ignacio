<?php
require_once 'user-clas.php';
$user = new USER();

if(!$user->isUserLoggedIn())
{
 $user->redirect('../../../signin');
}

if($user->isUserLoggedIn()!="")
{
 $user->logout();
 $user->redirect('../../../signin');
}
?>
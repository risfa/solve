<?php
/**
 * Created by PhpStorm.
 * User: arahman
 * Date: 2/6/17
 * Time: 10:37 AM
 */
include 'config.php';
$isLogin=$user_sessions->get('username');
$spbuActive=((!empty($user_sessions->get('nomerSPBU')))? $user_sessions->get('nomerSPBU') : "");
$sesUsername=$isLogin;
if(!isset($isLogin)){
    header('location:login.php');
}
$errors=$user_sessions->get('errors');
$errorHTML='';
if(!empty($errors)){
    $errorHTML.='<ul>';
    foreach ($errors as $e){
        $errorHTML.='<li>'.$e.'</li>';
    }
    $errorHTML.='</ul>';
    $errorHTML='
    <div class="alert alert-danger">
      '.$errorHTML.'
    </div>';
}
$input=$user_sessions->get('input');
$user_sessions->set('errors',array());
$user_sessions->set('input',array());

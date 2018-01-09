<?php
ob_start();
error_reporting(0);
include_once "core.php";
include_once "mysql.php";
require 'SafeSQL.class.php';
$db = new ezSQL_mysql('dapps_adminruff','admin5D','dapps_ruffle','localhost');

$safesql = new SafeSQL_MySQL;

mysql_connect("localhost", "dapps_adminruff", "admin5D");
mysql_select_db("dapps_ruffle");
session_start();

$config = array();
$config['twitter_key'] = "2205930396-FfgJ76lwtwGkhrrLziCwZxLNtUBAGyhBfEkHPZ2"; #config untuk pertaminalub
$config['twitter_secret'] = "jGFKH2NwioGAxDJrxzqkBn0geE8FxV9IbkYvAGJ45OO0B"; #config untuk pertaminalub
$config['wording'][0] = 'Terimakasih [mention] buat kesempatan menang di #LesehanEnduro, yuk follow akun @pertaminalub atau klik www.pertamina-lubricants.com';
$config['wording'][1] = 'Terimakasih [mention] untuk kesempatan menang di #LesehanEnduro, yuk follow akun @pertaminalub atau klik www.pertamina-lubricants.com';
$config['wording'][2] = '[mention] berkesempatan menang di #LesehanEnduro, yuk follow akun @pertaminalub atau klik www.pertamina-lubricants.com';
$config['wording'][3] = 'Terimakasih [mention] atas partisipasinya di #LesehanEnduro, yuk follow akun @pertaminalub atau klik www.pertamina-lubricants.com';
$config['wording'][4] = 'Terimakasih [mention] telah mengikuti #LesehanEnduro, yuk follow akun @pertaminalub atau klik www.pertamina-lubricants.com';
$config['wording_hadiah'][0] = 'Hi [mention] selamat kamu mendapatkan [hadiah] #LesehanEnduro. Yuk follow @pertaminalub';
$config['wording_hadiah'][1] = '[mention] selamat kamu mengikuti #LesehanEnduro & mendapatkan [hadiah]. Follow @pertaminalub';
$config['wording_hadiah'][2] = 'Selamat [mention] berhak dapatkan [hadiah] #LesehanEnduro. Follow @pertaminalub';
$config['wording_hadiah'][3] = '[mention] selamat kamu mendapatkan hadiah [hadiah] di #LesehanEnduro. Yuk follow @pertaminalub';
$config['wording_hadiah'][4] = 'Selamat [mention] memenangkan [hadiah] di #LesehanEnduro yuk follow @pertaminalub';
$config['wording_hadiah'][5] = '[mention] terimakasih mengikuti #LesehanEnduro dan mendapatkan [hadiah]. Follow @pertaminalub';
$config['wording_hadiah'][6] = 'Terimakasih berpartisipasi #LesehanEnduro [mention] mendapatkan [hadiah]. Follow @pertaminalub';
$config['wording_hadiah'][7] = '#LesehanEnduro memberikan hadiah [hadiah] kepada [mention]. Follow @pertaminalub #LesehanEnduro';
$config['wording_hadiah'][8] = 'Selamat [mention] kamu menang di #LesehanEnduro dan mendapatkan [hadiah] Yuk follow @pertaminalub';
$config['wording_hadiah'][9] = '[mention] mendapatkan [hadiah] di #LesehanEnduro. Terimakasih partisipasinya. Follow @pertaminalub';
?>
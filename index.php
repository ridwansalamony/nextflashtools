<?php
if (!session_id()) session_start();
date_default_timezone_set('Asia/Jakarta');

error_reporting(0);

require_once 'app/init.php';

$app = new App;

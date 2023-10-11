<?php
if (!session_id()) session_start();
date_default_timezone_set('Asia/Jakarta');

error_reporting(0);
set_time_limit(1000);

require_once 'app/init.php';

$app = new App;

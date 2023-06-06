<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>OnlineTrader - Setup wizard</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/bulma.min.css"/>
    <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="front/assets/css/bootstrap.min.css">
      <script defer src="fa/fa.js"></script>
  </head>
  <body>
      <header>
          <div class="section-header">
            <p>OnlineTrader setup wizard</p>
            <a href="mailto:support@brynamics.com" target="_blank">Get help</a>
          </div>
      </header>
      
    <div class="container"> 
      <div class="section" >
        <div class="column is-10 is-offset-1">
          
          <div class="box">
              
            <article class="message is-success">
                
                
                
                <div class="col-xl-12">



  <?php 
  error_reporting(0);

  function extension_check($name){
  if (!extension_loaded($name)) {
  $response = false;
  } else {
  $response = true;
  }
  return $response;
  }

  function folder_permission($name){
  $perm = substr(sprintf('%o', fileperms($name)), -4);
      if ($perm >= '0755') {
        $response = true;
      } else {
         $response = false;
      }
  return $response;
  }

  function importDatabase($mysql_host,$mysql_database,$mysql_user,$mysql_password){
    $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
    $query = file_get_contents("DATABASE.sql");
    $stmt = $db->prepare($query);
    if ($stmt->execute())
       return true;
    else 
       return false;
  }

  $base_url = home_base_url();
  if (substr("$base_url", -1=="/")) {
  $base_url = substr("$base_url", 0, -1);
  }

  function home_base_url(){   
    $base_url = (isset($_SERVER['HTTPS']) &&
    $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
    $tmpURL = dirname(__FILE__);
    $tmpURL = str_replace(chr(92),'/',$tmpURL);
    $tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);
    $tmpURL = ltrim($tmpURL,'/');
    $tmpURL = rtrim($tmpURL, '/');
    $tmpURL = str_replace('install','',$tmpURL);
    $base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL;
    return $base_url; 
  }

  function createTable($name, $details, $status){
  if ($status=='1') {
  $pr = '<i class="fa fa-check"><i>';
  }else{
  $pr = '<i class="fa fa-times text-red"><i>';
  }
  echo "<tr><td>$name</td><td>$details</td><td>$pr</td></tr>";
  }

  ////####################################################
  $extensions = [
      'openssl' ,'pdo', 'mbstring', 'tokenizer', 'JSON', 'cURL', 'gmp', 'XML', 'fileinfo'
  ];

  $folders = [
  '../bootstrap/cache/', '../storage/', '../storage/app/', '../storage/framework/', '../storage/logs/'
  ];
  ////####################################################

  if (isset($_GET['action'])) {
  $action = $_GET['action'];
  }else {
  $action = "";
  }
  if ($action=='install') {
  ?>
  <div class="step-installer first-installer second-installer third-installer">
  <div class="installer-content">
  <?php
  if ($_POST) {
  $user = $_POST['user'];
  $code = $_POST['code'];
  $db_name = $_POST['db_name'];
  $db_host = $_POST['db_host'];
  $db_user = $_POST['db_user'];
  $db_pass = $_POST['db_pass'];
  $status = TRUE;
  if ($status->status=='Error') {
  echo "<h2 class='text-center text-red'>$status->message<h2>";
  }else{
  if(importDatabase($db_host,$db_name,$db_user,$db_pass)){
  echo '<div class="cntr" class="message-body">
  <h3>Installation complete! </h3>
  <a href="'.$base_url.'" class="btn btn-success btn-sm">Go to Website</a> 
  <br><br><b class="text-red" >We strongly recommend deleting the install folder</b><br></div>';
  ////////////////////// UPDATE CONFIG
  $key = base64_encode(random_bytes(32));
  $output = '
APP_NAME=OnlineTrader
APP_ENV=local
APP_KEY=base64:pGwNRHBYg+/GuUZ6N9GSfb+cFrCED+0t0yjl+E7OI0g=
APP_DEBUG=false
APP_URL='.$base_url.'

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST='.$db_host.'
DB_PORT=3306
DB_DATABASE='.$db_name.'
DB_USERNAME='.$db_user.'
DB_PASSWORD='.$db_pass.'

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=database
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

BITPAY_PRIVATE_KEY_PATH=/tmp/bitpay.pri
BITPAY_PUBLIC_KEY_PATH=/tmp/bitpay.pub
BITPAY_NETWORK=testnet
BITPAY_KEY_STORAGE_PASSWORD=SomeRandomePasswordForKeypairEncryption
BITPAY_TOKEN=

  ';

  $file = fopen('../.env', 'w');
  fwrite($file, $output);
  fclose($file);
  }else{
  echo "<h3 class='text-center text-red'>Please Check Your Database Credential!<h3>";
  }
  }
  }
  ?>
  </div>
  </div>
  <?php
  }elseif($action=='config') {
  ?>
  <div class="step-installer first-installer second-installer third-installer">
  <center class="installer-header"><h3>Information</h3></center>
  <div class="installer-content">
  <form action="?action=install" method="post">
  <h5>APP URL</h5>
  <input class="form-control" name="app_url" value="<?php echo $base_url; ?>" type="text"><br>
 
<br>
  <hr>
  <h5>Database Details</h5>
  <input class="form-control input-lg" name="db_name" placeholder="Database Name" type="text" required=""><br>
  <input class="form-control input-lg" name="db_host" placeholder="Database Host" type="text" required=""><br>
  <input class="form-control input-lg" name="db_user" placeholder="Dabatabe User" type="text" required=""><br>
  <input class="form-control input-lg" name="db_pass" placeholder="Password" type="text" required=""><br>
  <button class="btn btn-success" type="submit">INSTALL NOW</button>
  </form>
  </div>
  </div>
  <?php
  }elseif ($action=='requirements') {
  ?>
  <div class="step-installer first-installer second-installer">
  <center><h3>Server requirements</h3></center>
  <div class="installer-content table-responsive">
  <table class="table table-striped cntr">
  <tbody>
  <?php
  $error = 0;
  $phpversion = version_compare(PHP_VERSION, '7.4.0', '>=');
  if ($phpversion==true) {
  $error = $error+0;
  createTable("PHP", "Required PHP version 7.4 or higher",1);
  }else{
  $error = $error+1;
  createTable("PHP", "Required PHP version 7.4 or higher",0);
  }
  foreach ($extensions as $key) {
  $extension = extension_check($key);
  if ($extension==true) {
  $error = $error+0;
  createTable($key, "Required ".strtoupper($key)." PHP Extension",1);
  }else{
  $error = $error+1;
  createTable($key, "Required ".strtoupper($key)." PHP Extension",0);
  }
  }
  foreach ($folders as $key) {
  $folder_perm = folder_permission($key);
  if ($folder_perm==true) {
  $error = $error+0;
  createTable(str_replace("../", "", $key)," Required permission: 0755 ",1);
  }else{
  $error = $error+1;
  createTable(str_replace("../", "", $key)," Required permission: 0755 ",0);
  }
  }
  $envCheck = is_writable('../.env');
  if ($envCheck==true) {
  $error = $error+0;
  createTable('env'," Required .env to be writable",1);
  }else{
  $error = $error+1;
  createTable('env'," Required .env to be writable",0);
  }
  $database = file_exists('DATABASE.sql');
  if ($database==true) {
  $error = $error+0;
  createTable('Database',"  Required DATABASE.sql available",1);
  }else{
  $error = $error+1;
  createTable('Database'," Required DATABASE.sql available",0);
  }
  echo '</tbody></table><div class="button">';
  if ($error==0) {
  echo '<a class="button is-warning" href="?action=config">Next Step <i class="fa fa-angle-double-right"></i></a>';
  }else{
  echo '<a class="button is-warning" href="?action=requirements">ReCheck <i class="fa fa-sync-alt"></i></a>';
  }
  ?>
  </div>
  </div>
  </div>
                
              <?php
              }else{
              ?>
              <center>
                <h1 class="title">Software terms of use</h1><br>
              </center>
          
              <div class="message-body">
                The Regular license can be used for only one website / domain. You should purchase another license if you need to use it on another domain name.<br><br>
                You can modify the code further to suite your needs. However, You cannot esell, distribute, give away or trade by any means to any third party or individual without permission. 
                Also, you cannot include this product into other products sold on Envato market, its affiliate websites or elsewhere on the internet. <br><br>
                
                To learn more about the software license, Please Check <a href="https://codecanyon.net/licenses/faq" target="_blank">Envato License FAQ.</a><br><br>
                
              </div>
              
              <center>
              <a class="button is-warning" href="?action=requirements" class="m-10">I agree. Please proceed</a>
              </center>
              <?php
              }
              ?>
            </article>
            

          </div>
        </div>
      </div>
    </div>
    <div class="content has-text-centered">
      <p>Copyright <?php echo date('Y'); ?> Brynamics, All rights reserved.</p><br>
    </div>
    
    <script src="front/assets/js/jquery-3.6.0.min.js"></script>
  <script src="front/assets/js/popper.js"></script>
  <script src="front/assets/js/bootstrap.min.js"></script>
  </body>
</html>
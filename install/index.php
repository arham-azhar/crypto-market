<?php
 // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF']; 
    
    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
    $pathInfo = pathinfo($currentPath); 
    
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST']; 
    
    // output: http://
    $protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
    
    // return: http://localhost/myproject/
     $siteURL= str_replace('/install','',$protocol.$hostName.$pathInfo['dirname']);
	 $actual_link = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	 $step2=str_replace('index.php','step2',$actual_link);
	 error_reporting(0);
	 session_start();
	 $db_config_path = '../application/config/database.php';
	 $db_common_config = '../application/config/common/dp_config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST) {
    
	require_once('taskCoreClass.php');
	require_once('includes/databaseLibrary.php');

	$core = new Core();
	$database = new Database();

	if($core->checkEmpty($_POST) == true)
	{
		if($database->create_database($_POST) == false)
		{
			$message = $core->show_message('error',"The database could not be created, make sure your the host, username, password, database name is correct.");
		} 
		else if ($database->create_tables($_POST) == false)
		{
			$message = $core->show_message('error',"The database could not be created, make sure your the host, username, password, database name is correct.");
		} 
		else if ($core->checkFile() == false)
		{
			$message = $core->show_message('error',"File application/config/database.php is Empty");
		}
		else if ($core->write_config($_POST) == false)
		{
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		}

		if(!isset($message)) {
            //$urlWb = $core->getAllData($_POST['url']); 
           
           //echo 'Installation Done. <a href='.$urlWb.'>Go to Site</a>';
            
            sleep(5);
            header( 'Location: ' . $step2 ) ;
		}
	}
	else {
		$message = $core->show_message('error','The host, username, password, database name are required.');
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Welcome to CryptoNet PHP Script Installer - Step 1</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <h1> CryptoNet Installer</h1>
            <hr>
            <?php 
            if(is_writable($db_config_path) && is_writable($db_common_config))
            {
            ?>
                <?php if(isset($message)) {
                echo '
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                ' . $message . '
                </div>';
                }?>
                
                <form id="install_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="hostname">Hostname</label>
                    <input type="text" id="hostname" value="localhost" class="form-control" name="hostname" />
                    <p class="help-block">Your Hostname.</p>
                </div>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control" name="username" />
                    <p class="help-block">Your Username.</p>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" name="password" />
                    <p class="help-block">Your Password.</p>
                </div>
                
                <div class="form-group">
                    <label for="database">Database Name</label>
                    <input type="text" id="database" class="form-control" name="database" />
                    <p class="help-block">Your Database Name.</p>
                </div>
                
                <!--<div class="form-group">
                    <label for="database">URL</label>
                    <input type="text" id="url" class="form-control" name="url" placeholder="http://test.com/" />
                    <p class="help-block">Your URL Website.</p>
                </div>-->
                <input type="hidden" name="template" id="template" value="3">
                
                <input type="hidden" name="url" id="url" value="<?php echo $siteURL;?>">
                <input type="submit" value="Install" class="btn btn-primary btn-block" id="submit" />
                </form>
        
                <?php 
                } 
                else if(!is_writable($db_config_path))
                {
					?>
                <p class="alert alert-danger">
                    Please make the application/config/database.php file writable.<br>
                    <strong>Example</strong>:<br />
                    <code>chmod 777 application/config/database.php</code>
                    </p>
                <?php 
                } 
                     else {
                ?>
                <p class="alert alert-danger">
                    Please make the application/config/common/dp_config.php file writable.<br>
                    <strong>Example</strong>:<br />
                    <code>chmod 777 application/config/common/dp_config.php</code>
                    </p>
                <?php 
                } 
                ?>
            </div>
            
          
      </div>
      <script src="assets/js/jquery.min.js" type="text/javascript"></script>
      <script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>

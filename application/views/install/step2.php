<?php
	error_reporting(0);
 // output: /myproject/index.php
     $currentPath = $_SERVER['PHP_SELF']; 
    
    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
    $pathInfo = pathinfo($currentPath); 
    
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST']; 
	// output: http:// or https://
    $protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
    $siteURL= str_replace('/install','',$protocol.$hostName.$pathInfo['dirname']);
    $siteURL= str_replace('index.php','admin',$siteURL);
    
     if (strpos($siteURL, 'admin') == false) {
			 $adminURL= $siteURL.'admin';
		}
	if (strpos($adminURL, '/admin') == false) {
			 $adminURL= $siteURL.'/admin';
		}	
	$baseURL= str_replace('/admin','',$adminURL);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Welcome to CryptoNet PHP Script Installer - Step 2</title>
		<link href="<?php echo $baseURL?>/install/assets/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <h1> CryptoNet Installer</h1>
            <hr>
                            <?php if(isset($error_msg)) {
                echo '
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                ' .$error_msg. '
                </div>';
							}
                ?>
                
                <form id="install_form" method="POST" action="">
                <div class="form-group">
                    <label for="database">ADMIN URL</label>
                    <input type="text" id="url" class="form-control" name="url" placeholder="<?php echo $adminURL;?>" readonly />
                    <p class="help-block">Your Admin URL.</p>
                </div>
                <div class="form-group">
                    <label for="hostname">Admin Email</label>
                    <input type="text" id="email" class="form-control" name="email" />
                    <p class="help-block">Your Admin Email.</p>
                </div>
                
                <div class="form-group">
                    <label for="username">Admin Password</label>
                    <input type="password" id="password" class="form-control" name="password" />
                    <p class="help-block">Your Admin Password (Minimum 8 characters)</p>
                </div>
                                <div class="form-group">
    <label for="api_key">CoinGecko API Key</label>
    <input type="text" id="api_key" class="form-control" name="api_key" required />
    <p class="help-block">
        Enter your CoinGecko API Key. &nbsp;
        <a href="https://support.coingecko.com/hc/en-us/articles/21880397454233-User-Guide-How-to-sign-up-for-CoinGecko-Demo-API-and-generate-an-API-key" target="_blank">How to sign up for CoinGecko Demo API and generate an API key?</a>
    </p>
</div>
                <input type="hidden" name="base_url" value="<?php echo $baseURL?>">
                                
                <input type="submit" value="Install" class="btn btn-primary btn-block" id="submit" />
                </form>
        
                
            </div>
            
           
      </div>
      <script src="<?php echo $baseURL?>/install/assets/js/jquery.min.js" type="text/javascript"></script>
      <script src="<?php echo $baseURL?>/install/assets/js/bootstrap.min.js"></script>
	</body>
</html>

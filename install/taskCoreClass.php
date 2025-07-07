<?php
class Core {
	function checkEmpty($data)
	{
	    if(!empty($data['hostname']) && !empty($data['username']) && !empty($data['database']) && !empty($data['url']) && !empty($data['template'])){
	        return true;
	    }else{
	        return false;
	    }
	}

	function show_message($type,$message) {
		return $message;
	}
	
	function getAllData($data) {
		return $data;
	}

	function write_config($data) {

        if($data['template'] == 2){
		    $template_path 	= 'includes/templatevtwo.php';
        }else if($data['template'] == 3){
            $template_path 	= 'includes/templatevthree.php';
        }
       
		$output_path 	= '../application/config/database.php';
		

		$database_file = file_get_contents($template_path);
		

		$new  = str_replace("%HOSTNAME%",$data['hostname'],$database_file);
		$new  = str_replace("%USERNAME%",$data['username'],$new);
		$new  = str_replace("%PASSWORD%",$data['password'],$new);
		$new  = str_replace("%DATABASE%",$data['database'],$new);
		

		$handle = fopen($output_path,'w+');
		@chmod($output_path,0777);
		
		$template_path2 	= 'includes/template.php';
		$output_path2 	= '../application/config/common/dp_config.php';
		$database_file2 = file_get_contents($template_path2);
		$new2  = str_replace("%domain%",$data['url'],$database_file2);
		
		
		
				
		$handle2 = fopen($output_path2,'w+');
		@chmod($output_path2,0777);
		
		fwrite($handle2,$new2);
		
		
		//if(is_writable(dirname($output_path))) {
		if(is_writable($output_path)) {

			if(fwrite($handle,$new)) {
			return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	function checkFile(){
	    $output_path = '../application/config/database.php';
	    
	    if (file_exists($output_path)) {
           return true;
        } 
        else{
            return false;
        }
	}
}

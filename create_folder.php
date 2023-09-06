<?php
$allData = array();
if(isset($_REQUEST['submit']))
{
   if($_POST['access_token'] == "" || $_POST['access_token'] == null)
   {
        $access_token_error = "access_token is Required";
   }
   else
   {
        $access_token = $_POST['access_token'];
   }
   if($_POST['name'] == "" || $_POST['name'] == null)
   {
        $name_error = "name is Required";
   }
   else
   {
        $name = $_POST['name'];
   }
   if($access_token !='' && $name !='')
   {
    $curl = curl_init();

    curl_setopt_array($curl, array(
     CURLOPT_URL => 'https://www.googleapis.com/drive/v3/files',
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'POST',
     CURLOPT_POSTFIELDS =>'{
       "name" :"'.$name.'",
       "mimeType": "application/vnd.google-apps.folder"
   }',
     CURLOPT_HTTPHEADER => array(
       'Authorization: Bearer '.$access_token,
       'Content-Type: application/json'
     ),
   ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $allData = $response;
    }
   }
   
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Folder</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
	<div class="container" style="margin-top : 30px">
		
		<div class="panel panel-info">
			
            <div class="panel-heading">
                <div class="panel-title">Create Folder</div>
            </div>  
            <div class="panel-body" >
            	<form method="post" action="">
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Access Token</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="api_key"  name="access_token" style="margin-bottom: 10px" type="text" value=""/>
                       <p class="text-danger"><?php echo $access_token_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Name</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="name" style="margin-bottom: 10px" type="text" value="" placeholder="test"/>
                       <p class="text-danger"><?php echo $name_error; ?></p>
                  </div>
                </div>
                <div class="form-group"> 
                    <div class="aab controls col-md-4 "></div>
                    <div class="controls col-md-8 ">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary btn btn-info" id="submit-id-signup" />
                    </div>
                </div> 
            	</form>	
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Result</div>
            </div>
            <div class="panel-body" >
                <?php
                    echo $allData;
                ?>
            </div>
        </div>
	</div>
</body>
</html>
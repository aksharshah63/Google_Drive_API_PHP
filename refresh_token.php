<?php
$allData = array();
if(isset($_REQUEST['submit']))
{
   if($_POST['refresh_token'] == "" || $_POST['refresh_token'] == null)
   {
        $refresh_token_error = "refresh_token is Required";
   }
   else
   {
        $refresh_token = $_POST['refresh_token'];
   }
   if($_POST['client_id'] == "" || $_POST['client_id'] == null)
   {
        $client_id_error = "client_id is Required";
   }
   else
   {
        $client_id = $_POST['client_id'];
   }
   if($_POST['client_secret'] == "" || $_POST['client_secret'] == null)
   {
        $client_secret_error = "client_secret is Required";
   }
   else
   {
        $client_secret = $_POST['client_secret'];
   }
   if($refresh_token !='' && $client_id !='' && $client_secret !='')
   {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://oauth2.googleapis.com/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'refresh_token='.$refresh_token.'&client_id='.$client_id.'&client_secret='.$client_secret.'&grant_type=refresh_token',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/x-www-form-urlencoded'
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
	<title>Fetch Access token from Refresh token</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
	<div class="container" style="margin-top : 30px">
		
		<div class="panel panel-info">
			
            <div class="panel-heading">
                <div class="panel-title">Fetch Access token from Refresh token</div>
            </div>  
            <div class="panel-body" >
            	<form method="post" action="">
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Refresh Token</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="api_key"  name="refresh_token" style="margin-bottom: 10px" type="text" value=""/>
                       <p class="text-danger"><?php echo $refresh_token_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Client Id</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="client_id" style="margin-bottom: 10px" type="text" value="543172563822-84kujucjblgth824kq65d8lh3n2m2c9c.apps.googleusercontent.com"/>
                       <p class="text-danger"><?php echo $client_id_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Client secret</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="client_secret" style="margin-bottom: 10px" type="text" value="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" />
                       <p class="text-danger"><?php echo $client_secret_error; ?></p>
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
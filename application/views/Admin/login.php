<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login</title>
<base href="<?PHP echo base_url(); ?>">

<link href="resources/admin-resources/css/bootstrap.min.css" rel="stylesheet">
<link href="resources/admin-resources/css/datepicker3.css" rel="stylesheet">
<link href="resources/admin-resources/css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<link  rel="shortcut icon" type="image/x-icon" href="resources/favicon.png" />
</head>

<body style="background:#fff">
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        
        <div class="logopanel text-center" style="margin-bottom: 10px;">
          <img src="resources/admin-resources/images/medha-samp.png"/>
          </div>
			<div class="login-panel panel panel-default admin">
            
          
            
            
				<div class="panel-heading">Admin login</div>
				<div class="panel-body">
					<form role="form" method="post" action="">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="User Id" name="UserId" type="text" value="<?PHP echo set_value('UserId');?>" autofocus="">
                                <div class="err-msg"><?PHP echo form_error('UserId');?></div>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="Password" type="password" value="">
                                <div class="err-msg"><?PHP echo form_error('Password');?></div>
							</div>
							
                            
							<input type="submit" name="adminlogin" value="Login" class="btn btn-primary">
                            
                            <span class="login-msg"><?PHP echo $this->session->flashdata('login_msg');?></span>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	<script src="resources/admin-resources/js/jquery-1.11.1.min.js"></script>
	<script src="resources/admin-resources/js/bootstrap.min.js"></script>
</body>

</html>

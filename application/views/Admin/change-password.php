<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
			<li><a href="<?PHP echo base_url('admin/view-all-applications'); ?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Change Password</li>
			</ol>
		</div><!--/.row-->
		

		<div class="row">
			<div class="col-lg-12 content-div" >
            	
                                
				<div class="panel panel-default">
					<div class="login-msg"><?PHP echo $this->session->flashdata('chngPwd_msg');?></div>

					<div class="panel-body ">
						<div class="col-md-6">
                         
							<form role="form" name="changepwd" method="post"> 
							
								<div class="form-group">
									<label>Current Password</label>
									<input class="form-control" type="text" name="currentpassword" value="<?PHP echo set_value('currentpassword');?>">
                                     <div class="err-msg"><?PHP echo form_error('currentpassword');?></div>
								</div>
																
								<div class="form-group">
									<label>New Password</label>
									<input type="password" name="password" class="form-control" >
                                    <div class="err-msg"><?PHP echo form_error('password');?></div>
								</div>
								
                                <div class="form-group">
									<label>Confirm Password</label>
									<input type="password" name="confirmpassword" class="form-control">
                                    <div class="err-msg"><?PHP echo form_error('confirmpassword');?></div>
								</div>
                                
                                  <div class="form-group">
									<label></label>
									<input type="submit" class="btn btn-primary" name="chngpwd" value="Change Password">
                                   
								</div>
								
								 <div class="clearfix"></div>
							</div>
					</div>
				</div>
                <div class="clearfix"></div>
			</div>
		</div><!--/.row-->	
		
        
        
		
	</div>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?PHP echo base_url('dashboard'); ?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Add exam center</li>
			</ol>
		</div><!--/.row-->
		

		<div class="row">
			<div class="col-lg-12 content-div" >
            	
                                
				<div class="panel panel-default">
					<div class="login-msg"><?PHP echo $this->session->flashdata('chngPwd_msg');?></div>

					<div class="panel-body ">
						<div class="col-md-6">
                         
							<form role="form" name="changepwexamcenter_form" method="post"> 
							
								<div class="form-group">
									<label>Select District</label>
									
                                    <select name="DistrictId" class="form-control">
                                    <option value="0">Select District</option>
                                    <?PHP
										foreach($districts->result()  as $dist)
										{
											?>
                                            <option value="<?PHP echo $dist->DistrictId?>"> <?PHP echo $dist->DistrictName?> </option>
                                            <?PHP	
										}
									
									?>
                                    </select>
                                    
                                     <div class="err-msg"><?PHP echo form_error('currentpassword');?></div>
								</div>
																
								<div class="form-group">
									<label>Exam center Name</label>
									<input type="text" name="CenterName" class="form-control" >
                                    <div class="err-msg"><?PHP echo form_error('password');?></div>
								</div>
								
                                
                                
                                  <div class="form-group">
									<label></label>
									<input type="submit" class="btn btn-primary" name="addexamcenter" value="Add Exam Center">
                                   
								</div>
								
								 <div class="clearfix"></div>
							</div>
					</div>
				</div>
                <div class="clearfix"></div>
			</div>
		</div><!--/.row-->	
		
        
        
		
	</div>
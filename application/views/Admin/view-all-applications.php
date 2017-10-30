<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
			
				<li class="active">view all applications</li>
                
                <li class="pull-right"><a href="<?PHP echo base_url('admin/resetapplicationfilter')?>" class="btn btn-primary btn-sm" style="padding: 3px 5px; color:#fff">Reset Search Filter</a></li>
			</ol>
		</div><!--/.row-->
		

		<div class="row">
			<div class="col-lg-12 content-div" >
				<div class="panel panel-default">
					
					<div class="panel-body ">
                    
                    
                    <div class="text-right sc-top" >
	                   	 <form method="post" class="text-right" action="<?PHP echo base_url('admin/view-all-applications')?>">
                          
                        <div class="filter-zone" style="padding:10px; margin-left:10px" >
                        
                        <select name="districts" id="districts" class="form-control">
                        <option value="0">Select Distict</option>
                        <?PHP
							foreach( $districts->result() as $dist)
							{
								?>
                                	<option value="<?PHP echo $dist->DistrictId?>" <?PHP if($selectedDistrict==$dist->DistrictId) echo 'selected';?> ><?PHP echo str_replace("DISTRICT","",$dist->DistrictName)?></option>
                                <?PHP	
							}
						?>
                        </select>
                        
                        </div>
                        
                     <div class="filter-zone" style="padding:10px; margin-left:10px" >
                        
                        <select name="Mandals" id="Mandals" class="form-control">
                        <option value="0">Select Mandal</option>
                        <?PHP
							if($mandals!='0')
							{
								foreach( $mandals->result() as $mndl)	
								{
									?>
                                    <option value="<?PHP echo $mndl->MandalId?>" <?PHP if($selectedMandal==$mndl->MandalId) echo 'selected';?> ><?PHP echo str_replace("(MANDAL)","",$mndl->MandalName)?></option>
                                    <?PHP	
								}
							}
						?>
                        </select>
                        
                        </div>
                        
                        <div class="filter-zone" style="padding:10px; margin-left:10px" >
                        
                        <select name="Schools" id="schools" class="form-control">
                        <option value="0">Select School</option>
                        <?PHP
							if($schools!='0')
							{
								foreach( $schools->result() as $schl)	
								{
									?>
                                    <option value="<?PHP echo $schl->SchoolId?>" <?PHP if($selectedSchool==$schl->SchoolId) echo 'selected';?> ><?PHP echo $schl->SchoolName?></option>
                                    <?PHP	
								}
							}
						?>
                        </select>
                        
                        </div>
                       
                        <div class="filter-zone" style="padding:10px; margin-left:10px" >
                        
                         <div  class="examcenterslist">
                                <ul style="margin:0px; list-style:none; position:absolute; text-align: left; padding: 0px; top:35px;">
                                
                                
                                </ul>
                            <div class="clearfix"> </div>
                        </div>
                        
                        <input type="hidden" name="SelectedExamcenter" id="SelectedExamcenter" value="<?PHP echo @$SelectedExamcenter;?>"  />
                        
                        <input type="text" name="Examcenters" id="Examcenters"  placeholder='Enter Examcenter' class="form-control" value="<?PHP echo @$CenterName; ?>" />
                        
                        <div class="clearfix"> </div>
                        </div>
                        
                        
                          
                       <div class="filter-zone-btn"  > 
                         <input type="submit" name="applications_filter" class="btn btn-primary bt" value="Search" />
                       </div>
                          
                       
                          </form>
                      <div class="clearfix"> </div>
                      </div>
                    
						<table class="table table-striped schol-top" >
						    <thead>
						    <tr>
                            	<th>Slno</th> <th>Application No</th><th>Student Name </th> <th>Contact Number</th>
                                <th>District</th> <th>Mandal</th><th>School</th> <th>IX Marks</th> <th>View Details</th>
                                
                            </tr>
                            
						    </thead>
						
                        <tbody>
                        <?PHP
							if($Applications!='0')
							{
							$slno=0;
							if($this->uri->segment(3)) { $slno = ($this->uri->segment(3)-1)*$perpage;	}
							
							foreach( $Applications->result() as $data)
							{
								$slno++;
						?>
                        <tr>
                            	<td><?PHP echo $slno?></td> <td><?PHP echo $data->ApplicationNo;?></td><td><?PHP echo $data->StudentName; ?></td> <td><?PHP echo $data->ContactNumber; ?></td>
                                <td><?PHP echo  str_replace("DISTRICT","",$data->DistrictName); ?></td> <td><?PHP echo str_replace("(MANDAL)","",$data->MandalName); ?></td><td><?PHP echo $data->SchoolName; ?></td> <td><?PHP echo $data->NinethMarks?></td> <td><a href="<?PHP echo base_url('admin/view-student-application/'.$data->ApplicationNo)?>" class="btn btn-sm btn-success">View</a></td>
                                
                            </tr>
                            
                            <?PHP
							}
								echo "<tr><td colspan=9 style='text-align:left'>".$pagination_string."</td></tr>";
							}
							else
							{
									
							}
							?>
                        		
                        </tbody>
                        
                        </table>
                    
                    
                    
                        
                        
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
        
        
		
	</div>
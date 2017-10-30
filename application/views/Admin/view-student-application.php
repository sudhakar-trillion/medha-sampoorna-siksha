<?PHP
	foreach( $applicantdetails->result() as $data )
	{
			$FirstName	 = $data->FirstName;
			$LastName	 = $data->LastName;
			
			$FatherName	 = $data->FatherName;
			$MotherName	 = $data->MotherName;
			
			$HeadMaster	 = $data->HeadMaster;
			$DOB	 = date_create($data->DOB);
			$DOB 	=	date_format($DOB,"d-m-Y");
			
			
			$ReservationCategory	 = $data->ReservationCategory;
			$PicPath	 = $data->PicPath;
			
			$ContactNumber	 = $data->ContactNumber;
			$AlternateNumber		 = $data->AlternateNumber;
			$HeadMasterContactNumber		 = $data->HeadMasterContactNumber;
			
			$Address		 	= $data->Address;
			$NinethMarks		 = $data->NinethMarks;
			
			$Gender 			=	$data->Gender;
			$AadharNumber		=	$data->AadharNumber;
			
			
			$District			=	$data->DistrictName;
			$Mandal				=	$data->MandalName;
			$School				=	$data->SchoolName;
			
			$PicPath 			= 	$data->PicPath;
			$AadharCardPath 			= 	$data->AadharCardPath;
			$MemoPath 			= 	$data->MemoPath;
			
			$cond = array();
			
			$cond['ApplicationNo'] = $this->uri->segment(3);
			
			/*
			$cond['District'] = $District;
			
			$cond['Mandal']	= $Mandal;
			$cond['School'] = $School;
			*/
			$cond['YEAR(ForYear)'] = date('Y');
			$table ='verifiedapplications';
		
			$this->db->where($cond);
			$qry = $this->db->get($table);
			if($qry->num_rows()>0)
				$verified="yes";
			else
				$verified = "no";
				
				//echo $this->db->last_query(); exit; 
			
	}

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?PHP echo base_url('dashboard'); ?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">view all applications</li>
			</ol>
		</div><!--/.row-->
		

		<div class="row">
			<div class="col-lg-12 content-div" >
				<div class="panel panel-default">
					
					<div class="panel-body ">
						<!--<table class="table" >
						    <thead>
						    <tr>
                            	<th>Slno</th> <th>Applicatio No</th><th>Student Name </th> <th>Contact Number</th>
                                <th>District</th> <th>Mandal</th><th>School</th> <th>IX Marks</th> <th>View Details</th>
                                
                            </tr>
                            
						    </thead>
						</table>-->
                    
                    <div class="col-md-3">
                    <div class="viewpro proimage">
                    
                    <div class="img-block">
                   <!-- <img src="resources/frontend-resources/img/student33.jpg"  />-->
                    <img src="<?PHP echo $PicPath?>"  style="width:215px; height:230px"/>
                    
                    
                    <a href="<?PHP echo $MemoPath?>" download appNo="<?PHP echo $this->uri->segment(3)?>"  target="_blank"><i class="fa fa-cloud-download" aria-hidden="true"></i> Download Marks-List</a>
                    
                      
                    <a  style="cursor:pointer"  class="viewmemo" data-toggle="modal" data-target="#memoPathmodal" Memopath="<?PHP echo $MemoPath;?>"  target="_blank" ><i class="fa fa-eye" style="background:#30a5ff" aria-hidden="true"></i> View Marks-List</a>
                    
                    </div>
                    
                    
                    </div>
                    
                    
                    <div class="viewpro proimage">
                    
                    <?PHP
					if($verified=="no")
					{
						?>
                    <div class="very-mark">
                    
                    <input type="number"  class="form-control ninethmarks" value="<?PHP echo $NinethMarks;?>" placeholder="Edit Marks"/>

                    <button type="button" class="editmark editninethmarks" id="edit"><i class="fa fa-edit"></i> Edit Marks</button>
                    
                    <button type="button" class="editmark veri verify pull-right" id="verify"><i class="fa fa-check"></i> Verify </button>
                    
                    <button type="button" class="editmark verified pull-right btn btn-success" style="display:none"><i class="fa fa-check"></i> Verified </button>

                    <div style="margin-top:5px; display:inline-block;" class="marks_msg"></div>
                  
                    </div>
                    <?PHP
					}
					else
					{
						?>
                			  <div class="very-mark">
                    
                  				 <button type="button" class="editmark pull-right btn btn-success btn-block"><i class="fa fa-check"></i> Verified </button>
                                 <div class="clearfix"> </div>
                                 </div>
                        <?PHP	
					}
					?>
                    
                    </div>
                    
                    
                    
                    <div class="viewpro proimage">
                    
                   
                    <div class="very-mark">
                    
                   

                    <a href="<?PHP echo $AadharCardPath; ?>" download class="editninethmarks btn btn-warning"><i class="fa fa-cloud-download"></i> Aadhar</a>
                    
                    <button type="button" class="btn veri pull-right btn-primary aadharCardview" path="<?PHP echo $AadharCardPath; ?>"  data-toggle="modal" data-target="#Aadharmodal" ><i class="fa fa-eye"></i> Aadhar </button>
                    
                    

                    <div style="margin-top:5px; display:inline-block;" class="marks_msg"></div>
                  
                    </div>
                    
                    </div>
                    
                    
                    </div>
                    
                        <div class="col-md-9 ">
                        
                        <div class="viewpro">
                        <table width="100%" class="table-striped" >
    <tr >
      <td width="40%">Full Name : </td>
      <td ><?PHP echo ucwords(strtolower($FirstName." ".$LastName)); ?></td>
    </tr>
   
    <tr >
      <td width="40%">Father Name : </td>
      <td ><?PHP echo ucwords(strtolower($FatherName));?></td>
    </tr>
    <tr >
      <td width="40%">Mother Name : </td>
      <td ><?PHP echo ucwords(strtolower($MotherName));?> </td>
    </tr>
    <tr >
      <td width="40%">Date of Birth : </td>
      <td ><?PHP echo $DOB;?></td>
    </tr>
    <tr >
      <td width="40%">Gender: </td>
      <td ><?PHP echo $Gender;?></td>
    </tr>
    <tr >
      <td width="40%">Mobile Number : </td>
      <td ><?PHP echo $ContactNumber?></td>
    </tr>
    <tr >
      <td width="40%">Alternate Number : </td>
      <td ><?PHP echo $AlternateNumber; ?> </td>
    </tr>
    
    <tr >
      <td width="40%">Aadhar Number : </td>
      <td >
	  
	  <?PHP echo $AadharNumber; ?>
     
       </td>
    </tr>
    
    <tr >
      <td width="40%">Headmaster Name : </td>
      <td ><?PHP echo ucwords(strtolower($HeadMaster));?></td>
    </tr>
    <tr >
      <td width="40%">Mobile Number : </td>
      <td ><?PHP echo $HeadMasterContactNumber;  ?></td>
    </tr>
    <tr >
      <td width="40%">Present Address : </td>
      <td ><p><?PHP echo ucwords(strtolower(str_replace(',',"<br>",$Address))); ?></p></td>
    </tr>
    <tr >
      <td width="40%">Reservation Category : </td>
      <td ><?PHP echo $ReservationCategory?></td>
    </tr>
    <tr >
      <td width="40%">School Details : </td>
      <td ><p><strong>District:</strong> <?PHP echo str_replace("District","",ucwords(strtolower($District)));?><br>
          <strong>Mandal:</strong> <?PHP echo str_replace("(mandal)","",ucwords(strtolower($Mandal)));?><br>
          <strong>School Name:</strong> <?PHP echo ucwords(strtolower($School));?></p></td>
    </tr>
    <tr >
      <td width="40%">Entry for IX Class Marks : </td>
      <td class="obtainedmarks"><?PHP echo $NinethMarks; ?></td>
    </tr>
  </table>
  
  <div class="clearfix"></div>
 </div>
                        
                        
                        </div>
                        
                    
                        
                        
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
        
        
		
	</div>
    
    
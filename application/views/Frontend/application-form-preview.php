<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Medha Sampurna Siksha</title>
<style>
* {
	margin: 0;
	padding: 0;
}
table tr td {
	padding: 9px 0px;
}
</style>
</head>
<body>
<div style="width:1140px; margin:auto; border:1px solid #5fa6ec;">
  <div style="background:#5fa6ec;">
    <div style="width:200px; float:left;"> <img src="resources/frontend-resources/img/medha-samp.png" style="float:left; margin-left:20px; margin-top:20px; "></div>
    <div>
      <h1 style=" font-family:Arial, Helvetica, sans-serif; font-size:36px; color:#d1e009; padding:55px 0px 10px 0px; text-transform:uppercase; font-weight:600; ">Medha Sampurna Siksha Application Form</h1>
      <!--<h3 style="   font-family:Arial, Helvetica, sans-serif;font-size: 22px;  letter-spacing: 0.7px;color: #fff;line-height: 30px;">Last Date for Submission 05-10-2017</h3>-->
    </div>

    <div style="clear:both;"></div>
  </div>
   <?PHP
  		
		foreach($formdata->result() as $data)
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
			
			
			//get the district name
			
			$cond = array();
			$cond['DistrictId'] = $data->District;
			$table = 'districts';
			

			$DistrictName = $this->Commonmodel->getAfield($table,$cond,$field='DistrictName',$order_by='',$order_by_field='',$limit='');
			
			//get the mandal name
			
			 $cond = array();
			$cond['DistrictId'] = $data->District;
			$cond['MandalId'] = $data->Mandal;
			$table = 'mandals';
			

			$MandalName = $this->Commonmodel->getAfield($table,$cond,$field='MandalName',$order_by='',$order_by_field='',$limit='');
			
			//get the school name
			
			 $cond = array();
			$cond['DistrictId'] = $data->District;
			$cond['MandalId'] = $data->Mandal;
			$cond['SchoolId'] = $data->School;
			$table = 'schools';
			

			$SchoolName = $this->Commonmodel->getAfield($table,$cond,$field='SchoolName',$order_by='',$order_by_field='',$limit='');
			
			//exam center name
			
			$this->db->select('cen.CenterName');
			$this->db->from('communicationdetails as cmd');
			$this->db->join('examcenters as cen','cmd.ExamCenter=cen.CenterCode');
			$this->db->where("cmd.ApplicationNo",$this->uri->segment(2));
			$CenterName = $this->db->get()->row('CenterName');
			
		}
  
  
  ?>
  <div style="width:60%; float:left">
  
  	<table width="100%" style="font-family:calibri; padding:20px; font-size:17px; color:#555; text-transform:uppercase; float:left;" >

    <tr >
      <td width="40%"><strong>Application Number : </strong></td>
      <td ><strong><?PHP echo $this->uri->segment(2); ?></strong></td>
    </tr>
    
    <tr >
      <td width="40%">Student Name : </td>
      <td ><?PHP echo $FirstName; ?></td>
    </tr>
    <tr >
      <td width="40%">Sur Name : </td>
      <td ><?PHP echo $LastName; ?> </td>
    </tr>
    
    <tr >
      <td width="40%">Gender : </td>
      <td ><?PHP echo $Gender; ?> </td>
    </tr>
    
    <tr >
      <td width="40%">Father Name : </td>
      <td ><?PHP echo $FatherName; ?></td>
    </tr>
    <tr >
      <td width="40%">Mother Name : </td>
      <td ><?PHP echo $MotherName; ?></td>
    </tr>
    <tr >
      <td width="40%">Date of Birth : </td>
      <td ><?PHP echo $DOB?></td>
    </tr>
    
    <tr >
      <td width="40%">Mobile Number : </td>
      <td ><?PHP echo $ContactNumber;?></td>
    </tr>
    <tr >
      <td width="40%">Alternate Number : </td>
      <td ><?PHP echo $AlternateNumber; ?> </td>
    </tr>
    
    
    <tr >
      <td width="40%">Aadhar Number : </td>
      <td ><?PHP echo $AadharNumber; ?></td>
    </tr>
    <tr >
      <td width="40%">Present Address : </td>
      <td ><p><?PHP echo str_replace(",","<br>",$Address); ?></p></td>
    </tr>
    <tr >
      <td width="40%">Category : </td>
      <td ><?PHP echo $ReservationCategory; ?></td>
    </tr>
    
    <tr >
      <td width="40%">Headmaster Name : </td>
      <td ><?PHP echo $HeadMaster;?></td>
    </tr>
    <tr >
      <td width="40%">Mobile Number : </td>
      <td ><?PHP echo $HeadMasterContactNumber; ?></td>
    </tr>
    <tr >
      <td width="40%">School Details : </td>
      <td ><p><strong>District:</strong> <?PHP echo str_replace("DISTRICT",'',$DistrictName);?><br>
          <strong>Mandal:</strong> <?PHP echo str_replace("(MANDAL)","",$MandalName);?><br>
         <!-- <strong>Village:</strong> Ramanthapur<br>-->
          <strong>School Name:</strong><?PHP echo $SchoolName;?></td>
    </tr>
    <tr >
      <td width="40%">IX Class Marks : </td>
      <td ><?PHP echo $NinethMarks; ?></td>
    </tr>
    
     <tr >
      <td width="40%">Examination Center : </td>
      <td ><?PHP echo $CenterName;?> </td>
    </tr>
  </table>
</div>
  
  <div style="width:40%; float:left">
  
  	<table width="100%" style="font-family:calibri; padding:20px; font-size:17px; color:#555; text-transform:uppercase" >
    <tr >
     <!-- <td  align="left" style="padding-bottom:50px;"><img src="resources/frontend-resources/img/signature.jpg" style="border:1px solid #ddd; padding:7px; margin-right:15px;" /></td>-->
      <td  align="right" style="padding-bottom:50px;"><img  src="<?PHP echo $PicPath?>" style="width:255px; height:220px border:1px solid #ddd; padding:7px; margin-right:15px;" /></td>
    </tr>
   <!-- <tr  >
      <td width="60%" style="padding-bottom:50px;"><strong>Examination centre :</strong></td>
      <td style="padding-bottom:50px;" ><p><strong>Medak </strong><br>
          Sangareddy</p></td>
    </tr>-->
   <!-- <tr >
      <td width="60%" style="padding:9px 15px; background:#d40c0c; color:#fff; text-decoration:none;"><a href="<?PHP echo base_url()?>" >Cancel</a></td>
      <td ><a href="#" style="padding:9px 15px; background:#549e57; color:#fff; text-decoration:none;">Confirm</a></td>
    </tr>-->
  </table>
  </div>
  
  
  <div style="clear:both;"></div>
</div>
</body>
</html>
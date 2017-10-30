<?PHP
	$hallticket = $this->uri->segment(2);
#echo $hallticket; exit;
		$cond['ApplicationNo'] = $hallticket;
		$cond['YEAR(ForYear)'] = date('Y');
		$table ='applicanthalltickets';
		
		$exists = $this->Commonmodel->checkexists($table,$cond);

		if( $exists>0)
		{
			$cond = array();
			//$qry = $this->db->query("SELECT CONCAT(app.FirstName, ' ', app.LastName) as StudentName, `app`.`PicPath` as `PicPath`, cen.CenterName, sch.SchoolName FROM `communicationdetails` as `cmm` JOIN `applicantdetails` as `app` ON `cmm`.`ApplicationNo`=`app`.`ApplicationNo` join examcenters as cen on cen.CenterCode=cmm.ExamCenter join schools as sch on sch.SchoolId=cmm.School where cmm.ApplicationNo='".$hallticket."'");
			
			
			$qry = $this->db->query("SELECT app.FatherName as FatherName, app.MotherName as MotherName, date_format(app.DOB,'%d-%m-%Y') as DOB, CONCAT(app.FirstName, ' ', app.LastName) as StudentName, `app`.`PicPath` as `PicPath`, cen.CenterName, sch.SchoolName FROM `communicationdetails` as `cmm` JOIN `applicantdetails` as `app` ON `cmm`.`ApplicationNo`=`app`.`ApplicationNo` join examcenters as cen on cen.CenterCode=cmm.ExamCenter join schools as sch on sch.SchoolId=cmm.School where cmm.ApplicationNo='".$hallticket."'");

#echo $this->db->last_query(); exit; 
	$jsonOutput = array();
	
		if( $qry->num_rows()>0)
		{
			foreach( $qry->result() as $data)	
			{
				$StudentName = $data->StudentName;
				$ApplicationNo = $hallticket;
				$DOB= $data->DOB;
				$MotherName = $data->MotherName;
				$FatherName = $data->FatherName;
				
				
				
				$SchoolName = $data->SchoolName;
				$CenterName = $data->CenterName;
				$PicPath = $data->PicPath;
			}
			
		}
		
		}
		else
		{
			redirect(base_url('download-hallticket'));
		}
?>



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
    <h1 style=" font-family:Arial, Helvetica, sans-serif; font-size:38px; color:#d1e009; padding:12px 0px; margin:5px 0px; text-transform:uppercase; font-weight:600; text-align:center;">Medha Sampurna Siksha Hall Ticket</h1>
  </div>
  
  <div style="width:700px; float:left;">
  <table width="100%" style="font-family:calibri; padding:20px; font-size:16px; color:#555; text-transform:uppercase; float:left;" >
    <tr >
      <td style="text-transform:uppercase;" width="30%">Student Name : </td>
      <td style="text-transform:uppercase;" ><?PHP echo $StudentName;?></td>
    </tr>
    
    <tr >
      <td style="text-transform:uppercase;" width="30%">Application No: </td>
      <td style="text-transform:uppercase;" ><?PHP echo $ApplicationNo;?></td>
    </tr>
    
    <tr >
      <td style="text-transform:uppercase;" width="30%">Date Of Birtth: </td>
      <td style="text-transform:uppercase;" ><?PHP echo $DOB;?></td>
    </tr>
    
      <tr >
      <td style="text-transform:uppercase;" width="30%">Mother Name: </td>
      <td style="text-transform:uppercase;" ><?PHP echo $MotherName;?></td>
    </tr>
    
      <tr >
      <td style="text-transform:uppercase;" width="30%">Father Name: </td>
      <td style="text-transform:uppercase;" ><?PHP echo $FatherName;?></td>
    </tr>
    
    
    
    <tr >
      <td width="30%" style="text-transform:uppercase;">School Name  : </td>
      <td style="text-transform:uppercase;"><?PHP echo $SchoolName; ?></td>
    </tr>
    <tr >
      <td colspan="2" style="padding-top:50px; padding-bottom:0px; text-transform:uppercase;"><strong> Appear for exam directly at selected</strong><br>
        <?PHP echo $CenterName;?><br>
        <br>
        <strong>Test duration 9.30 AM to 12.00 PM</strong><br><br>

        <p style="margin-top:20px; text-transform:uppercase;"><strong>Please bring these documents:</strong></p>
        <ul style="list-style:circle; margin-left:40px; margin-top:5px;">
          <li >Medha Sampurna Siksha Hall Ticket</li>
          <li>Original SSC Hall Ticket</li>
          <li>Xerox of SSC Hall Ticket</li>
        </ul></td>
    </tr>
  </table>
  </div>
  
  <div style="width:300px; float:left;">
	  <table width="100%" style="font-family:calibri; padding:20px; font-size:16px; color:#555; text-transform:uppercase" >
    <tr >
      <td  align="right"><img src="<?PHP echo $PicPath; ?>" style="border:1px solid #ddd; padding:7px; margin-right:15px; width:215px; height:220px" /></td>
    </tr>
    <tr >
      <td width="30%" style=""><p style="font-size:14px; font-weight:bold; display:inline-block; padding:10px;">Head Master Signature with Stamp</p></td>
    </tr>
  </table>
 </div>
  
  <div style="clear:both;"></div>
</div>
</body>
</html>
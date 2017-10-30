<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<base href="<?PHP echo base_url(); ?>"/>
<title>Medha Sampurna Siksha</title>

<!-- Bootstrap -->
<link href="resources/frontend-resources/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
<link href="resources/frontend-resources/css/regi.css" rel="stylesheet" type="text/css">
<link  rel="shortcut icon" type="image/x-icon" href="resources/favicon.png" />


<style>
.hidearow
{
	display:none;
}
.districtsexamcenters
{
	cursor:pointer;
}

</style>

</head>
<body>
<?PHP
$err_msg = "application-form-err-msg";
$noerr_msg = "application-form-no-err";
?>	

<?PHP

if( $this->input->post('edit-application-form'))
{
	$DOB=array();
	
		$FirstName	 = $this->input->post('FirstName');
		$LastName	 = $this->input->post('LastName');
		
		$FatherName	 = $this->input->post('FatherName');
		$MotherName	 = $this->input->post('MotherName');
		
		$HeadMaster	 = $this->input->post('HeadMaster');
		
		
		$DOB[0] = $this->input->post('DayOfBirth');
		$DOB[1] = $this->input->post('monthofbirth');
		$DOB[2] = $this->input->post('YearOfBirth');
		
		$ReservationCategory	 = $this->input->post('ReservationCategory');
		$PicPath	 = 'resources/frontend-resources/img/student.jpg';
		
		$ContactNumber	 = $this->input->post('ContactNumber');
		$AlternateNumber		 = $this->input->post('AlternateNumber');
		$HeadMasterContactNumber		 = $this->input->post('HeadMasterContactNumber');
		
		$Address		 	= $this->input->post('Address');
		$NinethMarks		 = $this->input->post('NinethMarks');
		
		$Gender 			=	$this->input->post('Gender');
		$AadharNumber		=	$this->input->post('AadharNumber');
		$ExamCenter = $this->input->post('ExamCenter');
		
		
}
else
{
  		
		foreach($formdata->result() as $data)
		{
			$FirstName	 = $data->FirstName;
			$LastName	 = $data->LastName;
			
			$FatherName	 = $data->FatherName;
			$MotherName	 = $data->MotherName;
			
			$HeadMaster	 = $data->HeadMaster;
			$DOB	 = date_create($data->DOB);
			$DOB 	=	date_format($DOB,"d-m-Y");
			
			$DOB = explode("-",$DOB);
			
			
			$ReservationCategory	 = $data->ReservationCategory;
			$PicPath	 = $data->PicPath;
			
			$AadharPath	 = $data->AadharCardPath;
			
			$ContactNumber	 = $data->ContactNumber;
			$AlternateNumber		 = $data->AlternateNumber;
			$HeadMasterContactNumber		 = $data->HeadMasterContactNumber;
			
			$Address		 	= $data->Address;
			$NinethMarks		 = $data->NinethMarks;
			
			$District 			= $data->District;
			$Gender 			=	$data->Gender;
			$AadharNumber		=	$data->AadharNumber;
			$ExamCenter 		= $data->ExamCenter;
		}
  
}
  ?>

<div class="container main">
  <div class="row rmt">
    <div class="header ">
      <div class="col-md-3  logo text-right"> <a href="<?PHP echo base_url();?>"><img src="resources/frontend-resources/img/medha-samp.png" alt="IACI"></a> </div>
      <div class="col-md-8">
        <h1>Medha Sampurna Siksha Application Form</h1>
        <h3>Last Date for Submission 05-10-2017</h3>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-md-6">
    <div class="Reg_form">
    <form class="form-horizontal" id="reg_form" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <legend style="padding:10px">Student Details</legend>
        <div class="col-sm-9">
        
        </div>
      </div>
    
      <div class="form-group">
        <label class="control-label col-sm-3" for="">Student Name:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control <?PHP if( form_error('FirstName')!='' ){ echo $err_msg;  }?> " value="<?PHP echo $FirstName;?>" name="FirstName" id="name" placeholder="">
          <span class="na-msg FirstName_err" id="name_err"><?PHP echo form_error('FirstName')?></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" for="">Sur Name:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control <?PHP if( form_error('LastName')!='' ){ echo $err_msg;  }?> " value="<?PHP echo $LastName;?>" name="LastName" placeholder="">
          <span class="na-msg LastName_err" id="name_err"><?PHP echo form_error('LastName');?></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" for="">Father Name:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control <?PHP if( form_error('FatherName')!='' ){ echo $err_msg;  }?> " value="<?PHP echo $FatherName;?>" name="FatherName" placeholder="">
          <span class="na-ms FatherName_errg" id="name_err"><?PHP echo form_error('FatherName');?></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" for="">Mother Name:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control <?PHP if( form_error('MotherName')!='' ){ echo $err_msg;  }?> " value="<?PHP echo $MotherName;?>" name="MotherName"  placeholder="">
          <span class="na-msg MotherName_err" id="name_err"><?PHP echo form_error('MotherName')?></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" for="">Date of Birth:</label>
        <div class="col-sm-9">
          <div class="col-sm-3 pl">
        <!--    <label class="control-label col-sm-12 pad" for="">Date </label>-->
            <select  name="DayOfBirth" class="form-control <?PHP if( form_error('DayOfBirth')!='') { echo $err_msg; }?> ">
             <option value="0">Date</option>
             <?PHP
			 	for($i=1;$i<=31;$i++)
				{
					?>
                    <option value="<?PHP echo $i;?>" <?PHP if($DOB[0]==$i) echo 'selected';?>><?PHP echo $i;?></option>
                    <?PHP	
				}
			 ?>
            </select>
             <span class="na-msg" id="name_err"><?PHP echo form_error('DayOfBirth')?></span> 
          </div>
          <div class="col-sm-5 pl">
        <?PHP  
          $formattedMonthArray = array(
                    "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                    "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                    "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                );
?>
<!-- displaying the dropdown list -->
<select name="monthofbirth" class="form-control <?PHP if(form_error('monthofbirth')!='') echo $err_msg; ?>" >
    <option value="0">Select Month</option>
    <?php
    foreach ($formattedMonthArray as $month=>$MonthName) {
?>

       <option value="<?PHP echo $month; ?>" <?PHP if( $DOB[1]==$month) echo 'selected'; ?>><?PHP echo $MonthName;?> </option>;
<?PHP       
    }
    ?>
</select>
 <span class="na-msg" id="name_err"><?PHP echo form_error('monthofbirth')?></span> 
          </div>
          <div class="col-sm-4 pl pr">
      <!--      <label class="control-label col-sm-12 pad" for="">Year </label>-->
      <?PHP
	  	$currentYear = date('Y');
		$TillYear = $currentYear-18;
		#echo $TillYear;
		$cnt=1;
	  ?>
      
            <select name="YearOfBirth" class="form-control  <?PHP if( form_error('YearOfBirth')!='') echo $err_msg; ?>">
              <option value="0">Year</option>
              <?PHP
			  	for($yr=$TillYear; $cnt<=10;$TillYear++)
				{
					?>
                    <option value="<?PHP echo $TillYear?>" <?PHP if( $DOB[2]==$TillYear) echo 'selected'; ?>><?PHP echo $TillYear?></option>
                    <?PHP
					$cnt++;	
				}
			  ?>
             
            </select>
            
             <span class="na-msg" id="name_err"><?PHP echo form_error('YearOfBirth')?></span> 
            
          </div>
          <span class="na-msg" id="name_err"></span> </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-sm-3 <?PHP if( form_error('AadharNumber')!='') ?>" name="ContactNumber" for="">Aadhar Number:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name='AadharNumber' value="<?PHP echo $AadharNumber;?>" placeholder="">
          <span class="na-msg AadharNumber_err" id="name_err"><?PHP echo form_error('AadharNumber')?></span> </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-sm-3 <?PHP if( form_error('AadharCard')!='') ?>" name="AadharCard" for="">Upload Aadhar Card:</label>
        <div class="col-sm-9">
          <input type="file" name="AadharCard" class="form-control">
          <span class="na-msg AadharCard_err" id="name_err"><?PHP if(form_error('AadharCard')=='') {?> <a style="cursor:pointer" data-toggle="modal" data-target="#Aadharmodal" class="aadharCardview" path='<?PHP echo $AadharPath; ?>'>Click here to see Aadhar Card</a><br>Note:Upload jpeg, jpg, png and pdf formats only<?PHP } else  echo form_error('AadharCard')?></span> </div>
      </div>
      
      
      <div class="form-group">
        <label class="control-label col-sm-3 <?PHP if( form_error('ContactNumber')!='') ?>"  name="ContactNumber" for="">Mobile Number:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name='ContactNumber' value="<?PHP echo $ContactNumber;?>" id="ContactNumber" placeholder="" maxlength="10">
          <span class="na-msg ContactNumber_err" id="name_err"><?PHP echo form_error('ContactNumber')?></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" for="">Alternate Number:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control <?PHP if( form_error('AlternateNumber')!='') echo $err_msg;?>" name="AlternateNumber" id="AlternateNumber" placeholder="" value="<?PHP echo $AlternateNumber?>" maxlength="10">
          <span class="na-msg AlternateNumber_err" id="name_err"><?PHP echo form_error('AlternateNumber');?></span> </div>
      </div>
      
      
      <div class="form-group">
        <label class="control-label col-sm-3" for="">Choose Gender:</label>
        <div class="col-sm-9">
          	<div class="reser">
            <input type="radio" id="res_Male" name="Gender" value="Male" <?PHP if( $Gender=="Male") echo "checked"; ?> >
            <label for="res_Male">Male</label> 
            </div>
            
            <div class="reser">
            <input type="radio" id="res_Female" name="Gender" value="Female" <?PHP if( $Gender=="Female") echo "checked"; ?> >
            <label for="res_Female">Female</label> 
            </div>
          
            <div class="clearfix"></div>  
			<div class="ad-msg" id="add_err"><?PHP echo form_error('Gender'); ?></div>
                      
        </div>

      </div>
      
      
      <div class="form-group">
        <label class="control-label col-sm-3" for="">Category:</label>
        <div class="col-sm-9">
          <div class="reser">
            <input type="radio" id="res_sc" name="ReservationCategory" value="SC" <?PHP if( $ReservationCategory=="SC") echo "checked"; ?> >
            <label for="res_sc">SC</label> </div>
          <div class="reser">
            <input type="radio" id="res_st" name="ReservationCategory" value="ST" <?PHP if( $ReservationCategory=="ST") echo "checked"; ?> >
           <label for="res_st"> ST</label> </div>
          <div class="reser">
            <input type="radio" id="res_bca" name="ReservationCategory" value="BC-A" <?PHP if( $ReservationCategory=="BC-A") echo "checked"; ?> >
           <label for="res_bca"> BC-A</label> </div>
          <div class="reser">
            <input type="radio" id="res_bcb" name="ReservationCategory" value="BC-B" <?PHP if( $ReservationCategory=="BC-B") echo "checked"; ?> >
            <label for="res_bcb"> BC-B </label></div>
          <div class="reser">
            <input type="radio" id="res_bcc" name="ReservationCategory" value="BC-C" <?PHP if( $ReservationCategory=="BC-C") echo "checked"; ?> >
           <label for="res_bcc"> BC-C</label> </div>
          <div class="reser">
            <input type="radio" id="res_bcd" name="ReservationCategory" value="BC-D" <?PHP if( $ReservationCategory=="BC-D") echo "checked"; ?> >
            <label for="res_bcd"> BC-D</label> </div>
            
            <div class="reser">
            <input type="radio" id="res_bce" name="ReservationCategory" value="BC-E" <?PHP if( $ReservationCategory=="BC-E") echo "checked"; ?> >
            <label for="res_bce"> BC-E</label> </div>
          <div class="reser gen">
            <input type="radio" id="res_gen" name="ReservationCategory" value="General" <?PHP if( $ReservationCategory=="General") echo "checked"; ?> >
             <label for="res_gen">GENERAL</label> </div>
            <div class="clearfix"></div>  
			<div class="ad-msg" id="add_err"><?PHP echo form_error('ReservationCategory'); ?></div>
                      
        </div>

      </div>
      
      <div class="form-group">
        <label class="control-label col-sm-3" for="">Student Home Address:</label>
        <div class="col-sm-9">
          <textarea class="form-control <?PHP if( form_error('Address')!='') echo $err_msg?>" name="Address" ><?PHP echo $Address; ?></textarea>
          <span class="ad-msg" id="add_err"><?PHP echo form_error('Address'); ?></span> </div>
      </div>
      
      
      <div class="form-group">
        <legend style="padding:10px">School Details</legend>
        <div class="col-sm-9">
        
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-sm-3" for="">Head Master Name:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control <?PHP if( form_error('HeadMaster')!='') echo $err_msg; ?> " name="HeadMaster" placeholder="" value="<?PHP echo $HeadMaster; ?>">
          <span class="na-msg" id="name_err"><?PHP echo form_error('HeadMaster')?></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" for="">Head Master Contact Number:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control <?PHP if( form_error('HeadMasterContactNumber')!='') echo $err_msg;?>" id="HeadMasterContactNumber" name="HeadMasterContactNumber" placeholder="" value="<?PHP echo $HeadMasterContactNumber;?>">
          <span class="na-msg HeadMasterContactNumber_err" id="name_err"><?PHP echo form_error('HeadMasterContactNumber');?></span> </div>
      </div>
      
      
      <div class="form-group">
        <label class="control-label col-sm-3" for="">School Details:</label>
        <div class="col-sm-9">
          <div class="col-sm-12 pl pr mb">
            <label class="control-label col-sm-12 pad" for="">District </label>
            <select class="form-control <?PHP if( form_error('districts')!='') echo $err_msg?>" name="districts" id="districts">
               <option value="0">Select District</option>
              <?PHP
			  	foreach($districts->result() as $distr)
				{
					?>
                    <option value="<?PHP echo $distr->DistrictId?>" <?PHP if($SelectedDistrict==$distr->DistrictId) echo 'selected'; ?>><?PHP echo $distr->DistrictName?></option>
                    <?PHP	
				}
			  ?>
              
            </select>
          </div>
          <div class="col-sm-12 pl pr mb">
            <label class="control-label col-sm-12 pad" for="">Mandal </label>
            <select class="form-control  <?PHP if( form_error('Mandal')!='') echo $err_msg?>" name="Mandal" id="Mandals">
              <option value="0">Select Mandal</option>
              <?PHP
			  foreach($mandals->result() as $mndl)
			  {
					?>
                    <option value="<?PHP echo $mndl->MandalId?>" <?PHP if( $mndl->MandalId==$SelectedMandal) echo 'selected' ?>><?PHP echo str_replace("(MANDAL)","",$mndl->MandalName)?></option>
                    <?PHP  
			  }
			  ?>
			  
              
            </select>
            
             <span class="na-msg" id="name_err"><?PHP echo form_error('Mandal')?></span> 
          </div>
         <!-- <div class="col-sm-12 pl pr mb">
            <label class="control-label col-sm-12 pad" for="">Village </label>
            <select class="form-control ">
            <option value="0">Select Village</option>
            </select>
          </div>-->
          <div class="col-sm-12 pl pr mb">
            <label class="control-label col-sm-12 pad" for="">School Name </label>
            <select class="form-control <?PHP if( form_error('school')!='') echo $err_msg?>" name="school" id="schools">
             <option value="0">Select School</option>
             <?PHP
			 	foreach($schools->result() as $schl)
				{
					?>
                    <option value="<?PHP echo $schl->SchoolId?>" <?PHP if($SelectedSchool==$schl->SchoolId) echo 'selected';?> ><?PHP echo $schl->SchoolName?></option>
                    <?PHP	
				}
			 ?>
            </select>
             <span class="na-msg" id="name_err"><?PHP echo form_error('school')?></span> 
          </div>
          <span class="na-msg" id="name_err"></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" for="">IX Class Marks:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control <?PHP if( form_error('NinethMarks')!='' ) echo $err_msg; ?>" id="NinethMarks" name="NinethMarks" placeholder="" value="<?PHP echo $NinethMarks?>" maxlength="3">
          <span class="na-msg NinethMarks_err" id="name_err"><?PHP echo form_error('NinethMarks')?></span> </div>
      </div>
      </div>
      </div>
      <div class="col-md-6">
      <div class="Reg_table ">
        <div class="col-md-5 pl file ">
         <p>Upload 9<sup>th</sup> Class Mark List & Head Master Signature & School Stamp</p>
          <div class="Schoolstamp text-center" id="marks_preview"> <img src="resources/frontend-resources/img/signature.jpg" class=" img-responsive" /> </div>
          <input type="file" name="docs[]" id="docs" multiple='multiple' class="form-control">
      <?PHP if(form_error('docs')==''){?>     <span class="na-msg" id="name_err">Note:Upload jpeg, jpg, png and pdf formats only</span> <?PHP } ?>
        </div>
        <div class="col-md-5 col-md-offset-2 pl file ">
           <p>Upload Student Pass Photo Size Photo</p>
          <div class="Schoolstamp text-center" style="margin-top:10px;" id="dvPreview"> <img  src="<?PHP echo $PicPath?>" class=" img-responsive" /> </div>
          <input type="file" name="stdpic" id="fileupload" class="form-control">
              <?PHP if(form_error('stdpic')==''){ ?> <span class="na-msg" id="name_err">Note:Upload jpeg, jpg, png formats only</span><?PHP } ?>
          
        </div>
        <div class="clearfix"></div>
     <p class="tick">Select your choice of examination center</p>

        
<!--
        <table width="100%"c class="exam-dis" >
        <?PHP
		$discnt=0;
				foreach($examcenters as $district=>$centers)
				{
					
					?>
                    
                    <tr class="districtsexamcenters" > <th class="life" colspan="3" id="row_<?PHP echo $DistrictId[$discnt]?>"  dist_id="row_<?PHP echo $DistrictId[$discnt]?>"><?PHP echo $district;?></th> </tr>
                   
                    <?PHP
					
					$totalCenterperDist = sizeof($centers);
					
					$cnt=0;
					foreach( $centers as $ind=>$val)
					{
						$cnt++;
						if($cnt==1)
						{
							if($discnt==0)
							$hidearow='';
							else
							$hidearow='hidearow';
							echo "<tr id='row_".$DistrictId[$discnt]."' class='row_".$DistrictId[$discnt]." ".$hidearow." examcenterssection'>";	
						}
//						echo $cnt."<br>";
						?>	
                        <td>
                        	<input type="radio" id="mand_<?PHP echo str_replace(" ","-",$val['CenterName'])?>" name="ExamCenter" value="<?PHP echo $val['CenterId']?>" class="e-centers" <?PHP if($ExamCenter==$val['CenterId']) echo 'checked'; ?>>
				            <label style="<?PHP if(set_value('ExamCenter')==$val['CenterId']) echo 'font-weight:bold !important; color:#5f5757';?>"  for="mand_<?PHP echo str_replace(" ","-",$val['CenterName'])?>"><?PHP echo str_replace("(","",str_replace(")","",$val['CenterName']))?></label> 
                          </td>
                        
						<?PHP

						if( $cnt==3)
						{
							$cnt=0;
							echo "</tr>";
						}
						if($ind==($totalCenterperDist-1))
							echo "</tr>";
                    }
				$discnt++;	
				}
		?>
        </tr>
 
        </table>
        
  -->      
        <div class="form-group">
        <label class="control-label col-sm-3" for="">Select Exam Center:</label>
        <div class="col-sm-9">
<select class="form-control" name="ExamCenter">
<option value="">Select Exam Center</option>
<?PHP
	foreach( $centers->result() as $center)
	{
		?>
        <option value="<?PHP echo $center->CenterCode?>" <?PHP if($ExamCenter==$center->CenterCode) echo 'selected';?>><?PHP echo $center->CenterName?></option>
        <?PHP	
	}


?>

</select>
          <span class="na-msg NinethMarks_err" id="name_err"><?PHP echo form_error('ExamCenter')?></span> </div>
      </div>
        
        
       
      </div>
      <div class="bottom_content">
    
      
      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10 text-right pr">
      <input  type="submit" name="edit-application-form" i class="btn  btn-success submit_btn submitbtn" value="Update Application">
    </form>
  </div>
</div>
</div>
</div>
</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="resources/frontend-resources/js/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 

<script src="resources/frontend-resources/js/jquery-3.2.1.min.js"> </script> 
<script src="resources/frontend-resources/js/bootstrap.min.js"></script> 

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
$(function () {
    $("#fileupload").change(function () {
        $("#dvPreview").html("");
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        if (regex.test($(this).val().toLowerCase())) {
            if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
                $("#dvPreview").show();
                $("#dvPreview")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
            }
            else {
                if (typeof (FileReader) != "undefined") {
                    $("#dvPreview").show();
                    $("#dvPreview").append("<img />");
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#dvPreview img").attr("src", e.target.result);
						$("#dvPreview img").css({"width":'205px','height':'218px'});
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            }
        } else {
            alert("Please upload a valid image file.");
			$("#dvPreview").show();
            $("#dvPreview").append("<img />");
			$("#dvPreview img").attr("src",'resources/frontend-resources/img/student.jpg');
        }
    });
});

$(function () {
    $("#docs").change(function () {
		
		 var fileName = $(this).val();
		var fileExtension = fileName.replace(/^.*\./, '');
		
		
        $("#marks_preview").html("");
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp|.pdf)$/;
        if (regex.test($(this).val().toLowerCase())  ) {
            if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
                $("#marks_preview").show();
                $("#marks_preview")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
            }
            else {
                if (typeof (FileReader) != "undefined") {
                    $("#marks_preview").show();
                    $("#marks_preview").append("<img />");
                    var reader = new FileReader();
                    reader.onload = function (e) {
						if(fileExtension.toLowerCase()=='pdf')
						{
							
							$("#marks_preview img").attr("src", "resources/frontend-resources/img/pdfformat.png");
							$("#marks_preview img").css({"width":'205px','height':'218px'});
						}
						else
						{
                        	$("#marks_preview img").attr("src", e.target.result);
							$("#marks_preview img").css({"width":'205px','height':'218px'});
						}
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            }
        } else {
				$("#marks_preview").show();
				$("#marks_preview").append("<img />");
				
				$("#marks_preview img").attr("src", "resources/frontend-resources/img/invalidformat.png");
				$("#marks_preview img").css({"width":'205px','height':'218px'});
        }
    });
});


$(document).ready(function()
{
	$("input[name=AadharNumber]").keyup(function(){
        var $this = $(this);
        if ((($this.val().length+1) % 5)==0){
            $this.val($this.val() + " ");
        }
    });
	
	
	$(".submitbtn").on('click',function()
	{
		$(this).val('Updating form...');
	});
	
	
	$("#districts").on('change',function()
	{
			
			var DistrictId = $(this).val();
				DistrictId = $.trim(DistrictId);
				DistrictId = parseInt(DistrictId);
				
			if(DistrictId>0)
			{
				$.ajax({
						url:'<?PHP echo base_url()?>/Requestdispatcher/getmandals',
						type:"POST",
						data:{"DistrictId":DistrictId},
						success:function(resp)
						{
							resp = $.trim(resp);
							
							if(resp!='0')	
							{
								resp = JSON.parse(resp);
								var section_options='<option value=0>Select Mandal</option>';
									
									$.each(resp,function(index,val)
									{
										section_options=section_options+'<option value="'+val.MandalId+'">'+val.MandalName+'</option>';
										console.log(section_options);
									});
									
									$("#Mandals").html(section_options);	
							}
						}//success ends here
					});
			}
			else
			{
				var section_options='<option value=0>Select Mandal</option>';	
				$("#Mandals").html(section_options);	
			}
			
	});
	//populate mandals ends here
	
	$(document).on('change',"#Mandals",function()
	{
		var DistrictId = $('#districts').val();
				DistrictId = $.trim(DistrictId);
				DistrictId = parseInt(DistrictId);
				
		var MandalId = $(this).val();
				MandalId = $.trim(MandalId);
				MandalId = parseInt(MandalId);		
				
		if( DistrictId>0 && MandalId>0)
		{
			
			$.ajax({
						
						url:'<?PHP echo base_url()?>/Requestdispatcher/getschools',
						type:"POST",
						data:{"DistrictId":DistrictId,"MandalId":MandalId},
						success:function(resp)
						{
							resp = $.trim(resp);
							
							if(resp!='0')	
							{
								resp = JSON.parse(resp);
								var section_options='<option value=0>Select School</option>';
									
									$.each(resp,function(index,val)
									{
										section_options=section_options+'<option value="'+val.SchoolId+'">'+val.SchoolName+'</option>';
										console.log(section_options);
									});
									
									$("#schools").html(section_options);	
							}
						}//success ends here
					
				
				});
		}
		else
		{
				var section_options='<option value=0>Select School</option>';	
				$("#schools").html(section_options);	
		}
	});
	
	
	
	$(document).on('click','.districtsexamcenters',function()
	{
		var distid = $(this).children().attr('dist_id');
		
		
		$(".examcenterssection").addClass("hidearow");
		$("."+distid).removeClass('hidearow');
		
	});
	
	var selected_dist = $(".e-centers:checked").parent().parent().attr('id');
	
		$(".examcenterssection").addClass("hidearow");
		$("."+selected_dist).removeClass('hidearow');
	
$("input[name=FirstName], input[name=LastName], input[name=FatherName], input[name=MotherName], input[name=HeadMaster]").keypress(function(e){

                    var key = e.keyCode;
//					alert(key)
                    if (key >= 48 && key <= 57) {
						e.preventDefault();
                    }
                });
				
				
$("#ContactNumber, #AlternateNumber, #HeadMasterContactNumber,#NinethMarks").keypress(function (e) {
	
	var shorerr_at = $(this).attr('name');
	
	
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("."+shorerr_at+"_err").html("Enter only numerics").show().fadeOut(1520).css({'color':'red'});
        return false;
    }
   });
   
   $("input[name=FirstName], input[name=LastName]").keypress(function(e){
	
	var errmsgat = $(this).attr('name');
	
    var arr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ";
    var code;
    if (window.event)
        code = e.keyCode;
    else
        code = e.which;
    var char = keychar = String.fromCharCode(code);
    if (arr.indexOf(char) == -1)
     {
		 $("."+errmsgat+"_err").html("Enter only alphabets").show().fadeOut(1520).css({'color':'red'});
        return false; 
	 }
});


$("input[name=AadharNumber]").keypress(function(e){
	
	var errmsgat = $(this).attr('name');
	
    var arr = "0123456789 ";
    var code;
    if (window.event)
        code = e.keyCode;
    else
        code = e.which;
    var char = keychar = String.fromCharCode(code);
    if (arr.indexOf(char) == -1)
     {
		 $("."+errmsgat+"_err").html("Enter only numerics").show().fadeOut(1520).css({'color':'red'});
        return false; 
	 }
});
	

	$(document).on('click','.districtsexamcenters',function()
	{
		var distid = $(this).children().attr('dist_id');
		
		
		$(".examcenterssection").addClass("hidearow");
		$("."+distid).removeClass('hidearow');
		
	});
	
	var selected_dist = $(".e-centers:checked").parent().parent().attr('id');
	
		$(".examcenterssection").addClass("hidearow");
		$("."+selected_dist).removeClass('hidearow');	
	
	
});

$(document).on('click','.aadharCardview',function()
{
	var path = $(this).attr('path');

	var img = "<img src="+path+" style='width:100%'>";
	$(".aadharcardview").html(img);
	
});



</script>


<div id="Aadharmodal" class="modal fade ve-mark" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Aadhar Card</h4>
      </div>
      <div class="modal-body aadharcardview">
      
      
        
          <div class="clearfix"></div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
      <div class="clearfix"></div>
    </div>

  </div>
</div>
</body>
</html>
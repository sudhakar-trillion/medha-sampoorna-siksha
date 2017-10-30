<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Enter Application Number</title>
<base href="<?PHP echo base_url(); ?>">

<link href="resources/admin-resources/css/bootstrap.min.css" rel="stylesheet">
<link href="resources/admin-resources/css/datepicker3.css" rel="stylesheet">
<link href="resources/admin-resources/css/styles.css" rel="stylesheet">

<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/ rel="stylesheet">


<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<link  rel="shortcut icon" type="image/x-icon" href="resources/favicon.png" />


<style>
.panel-heading
{
	font-size:23px !important;
}
.datepicker, .dropdown-menu
{
	z-index: 99999;	
}


</style>
</head>

<body style="background:#fff">
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        
        <div class="logopanel text-center" style="margin-bottom: 10px;">
          <img src="resources/admin-resources/images/medha-samp.png"/>
          </div>
			<div class="login-panel panel panel-default admin">
            
          
            
            
				<div class="panel-heading">Enter Application Number</div>
				<div class="panel-body">
					<form role="form" method="post" action="">
						<fieldset>
							<div class="form-group">
								<div style="width:80%; float:left">
                                <input class="form-control" placeholder="Application Number" id="ApplicationNO" name="ApplicationNO" type="text" value="<?PHP echo set_value('UserId');?>" autofocus="">
                                
                                </div>
                                
                                <div style="width:10%; float:left">
                                	<input type="button" name="enter" id="clickhere" value="Enter" class="btn btn-sm" style="    margin-left: 10px; padding: 15px; background: #d1291e; color: #fff;" >

                                 </div>
                                 
                                 
								<div class="clearfix"></div>
							</div>
                            
                            <div class="form-group">
								<div style="text-align:right" >
                               <a style="cursor:pointer;"  data-toggle="modal" data-target="#lostApplication" class="lostApplication">Lost Application No</a>
                                <div class="clearfix"></div>
                                </div>
                                
                                 
                                 
								<div class="clearfix"></div>
							</div>
							
                            
                            <div style="margin-top:-20px" class="download-msg"></div>
                            
                            
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		<div id="lostApplication" class="modal ve-mark" role="dialog">
  <div class="modal-dialog">
<form id="forgetAppliform">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Get Application Number</h4>
      </div>
      <div class="modal-body">
       
       <div class="col-md-6"> <input type="text" name="AadharNumber" class="form-control AadharNumber" id="AadharNumber" maxlength="14"  placeholder="Aadhar-Card Number" />
       
       </div>
       
        <div class="col-md-6">
        					
                            <div class="col-md-4"> 
                                <select  name="DayOfBirth" id="DayOfBirth" class="form-control " style="padding:5px 5px">
                                    <option value="0">DD </option>
                                    <?PHP
                                    for($i=1;$i<=31;$i++)
                                    {
                                    ?>
                                    <option value="<?PHP echo $i;?>"><?PHP echo $i;?></option>
                                    <?PHP	
                                    }
                                    ?>
                                </select>
                                <span class="text-danger date-err"></span>
                            </div>
                            
                            <div class="col-md-4"> 
                            
                            <?PHP  
          $formattedMonthArray = array(
                    "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                    "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                    "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                );
?>
                                    <select name="monthofbirth" id="monthofbirth" class="form-control " style="padding:5px 3px" >
                                    <option value="0">MM</option>
                                    <?php
                                    foreach ($formattedMonthArray as $month=>$MonthName) {
                                    ?>
                                    
                                    <option value="<?PHP echo $month; ?>" ><?PHP echo $MonthName;?> </option>;
                                    <?PHP       
                                    }
                                    ?>
                                    </select> 
                                    <span class="text-danger mnth-err"></span>
                            </div>
                            
                            <div class="col-md-4"> 
                            	<?PHP
	  	$currentYear = date('Y');
		$TillYear = $currentYear-18;
		#echo $TillYear;
		$cnt=1;
	  ?>
      
            <select name="YearOfBirth" id="YearOfBirth" class="form-control " style="padding:5px 0px" >
              <option value="0">YY</option>
              <?PHP
			  	for($yr=$TillYear; $cnt<=10;$TillYear++)
				{
					?>
                    <option value="<?PHP echo $TillYear?>" <?PHP if( set_value('YearOfBirth')==$TillYear) echo 'selected'; ?>><?PHP echo $TillYear?></option>
                    <?PHP
					$cnt++;	
				}
			  ?>
             
            </select>
                    <span class="text-danger yr-err"></span>             
                            </div>
                            
                             <div class="clearfix"></div>
        </div>
       
       
       
       
         <div class="clearfix"></div>
        <span class="applicnt_errmsg" ></span>
        
        <button type="button" class="editmark pull-right sendApplicatinNo">Send Application Number</button>
        
          <div class="clearfix"></div>
      </div>
      <!--<div class="modal-footer"> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
      <div class="clearfix"></div>
    </div>
</form>
  </div>
</div>





<div id="hallticket" class="modal fade ve-mark hall-tick" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hall-Ticket For Application No:<span class="ApplicationNumber"></span></h4>
      </div>
      <div class="modal-body">
      
      
      <table width="70%" style="font-family:calibri; padding:20px; font-size:16px; color:#555; text-transform:uppercase; float:left;" >
    <tr >
      <td width="30%">Student Name : </td>
      <td class="StudentName"></td>
    </tr>
      <tr >
      <td width="30%">Application Number : </td>
      <td class="ApplicationNumber" ></td>
    </tr>
    
     <tr >
      <td width="30%">Date Of Birth: </td>
      <td class="DOB" ></td>
    </tr>
    
    <tr >
      <td width="30%">Mother Name: </td>
      <td class="MotherName" ></td>
    </tr>
    
    <tr >
      <td width="30%">Father Name: </td>
      <td class="Father" ></td>
    </tr>
    <tr >
      <td width="30%">School Name  : </td>
      <td class="SchoolName"></td>
    </tr>
    <tr >
      <td colspan="2" style="padding-top:30px; padding-bottom:0px;"><strong> Appear for exam directly at </strong><br>
       <span class="SelectedCenter"></span><br>
        <br>
        <strong>Exam date and reporting time 9.30 AM to 12.00 PM</strong><br>
        
        <div style="border:1px solid #ddd;padding: 7px 19px;margin-top: 20px;display: inline-block;">
        <p ><strong>Please bring these documents:</strong></p>
        <ul style="list-style:circle; margin-left:0px; margin-top:5px;">
          <li >Medha Sampurna Siksha Hall Ticket</li>
          <li>Original SSC Hall Ticket</li>
          <li>Xerox of SSC Hall Ticket</li>
        </ul> </div></td>
    </tr>
  </table>
      
      
      <table width="30%" style="font-family:calibri; padding:20px; font-size:17px; color:#555; text-transform:uppercase" >
    <tr >
      <td  align="right"><img class="applicantPic" src="" style="border:1px solid #ddd; padding:7px; margin-right:15px;" /></td>
    </tr>
    <tr >
      <td width="30%" align="right"><p style="font-size:14px; font-weight:bold; display:inline-block; padding:10px; color:#F00"><strong>Head Master Signature with Stamp</strong></p></td>
    </tr>
  </table>
  
  
  
  <table width="30%" style="font-family:calibri; padding:20px; font-size:17px; color:#555; text-transform:uppercase" >
  
    <tr >
      <td width="30%" align="right"><span class="sms_msg"> </span><a href="" id="downloadhallticket" class="btn btn-primary" target="_blank" >Download</a></td>
      <td width="30%" align="right"><span class="sms_msg"> </span><a href="<?PHP echo base_url(); ?>" id="" class="btn btn-primary"  >New Application</a></td>
    </tr>
  </table>
      
      
      
      
      
      
      
      
     
       
        
          <div class="clearfix"></div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
      <div class="clearfix"></div>
    </div>

  </div>
</div>

	<script src="resources/admin-resources/js/jquery-1.11.1.min.js"></script>


<script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script src="resources/admin-resources/js/bootstrap.min.js"></script>

	
<script>



$(document).on('click','.downloadbtn',function()
{
	$(this).remove();
});

		$("#lostApplication").draggable({ handle: ".modal-dialog" });

	$(document).ready(function()
	{
		$(".lostApplication").on('click',function()
		{
			$("#AadharNumber").val('');
			$("#dob").val('');
			
		});
		
		$("#ApplicationNO").on('focus',function()
		{
			$(".download-msg").html("");	
		});
		
			$("#clickhere").on('click',function()
			{
			
				var ApplicationNO = $("#ApplicationNO").val();
					ApplicationNO = $.trim(ApplicationNO);
					
					if(ApplicationNO!='')
					{
						//ApplicationNO=parseInt(ApplicationNO);
						
						if(ApplicationNO!='0')
						{
							
							$.ajax({	
										url:'<?PHP echo base_url('Requestdispatcher/checkApplicationnumber')?>',
										type:"POST",
										data:{"hallticket":ApplicationNO},
										success:function(resp)
										{
											resp = $.trim(resp);
											
											if(resp=='0')
											{
											$(".download-msg").html("<span style='display:inline-block' class='alert alert-danger'>Invalid application number or hall ticket may not generated yet</span>");		
											}
											else
											{
												$("#hallticket").modal('show');

												$('#hallticket').modal("show");
													
													resp = JSON.parse(resp);
													
													$.each(resp,function(ind,val)
													{
													if(ind=='StudentName')
													$(".StudentName").html(val);
													
													if(ind=='DOB')
													$(".DOB").html(val);
													
													if(ind=='ApplicationNo')
													$(".ApplicationNumber").html(val);	
													
													if(ind=='MotherName')
													$(".MotherName").html(val);	
													
													if(ind=='SchoolName')
													$(".SchoolName").html(val);	
													
													if(ind=='FatherName')
													$(".Father").html(val);	
													
													if(ind == 'PicPath')
													$(".applicantPic").attr('src',val).css({'width':'215px','height':'235px'});
													
													if(ind=='CenterName')
													$(".SelectedCenter").html(val);
													
													
													var path = '<?PHP echo base_url('generate-hallticket/');?>'+ApplicationNO;
													$("#downloadhallticket").attr('href',path);
													
													});
								
													
											}
										}
								
									});
							
							
							
						}
						else
						{
							$(".download-msg").html("<span style='display:inline-block' class='alert alert-danger'>Application number should not be zero</span>");
						}
						
					}
					else
					{
						
						$(".download-msg").html("<span style='display:inline-block' class='alert alert-danger'>Please enter application number</span>");	
					}
						
					
					
			});



	});
	



$(document).on('keyup',"input[name=AadharNumber]",function(){
        var $this = $(this);
        if ((($this.val().length+1) % 5)==0){
            $this.val($this.val() + " ");
        }
    });   


$(document).on('keypress',"input[name=AadharNumber]",function(e){
	
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

	
	//applicnt_errmsg,sendApplicatinNo
$(document).on('click','.sendApplicatinNo',function()
{
	
	var err_cnt='0';
	
	var AadharNumber = $("#AadharNumber").val();
		AadharNumber = $.trim(AadharNumber);
		
	
	
	
	if( AadharNumber!='' && AadharNumber.length==14 )
	{
		$(".applicnt_errmsg").html('');
	}
	else
	{
		err_cnt='1';
		$(".applicnt_errmsg").html('<span class="text-danger">Aadhar card should be of exactly 12 digits</span>');
		return false;
	}
	
	
	var DayOfBirth = $("#DayOfBirth").val();
		DayOfBirth = $.trim(DayOfBirth);
		
	if(DayOfBirth=='0')
	{
		err_cnt='1';
		$(".date-err").html('<span class="text-danger">SelectDate</span>');
		return false;	
	}
	else
		$(".date-err").html('');	
		
		
	var monthofbirth = $("#monthofbirth").val();
		monthofbirth = $.trim(monthofbirth);
		
	if(monthofbirth=='0')
	{
		
			err_cnt='1';
			$(".mnth-err").html('<span class="text-danger">Select Month</span>');
			return false;	
		
	}
	else
	{
		if(monthofbirth=="2")
		{
			DayOfBirth = parseInt(DayOfBirth);	
			if(DayOfBirth>29)
			{
				err_cnt='1';
				$(".mnth-err").html('<span class="text-danger">Check date</span>');
				return false;
			}	
		}
		else
				$(".mnth-err").html('');		
	}
	
	var YearOfBirth = $("#YearOfBirth").val();
		YearOfBirth = $.trim(YearOfBirth);
		
	if(YearOfBirth=='0')
	{
		err_cnt='1';
		$(".yr-err").html('<span class="text-danger">Select Year</span>');
		return false;	
	}
	else
		$(".date-err").html('');
	
	
	
	if(err_cnt=='0')	
	{
		
		var dob = DayOfBirth+"-"+monthofbirth+"-"+YearOfBirth;
		
		$(".applicnt_errmsg").html('');
		$.ajax({
				
				url:'<?PHP echo base_url('Requestdispatcher/sendApplicationNumber');?>',
				type:"POST",
				data:{"AadharNumber":AadharNumber,"dob":dob},
				success:function(resp)
				{
					resp = $.trim(resp);
					
					if(resp=='0')
					{
						$(".applicnt_errmsg").html('<span class="text-danger">Please Check the Aadhar and Date of birth</span>');	
					}
					else
					{
						$(".applicnt_errmsg").css({'float':'left'});
						$(".applicnt_errmsg").html('<span class="text-success">Your Application is:<b>'+resp+'</b></span>');
						$("#AadharNumber").val('');
						$("#dob").val('');
						
						$("form#forgetAppliform")[0].reset();
						
					}
				}
			
			});	
	}
	
	
	
	
		
});
		
</script>




</body>

</html>

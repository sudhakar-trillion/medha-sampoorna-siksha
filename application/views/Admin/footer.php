<script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


	<script src="resources/admin-resources/js/bootstrap.min.js"></script>
	<script src="resources/admin-resources/js/bootstrap-datepicker.js"></script>
	<script>
	
	
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
  <!-- Modal -->
<div id="myModal" class="modal fade ve-mark" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Veryfy Marks</h4>
      </div>
      <div class="modal-body">
       <input type="text" class="form-control applicaiton_no"  placeholder="Application No" />
        
        <span class="applicnt_errmsg" ></span>
        <button type="button" class="editmark veri pull-right getapplicant">Get Details </button>
        
          <div class="clearfix"></div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
      <div class="clearfix"></div>
    </div>

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
      <td width="30%">Full Name : </td>
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
      <td width="30%" align="right"><span class="sms_msg"> </span><input type="button" class="btn btn-primary" value="Send SMS" /></td>
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


<div id="memoPathmodal" class="modal fade ve-mark" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="width:1070px; margin-left:-255px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">IX class memo marks</h4>
      </div>
      <div class="modal-body ">
      
      <iframe src="" class="memoview" height:500px> </iframe>
      
        
          <div class="clearfix"></div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
      <div class="clearfix"></div>
    </div>

  </div>
</div>


<script>
	$(document).ready(function()
	{
		

		$("#myModal").draggable({  handle: ".modal-content" });
							
		$("#hallticket").draggable({ handle: ".modal-dialog" });
	
	});//document ready ends here
</script>



<script>

$(document).ready(function()
	{
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
	});
	
	$(document).ready(function()
	{
		$(document).on('focus','.applicaiton_no',function()
		{
			$(".applicnt_errmsg").html("");
		});
		
		$(document).on('click','.getapplicant',function()
		{
			var ApplicationNo = $(".applicaiton_no").val();
				ApplicationNo = $.trim(ApplicationNo);
				//ApplicationNo = parseInt(ApplicationNo);
				
			if(ApplicationNo!='')
			{
				$.ajax({
							url:'<?PHP echo base_url()?>Requestdispatcher/get_applicantdetails',
							type:"POST",
							data:{"ApplicationNo":ApplicationNo},
							success:function(resp)
							{
								resp=$.trim(resp);
								if(resp=='0')
								{
									$(".applicnt_errmsg").html("<p style='display:inline-block; margin-bottom:0px; padding:5px' class='alert alert-danger'>Applicant with this application number does not exit</p>");
								}
								else
									location.href="<?PHP echo base_url('admin/view-student-application/')?>"+ApplicationNo;
							}
						
						});
			}
			else
			{
				$(".applicnt_errmsg").html("<p style='display:inline-block; margin-bottom:0px; padding:5px' class='alert alert-danger'>Please enter the application number</p>");
			}
		});
	});
	
	$(document).ready(function()
	{
		
		$(document).on('click','.aadharCardview',function()
		{

				var path = $(this).attr('path');
		
			var img = "<img src="+path+" style='width:100%'>";
			$(".aadharcardview").html(img);
			
		});
		
		
		
		$(document).on('click','.viewmemo',function()
		{

			var Memopath = $(this).attr('Memopath');
		
			$(".memoview").attr('width','100%');
			$(".memoview").css({'height':'500px'});
			$(".memoview").attr('src',Memopath);
			
		});
		
		
		
		$(document).on('click','.editninethmarks, .verify',function()
		{
			
			$(".ninethmarks").removeClass('err-msg-border');
			
			
			if( $(this).attr('id')=='edit')
			{
				var ninethmarks = $(".ninethmarks").val();
					ninethmarks = $.trim(ninethmarks);
					ninethmarks = parseInt(ninethmarks);
					
				if(ninethmarks!='' && ninethmarks>0)
				{	
				
				}
				else
				{
					$(".ninethmarks").addClass('err-msg-border');	
					return false;	
				}
					
			}
			else
			{
				var ninethmarks = '';
			}
				
				$.ajax({
							url:"<?PHP echo base_url('Requestdispatcher/updateninethmarks/');?>",
							type:"POST",
							data:{"ApplicationNo":"<?PHP echo $this->uri->segment(3); ?>","ninethmarks":ninethmarks},
							success:function(resp)
							{
								resp = $.trim(resp);
								if(resp=='0')	
								{
									$(".marks_msg").html('<span class="alert alert-danger">Unable to update kindly contact admin</span>');
								}
								else
								{
										$(".marks_msg").html('<span class="alert alert-success" style="display:inline-block" >Successfully updated and verified</span>');
										$(".verify").remove();
										$(".verified").css({'display':'block'});
										$(".obtainedmarks").html(ninethmarks);
										$(".ninethmarks").val('');
										
								}
							}
							
						});
				
				
			
			
			
			
			
				
		});
		//ninethmarks
	var paginateionnumber = '<?PHP echo $this->uri->segment(3)?>';
	
	if(paginateionnumber!='')
	{	
		$("ul li").removeClass('active');	
		$("ul li:nth-child("+paginateionnumber+")").addClass('active');
	}
	else
		$("ul li:nth-child(1)").addClass('active');
	
	
	
	$("#Examcenters").on('keyup',function()
	{
		var wilcard = $(this).val();
			wilcard = $.trim(wilcard);
			
		if(wilcard =='')
		{
			$(".examcenterslist ul").html('');
			$(".examcenterslist").css({'display':'none'});
		}
		else
		{
			$.ajax({
					
					url:"<?PHP echo base_url();?>Requestdispatcher/getExamcenters",
					type:"POST",
					data:{"wildcard":wilcard},
					success:function(resp)
					{
						resp=$.trim(resp);
						
						
						if(resp=='0')	
						{
							console.log(resp);
						}
						else
						{
							$(".examcenterslist").css({'display':'inline-block'});
							$(".examcenterslist ul").html(resp);
						}
					}
				
				})	
		}
			
			
	});
	
	
	//hall ticket modal popup 
	
	$(document).on('click','.genrateHallticket',function(e)
	{
		var hallticket = $(this).attr('id');
		var OnClick = $(this);


		
		$.ajax({
					url:'<?PHP echo base_url('Requestdispatcher/generateHallticket') ?>',
					type:'POST',
					data:{"hallticket":hallticket},
					success:function(resp)
					{
						resp = $.trim(resp);
						
						if(resp!='0')	
						{
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
									
									OnClick.addClass('btn-warning');
									OnClick.removeClass('genrateHallticket');
									OnClick.html('Hallticket Genreated');
									
									
								});
							
							
						}
						else
						{
							
						}
					}
				})
		
		
	});
	
	
	
	});

$(document).on('keypress','.applicaiton_no',function(e) 
		{
		    if(e.which == 13)
			{
        		$(".getapplicant").trigger('click');
    		}
		});

$(document).on('click','.autosuggestlist',function()
{
	$("#Examcenters").val($(this).html());
	$("#SelectedExamcenter").val($(this).attr('centerid'));
	
	$(this).parent().parent().css({'display':'none'});
	
});

</script>


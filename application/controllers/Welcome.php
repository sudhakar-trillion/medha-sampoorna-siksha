<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('Commonmodel');
	}


public function pagenotfound()
{
	$this->load->view('Frontend/page-not-found');
}

public function loadformrules($configItem)
	{
		return $this->config->item($configItem);
	}	


	public function index()
	{
		
		//get the districts
		$table = 'districts';
		$fields='DistrictName, DistrictId';
		$cond = array();
		
		
		$districts = $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='DistrictName',$limit='');
		
		$data['districts'] = $districts;
		$data['mandals'] = '0';
		$data['schools'] = '0';
		
		/*
		
			//get the exam center by district wise
		
		$this->db->select("cent.CenterId as CenterId, cent.CenterName as CenterName, dis.DistrictId as DistrictId, dis.DistrictName as DistrictName");
		$this->db->from('examcenters as cent');
		$this->db->join("districts as dis",'cent.DistrictId=dis.DistrictId');
		//$this->db->order_by('cent.CenterId','ASC');
		$this->db->order_by('dis.DistrictName','ASC');
		$centersQry = $this->db->get();
		
		$output = array();
		
		foreach($centersQry->result() as $center)
		{
			$output[ trim( str_replace("DISTRICT","",$center->DistrictName ) )][] = array("CenterId"=>$center->CenterId,"DistrictId"=>$center->DistrictId, "CenterName"=>$center->CenterName);
			$DistrictId[$center->DistrictId] = $center->DistrictId;
			
		}	
		
		
		$Districts = array();
		
		foreach($DistrictId as $Id)
		{
			$Districts[] = $Id;	
		}
		
		$data['examcenters'] = $output;
		$data['DistrictId'] = $Districts;
		
		*/
		
		$table = 'examcenters';
		$fields='CenterName, CenterCode, CenterId';
		$cond = array();
		
		
		$centers =  $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='CenterCode',$limit='');		
		
		$data['centers'] = $centers;
		
		if( $this->input->post('application-form'))
		{
			
			if($this->input->post('districts')>0)
			{
				 $DistrictId = trim( $this->input->post('districts') );
				
				$cond['DistrictId'] = $DistrictId;
				$fields='MandalId,MandalName';
				$table = 'mandals';
				$mandaldata = $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='MandalName',$limit='');
				if($mandaldata!='0')
				{
					$data['mandals'] = $mandaldata;
				}
					
			}
			
			if($this->input->post('Mandal')>0)
			{
				$cond = array();
				$table  = 'schools';
				 $DistrictId = trim( $this->input->post('districts') );
				 $MandalId = trim( $this->input->post('Mandal') );
				
				$cond['DistrictId'] = $DistrictId;
				$cond['MandalId'] = $MandalId;
				$fields='SchoolId,SchoolName';
		
				$schooldata = $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='SchoolName',$limit='');
				if($schooldata!='0')
				{
					$data['schools'] = $schooldata;
				}
					
			}
			
			
			$this->form_validation->set_rules( $this->config->item('ApplicationForm') );
			if( $this->form_validation->run() === false) { 	$this->load->view('Frontend/application-form',$data); }
			else
			{
				
				$table = "applicantdetails";
				$insertdata = array();
				
				$insertdata['FirstName'] = $this->input->post('FirstName');
				$insertdata['LastName'] = $this->input->post('LastName');
				$insertdata['FatherName'] = $this->input->post('FatherName');
				
				$insertdata['MotherName'] = $this->input->post('MotherName');
				$insertdata['HeadMaster'] = $this->input->post('HeadMaster');
				
				
				$insertdata['DOB'] = $this->input->post('YearOfBirth')."-".$this->input->post('monthofbirth')."-".$this->input->post('DayOfBirth');
				
				$insertdata['Gender'] = $this->input->post('Gender');
				$insertdata['AadharNumber'] = $this->input->post('AadharNumber');
				
				
				$insertdata['ReservationCategory'] = $this->input->post('ReservationCategory');
				$insertdata['LastUpdated'] = time();
				
				
				$SLNO = $this->Commonmodel->insertdata($table,$insertdata);
				
				//get the district code
				$districtcond = array();
				$districtcond['DistrictId'] = $DistrictId;
				$table = 'districts';
				
				$DistrictCode = $this->Commonmodel->getAfield($table,$districtcond,$field='DistrictCode',$order_by='',$order_by_field='',$limit='');
				
				$DistrictCode = substr($DistrictCode,0,2);
				
				
				//get the schoolCode from the school table
				
				$SchoolCond = array();
				
				$SchoolCond['SchoolId'] =$this->input->post('school');
				$table = 'schools';
				
				$SchoolCode = $this->Commonmodel->getAfield($table,$SchoolCond,$field='SchoolCode',$order_by='',$order_by_field='',$limit='');
				
				if(strlen($SchoolCode)==1)
					$SchoolCode = "00".$SchoolCode;
				elseif(strlen($SchoolCode)==2)
					$SchoolCode = "0".$SchoolCode;
				elseif(strlen($SchoolCode)==3)
					$SchoolCode = $SchoolCode;	
				
				///make the ApplicationNo.
				$ApplicationNo = "MSS".date('y').$DistrictCode.$SchoolCode.$SLNO;
			
				
				mkdir(FCPATH.'/resources/frontend-resources/applicants/'.$ApplicationNo, 0777, TRUE);
				
				$imgPath ='resources/frontend-resources/applicants/'.$ApplicationNo."/".time();
				
				move_uploaded_file($_FILES['stdpic']['tmp_name'],$imgPath."_".str_replace(" ","-",$_FILES['stdpic']['name']) );
				
				
				//aadhar card upload
				
				mkdir(FCPATH.'/resources/frontend-resources/aadharcards/'.$ApplicationNo, 0777, TRUE);
				
				$aadharcardPath ='resources/frontend-resources/aadharcards/'.$ApplicationNo."/".time();
				
				move_uploaded_file($_FILES['AadharCard']['tmp_name'],$aadharcardPath."_".str_replace(" ","-",$_FILES['AadharCard']['name']) );
				
				$cond = array();
				$setdata = array();
				$table='applicantdetails';
				$cond['SLNO'] = $SLNO;
				
				$setdata['ApplicationNo'] = $ApplicationNo;
				$setdata['PicPath'] = $imgPath."_".str_replace(" ","-",$_FILES['stdpic']['name']);				
				$setdata['AadharCardPath'] = $aadharcardPath."_".str_replace(" ","-",$_FILES['AadharCard']['name']);
				
				$setdata['LastUpdated'] = time();
				
				$this->Commonmodel->updatedata($table,$setdata,$cond);
				
				//echo "HEY".$ApplicationNo; exit;
				
				
				$table = 'communicationdetails';
				$cond = array();
				$insertdata = array();
				
				$insertdata['ApplicationNo'] = $ApplicationNo;
				
				$insertdata['ContactNumber'] = $this->input->post('ContactNumber');
				$insertdata['AlternateNumber'] = $this->input->post('AlternateNumber');
				$insertdata['HeadMasterContactNumber'] = $this->input->post('HeadMasterContactNumber');
				
				$insertdata['NinethMarks'] = $this->input->post('NinethMarks');
				$insertdata['Address'] = $this->input->post('Address');
				$insertdata['ExamCenter'] = $this->input->post('ExamCenter');

				$insertdata['District'] = $this->input->post('districts');
				$insertdata['Mandal'] = $this->input->post('Mandal');
				$insertdata['School'] = $this->input->post('school');
				
				$insertdata['AppliedOn'] = date('Y-m-d');;
				$insertdata['LastUpdated'] = time();
				
				$this->Commonmodel->insertdata($table,$insertdata);
				
				$totalFiles = sizeof($_FILES['docs']['tmp_name']);
				mkdir(FCPATH.'/resources/frontend-resources/markslist-docs/'.$ApplicationNo, 0777, TRUE);
				
				$markslistBasePath = 'resources/frontend-resources/markslist-docs/'.$ApplicationNo."/";
				
				$marksListPaths=array();
				
				
				$tme = time();
				$markslistcnt=0;
				for($i=0;$i<$totalFiles;$i++)
				{
					$markslistcnt++;
					
					move_uploaded_file($_FILES['docs']['tmp_name'][$i],$markslistBasePath.$tme."_".str_replace(" ","-",$_FILES['docs']['name'][$i]) );
					$marksListPath = $markslistBasePath.$tme."_".str_replace(" ","-",$_FILES['docs']['name'][$i]);
					
					$insertdata = array();
					$table = 'marksmemos';
					
					$insertdata['ApplicationNo'] = $ApplicationNo;
					$insertdata['MemoPath'] 	 = $marksListPath;
					$insertdata['LastUpdated']   = time();
									
					
					$this->Commonmodel->insertdata($table,$insertdata);
				}
				
				if($markslistcnt==$totalFiles)
				{
					redirect(base_url('confirm-application/'.$ApplicationNo));
					//redirect(base_url('application-preview/'.$ApplicationNo));
					//exit; 
				}
				
			}
		}
		else
			$this->load->view('Frontend/application-form',$data);
	}
	
	
	public function confirmapplication()
	{
			// get the application data and send it to the view
		
		$this->db->select('app.*,cmm.*');
		$this->db->from('applicantdetails as app');
		$this->db->join('communicationdetails as cmm','cmm.ApplicationNo=app.ApplicationNo');
		$this->db->where('app.ApplicationNo',$this->uri->segment(2));
		$qry = $this->db->get();
		
		
		if($qry->num_rows()>0)
		{	
			$data = array();
			$data['formdata'] = $qry;
			
			
			$this->load->view('Frontend/confirm-application',$data);
		}
		else
			$this->load->view('Frontend/page-not-found');

	}
	
	
	public function editapplication()
	{
		$data = array();	

/*	
			
//get the exam center by district wise
		
		$this->db->select("cent.CenterId as CenterId, cent.CenterName as CenterName, dis.DistrictId as DistrictId, dis.DistrictName as DistrictName");
		$this->db->from('examcenters as cent');
		$this->db->join("districts as dis",'cent.DistrictId=dis.DistrictId');
		//$this->db->order_by('cent.CenterId','ASC');
		$this->db->order_by('dis.DistrictName','ASC');
		$centersQry = $this->db->get();
		
		$output = array();
		
		foreach($centersQry->result() as $center)
		{
			$output[ trim( str_replace("DISTRICT","",$center->DistrictName ) )][] = array("CenterId"=>$center->CenterId,"DistrictId"=>$center->DistrictId, "CenterName"=>$center->CenterName);
			$DistrictId[$center->DistrictId] = $center->DistrictId;
			
		}	
		
		
		$Districts = array();
		
		foreach($DistrictId as $Id)
		{
			$Districts[] = $Id;	
		}
		
		$data['examcenters'] = $output;
		$data['DistrictId'] = $Districts;

*/	

$table = 'examcenters';
		$fields='CenterName, CenterCode, CenterId';
		$cond = array();
		
		
		$centers =  $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='CenterCode',$limit='');		
		
		$data['centers'] = $centers;
		
		//get the selected district, mandal and school
		$cond = array();
		$table = 'communicationdetails';
		
		$cond['ApplicationNo'] = $this->uri->segment(2);
		
		
		$fields = 'District, Mandal, School';
		
		$selected_dis_man_sch = $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='',$order_by_field='',$limit='');
		if($selected_dis_man_sch!='0')
		{
			
				foreach($selected_dis_man_sch->result() as $dis_man_sch )
				{
					$data['SelectedDistrict']	 = $dis_man_sch->District;
					$data['SelectedMandal']	 = $dis_man_sch->Mandal;
					$data['SelectedSchool']	 = $dis_man_sch->School;
				}
			
			if( $this->input->post('edit-application-form'))
			{
					$data['SelectedDistrict']	= $this->input->post('districts');
					$data['SelectedMandal']	 	= $this->input->post('Mandal');
					$data['SelectedSchool']		= $this->input->post('school');
			}
			
			
			
			//get the districts	
			$table = 'districts';
			$fields='DistrictName, DistrictId';
			$cond = array();
			
			
			$districts = $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='DistrictName',$limit='');
			
			$data['districts'] = $districts;
			$data['mandals'] = '0';
			$data['schools'] = '0';
			
			//get the madals of the district
			
			$cond = array();
			$table ='mandals';
			$fields='MandalName, MandalId';
			$cond['DistrictId'] = $data['SelectedDistrict'];
			
			$mandals = $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='MandalName',$limit='');
			
			$data['mandals'] = $mandals;
			
			
			//get the schools of the district and mandal
			
			$cond = array();
			$table ='schools';
			$fields='SchoolId,SchoolName';
			
			$cond['DistrictId'] = $data['SelectedDistrict'];
			$cond['MandalId'] = $data['SelectedMandal'];

			
			$schools = $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='SchoolName',$limit='');
			
			$data['schools'] = $schools;
			
		
			
			if( $this->input->post('edit-application-form'))
			{
				$cond = array();
				$ApplicationNo = $this->uri->segment(2);
				$cond['ApplicationNo'] = $ApplicationNo;
							
				
				$this->form_validation->set_rules( $this->config->item('EditApplicationForm') );
				if( $this->form_validation->run() === false) { 	$this->load->view('Frontend//edit-application-form',$data); }
				else
				{
			
					
					$table = "applicantdetails";
	
					
					$setdata = array();
					
					$setdata['FirstName'] = $this->input->post('FirstName');
					$setdata['LastName'] = $this->input->post('LastName');
					$setdata['FatherName'] = $this->input->post('FatherName');
					
					$setdata['MotherName'] = $this->input->post('MotherName');
					$setdata['HeadMaster'] = $this->input->post('HeadMaster');
					
					$setdata['Gender'] = $this->input->post('Gender');
					$setdata['AadharNumber'] = $this->input->post('AadharNumber');
					
					$setdata['DOB'] = $this->input->post('YearOfBirth')."-".$this->input->post('monthofbirth')."-".$this->input->post('DayOfBirth');
					
					$setdata['ReservationCategory'] = $this->input->post('ReservationCategory');
					
					$imgPath='';
					if( is_uploaded_file($_FILES['stdpic']['tmp_name']) )
					{
						
						//remove the previous student image form the server
						
						$field='PicPath';
						
						$PicPath = FCPATH.$this->Commonmodel->getAfield($table,$cond,$field,$order_by='',$order_by_field='',$limit='');
						
						@unlink($PicPath);
	
					
						$imgPath ='resources/frontend-resources/applicants/'.$ApplicationNo."/".time();
					
						move_uploaded_file($_FILES['stdpic']['tmp_name'],$imgPath."_".str_replace(" ","-",$_FILES['stdpic']['name']) );
						
					}
					
					$aadharcardPath='';
					
					if( is_uploaded_file($_FILES['AadharCard']['tmp_name']) )
					{
						//remove previous aadhar card
												
						$field='AadharCardPath';
						
						$AadharCardPath = FCPATH.$this->Commonmodel->getAfield($table,$cond,$field,$order_by='',$order_by_field='',$limit='');
						@unlink($AadharCardPath);
	
						//aadhar card upload
						$aadharcardPath ='resources/frontend-resources/aadharcards/'.$ApplicationNo."/".time();
						
						move_uploaded_file($_FILES['AadharCard']['tmp_name'],$aadharcardPath."_".str_replace(" ","-",$_FILES['AadharCard']['name']) );	
					}
					
					if($imgPath!='')
						$setdata['PicPath'] = $imgPath."_".str_replace(" ","-",$_FILES['stdpic']['name']);
						
					if($aadharcardPath!='')
						$setdata['AadharCardPath'] = $aadharcardPath."_".str_replace(" ","-",$_FILES['AadharCard']['name']);		
					
					$setdata['LastUpdated'] = time();
					
					$this->Commonmodel->updatedata($table,$setdata,$cond);
					
					$table = 'communicationdetails';
					$cond = array();
					$setdata = array();
	
					$ApplicationNo = $this->uri->segment(2);
					$cond['ApplicationNo'] = $ApplicationNo;
					
					$setdata['ContactNumber'] = $this->input->post('ContactNumber');
					$setdata['AlternateNumber'] = $this->input->post('AlternateNumber');
					$setdata['HeadMasterContactNumber'] = $this->input->post('HeadMasterContactNumber');
					
					
					$setdata['District'] = $this->input->post('districts');
					$setdata['Mandal'] = $this->input->post('Mandal');
					$setdata['School'] = $this->input->post('school');
					
					$setdata['NinethMarks'] = $this->input->post('NinethMarks');
					$setdata['Address'] = $this->input->post('Address');
					$setdata['ExamCenter'] = $this->input->post('ExamCenter');
					$setdata['LastUpdated'] = time();
					
					$this->Commonmodel->updatedata($table,$setdata,$cond);
					
					
					
					if( is_uploaded_file($_FILES['docs']['tmp_name'][0]) )
					{

						$totalFiles = sizeof($_FILES['docs']['tmp_name']);
						
						$cond = array();
						
						$cond['ApplicationNo'] = $ApplicationNo;
						$table ='marksmemos';
						
						$field='MemoPath';
						$MarksListPath = $this->Commonmodel->getRows_fields($table,$cond,$field,$order_by='',$order_by_field='',$limit='');
						
						if( $MarksListPath!='0')
						{
							foreach( $MarksListPath->result() as $link )
							{
								
								//echo FCPATH.$link->MemoPath;
								$MemPath = FCPATH.$link->MemoPath;
								@unlink($MemPath);
							}
						}
						
						$this->Commonmodel->deleterow($table,$cond);
						
						
						
						//mkdir(FCPATH.'/resources/frontend-resources/markslist-docs/'.$ApplicationNo, 0777, TRUE);
						
						$markslistBasePath = 'resources/frontend-resources/markslist-docs/'.$ApplicationNo."/";
						
						$marksListPaths=array();
						
						
						$tme = time();
						$markslistcnt=0;
						for($i=0;$i<$totalFiles;$i++)
						{
							$markslistcnt++;
							
							move_uploaded_file($_FILES['docs']['tmp_name'][$i],$markslistBasePath.$tme."_".str_replace(" ","-",$_FILES['docs']['name'][$i]) );
							$marksListPath = $markslistBasePath.$tme."_".str_replace(" ","-",$_FILES['docs']['name'][$i]);
							
							$insertdata = array();
							$table = 'marksmemos';
							
							$insertdata['ApplicationNo'] = $ApplicationNo;
							$insertdata['MemoPath'] 	 = $marksListPath;
							$insertdata['LastUpdated']   = time();
							
							
							$this->Commonmodel->insertdata($table,$insertdata);
						}
						
						if($markslistcnt==$totalFiles)
						{
							redirect(base_url('confirm-application/'.$ApplicationNo));
							//echo "done"; exit; 
						}
						//redirect(base_url('confirm-application/'.$ApplicationNo));
					
					}
					else
						redirect(base_url('confirm-application/'.$ApplicationNo));
						
					
					
				}
				
			}
			else
			{
				$this->db->select('app.*,cmm.*');
				$this->db->from('applicantdetails as app');
				$this->db->join('communicationdetails as cmm','cmm.ApplicationNo=app.ApplicationNo');
				$this->db->where('app.ApplicationNo',$this->uri->segment(2));
				$qry = $this->db->get();
				
				if($qry!='0')
				{	
	
					$data['formdata'] = $qry;
					$this->load->view('Frontend/edit-application-form',$data);
				}
				else
					$this->load->view('Frontend/page-not-found');
			}
		}
		else
		$this->load->view('Frontend/page-not-found');
		
		
	}
	
	
	
	public function generatehallticket()
	{
		
		$this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model
        // boost the memory limit if it's low ;)
		
        $html = $this->load->view('Frontend/hall-ticket','',TRUE);

		$pdf->AddPage('A4-L');
		
        // render the view into HTML
        $pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = $this->uri->segment(2).'.pdf';
        $pdf->Output("$output", 'I');
			
			
	}
	
	public function applicationpreview()
	{
		
		
		$this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model
        // boost the memory limit if it's low ;)
		
		
		// get the application data and send it to the view
		
		$this->db->select('app.*,cmm.*');
		$this->db->from('applicantdetails as app');
		$this->db->join('communicationdetails as cmm','cmm.ApplicationNo=app.ApplicationNo');
		$this->db->where('app.ApplicationNo',$this->uri->segment(2));
		$qry = $this->db->get();
		
		if( $qry->num_rows() == 1 )
		{
			$conde = array();
			$table ='smsinfo';	
			
			$conde['ApplicationNo'] = $this->uri->segment(2);
			$conde['Send'] = "Yes";
			
		
		if(!$this->Commonmodel->checkexists($table,$conde))
		{
			$url="http://alerts.solutionsinfini.com/api/v4/";
			//get the phone number
			
			$table = 'communicationdetails';
			$cond['ApplicationNo'] = $this->uri->segment(2);
			
			$field = 'ContactNumber';
			
			$ContactNumber = $this->Commonmodel->getAfield($table,$cond,$field,$order_by='',$order_by_field='',$limit='');
			
			$table = 'applicantdetails';
			
			
			$cond['ApplicationNo'] = $this->uri->segment(2);
			$field = 'FirstName';
			$FirstName = $this->Commonmodel->getAfield($table,$cond,$field,$order_by='',$order_by_field='',$limit='');
			
			$msg = "Thank you for registering Medha Sampurna Siksha Entrance Test for Year ".date('Y-m-d')." Your application no.".$this->uri->segment(2).", Use this no. in future MSS Screening Process";
			
			//$ContactNumber = "8008571062";
			
			$request = "api_key=A74036853687e4c319df659e5bd6e51d3&format=json&method=sms&message=".$msg."&to=".$ContactNumber."&sender=MCTMSS";
			
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
			$response=curl_exec($ch);
			
			
			/*echo "<pre>";
			
			print_r($response); exit;*/
			
			$table ='smsinfo';	
			$insertdata = array();
			
			$insertdata['ApplicationNo'] = $this->uri->segment(2);
			$insertdata['Send'] ="Yes";
			
			$this->Commonmodel->insertdata($table,$insertdata);
		}
			
			
			$data = array();
			$data['formdata'] = $qry;
			$html = $this->load->view('Frontend/application-form-preview',$data,TRUE);
			
			$pdf->AddPage('A4');
			
			// render the view into HTML
			$pdf->WriteHTML($html);
			// write the HTML into the PDF
			$output = $this->uri->segment(2)."_".time().'_.pdf';
			$hey = $pdf->Output("resources/frontend-resources/download-applicants/".$output, 'F');
			
			$path = "resources/frontend-resources/download-applicants/".$output;

			
			force_download($path,NULL);
			
				
		}
		else
		$this->load->view('Frontend/page-not-found');
		
		
        
	}
	
	
	public function downloadhallticket()
	{
		$this->load->view('Frontend/download-hallticket');
	}
	
	
	
	//callbacks starts here
	
	public function chekreservationcateg($res)
	{
		if(trim($res)!='')
		{
			if( $res=="SC" || $res=="ST" || $res=="BC-A" || $res=="BC-B" || $res=="BC-C" || $res=="BC-D" || $res=="BC-E" || $res=="General" || $res=='Others' )	
			{
				return true;
			}
			else
				{
					$this->form_validation->set_message('chekreservationcateg','Select Proper reservation');	
				 false;
				}
			
		}
		else
		{
			$this->form_validation->set_message('chekreservationcateg','Select reservation category');	
			return false;
		}
	}
		
	public function prevmarkslist()
	{
		if( is_uploaded_file($_FILES['docs']['tmp_name'][0]) )
		{
			$size = $_FILES['docs']['size'][0];
			
			$allowedsize = 1024*1024*2;
			if( $size<=$allowedsize)
			{
				
			$totalFiles = sizeof($_FILES['docs']['tmp_name']);
			
			$allowedtype = array("application/pdf","image/jpeg","image/png");
			
			$cnt=0;
			
			for($i=0;$i<$totalFiles;$i++)
			{
				
				$mimetype = '';
				$mimetype = $_FILES['docs']['type'][$i];
				
				if( in_array($mimetype, $allowedtype) )
				{
					$cnt++;	
				}
				else
				{
					$this->form_validation->set_message('prevmarkslist','Upload pdf or image format only');	
					return false;		
				}
			}
			if($cnt==$allowedtype)
			return true;
		
			
			
			}
			else
			{
				$this->form_validation->set_message('prevmarkslist','Upload 9th class marks list below 2MB');	
				return false;
			}
			
			
		}
		else
		{
			$this->form_validation->set_message('prevmarkslist','Upload 9th class marks list, only  jpeg, jpg, png and pdf formats');	
			return false;
		}
	}
	
	public function editprevmarkslist()
	{
		if( is_uploaded_file($_FILES['docs']['tmp_name'][0]) )
		{
			$totalFiles = sizeof($_FILES['docs']['tmp_name']);
			
			$allowedtype = array("application/pdf","image/jpeg","image/png");
			
			$cnt=0;
			
			$allowedsize = 1024*1024*2;
			
			for($i=0;$i<$totalFiles;$i++)
			{
				$size = $_FILES['docs']['size'][$i];
			
				$mimetype = '';
				$mimetype = $_FILES['docs']['type'][$i];
				
				if( $size<=$allowedsize )
				{
					if( in_array($mimetype, $allowedtype) )
				{
					$cnt++;	
				}
				else
				{
					$this->form_validation->set_message('editprevmarkslist','Upload pdf or image format only');	
					return false;		
				}
				}
				else
				{
					$this->form_validation->set_message('editprevmarkslist','Upload marks list below 2MB');	
					return false;
				}
				
				
			}
			if($cnt==$allowedtype)
			return true;
		
			
		}
		else
		{
			return true;
		}
	}
	
	public function studentPic()
	{
		if( is_uploaded_file($_FILES['stdpic']['tmp_name']) )
		{
			
			$size = $_FILES['stdpic']['size'];
			$allowedsize = 1024*500;
			
			
			if($size<=$allowedsize)
			{
				$totalFiles = sizeof($_FILES['stdpic']['tmp_name']);
				
				$allowedtype = array("image/jpeg","image/png");
				
				$cnt=0;
				
				$mimetype = $_FILES['stdpic']['type'];
				if( in_array($mimetype, $allowedtype) )
				{
					return true	;
				}
				else
				{
					$this->form_validation->set_message('studentPic','Only image format allowed');	
					return false;		
				}	
			}
			else
				{
					$this->form_validation->set_message('studentPic','Upload Image below 500KB');	
					return false;		
				}	
			
			
		}
		else
		{
			$this->form_validation->set_message('studentPic','Upload student picture, only jpeg, jpg, png formats ');	
			return false;
		}
	}
	
	public function editstudentPic()
	{
		if( is_uploaded_file($_FILES['stdpic']['tmp_name']) )
		{
			$size = $_FILES['stdpic']['size'];
			$allowedsize = 1024*500;
			
			if($size<=$allowedsize)
			{
				$totalFiles = sizeof($_FILES['stdpic']['tmp_name']);
			
			$allowedtype = array("image/jpeg","image/png");
			
			$cnt=0;
			
			$mimetype = $_FILES['stdpic']['type'];
				if( in_array($mimetype, $allowedtype) )
				{
					return true	;
				}
				else
				{
					$this->form_validation->set_message('editstudentPic','Only image format allowed');	
					return false;		
				}
			}
			else
				{
					$this->form_validation->set_message('editstudentPic','Upload Image belw 500KB');	
					return false;		
				}	
			
		
			
		}
		else
		{
			return true;
		}
	}
	
	
	public function CheckAadharCard()
	{
		if( is_uploaded_file($_FILES['AadharCard']['tmp_name']) )
		{
			
			$size = $_FILES['AadharCard']['size'];
			$allowedsize = 1024*1024*2;
			
			
			if($size<=$allowedsize)
			{
				$totalFiles = sizeof($_FILES['AadharCard']['tmp_name']);
				
				$allowedtype = array("image/jpeg","image/png");
				
				$cnt=0;
				
				$mimetype = $_FILES['AadharCard']['type'];
				if( in_array($mimetype, $allowedtype) )
				{
					return true	;
				}
				else
				{
					$this->form_validation->set_message('CheckAadharCard','Only jpeg,jpg or png formats allowed');	
					return false;		
				}	
			}
			else
				{
					$this->form_validation->set_message('CheckAadharCard','Upload Image belw 2MB');	
					return false;		
				}	
			
			
		}
		else
		{
			$this->form_validation->set_message('CheckAadharCard','Upload Aadhar Card');	
			return false;
		}
	}
	
	public function CheckEditAadharCard()
	{
		
		if( is_uploaded_file($_FILES['AadharCard']['tmp_name']) )
		{
			
			$size = $_FILES['AadharCard']['size'];
			$allowedsize = 1024*1024*2;
			
			
			if($size<=$allowedsize)
			{
				$totalFiles = sizeof($_FILES['AadharCard']['tmp_name']);
				
				$allowedtype = array("image/jpeg","image/png");
				
				$cnt=0;
				
				$mimetype = $_FILES['AadharCard']['type'];
				if( in_array($mimetype, $allowedtype) )
				{
					return true	;
				}
				else
				{
					$this->form_validation->set_message('CheckEditAadharCard','Only jpeg,jpg or png formats allowed');	
					return false;		
				}	
			}
			else
				{
					$this->form_validation->set_message('CheckEditAadharCard','Upload Image belw 2MB');	
					return false;		
				}	
			
			
		}
		else
		{
			return true;
		}
	
	}
	
	
	public function chekexamcenter($center)
	{
		if(trim($center)!='')
		{
			return true;
			
		}
		else
		{
			$this->form_validation->set_message('chekexamcenter','Select examination center');	
			return false;
		}
			
			
	}


	public function checkfebmonth()
	{
		$date = $this->input->post('DayOfBirth');
		$mnth = $this->input->post('monthofbirth');
		if($date<1)
		{
			$this->form_validation->set_message('checkfebmonth','Select Date');	
			return false;
		}
		else
		{
			if($mnth==2)
			{
				if($date<=29)
				return true;
				else
				{
					$this->form_validation->set_message('checkfebmonth','Check date & month');	
					return false;
				}
			}
			else
				return true;
		}
	}
} //class ends here

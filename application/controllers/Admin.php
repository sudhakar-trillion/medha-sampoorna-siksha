<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		define('HEADER','Admin/header');
		define('FOOTER','Admin/footer');
		
		$this->load->model('Commonmodel');
	
		//check whether the admin logged-in or not
		
		if( $this->uri->segment(1)=='admin' && $this->uri->segment(2)=='')
		{
			if( $this->session->userdata('adminId')!='')
				redirect(base_url('admin/view-all-applications'));
		}
		else
		{
			if( $this->session->userdata('adminId')!='' )	
			{

			}
			else
				redirect(base_url('admin'));
				
		}
				
	}
	

public function loadformrules($configItem)
	{
		return $this->config->item($configItem);
	}	
	
public function login()
	{
		if( $this->input->post('adminlogin'))
		{
			$this->form_validation->set_rules( $this->config->item('Adminlogin') );
			
			if( $this->form_validation->run() === false) { 	$this->load->view('Admin/login'); }
			else
			{
				$table = 'logins';
				
				$cond = array();
				
				$cond['UserId']  = $this->input->post('UserId');
				$cond['Password']  = md5($this->input->post('Password'));
				
				if( $this->Commonmodel->checkexists($table,$cond))
				{
					$this->session->set_userdata('adminId',$this->input->post('UserId'));
					$LoginId = $this->Commonmodel->getAfield($table,$cond,$field='LoginId',$order_by='',$order_by_field='',$limit='');
					
					$this->session->set_userdata('LoginId',$LoginId);
					
					redirect(base_url('admin/view-all-applications'));
				}
				else
				{
					$msg = "<span class='alert alert-warning'>Check your login credentials </span>";
					$this->session->set_flashdata('login_msg',$msg);
					redirect(base_url('admin'));
				}
				
				
			}
			
		}
		else
			$this->load->view('Admin/login');
	}//login method ends here
	
	public function dashboard()
	{
		$this->load->view(HEADER);
		
		$this->load->view(FOOTER);
	}
	
	
	public function viewapplications()
	{
		
	//	$this->session->set_userdata('SelectedExamcenter','');
		
		$this->load->view(HEADER);
		
		$table = 'districts';
		$fields='DistrictName, DistrictId';
		$cond = array();
		$mandalcond = array();
		$schoolcond = array();
		
		$districts = $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='DistrictName',$limit='');
		
		$data['districts'] = $districts;
		$data['mandals'] = '0';
		$data['schools'] = '0';
		
		$data['selectedDistrict']=0;
		$data['selectedMandal'] = 0;
		$data['selectedSchool']=0;
		
		
		
		if( $this->input->post('applications_filter') )
		{
			if( trim($this->input->post('districts'))>0)
			{
				$selectedDistrict = trim($this->input->post('districts'));
				$data['selectedDistrict'] = $selectedDistrict;
				$this->session->set_userdata('selectedDistrict',$selectedDistrict);
				
				$cond['cmm.District'] = $selectedDistrict;
				
				$mandalcond['DistrictId'] = $selectedDistrict;
				
				$tbl = "mandals";
				$fields='MandalName,MandalId';
	
				$data['mandals'] = $this->Commonmodel->getRows_fields($tbl,$mandalcond,$fields,$order_by='',$order_by_field='',$limit='');
				
			}
			else
			{
				$data['selectedDistrict'] = 0;
				$this->session->set_userdata('selectedDistrict','');	
			}
				
			
			if( trim($this->input->post('Mandals'))>0)
			{
				$selectedMandal = trim($this->input->post('Mandals'));
				$data['selectedMandal'] = $selectedMandal;
				
				$this->session->set_userdata('selectedMandal',$selectedMandal);

				$cond['cmm.Mandal']   = $selectedMandal;
				
				$schoolcond = array();
				
				$schoolcond['DistrictId'] = $selectedDistrict;
				$schoolcond['MandalId'] = $selectedMandal;
				
				$tbl = "schools";
				$fields='SchoolName,SchoolId';
				
				$data['schools'] = $this->Commonmodel->getRows_fields($tbl,$schoolcond,$fields,$order_by='',$order_by_field='',$limit='');
				
				
				
				$selectedSchool = trim($this->input->post('Schools'));
				$data['selectedSchool'] = $selectedSchool;
				
			}
			else
			{
				$data['selectedSchool'] = 0;
				$data['selectedMandal'] = 0;
				$this->session->set_userdata('selectedMandal','');
			}

			if( trim($this->input->post('Schools'))>0)
			{
				$selectedSchool = trim($this->input->post('Schools'));
				$data['selectedSchool'] = $selectedSchool;
				$this->session->set_userdata('selectedSchool',$selectedSchool);
				$cond['cmm.School']   = $selectedSchool;
				
			}
			else
			{
				$data['selectedSchool'] = 0;
				$this->session->set_userdata('selectedSchool','');
			}
			
			if( trim($this->input->post('SelectedExamcenter'))>0)
			{
				
				$SelectedExamcenter = $this->input->post('SelectedExamcenter');
				
				$cond['cmm.ExamCenter']   = $SelectedExamcenter;
				
				$data['SelectedExamcenter'] = $SelectedExamcenter;
				$this->session->set_userdata('SelectedExamcenter',$SelectedExamcenter);
				
				
				$examcentercond = array();
				$table = 'examcenters';
				$examcentercond['CenterId'] = $this->session->userdata('SelectedExamcenter');
				
				$SelectedExamcenterName = $this->Commonmodel->getAfield($table,$examcentercond,$field='CenterName',$order_by='',$order_by_field='',$limit='');
				
				$data['CenterName'] = $SelectedExamcenterName;
				
				#echo $this->db->last_query(); exit; 
				
			}
			else
			{
				$data['SelectedExamcenter'] = '';
				$this->session->set_userdata('SelectedExamcenter','');
			}
			
			
		}
		else
		{
			
			if( $this->session->userdata('selectedDistrict')!='' )
			{
				$selectedDistrict = $this->session->userdata('selectedDistrict');
				
				$data['selectedDistrict'] = $selectedDistrict;
				$this->session->set_userdata('selectedDistrict',$selectedDistrict);
				
				$cond['cmm.District'] = $selectedDistrict;
				
				$mandalcond['DistrictId'] = $selectedDistrict;
				
				$tbl = "mandals";
				$fields='MandalName,MandalId';
	
				$data['mandals'] = $this->Commonmodel->getRows_fields($tbl,$mandalcond,$fields,$order_by='',$order_by_field='',$limit='');
			}
			else
			{
				$data['selectedDistrict']=0;
				$data['mandals'] =0;
				$this->session->set_userdata('selectedDistrict','');
			}
			
			if( $this->session->userdata('selectedMandal')!='' )
			{
				$selectedMandal = $this->session->userdata('selectedMandal');
				
				$data['selectedMandal'] = $selectedMandal;
				
				$this->session->set_userdata('selectedMandal',$selectedMandal);

				$cond['cmm.Mandal']   = $selectedMandal;
				
				$schoolcond = array();
				
				$schoolcond['DistrictId'] = $selectedDistrict;
				$schoolcond['MandalId'] = $selectedMandal;
				
				$tbl = "schools";
				$fields='SchoolName,SchoolId';
				
				$data['schools'] = $this->Commonmodel->getRows_fields($tbl,$schoolcond,$fields,$order_by='',$order_by_field='',$limit='');
				$selectedSchool = trim($this->input->post('Schools'));
				$data['selectedSchool'] = $selectedSchool;
	
			}
			else
			{
				$data['selectedSchool'] = 0;
				$data['selectedMandal'] = 0;
				$this->session->set_userdata('selectedMandal','');
			}
			
			if( $this->session->userdata('selectedSchool','')!='' )
			{
				$selectedSchool = $this->session->userdata('selectedSchool');
				
				$data['selectedSchool'] = $selectedSchool;
				$this->session->set_userdata('selectedSchool',$selectedSchool);
				$cond['cmm.School']   = $selectedSchool;	
			}
			else
			{
				$data['selectedSchool'] = 0;
				$this->session->set_userdata('selectedSchool','');	
			}
			
			if( $this->session->userdata('SelectedExamcenter')!='' )
			{
				$SelectedExamcenter = $this->session->userdata('SelectedExamcenter');
				$cond['cmm.ExamCenter']   = $SelectedExamcenter;
				$data['SelectedExamcenter'] = $SelectedExamcenter;
				$this->session->set_userdata('SelectedExamcenter',$SelectedExamcenter);
				
				
				$examcentercond = array();
				$table = 'examcenters';
				$examcentercond['CenterId'] = $this->session->userdata('SelectedExamcenter');
				
				$SelectedExamcenterName = $this->Commonmodel->getAfield($table,$examcentercond,$field='CenterName',$order_by='',$order_by_field='',$limit='');
				$data['CenterName'] = $SelectedExamcenterName;
				
					
			}
			else
			{
				$data['SelectedExamcenter'] = '';
				$this->session->set_userdata('SelectedExamcenter','');
			}
			
			
		}
		
		$cond['YEAR(cmm.AppliedOn)'] = date('Y');
		
		$table = 'applicantdetails as app';
		$baseurl='admin/view-all-applications';
		$perpage=20;
		$order_by_field='ApplicationNo';
		$datastring='Applications';
		$pagination_string = 'pagination_string';
		
		
		$all_Applications = $this->tsmpaginate->applications($cond,$baseurl,$perpage,$order_by_field,$datastring,$pagination_string);
		
		if( $all_Applications['Applications']!='0')
		{

			$data['perpage']= $perpage;
			$data['Applications'] = $all_Applications['Applications'];
			$data['pagination_string'] = $all_Applications['pagination_string'];
			
			$this->load->view('Admin/view-all-applications',$data);	
		}
		else
		{
			
			$data['Applications'] = '0';
			if( $this->uri->segment(3)!='')
				{
					if($this->uri->segment(3)>0)
					{
						$paginate=$this->uri->segment(3)-1;
						redirect(base_url('admin/view-all-applications/'.$paginate));
					}
					else
					{
						$data['routeto'] = 'admin/view-all-applications';
						$this->load->view('Admin/page-not-found',$data);
					}
				}
			else
			{
				//$this->load->view('Admin/view-all-applications',$data);	
						$data['routeto'] = 'admin/view-all-applications';
						$this->load->view('Admin/page-not-found',$data);
			}
			
		}
		
		
		$this->load->view(FOOTER);
	}
	
	public function downloadmarkslist()
	{
		
		$cond=array();
		
		$cond['ApplicationNo'] = $this->uri->segment(3);
		$table ='marksmemos';
		$field = 'MemoPath';
		
		$file_name = FCPATH.$this->Commonmodel->getAfield($table,$cond,$field,$order_by='',$order_by_field='',$limit='');
	
		echo $file_name;
	}
	
	public function viewstudentapplication()
	{
		
		
		$this->load->view(HEADER);
		
		$cond = array();
		$table = 'applicantdetails';
		
		$cond['ApplicationNo'] = $this->uri->segment(3);
		
		
		if( $this->Commonmodel->checkexists($table,$cond) )
		{
			
			//get the info of the applicant
			
			$this->db->select("app.*,cmm.*, dis.DistrictName, mndl.MandalName, schl.SchoolName,mrks.MemoPath ");
			$this->db->from('applicantdetails as app');
			$this->db->join('communicationdetails as cmm','cmm.ApplicationNo=app.ApplicationNo');
			
			$this->db->join('districts as dis','cmm.District=dis.DistrictId');
			$this->db->join('mandals as mndl','cmm.Mandal=mndl.MandalId');
			$this->db->join('schools as schl','cmm.School=schl.SchoolId');
			$this->db->join('marksmemos as mrks','mrks.ApplicationNo=app.ApplicationNo');
			$this->db->where('app.ApplicationNo',$this->uri->segment(3));
			$qry = $this->db->get('');
			
			$data['applicantdetails'] = $qry;
			
			$this->load->view('Admin/view-student-application',$data);	
		}
		else
			$this->load->view('Admin/page-not-found');	
		
		
		
		
		
		
		$this->load->view(FOOTER);
		
	}
	
	
	
	public function verifymarks()
	{
		$this->load->view(HEADER);
		$this->load->view('Admin/verify-marks');	
		$this->load->view(FOOTER);
	}
	
	public function schoolwisetoppers()
	{
		$this->load->view(HEADER);
		$table = 'districts';
		$fields='DistrictName, DistrictId';
		$cond = array();
		$mandalcond = array();
		$schoolcond = array();
		
		$districts = $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='DistrictName',$limit='');
		
		$data['districts'] = $districts;
		$data['mandals'] = '0';
		$data['schools'] = '0';
		
		$data['selectedDistrict']=0;
		$data['selectedMandal'] = 0;
		$data['selectedSchool']=0;
		
		
		
		if( $this->input->post('schoolwise_filter') )
		{
			
			if( trim($this->input->post('districts'))>0)
			{
				$selectedDistrict = trim($this->input->post('districts'));
				$data['selectedDistrict'] = $selectedDistrict;
				$this->session->set_userdata('selectedDistrict',$selectedDistrict);
				
				$mandalcond['DistrictId'] = $selectedDistrict;
	
				$tbl = "mandals";
				$fields='MandalName,MandalId';
	
				$data['mandals'] = $this->Commonmodel->getRows_fields($tbl,$mandalcond,$fields,$order_by='',$order_by_field='',$limit='');
				
				$cond['ver.District'] = $selectedDistrict;
			}
			
			else
			{
				$data['selectedDistrict'] = 0;
				$this->session->set_userdata('selectedDistrict','');	
			}
			
			if( trim($this->input->post('Mandals'))>0)
			{
				$selectedMandal = trim($this->input->post('Mandals'));
				$data['selectedMandal'] = $selectedMandal;
				
				$this->session->set_userdata('selectedMandal',$selectedMandal);
				
				
				$schoolcond = array();
				
				$schoolcond['DistrictId'] = $selectedDistrict;
				$schoolcond['MandalId'] = $selectedMandal;
				
				$tbl = "schools";
				$fields='SchoolName,SchoolId';
				
				$data['schools'] = $this->Commonmodel->getRows_fields($tbl,$schoolcond,$fields,$order_by='',$order_by_field='',$limit='');
				
				
				
				$selectedSchool = trim($this->input->post('Schools'));
				$data['selectedSchool'] = $selectedSchool;
				
				$cond['ver.Mandal'] = $selectedMandal;
				
			}	
			else
			{
				$data['selectedMandal'] = 0;
				$this->session->set_userdata('selectedMandal','');
			}

			if( trim($this->input->post('Schools'))>0)
			{
				$selectedSchool = trim($this->input->post('Schools'));
				$data['selectedSchool'] = $selectedSchool;
				$this->session->set_userdata('selectedSchool',$selectedSchool);
				
				$cond['ver.School'] = $selectedSchool;
				
			}
			else
			{

				$data['selectedSchool'] = 0;
				$this->session->set_userdata('selectedSchool','');	
			}
			
		
		}
		else
		{
			
			if($this->session->userdata('selectedDistrict')!='')
			{
				$selectedDistrict = $this->session->userdata('selectedDistrict');
				$data['selectedDistrict'] = $selectedDistrict;
				$this->session->set_userdata('selectedDistrict',$selectedDistrict);
				
				$mandalcond['DistrictId'] = $selectedDistrict;
	
				$tbl = "mandals";
				$fields='MandalName,MandalId';
	
				$data['mandals'] = $this->Commonmodel->getRows_fields($tbl,$mandalcond,$fields,$order_by='',$order_by_field='',$limit='');
				
				$cond['ver.District'] = $selectedDistrict;	
			}
			else
			{
				$data['selectedDistrict'] = 0;
				$this->session->set_userdata('selectedDistrict','');	
			}
			
			if($this->session->userdata('selectedMandal')!='')
			{
				
				$selectedMandal = $this->session->userdata('selectedMandal');
				$data['selectedMandal'] = $selectedMandal;
				
				$this->session->set_userdata('selectedMandal',$selectedMandal);

				$schoolcond = array();
				
				$schoolcond['DistrictId'] = $selectedDistrict;
				$schoolcond['MandalId'] = $selectedMandal;
				
				$tbl = "schools";
				$fields='SchoolName,SchoolId';
				
				$data['schools'] = $this->Commonmodel->getRows_fields($tbl,$schoolcond,$fields,$order_by='',$order_by_field='',$limit='');
				
				
				
				$selectedSchool = trim($this->input->post('Schools'));
				$data['selectedSchool'] = $selectedSchool;
				
				$cond['ver.Mandal'] = $selectedMandal;
				
				
			}
			else
			{
				$data['selectedMandal'] = 0;
				$this->session->set_userdata('selectedMandal','');
			}
			
			if($this->session->userdata('selectedSchool')!='')
			{
				$selectedSchool = $this->session->userdata('selectedSchool');
				$data['selectedSchool'] = $selectedSchool;
				$this->session->set_userdata('selectedSchool',$selectedSchool);
				$cond['ver.School'] = $selectedSchool;	
			}
			else
			{
				$data['selectedSchool'] = 0;
				$this->session->set_userdata('selectedSchool','');	
			}
			
			
		}
		
		$cond['YEAR(cmm.AppliedOn)'] = date('Y');
		
		$table = 'verifiedapplications as ver';
		$baseurl='admin/schoolwise-toppers';
		$perpage=20;
		$order_by_field='ver.ApplicationNo';
		$datastring='VerifiedApplicants';
		$pagination_string = 'pagination_string';
		
		
		$all_Applications = $this->tsmpaginate->VerifiedApplicants($cond,$baseurl,$perpage,$order_by_field,$datastring,$pagination_string);
		
		if( $all_Applications['VerifiedApplicants']!='0')
		{
		

			$data['perpage']= $perpage;
			$data['VerifiedApplicants'] = $all_Applications['VerifiedApplicants'];
			$data['pagination_string'] = $all_Applications['pagination_string'];
			
			$this->load->view('Admin/schoolwise-toppers',$data);	
		}
		else
		{
			
			$data['VerifiedApplicants'] = '0';
			if( $this->uri->segment(3)!='')
				{
					if($this->uri->segment(3)>0)
					{
						$paginate=$this->uri->segment(3)-1;
						redirect(base_url('admin/schoolwise-toppers/'.$paginate));
					}
					else
					{
						$data['routeto'] = 'admin/schoolwise-toppers';
						$this->load->view('Admin/page-not-found',$data);
					}
				}
			else
			{
				//$this->load->view('Admin/view-all-applications',$data);	
						$data['routeto'] = 'admin/view-all-applications';
						$this->load->view('Admin/page-not-found',$data);
			}
			//$this->load->view('Admin/schoolwise-toppers',$data);	
		}

		
		$this->load->view(FOOTER);
	
	}
	
	
	
	public function changepassword()
	{
		$this->load->view(HEADER);
		
		if( $this->input->post('chngpwd') )
		{
				$this->form_validation->set_rules( $this->config->item('ChangePwd') );
			
				if( $this->form_validation->run() === false) { 	$this->load->view('Admin/change-password'); }
				else
				{	
					$cond = array();
					$table='logins';
					$setdata = array();
					
					$confirmpassword = $this->input->post('confirmpassword');
					
					
					$cond['LoginId'] = $this->session->userdata('LoginId');
					$setdata['Password'] = md5($confirmpassword);	
					
					$setdata['LastUpdate'] = time();	
					
					if( $this->Commonmodel->updatedata($table,$setdata,$cond) )
					{
						$msg = '<span class="alert alert-success">Password updated successfully</span>';
						$this->session->set_flashdata('chngPwd_msg',$msg);
					}
					else
					{
						$msg = '<span class="alert alert-danger">Failed to update password</span>';
						$this->session->set_flashdata('chngPwd_msg',$msg);
					}
					redirect(base_url('change-password'));
					
				}
		
		}
		else
		$this->load->view('Admin/change-password');	
		
		$this->load->view(FOOTER);
	
	}
	

	public function addcenters()
	{
		
		$districts = $this->Commonmodel->getrows($table='districts',$cond=array(),$order_by='',$order_by_field='',$limit='');
		
		
		if($districts!='0')
			$data['districts'] = $districts;
		
		
		
		
		$this->load->view(HEADER);
			
		if( $this->input->post('addexamcenter'))	
		{
			$insertdata = array();
			$table = 'examcenters';
			
			$insertdata['CenterName'] = $this->input->post('CenterName');
			$insertdata['DistrictId'] = $this->input->post('DistrictId');
			$insertdata['LastUpdated'] = time();
			
			$this->Commonmodel->insertdata($table,$insertdata);
			
		}
			$this->load->view('Admin/add-exam-centers',$data);
			
		$this->load->view(FOOTER);
		
	}
	//addcenters ends here
	
	public function resetapplicationfilter()
	{
		$this->session->set_userdata('selectedSchool','');	
		$this->session->set_userdata('selectedMandal','');
		$this->session->set_userdata('selectedDistrict','');
		$this->session->set_userdata('SelectedExamcenter','');

		
		redirect(base_url('admin/view-all-applications'));
	}


	public function resetschoolwisefilter()
	{
		$this->session->set_userdata('selectedSchool','');	
		$this->session->set_userdata('selectedMandal','');
		$this->session->set_userdata('selectedDistrict','');
		$this->session->set_userdata('SelectedExamcenter','');

		
		redirect(base_url('admin/schoolwise-toppers'));
	}


	//custom callbacks
	
	public function checkcurrentpwd($currentPwd)
	{
		$cond = array();
		$table = 'logins';
		
		$cond['LoginId'] = $this->session->userdata('LoginId');
		$cond['Password'] = md5($currentPwd);
		
		if( $this->Commonmodel->checkexists($table,$cond))
			return true;	
		else
			{
				if(trim($currentPwd)!='')
				{
					$this->form_validation->set_message('checkcurrentpwd','Check your current password');
					return false;
				}
				else
				{
					$this->form_validation->set_message('checkcurrentpwd','Enter Current Password');
					return false;
				}
			}
			
	}
	
	//custom callbacks ends here
	
	public function logout()
	{
		$this->session->set_userdata('adminId','');
		$this->session->set_userdata('LoginId','');	
		redirect(base_url('admin'));
	}
	
}//class ends here

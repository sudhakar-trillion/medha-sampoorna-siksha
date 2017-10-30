<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requestdispatcher extends CI_Controller {

public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('Commonmodel');
	}


	public function striptags($posted_data)
		{
			
			
		
			$requested_from =  $_SERVER['HTTP_REFERER'];
			
			
		if( strpos($requested_from, 'localhost') !== false || strpos($requested_from, 'trillionit.in') !== false)
			//if( strpos($requested_from, 'trillionit.in') !== false)
			{
			//foreach($posted_data as $key=>$val) { $_POST[$key] = htmlentities( stripslashes(strip_tags($val)), ENT_QUOTES | ENT_HTML5, 'UTF-8'); }
			foreach($posted_data as $key=>$val) 
			{ 
			$str = stripslashes(str_replace("'","",$val));
			//The following to sanitize a string. It will both remove all HTML tags, and all characters with ASCII value > 127, from the string:
			$_POST[$key] = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
			
			}
			return $_POST;	
			}
			else
			echo "!!!! Access denied !!!!"; exit; 
		
		
		}

	public function getmandals()
	{
		
		$postdata = $this->striptags($_POST);
		$cond = array();
		$table  = 'mandals';
		
		extract($postdata);
		
		$cond['DistrictId'] = $DistrictId;
		$fields='MandalId,MandalName';
		
		$data = $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='MandalName',$limit='');
		
		$output=array();
		
		if($data->num_rows()>0)
		{
			foreach( $data->result() as $mandals)
			{
				$output[] = array(
									"MandalId"=>$mandals->MandalId,
									"MandalName"=>str_replace("(MANDAL)","",$mandals->MandalName)
									);	
			}
			echo json_encode($output);
		}
		else
		{
			echo "0";
		}
	}
	//get mandals ends here
	
	
	//getschools starts here
	
	
	public function getschools()
	{
		
		$postdata = $this->striptags($_POST);
		$cond = array();
		$table  = 'schools';
		
		extract($postdata);
		
		$cond['DistrictId'] = $DistrictId;
		$cond['MandalId'] = $MandalId;
		$fields='SchoolId,SchoolName';
		
		$data = $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='ASC',$order_by_field='SchoolName',$limit='');
		
		$output=array();
		
		if($data->num_rows()>0)
		{
			foreach( $data->result() as $sch)
			{
				$output[] = array(
									"SchoolId"=>$sch->SchoolId,
									"SchoolName"=>$sch->SchoolName
									);	
			}
			echo json_encode($output);
		}
		else
		{
			echo "0";
		}
	}
	//get getschools ends here
	
	
//get_applicantdetails

	public function get_applicantdetails()
	{
		$postdata = $this->striptags($_POST);
		$cond = array();
		$table  = 'applicantdetails';
		
		extract($postdata);
		
		$cond['ApplicationNo'] = $ApplicationNo;
		
		echo $this->Commonmodel->checkexists($table,$cond);
	}

///get_applicantdetails ends here	
	
//updateninethmarks

	public function updateninethmarks()
	{
		
		$postdata = $this->striptags($_POST);
		$cond = array();
		$table  = 'communicationdetails';
		
		extract($postdata);
		
		$cond['ApplicationNo'] = $ApplicationNo;
		
		
		$fields='District,Mandal,School,NinethMarks';
		
		$qry = $this->Commonmodel->getRows_fields($table,$cond,$fields,$order_by='',$order_by_field='',$limit='');
		foreach($qry->result() as $data)
		{
				$District = $data->District;
				$Mandal	= $data->Mandal;
				$School = $data->School;
				$NinethMarks= $data->NinethMarks;
		}
		
		$cond = array();
		
		$cond['ApplicationNo'] = $ApplicationNo;
		$cond['District'] = $District;
		
		$cond['Mandal']	= $Mandal;
		$cond['School'] = $School;
		
		$cond['YEAR(ForYear)'] = date('Y');
		$table ='verifiedapplications';
		
		$setdata = array();
		$insertdata = array();
		
		
		if( $this->Commonmodel->checkexists($table,$cond) )
		{
			
			if($ninethmarks!='')
			{
				$setdata['Marks'] = $ninethmarks;
				
					$cond = array();
					$table1 = 'communicationdetails';
					
					$cond['ApplicationNo'] = $ApplicationNo;
					
					$setdata1 = array();					
					$settdata1['NinethMarks'] = $NinethMarks;
					$settdata1['LastUpdated'] = time();
					
			}
			
			$cond = array();
			
			$cond['ApplicationNo'] = $ApplicationNo;
			$cond['District'] = $District;
			
			$cond['Mandal']	= $Mandal;
			$cond['School'] = $School;
			
			$cond['YEAR(ForYear)'] = date('Y');
			$table ='verifiedapplications';
			

			$setdata['District'] = $District;
			
			$setdata['Mandal']	= $Mandal;
			$setdata['School'] = $School;
			
			
			
			$setdata['ForYear'] = date('Y-m-d');
			
			$setdata['Status']	= 'Verified';
			$setdata['LastUpdated'] = time();
			
			if( $this->Commonmodel->updatedata($table,$setdata,$cond))
				{
					$this->Commonmodel->updatedata($table1,$setdata1,$cond);	
					echo "1";
					
				}
			else
				echo "0";	
		}
		else
		{
			$insertdata['ApplicationNo'] = $ApplicationNo;
			$insertdata['District'] = $District;
			
			$insertdata['Mandal']	= $Mandal;
			$insertdata['School'] = $School;

			if( $ninethmarks!='' )
				$insertdata['Marks'] = $ninethmarks;
			else
			{
				$insertdata['Marks'] = $NinethMarks;
				$ninethmarks = $NinethMarks;
			}

			$insertdata['ForYear'] = date('Y-m-d');
			
			$insertdata['Status']	= 'Verified';
			$insertdata['LastUpdated'] =time();
			
			/*echo "<pre>";
			print_r($insertdata);			
			exit;*/
			
			if( $this->Commonmodel->insertdata($table,$insertdata) )
				{
					echo "1";
					
					$cond = array();
					$table = 'communicationdetails';
					
					$cond['ApplicationNo'] = $ApplicationNo;
					
					$setdata = array();					
					$setdata['NinethMarks'] = $ninethmarks;
					$setdata['LastUpdated'] = time();
					
					$this->Commonmodel->updatedata($table,$setdata,$cond);
				}
			else
				echo "0";
			
		}
		
	}
//updateninethmarks ends here

	//getExamcenters starts here
	
	public function getExamcenters()
	{
	
		
		$cond = array();
		$table  = 'examcenters';
		
		
		
		$outputarr =array();
		
		$this->db->select('CenterName, CenterId');
		$this->db->from($table);
		$this->db->like('CenterName',$_POST['wildcard']);
		$this->db->order_by('CenterName','ASC');
		$qry = $this->db->get();
		
		
		$examcenters ='';
		
		if($qry!='0')
		{
			
			foreach($qry->result() as $data)
			{
				$examcenters.="<li class='autosuggestlist' centerid='".$data->CenterId."'>".$data->CenterName."</li>";
			}
		
			echo $examcenters;
		}
		else
		{
			echo "0";
		}
		
		
			
					
	}
	
	//getExamcenters ends here

//generateHallticket starts here

	public function generateHallticket()
	{
		$postdata = $this->striptags($_POST);
		$cond = array();
		
		extract($postdata);
		
		$cond['ApplicationNo'] = $hallticket;
		$cond['YEAR(ForYear)'] = date('Y');
		$table ='applicanthalltickets';
		
		$exists = $this->Commonmodel->checkexists($table,$cond);

		if( $exists =='0')
		{
			
			
			$cond = array();
			$qry = $this->db->query("SELECT app.FatherName as FatherName, app.MotherName as MotherName, date_format(app.DOB,'%d-%m-%Y') as DOB, CONCAT(app.FirstName, ' ', app.LastName) as StudentName, `app`.`PicPath` as `PicPath`, cen.CenterName, sch.SchoolName FROM `communicationdetails` as `cmm` JOIN `applicantdetails` as `app` ON `cmm`.`ApplicationNo`=`app`.`ApplicationNo` join examcenters as cen on cen.CenterCode=cmm.ExamCenter join schools as sch on sch.SchoolId=cmm.School where cmm.ApplicationNo='".$hallticket."'");

#echo $this->db->last_query(); 
	$jsonOutput = array();
	
		if( $qry->num_rows()>0)
		{
			foreach( $qry->result() as $data)	
			{
				$jsonOutput['StudentName'] = $data->StudentName;
				$jsonOutput['ApplicationNo'] = $hallticket;
				$jsonOutput['DOB'] = $data->DOB;
				$jsonOutput['SchoolName'] = $data->SchoolName;
				$jsonOutput['CenterName'] = $data->CenterName;
				
				$jsonOutput['MotherName'] = $data->MotherName;
				$jsonOutput['FatherName'] = $data->FatherName;
				
				$jsonOutput['PicPath'] = $data->PicPath;
			}
			
			$table ='applicanthalltickets';
			$insertdata = array();
			
			$insertdata['ApplicationNo'] = $hallticket;
			$insertdata['ForYear'] = date('Y-m-d');
			$insertdata['LastUpdated'] = time();
			
			$this->Commonmodel->insertdata($table,$insertdata);
			
			$url="http://alerts.solutionsinfini.com/api/v4/";
			
			$table = 'communicationdetails';
			$cond['ApplicationNo'] = $hallticket;
			
			$field = 'ContactNumber';
			
			$ContactNumber = $this->Commonmodel->getAfield($table,$cond,$field,$order_by='',$order_by_field='',$limit='');
			
			
			//$ContactNumber = "9010691937";
			
			//$ContactNumber ='8499032661' ;
			
			$msg="Your Hallticket with application no. ".$hallticket." has been generated. Visit ".base_url('download-hallticket')." to download hallticket";
			
//			$msg = "Dear: ".ucwords(strtolower($data->StudentName))." your hallticket with application no.".$hallticket." for MSS exam has been generated kindly visit ".base_url('download-hallticket')." to download hallticket";
			
			$request = "api_key=A74036853687e4c319df659e5bd6e51d3&format=json&method=sms&message=".$msg."&to=".$ContactNumber."&sender=MCTMSS";
			
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
			$response=curl_exec($ch);
			
			
			echo json_encode($jsonOutput);
		}
		else
			echo "0";
		
		
		}
		else
		{
			//echo $this->db->last_query();
			echo "-1";
		}
			
			
	}

//generateHallticket ends here

//checkApplicationnumber

public function checkApplicationnumber()
{
	
	
		$postdata = $this->striptags($_POST);
		$cond = array();
		
		extract($postdata);
		
		$cond['ApplicationNo'] = $hallticket;
		$cond['YEAR(ForYear)'] = date('Y');
		$table ='applicanthalltickets';
		
		$exists = $this->Commonmodel->checkexists($table,$cond);
		
		if( $exists!='0')
		{
			
			
			$cond = array();
			$qry = $this->db->query("SELECT app.FatherName as FatherName, app.MotherName as MotherName, date_format(app.DOB,'%d-%m-%Y') as DOB, CONCAT(app.FirstName, ' ', app.LastName) as StudentName, `app`.`PicPath` as `PicPath`, cen.CenterName, sch.SchoolName FROM `communicationdetails` as `cmm` JOIN `applicantdetails` as `app` ON `cmm`.`ApplicationNo`=`app`.`ApplicationNo` join examcenters as cen on cen.CenterCode=cmm.ExamCenter join schools as sch on sch.SchoolId=cmm.School where cmm.ApplicationNo='".$hallticket."'");

#echo $this->db->last_query(); 
	$jsonOutput = array();
	
		if( $qry->num_rows()>0)
		{
			foreach( $qry->result() as $data)	
			{
				$jsonOutput['StudentName'] = $data->StudentName;
				$jsonOutput['ApplicationNo'] = $hallticket;
				$jsonOutput['DOB'] = $data->DOB;
				$jsonOutput['SchoolName'] = $data->SchoolName;
				$jsonOutput['CenterName'] = $data->CenterName;
				
				$jsonOutput['MotherName'] = $data->MotherName;
				$jsonOutput['FatherName'] = $data->FatherName;
				
				$jsonOutput['PicPath'] = $data->PicPath;
			}
			
			$table ='applicanthalltickets';
			$insertdata = array();
			
			$insertdata['ApplicationNo'] = $hallticket;
			$insertdata['ForYear'] = date('Y-m-d');
			$insertdata['LastUpdated'] = time();
			
			$this->Commonmodel->insertdata($table,$insertdata);
			
			
			echo json_encode($jsonOutput);
		}
		else
			echo "0";
		
		
		}
		else
		{
			//echo $this->db->last_query();
			echo "-1";
		}
			
			
		
}


//checkApplicationnumber

//sendApplicationNumber starts here

	public function sendApplicationNumber()
	{
		$postdata = $this->striptags($_POST);
			
		extract($postdata);
		
		$cond = array();
		$table='applicantdetails';
		
		$cond['AadharNumber'] = trim($AadharNumber);
		
		$DOB = date_create(trim($dob));
		$DOB = date_format($DOB,"Y-m-d");
		
		$cond['DOB'] = trim($DOB);
		
		
		$details = $this->Commonmodel->getRows_fields($table,$cond,$fields='FirstName,LastName,ApplicationNo',$order_by='',$order_by_field='',$limit='');
		if($details!='0')
		{
			foreach( $details->result() as $data)
			{
				$ApplicationNo = $data->ApplicationNo;
				$Student = $data->FirstName." ".$data->LastName;
			}
			echo $ApplicationNo;
			/*
			
			$cond = array();
			$table = 'communicationdetails';
			
			$cond['ApplicationNo'] = $ApplicationNo;
			
			$Phone = $this->Commonmodel->getAfield($table,$cond,$field='ContactNumber',$order_by='',$order_by_field='',$limit='');
			
			echo "1";
			*/
			
		}
		else
			echo "0";
		
		
			
	}

//sendApplicationNumber ends here
	
} //class ends here

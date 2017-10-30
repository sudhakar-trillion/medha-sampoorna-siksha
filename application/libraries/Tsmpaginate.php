<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Tsmpaginate
	{
		public function __construct()
		{
			$this->CI =& get_instance();
			
			$this->CI->load->helper('url');
			$this->CI->config->item('base_url');
			$this->CI->load->database();	
			$this->CI->load->model('Commonmodel');
			$this->CI->load->library('pagination');
		}
		
		
		public function commonpaginationConfigs($table,$cond,$baseurl,$perpage)
		{
			$total_rows = $this->CI->Commonmodel->getnumRows($table,$cond);
			
			$config['base_url'] = $baseurl;
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			
			/* Pagination configuration style starts here */
			
			$config['full_tag_open'] = '<div><ul class="pagination">';
			$config['full_tag_close'] = '</ul></div><!--pagination-->';
			$config['first_link'] = '&laquo; First';
			$config['first_tag_open'] = '<li class="prev page">';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'Last &raquo;';
			$config['last_tag_open'] = '<li class="next page">';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = 'Next &rarr;';
			$config['next_tag_open'] = '<li class="next page">';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&larr; Previous';
			$config['prev_tag_open'] = '<li class="prev page">';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page">';
			$config['num_tag_close'] = '</li>';
			// $config['display_pages'] = FALSE;
			// 
			$config['anchor_class'] = 'follow_link';	
			return $config;
		
	}//commonpaginationConfigs ends here
	
		
		public function singletablePaginateion($table,$cond,$baseurl,$perpage,$order_by_field,$datastring,$pagination_string)
		{
			
			
			$total_rows = $this->CI->Commonmodel->getnumRows($table,$cond);

			$config['base_url'] = $baseurl;
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			
			/* Pagination configuration style starts here */
			
			$config['full_tag_open'] = '<div><ul class="pagination">';
			$config['full_tag_close'] = '</ul></div><!--pagination-->';
			$config['first_link'] = '&laquo; First';
			$config['first_tag_open'] = '<li class="prev page">';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'Last &raquo;';
			$config['last_tag_open'] = '<li class="next page">';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = 'Next &rarr;';
			$config['next_tag_open'] = '<li class="next page">';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&larr; Previous';
			$config['prev_tag_open'] = '<li class="prev page">';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page">';
			$config['num_tag_close'] = '</li>';
			// $config['display_pages'] = FALSE;
			// 
			$config['anchor_class'] = 'follow_link';
		
			/* Pagination configuration style ends here */		
			
			$this->CI->pagination->initialize($config);
			
			$data['page'] = ($this->CI->uri->segment(2)) ? (($this->CI->uri->segment(2))) : 0;
			
			$limit = $config["per_page"];
			
			if($data['page']==0)
			$start = 0;
			else
			$start = ($data['page']-1)*$config["per_page"];
			
			$data[$datastring] = $this->CI->Commonmodel->paginate($table,$cond,$order_by='DESC',$order_by_field,$limit,$start );
			$data[$pagination_string] = $this->CI->pagination->create_links();		
			
			return $data;	
				
		
		}
		
		
		
	public function applications($cond,$baseurl,$perpage,$order_by_field,$datastring,$pagination_string)
	{
			
			$table ='applicantdetails as app';
		
			$this->CI->db->select('app.ApplicationNo');
			$this->CI->db->from('applicantdetails as app');
			$this->CI->db->join('communicationdetails as cmm','app.ApplicationNo=cmm.ApplicationNo');
			$this->CI->db->where($cond);
			$qry = $this->CI->db->get();
			
			
			$total_rows = $qry->num_rows() ;
			
		#	echo $total_rows; exit; 
			
			$config['base_url'] = $baseurl;
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			
			/* Pagination configuration style starts here */
			
			$config['full_tag_open'] = '<div><ul class="pagination">';
			$config['full_tag_close'] = '</ul></div><!--pagination-->';
			$config['first_link'] = '&laquo; First';
			$config['first_tag_open'] = '<li class="prev page">';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'Last &raquo;';
			$config['last_tag_open'] = '<li class="next page">';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = 'Next &rarr;';
			$config['next_tag_open'] = '<li class="next page">';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&larr; Previous';
			$config['prev_tag_open'] = '<li class="prev page">';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="'.$baseurl.'">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page">';
			$config['num_tag_close'] = '</li>';
			
			$config['anchor_class'] = 'follow_link';
		
			/* Pagination configuration style ends here */		
			
			$this->CI->pagination->initialize($config);
			
				$data['page'] = ($this->CI->uri->segment(3)) ? (($this->CI->uri->segment(3))) : 0;
			
			$limit = $config["per_page"];
			
			if($data['page']==0)
			$start = 0;
			else
			$start = ($data['page']-1)*$config["per_page"];
			
			
			$data[$datastring] = $this->CI->Commonmodel->applications($cond,$order_by='',$order_by_field,$limit,$start );
#echo $this->CI->db->last_query();
			
			$data[$pagination_string] = $this->CI->pagination->create_links();		
			
			return $data;	
	}

		
		
		public function VerifiedApplicants($cond,$baseurl,$perpage,$order_by_field,$datastring,$pagination_string)
		{
			
			$table ='verifiedapplications as ver';
		
			$this->CI->db->select('ver.ApplicationNo');
			$this->CI->db->from('verifiedapplications as ver');
			$this->CI->db->join('communicationdetails as cmm','ver.ApplicationNo=cmm.ApplicationNo');
			$this->CI->db->where($cond);
			
			$this->CI->db->order_by('ver.District','ASC');
			$this->CI->db->order_by('ver.Mandal','ASC');
			$this->CI->db->order_by('ver.School','ASC');
			$this->CI->db->order_by('ver.Marks','DESC');
			
			$qry = $this->CI->db->get();
			
			
			$total_rows = $qry->num_rows() ;
			
		#echo $total_rows; exit; 
			
			$config['base_url'] = $baseurl;
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			
			/* Pagination configuration style starts here */
			
			$config['full_tag_open'] = '<div><ul class="pagination">';
			$config['full_tag_close'] = '</ul></div><!--pagination-->';
			$config['first_link'] = '&laquo; First';
			$config['first_tag_open'] = '<li class="prev page">';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'Last &raquo;';
			$config['last_tag_open'] = '<li class="next page">';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = 'Next &rarr;';
			$config['next_tag_open'] = '<li class="next page">';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&larr; Previous';
			$config['prev_tag_open'] = '<li class="prev page">';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="'.$baseurl.'">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page">';
			$config['num_tag_close'] = '</li>';
			
			$config['anchor_class'] = 'follow_link';
		
			/* Pagination configuration style ends here */		
			
			$this->CI->pagination->initialize($config);
			
				$data['page'] = ($this->CI->uri->segment(3)) ? (($this->CI->uri->segment(3))) : 0;
			
			$limit = $config["per_page"];
			
			if($data['page']==0)
			$start = 0;
			else
			$start = ($data['page']-1)*$config["per_page"];
			
			
			$data[$datastring] = $this->CI->Commonmodel->VerifiedApplicants($cond,$order_by='',$order_by_field,$limit,$start );
#echo $this->CI->db->last_query();
			
			$data[$pagination_string] = $this->CI->pagination->create_links();		
			
			return $data;	
	
				
		}
	
	
	
	
	
	
	}
	
?>
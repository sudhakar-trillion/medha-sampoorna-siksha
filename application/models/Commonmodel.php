<?PHP
class Commonmodel extends CI_Model
{
	public function checkexists($table,$cond)
	{
		$this->db->where($cond);
		$qry = $this->db->get($table);
		if($qry->num_rows()>0)
			return $qry->num_rows();
		else
			return "0";
		
	}
	
	
	public function getnumRows($table,$cond)	
	{
		$this->db->where($cond)	;
		
		$qry = $this->db->get($table);
		return  $qry->num_rows();
	}
	
	public function getRows_fields($table,$cond,$fields,$order_by,$order_by_field,$limit)
	{
		$this->db->select($fields);
		$this->db->from($table);
		
		if( sizeof($cond) )
		{
			$this->db->where($cond);
		}
		if($order_by!='')
		{
			$this->db->order_by($order_by_field,$order_by);
		}	
		if($limit!='')
		{
				$this->db->limit($limit);
		}
		$qry = $this->db->get('');
		
		if($qry->num_rows()>0)
		{
			return $qry;		
		}
		else
			return "0";
		
	}
	
	
	public function getRows_fields_groupby($table,$cond,$fields,$groupby,$order_by,$order_by_field,$limit)
	{
		$this->db->select($fields);
		$this->db->from($table);
		
		if( sizeof($cond) )
			$this->db->where($cond);
		if($order_by!='')
			$this->db->order_by($order_by_field,$order_by);
		if($limit!='')
				$this->db->limit($limit);
		if($groupby!='')
			$this->db->group_by($groupby);
		
		$qry = $this->db->get('');
		
		if($qry->num_rows()>0)
			return $qry;		
		else
			return "0";	
	}
	
	
	
	public function getAfield($table,$cond,$field,$order_by='',$order_by_field='',$limit='')
	{
		$this->db->select($field);
		$this->db->from($table);
		if( sizeof( count($cond) ) )
		{
			$this->db->where($cond);
		}
		if($order_by!='')
		{
			$this->db->order_by($order_by_field,$order_by);
		}	
		if($limit!='')
		{
				$this->db->limit($limit);
		}
		$qry = $this->db->get('');
		if($qry->num_rows()>0)
		{
			return $qry->row($field);			
		}else
			return "0";
		
	}
	
	//getAfieldWithalias($table,$cond,$field='sum(Paid)',$Alias='PaidTill',$order_by='',$order_by_field='',$limit='');
	
	public function getAfieldWithalias($table,$cond,$field,$Alias,$order_by='',$order_by_field='',$limit='')
	{
		$this->db->select($field." as $Alias");
		$this->db->from($table);
		if( sizeof( count($cond) ) )
		{
			$this->db->where($cond);
		}
		if($order_by!='')
		{
			$this->db->order_by($order_by_field,$order_by);
		}	
		if($limit!='')
		{
				$this->db->limit($limit);
		}
		$qry = $this->db->get('');
		if($qry->num_rows()>0)
		{
			return $qry->row($Alias);			
		}else
			return "0";
		
	}
	
	public function getrows($table,$cond,$order_by='',$order_by_field='',$limit='')
	{
		
		
		if( sizeof( count($cond) ) )
		{
			$this->db->where($cond);
		}
		if($order_by!='')
		{
			$this->db->order_by($order_by_field,$order_by);
		}	
		if($limit!='')
		{
				$this->db->limit($limit);
		}
		
		$qry = $this->db->get($table);
		if($qry->num_rows()>0)
		return $qry;
		else	
		return "0";
		
	}
	
	
	public function get_single_row($table,$cond,$order_by='',$order_by_field='',$limit='')
	{
		
		if( sizeof( count($cond) ) )
		{
			$this->db->where($cond);
		}
		if($order_by!='')
		{
			$this->db->order_by($order_by_field,$order_by);
		}	
		if($limit!='')
		{
				$this->db->limit($limit);
		}
		
		$qry = $this->db->get($table);
//		echo $this->db->last_query(); exit; 
		
		if($qry->num_rows()>0)
		return $qry;
		else	
		return "0";
	
	}
	
	public function insertdata($table,$data)
	{
		$this->db->insert($table,$data)	;
		return $this->db->insert_id();
		
	}
	
	
	public function updatedata($table,$data,$cond)	
	{
		$this->db->where($cond);
		$this->db->update($table,$data);
		return $this->db->affected_rows(); exit; 
//		echo $this->db->last_query(); exit; 
		if($this->db->affected_rows()>0)
			return "1";
		else
			return "0";
	}
	
	public function deleterow($table,$cond)
{
	$this->db->delete($table,$cond);
	return "1";	
}
	
	public function getsmtpdetails()
	{
			$this->db->select('user,password');
			$this->db->from('smtp_details');
			$this->db->limit(1);
			$qry = $this->db->get();

			if($qry->num_rows()>0)
				return $qry;
			else
				return "0";
		
					
	}
	
	public function getkeydetails($cond)
	{
		
			$this->db->select('EncKey');
			$this->db->from('getkeys');
			$this->db->where($cond);
			$this->db->limit(1);
			$qry = $this->db->get();

			if($qry->num_rows()>0)
				return $qry;
			else
				return "0";
	}



//general pagination 

	public function paginate($table,$cond,$order_by='',$order_by_field='',$limit,$start )
	{
		
		$this->db->select('*');
		$this->db->from($table);
		
		if( sizeof($cond) )
		{
			$this->db->where($cond);
		}
		if($order_by!='')
		{
			$this->db->order_by($order_by_field,$order_by);
		}	
		if($limit!='')
		{
				$this->db->limit($limit,$start);
		}
		$qry = $this->db->get('');

#		echo $this->db->last_query();
		if($qry->num_rows()>0)
		{
			return $qry;		
		}
		else
			return "0";
		
		
	}

//general pagination ends here
	
	public function applications($cond,$order_by='',$order_by_field,$limit,$start )
	{
		
		$this->db->select("app.ApplicationNo as ApplicationNo, CONCAT(app.FirstName,' ',app.LastName) as StudentName, app.AadharNumber as AadharNumber, cmm.ContactNumber, dis.DistrictName, mndl.MandalName, schl.SchoolName, cmm.NinethMarks");
		$this->db->from('applicantdetails as app');
		$this->db->join('communicationdetails as cmm','cmm.ApplicationNo=app.ApplicationNo');
		
		$this->db->join('districts as dis','cmm.District=dis.DistrictId');
		$this->db->join('mandals as mndl','cmm.Mandal=mndl.MandalId');
		$this->db->join('schools as schl','cmm.School=schl.SchoolId');

		if(!empty($cond))
			$this->db->where($cond);
	
		$this->db->order_by('app.ApplicationNo',"DESC");
	
		$this->db->limit($limit,$start);
		$qry = $this->db->get();
		
		#echo $this->db->last_query(); exit; 
				
		if($qry->num_rows()>0)
			return $qry;
		else
			return '0';		
		}


	public function VerifiedApplicants($cond,$order_by='',$order_by_field,$limit,$start )
	{
		$this->db->select("app.ApplicationNo as ApplicationNo, CONCAT(app.FirstName,' ',app.LastName) as StudentName, app.AadharNumber as AadharNumber, cmm.ContactNumber, dis.DistrictName, mndl.MandalName, schl.SchoolName, cmm.NinethMarks");
		$this->db->from('applicantdetails as app');
		$this->db->join('communicationdetails as cmm','cmm.ApplicationNo=app.ApplicationNo');

		$this->db->join('verifiedapplications as ver','ver.ApplicationNo=app.ApplicationNo');
		
		$this->db->join('districts as dis','cmm.District=dis.DistrictId');
		$this->db->join('mandals as mndl','cmm.Mandal=mndl.MandalId');
		$this->db->join('schools as schl','cmm.School=schl.SchoolId');

		if(!empty($cond))
			$this->db->where($cond);
	
		$this->db->order_by('app.ApplicationNo',"DESC");
	
		$this->db->limit($limit,$start);
		$qry = $this->db->get();
		
		#echo $this->db->last_query(); exit; 
				
		if($qry->num_rows()>0)
			return $qry;
		else
			return '0';	
	}

}//class ends here

?>
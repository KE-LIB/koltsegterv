<?php
class Login_model extends CI_Model {

      
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }
		public function loginMember($username,$password)
        {
			$name="";
			
			$this->load->database();
			$this->db->where('email', $username);
            $this->db->where('password', md5($password));
			$query = $this->db->get("kltsg_users");
			$rowcount = $query->num_rows();

			if($rowcount>0)
			{
			foreach ($query->result() as $row)
				{
				set_cookie('userid',$row->id,0);
				set_cookie('lvl',$row->level,0);
				$name=$row->last_name." ".$row->first_name." ".$row->level;
				return $name;
				}
			}
			else
			{
				$name="error";
			}
            return $name;
		
		}
        }
?>		
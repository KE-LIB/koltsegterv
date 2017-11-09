<?php
class Koltsegterv extends CI_Controller {
	
	   function __construct()
       {
            parent::__construct();
            //$data['title'] = ucfirst($page); // Capitalize the first letter
			/*if(isset($_COOKIE['userid']))
			{}
		else
		{
			redirect('/Koltsegterv/view/index', 'refresh');
		}*/
		$this->output->set_header('Content-Type: text/html; charset=utf-8');
      
       }
	public function view($page = 'index')
        {
			  if ( ! file_exists(APPPATH.'views/koltsegterv/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
               show_404();
			   echo "hopp A manóba! ".$page." nem található";
        }
		$data['title']="Költségtervező";
		$this->load->view('koltsegterv/header', $data);
        $this->load->view('koltsegterv/'.$page, $data);
        $this->load->view('koltsegterv/footer', $data);
		
	}
	public function Login()
	{
		$this->load->helper('form'); 
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('psw', 'psw', 'required');
	
		
	 if ($this->form_validation->run() === FALSE)
    {
		$data['message']="Ki kell tölteni minden mezőt!";
		$this->load->view('koltsegterv/header', $data);
        $this->load->view('koltsegterv/index', $data);
        $this->load->view('koltsegterv/footer', $data);
    }
    else
    {
		$this->load->model('Login_model');
		$name=$this->Login_model->LoginMember($_POST['email'],$_POST['psw']);
		
		if($name=="error")
		{
	    $data['message']='Rossz felhasználónév vagy jelszó';
		$this->load->view('koltsegterv/header', $data);
        $this->load->view('koltsegterv/index', $data);
        $this->load->view('koltsegterv/footer', $data);
		}
		else
		{
		$split_a=explode(" ",$name);
		$data['user']=$split_a[0]." ".$split_a[1] ;
		$data['message']='Szuper';
		$this->load->view('koltsegterv/headerLogin', $data);
		//echo $_COOKIE['lvl']; 
		if($split_a[2]=="1")
		{
        $this->load->view('koltsegterv/mainA', $data);
		}
		else
		{
		$this->load->view('koltsegterv/main', $data);
		}
        $this->load->view('koltsegterv/footer', $data);
		
		}
    }
	}
	
		public function loadPage()
		{
		$data['title']="Költségtervező";
		
		if($_POST['mit']=="main")
		{
			if($_COOKIE['lvl']=="1")
		{
        $this->load->view('koltsegterv/mainA', $data);
		}
		else
		{
		$this->load->view('koltsegterv/main', $data);
		}
		}
		elseif($_POST['mit']=="download")
		{
			if($_COOKIE['lvl']=="1")
			{
			
			setcookie("Ev",(date("Y")+1));
			$this->load->view('koltsegterv/downloadA', $data);
			}
			else
			{
			
			setcookie("Ev",(date("Y")+1));
			$this->load->view('koltsegterv/download', $data);
			}
		}
		else
		{
			
        $this->load->view('koltsegterv/'.$_POST['mit'], $data);
		}
		}
		public function loadAPage($mit)
		{
		
		$data['title']="Költségtervező";
		
		if($mit=="users")
		{
			$this->load->model('Helper_model');
			$query=$this->Helper_model->getUsers();
			$user=array();
			foreach($query->result() as $row)
			{
				$help=array();
				array_push($help,$row->last_name);
				array_push($help,$row->first_name);
				array_push($help,$row->level);
				array_push($help,$row->email);
				array_push($help,$row->id);
				array_push($user,$help);
			}
			$data['users']=$user;
			$query=$this->Helper_model->getEveryEgyseg();
			$egyseg=array();
			foreach($query->result() as $row)
			{
				$help=array();
				array_push($help,$row->itid);
				array_push($help,$row->itname);
				array_push($egyseg,$help);
			}
			$data['egyseg']=$egyseg;
			$query=$this->Helper_model->getEveryAlEgyseg();
			$alegyseg=array();
			foreach($query->result() as $row)
			{
				$help=array();
				array_push($help,$row->unitid);
				array_push($help,$row->unitname);
				array_push($help,$row->unitParent);
				array_push($alegyseg,$help);
			}
			$data['alegyseg']=$alegyseg;
		}
		if($mit=="instituts")
		{
			$this->load->model('Helper_model');
			$query=$this->Helper_model->getEveryEgyseg();
			$egyseg=array();
			foreach($query->result() as $row)
			{
				$help=array();
				array_push($help,$row->itid);
				array_push($help,$row->itname);
				array_push($egyseg,$help);
			}
			$data['egyseg']=$egyseg;
			$query=$this->Helper_model->getEveryAlEgyseg();
			$alegyseg=array();
			foreach($query->result() as $row)
			{
				$help=array();
				array_push($help,$row->unitid);
				array_push($help,$row->unitname);
				array_push($help,$row->unitParent);
				array_push($alegyseg,$help);
			}
			$data['alegyseg']=$alegyseg;
		}
		if($mit=="afa")
		{
			$this->load->model('Helper_model');
			$query=$this->Helper_model->getEveryAfa();
			$egyseg=array();
			foreach($query->result() as $row)
			{
				array_push($egyseg,$row->id);
				array_push($egyseg,$row->value);	
			}
			$data['afa']=$egyseg;
		}
		if($mit=="mertekEgyseg")
		{
			$this->load->model('Helper_model');
			$query=$this->Helper_model->getEveryMertek();
			$egyseg=array();
			foreach($query->result() as $row)
			{
				array_push($egyseg,$row->id);
				array_push($egyseg,$row->name);	
			}
			$data['mertek']=$egyseg;
		}
		if($mit=="kiadKod")
		{
			$this->load->model('Helper_model');
			$query=$this->Helper_model->getEveryKK();
			$egyseg=array();
			foreach($query->result() as $row)
			{
				array_push($egyseg,$row->id);
				array_push($egyseg,$row->code);
				array_push($egyseg,$row->name);	
				array_push($egyseg,$row->tax);	
			}
			$data['kk']=$egyseg;
		}
		if($mit=="bevKod")
		{
			$this->load->model('Helper_model');
			$query=$this->Helper_model->getEveryBK();
			$egyseg=array();
			foreach($query->result() as $row)
			{
				array_push($egyseg,$row->id);
				array_push($egyseg,$row->code);
				array_push($egyseg,$row->name);	
				array_push($egyseg,$row->tax);	
			}
			$data['bk']=$egyseg;
		}	
        $this->load->view('koltsegterv/'.$mit, $data);
		}
		
		public function deleteUser()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->deleteUser();
		}
		public function getModUser()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->getModUser();
		$return="";
		foreach ($query->result() as $sor)
		{
		$return=$sor->id.','.$sor->last_name.','.$sor->first_name.','.$sor->email.','.$sor->level;
		}
		$query=$this->Helper_model->GetUserAlegyseg();;
			
			foreach($query->result() as $row)
			{
				$return=$return.','.$row->unitid;
			}
		echo $return;
		}
		public function getInstUnits()
		{
		$this->load->model('Helper_model');
		
		$query=$this->Helper_model->getInst();
		$return=$_POST['id'];
		foreach ($query->result() as $sor)
		{
		$return=$return.','.$sor->name;
		}
		$query=$this->Helper_model->getInstUnits();
		foreach ($query->result() as $sor)
		{
		$return=$return.','.$sor->unitid;
		}
		echo $return;
		
		}
		public function getUnit()
		{
		$this->load->model('Helper_model');
		
		$query=$this->Helper_model->getUnit();
		$return=$_POST['id'];
		foreach ($query->result() as $sor)
		{
		$return=$return.','.$sor->name;
		}
		echo $return;
		
		}
		public function modUser()
		{
		$data['valami']="";
		$this->load->helper('form'); 
		$this->load->model('Helper_model');
		$this->Helper_model->saveUser();
		$query=$this->Helper_model->getUsers();
			$user=array();
			foreach($query->result() as $row)
			{
				$help=array();
				array_push($help,$row->last_name);
				array_push($help,$row->first_name);
				array_push($help,$row->level);
				array_push($help,$row->email);
				array_push($help,$row->id);
				array_push($user,$help);
			}
			$data['users']=$user;
			$query=$this->Helper_model->getEveryEgyseg();
			$egyseg=array();
			foreach($query->result() as $row)
			{
				$help=array();
				array_push($help,$row->itid);
				array_push($help,$row->itname);
				array_push($egyseg,$help);
			}
			$data['egyseg']=$egyseg;
			$query=$this->Helper_model->getEveryAlEgyseg();
			$alegyseg=array();
			foreach($query->result() as $row)
			{
				$help=array();
				array_push($help,$row->unitid);
				array_push($help,$row->unitname);
				array_push($help,$row->unitParent);
				array_push($alegyseg,$help);
			}
			$data['alegyseg']=$alegyseg;
		$this->load->view('koltsegterv/headerLogin', $data);
		$this->load->view('koltsegterv/users', $data);
        $this->load->view('koltsegterv/footer', $data);
		}
		public function saveModInst()
		{
		$data['valami']="";
		$this->load->helper('form'); 
		$this->load->model('Helper_model');
		$this->Helper_model->saveModInst();
		$query=$this->Helper_model->getEveryEgyseg();
			$egyseg=array();
			foreach($query->result() as $row)
			{
				$help=array();
				array_push($help,$row->itid);
				array_push($help,$row->itname);
				array_push($egyseg,$help);
			}
			$data['egyseg']=$egyseg;
			$query=$this->Helper_model->getEveryAlEgyseg();
			$alegyseg=array();
			foreach($query->result() as $row)
			{
				$help=array();
				array_push($help,$row->unitid);
				array_push($help,$row->unitname);
				array_push($help,$row->unitParent);
				array_push($alegyseg,$help);
			}
			$data['alegyseg']=$alegyseg;
		$this->load->view('koltsegterv/headerLogin', $data);
		$this->load->view('koltsegterv/instituts', $data);
        $this->load->view('koltsegterv/footer', $data);
		}
		public function saveModUnit()
		{
		$data['valami']="";
		$this->load->helper('form'); 
		$this->load->model('Helper_model');
		$this->Helper_model->saveModUnit();
		$query=$this->Helper_model->getEveryEgyseg();
			$egyseg=array();
			foreach($query->result() as $row)
			{
				$help=array();
				array_push($help,$row->itid);
				array_push($help,$row->itname);
				array_push($egyseg,$help);
			}
			$data['egyseg']=$egyseg;
			$query=$this->Helper_model->getEveryAlEgyseg();
			$alegyseg=array();
			foreach($query->result() as $row)
			{
				$help=array();
				array_push($help,$row->unitid);
				array_push($help,$row->unitname);
				array_push($help,$row->unitParent);
				array_push($alegyseg,$help);
			}
			$data['alegyseg']=$alegyseg;
		$this->load->view('koltsegterv/headerLogin', $data);
		$this->load->view('koltsegterv/instituts', $data);
        $this->load->view('koltsegterv/footer', $data);
		}
		public function getEgyseg()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->getEgyseg();
		foreach ($query->result() as $row)
		{
			echo "<option value=".$row->instid." selected>".$row->instname."</option>";
		}
		echo'<option value="999" selected>Válasszon...</option>';
		}
		public function addAfa()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->addAfa();
		}
		public function addMertek()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->addMertek();
		}
		public function addKK()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->addKK();
		}
		public function addBK()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->addBK();
		}
		public function ajaxGetAlegyseg()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->GetAlEgyseg();
		foreach ($query->result() as $row)
		{
			echo "<option value=".$row->unitid." selected>".$row->unitname."</option>";
		}
		echo'<option value="999" selected>Válasszon...</option>';
		}
		public function getAlegysegName()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->getAlegysegName();
		foreach ($query->result() as $row)
		{
			echo $row->alegyseg;
		}
		}
		public function getEgysegName()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->getEgysegName();
		foreach ($query->result() as $row)
		{
			echo $row->egyseg;
		}
		}
		public function loadForm()
		{
		$data['title']="Költségtervező";
		$this->load->model('Helper_model');
		$query=$this->Helper_model->getAlEgysegName($_POST['alEgyseg']);
		foreach ($query->result() as $row)
		{
			$data['alEgyseg']=$row->egyseg;
		}
		$query=$this->Helper_model->getEgysegName($_POST['egyseg']);
		foreach ($query->result() as $row)
		{
			$data['egyseg']=$row->egyseg;
		}
		$date=date("Y");
		$data['evek']=$date;
        $this->load->view('koltsegterv/form', $data);
		}
		public function fillKiadas()
		{
		$this->load->model('Helper_model');
		switch ($_POST['mit'])
		{
			case "rovat":
			$query=$this->Helper_model->getAllRovat();
			foreach ($query->result() as $row)
		{
			echo "<option value=".$row->id.">".$row->code." - ".$row->name."</option>";
		}
		echo '<option value="999" selected="selected">Válasszon...</option>';
			break;
			case "afa":
			$query=$this->Helper_model->getAllAfa();
			foreach ($query->result() as $row)
		{
			echo "<option value=".$row->value." >".$row->value." %</option>";
		}
		echo '<option value="999" selected="selected">Válasszon...</option>';
			break;	
			case "mertek":
			$query=$this->Helper_model->getAllMertek();
			foreach ($query->result() as $row)
		{
			echo "<option value=".$row->id.">".$row->name." </option>";
		}
		echo '<option value="999" selected="selected">Válasszon...</option>';
			break;
				
		case "cpv1":
			$query=$this->Helper_model->getAllCPV1();
			foreach ($query->result() as $row)
		{
			echo "<option value=".$row->id.">".$row->code." - ".$row->name." </option>";
		}
		echo '<option value="999" selected="selected">Válasszon...</option>';
			break;	
		case "cpv2":
			$query=$this->Helper_model->getCPV2();
			foreach ($query->result() as $row)
		{
			echo "<option value=".$row->id.">".$row->code." - ".$row->name." </option>";
		}
		echo '<option value="999" selected="selected">Válasszon...</option>';
		
		break;
		}
		
		}
		public function fillBevetel()
		{
		$this->load->model('Helper_model');
		switch ($_POST['mit'])
		{
			case "rovat":
			$query=$this->Helper_model->getAllBRovat();
			foreach ($query->result() as $row)
		{
			echo "<option value=".$row->id.">".$row->code." - ".$row->name."</option>";
		}
		echo '<option value="999" selected="selected">Válasszon...</option>';
			break;
			case "afa":
			$query=$this->Helper_model->getAllAfa();
			foreach ($query->result() as $row)
		{
			echo "<option value=".$row->value." >".$row->value." %</option>";
		}
		echo '<option value="999" selected="selected">Válasszon...</option>';
			break;	
			case "mertek":
			$query=$this->Helper_model->getAllMertek();
			foreach ($query->result() as $row)
		{
			echo "<option value=".$row->id.">".$row->name." </option>";
		}
		echo '<option value="999" selected="selected">Válasszon...</option>';
			break;
		}
		
		}
		public function addKiadas()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->addKiadas();
		}
		public function addBevetel()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->addBevetel();
		}
		public function modKiadas()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->modKiadas();
		}
		public function modBevetel()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->modBevetel();
		}
		public function getKiadas()
		{
		$this->load->model('Helper_model');
		$ossz=$this->Helper_model->getKiadas();
		//echo $ossz;
		//echo'<oreo id="buruttOsszesKiad" class="stealth">'.$ossz.'</oreo>';
		}
		public function getBevetel()
		{
		$this->load->model('Helper_model');
		$ossz=$this->Helper_model->getBevetel();
		//echo $ossz;
		//echo'<oreo id="buruttOsszesKiad" class="stealth">'.$ossz.'</oreo>';
		}
		
		public function getKiadasSum()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->getKiadasSum();
		foreach ($query->result() as $row)
		{
			$string = preg_replace('/\s+/', '', $row->brutto);
			if($row->brutto==NULL)
			{
			echo "0";
			}
			else
			{
			echo $string;
			}
		}
		}
		
		public function getBevetelSum()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->getBevetelSum();
		foreach ($query->result() as $row)
		{
			$string = preg_replace('/\s+/', '', $row->brutto);
			if($row->brutto==NULL)
			{
			echo "0";
			}
			else
			{
			echo $string;
			}
		}
		}
		public function delKiadasRow()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->delKiadasRow($_POST['id']);
		}
		public function delBevRow()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->delBevRow($_POST['id']);
		}
		public function editKiadasRow()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->editKiadasRow($_POST['id']);
		foreach ($query->result() as $sor)
		{
		$return=$sor->sub_id.','.$sor->tax.','.$sor->megnevezes.','.$sor->brutto_egysegar.','.$sor->mennyiseg.','.$sor->quant.','.$sor->Year.','.$sor->cpv.','
		.$sor->honap;
		}
		echo $return;
		}
		public function editBevetelRow()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->editBevetelRow($_POST['id']);
		foreach ($query->result() as $sor)
		{
		$return=$sor->sub_id.','.$sor->tax.','.$sor->megnevezes.','.$sor->brutto_egysegar.','.$sor->mennyiseg.','.$sor->quant.','.$sor->Year.','.$sor->honap;
		}
		echo $return;
		}
		public function confirmAndSave()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->confirmAndSave();
		}
		public function confirmSend()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->confirmSend();
		}
		public function clearSubmission()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->clearSubmission();
		}
		public function getSavedPlansList()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->getSavedPlansList();
		}
		public function changedPlansPlace()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->changedPlansPlace();
		}
		public function editWork()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->editWork();
		}
		public function sendSavedPlane()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->sendSavedPlane();
		}
		public function deletePlane()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->deletePlane();
		}
		public function getSendPlansList()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->getSendPlansList();
		}
		public function getViewPlan()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->getViewPlan();
		}
		public function logOut()
		{
		unset($_COOKIE['Page']);
		setcookie('Page', null, -1, '/newkoltsegterv/koltsegterv');
		unset($_COOKIE['KEname']);
		setcookie('KEname', null, -1, '/newkoltsegterv/koltsegterv');
		unset($_COOKIE['userid']);
		setcookie('KEname', null, -1, '/newkoltsegterv/koltsegterv');
		unset($_COOKIE['lvl']);
		setcookie('lvl', null, -1, '/newkoltsegterv/koltsegterv');
		unset($_COOKIE['Page']);
		setcookie('Page', null, -1, '/newkoltsegterv/koltsegterv');
		unset($_COOKIE['Page']);
		setcookie('Page', null, -1, '/newkoltsegterv/koltsegterv');
		unset($_COOKIE['Page']);
		setcookie('Page', null, -1, '/newkoltsegterv/koltsegterv');
		unset($_COOKIE['Page']);
		setcookie('Page', null, -1, '/newkoltsegterv/koltsegterv');
		$data['title']="Költségtervező";
        $this->load->view('koltsegterv/header', $data);
        $this->load->view('koltsegterv/index', $data);
        $this->load->view('koltsegterv/footer', $data);
		}
		public function getEgysegenkentiLista()
		{
		$this->load->model('Helper_model');
		$this->Helper_model->getEgysegenkentiLista();
		}
		public function setYear()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->setYear();
		foreach($query->result() as $record)
	{	
		if($record->Year==$_COOKIE['Ev'])
		{
			$selected="selected=selected";
		}
		else
		{
		$selected="";	
		}
		echo "<option value=".$record->Year." ".$selected.">".$record->Year."</option>";
	}		
	echo'<option value="999" >Válasszon...</option>';
		}
		
		public function getFinanc()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->getFinanc();
		echo $query;
		}
		public function getFinancUser()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->getFinancUser();
		echo $query;
		}
		public function makeAnEgyseg()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->makeAnEgyseg();
		}
		public function makeAnAlEgyseg()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->makeAnAlEgyseg();
		}
		public function makeAnRecord()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->makeAnAlEgyseg();
		}
		public function makeAnFull()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->makeAnFull();
		}
		public function makeAgEgyseg()
		{
		$this->load->model('Helper_model');

		$query=$this->Helper_model->makeAgEgyseg();
		}
		public function makeAgAlEgyseg()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->makeAgAlEgyseg();
		}
		public function makeAgFull()
		{
		$this->load->model('Helper_model');
		$query=$this->Helper_model->makeAgFull();
		}
		public function deleteFile()
		{
		unlink('download/'.$_GET['name'].'.xlsx');
		}
		
}

	
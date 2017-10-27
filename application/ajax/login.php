<?php
	include_once("../Scripts/db.php");
	@session_start();
	$username=$_POST['email'];
	$pass=$_POST['psw'];
	$password = md5($pass);
	$sql="SELECT * FROM kltsg_users WHERE email='".$username."'";
	
        $eredmeny=$GLOBALS['conn']->query($sql) or die("Hiba a felhasználó lekérdezésénél") ;
		$row_count = $eredmeny->num_rows;
		if ( $row_count!= 1) {
			echo "false";
		}
		else
		{
			$dbusr= $eredmeny->fetch_array(MYSQLI_BOTH);
			
			if($dbusr['password']==$password)
			{
				$_SESSION['id']=$dbusr['id'];
				$_SESSION['first_name']=$dbusr['first_name'];
				$_SESSION['last_name']=$dbusr['last_name'];
				echo $_SESSION['last_name']." ".$_SESSION['first_name']." ".$dbusr['level'];
				
			}
			else
			{
				echo "false";
			}
		}
?>
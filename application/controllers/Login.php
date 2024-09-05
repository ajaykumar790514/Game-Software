<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
class Login extends Main {

	public function index($type='admin')
	{
		if ($this->input->server('REQUEST_METHOD')=='POST') {

			if (!$_POST['username'] or !$_POST['password']) {
				$return['res'] = 'error';
				$return['msg'] = 'Please Enter Username & Password !';
				echo json_encode($return); die();
			}
			
			$check['username'] = $_POST['username'];
			$type = $_POST['type'];
			if (@$_POST['type']=='admin') {
				$user = $this->model->getRow('tb_admin',$check);
				$password = $this->encryption->decrypt(@$user->password);
				// echo prx($user);
				if(!@$user){
					$user = $this->model->getRow('clinics',$check);
					$user->status 	= $user->active;
					$password =   $this->encryption->decrypt(@$user->password);
				}
			}
			elseif(@$_POST['type']=='host') {
				$user = $this->model->getRow('usermaster',$check);
				if ($user) {
					$user->status 	= $user->isactive;
				}
				$_POST['password'] 	=   $this->encryption->decrypt(@$user->password);
			}
			else{
				$user = false;
			}
			

			if ($user) {
				if ($user->status==1) {
					if ($_POST['password']==(@$password) ){
						$user = array_encryption($user);
						$type = value_encryption($type,'encrypt');
						set_cookie('63a490ed05b42',$user['id'],8000*24*30);
						set_cookie('63a490ed05b43',$user['username'],8000*24*30);
						set_cookie('63a490ed05b44',$type,8000*24*30);
						$return['res'] = 'success';
						$return['msg'] = 'Login Successful Please Wait Redirecting...';
						$return['redirect_url'] = base_url();
					}
					else {
						$return['res'] = 'error';
						$return['msg'] = 'Incorrect Password';
					}
				}
				else {
					$return['res'] = 'error';
					$return['msg'] = 'Account Temporarily Disabled!';
				}
			}
			else {
				$return['res'] = 'error';
				$return['msg'] = 'User Not Found!';
			}
			echo json_encode($return);

		}
		else{
			$admin_logo = $this->model->getRow('tb_admin',['id'=>'1']);
		if(!empty($admin_logo))
		{
			$data['logo'] = IMGS_URL.$admin_logo->photo;
			
		}else
		{
       $data['logo'] = base_url() . 'public/uploads/users/logo.png';
		}
			$data['title'] 	= 'Login';
			$data['type']	=	$type;
			load_view('login',$data);
		}
	}
	public function admin_mobile_otp()
	{  
		 
		$mobile=$_POST['mobile'];
		
		$this->db->delete('tb_admin_otp', array('mobile' => $mobile));
		if(isset($_POST['mobile']) && $_POST['mobile']!==''){
			//$check_existing_record = $this->model->getRows(array('conditions'=>array('contact_number'=>$_POST['mobile'],'active'=>'1')));
			$check_existing_record = $this->model->admin_mobile_exist($_POST['mobile']);
		   
			if($check_existing_record){
			    $otp=mt_rand(100000, 999999);
				$_SESSION['otp']  = $otp;
				$data =array(
				      'otp'=>$otp,
					  'mobile'=>$_POST['mobile'],
				);

				if($this->model->adminupdateRow($mobile,$data))
				{
					//code to send the otp to the mobile number will be placed here
					if(TRUE)
					{
						$return['res'] = 'success';
						$return['msg'] = 'Otp Send Your Mobile Number';
						$msg =$otp.' is your login OTP. Treat this as confidential. Techfi Zone will never call you to verify your OTP. Techfi Zone Pvt Ltd.';
                        $conditions = array(
                            'returnType' => 'single',
                            'conditions' => array(
                                'id'=>'6'
                                )
                        );
                        $smsData = $this->ManageOrderOtpModel->getSmsRows($conditions);
                        $smsData['mobileNos'] = $mobile;
                        $smsData["message"] = $msg;
                        $this->ManageOrderOtpModel->send_sms($smsData);
					}
					else
					{
						$return['res'] = 'error';
						$return['msg'] = "Message could not be sent.";	
					}
				}
				else
				{
					$return['res'] = 'error';
						$return['msg'] = "Otp could not be generated.";	
				}
			}
			else
			{
				$return['res'] = 'error';
			    $return['msg'] =  "Mobile number does not exist.";
			}
		}
		else
		{
			$return['res'] = 'error';
	    	$return['msg'] =  "Mobile number not received.";
		}
		echo json_encode($return);
		return TRUE;
	}
	public function admin_check_otp()
	{
		$otp=$_POST['otp'];
		if(isset($_POST['otp']) && $_POST['otp']!==''){
			
			  $check_existing_otp = $this->model->admin_otp_exist($_POST['otp']); 
			  if($check_existing_otp)
			  {
				$return= 1;
			  }else{
				$return= 0;
			  }

		}else
		{
			$return['res'] = 'error';
	    	$return['msg'] =  "Mobile number not received.";
		}
		echo json_encode($return);
		return TRUE;
		
	}
	public function admin_update_pass()
	{
		$newpassword=$_POST['newpassword'];
		$cpassword=$_POST['cpassword'];
		$mobile=$_POST['mobile'];
		if(isset($_POST['newpassword']) && $_POST['newpassword']!==''){
			$data =array(
             'password'=>$this->encryption->encrypt($newpassword),
			);
			if($this->model->admin_update_password($mobile,$data))
			{
				$return['res'] = 'success';
	    	    $return['msg'] =  "Password forgot successfully";
				$this->db->delete('tb_admin_otp', array('mobile' => $mobile));
			}else
			{
				$return['res'] = 'error';
	    	    $return['msg'] =  "Failed";
			}

		}
	
		echo json_encode($return);
		return TRUE;
	}
	public function logout()
	{
		delete_cookie('63a490ed05b42');	
		delete_cookie('63a490ed05b43');	
		delete_cookie('63a490ed05b44');	
		redirect(base_url());
	}
}

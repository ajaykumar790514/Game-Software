<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
class Consumers extends Main {
	

	public function consumers_remote($type,$id=null,$column='name')
    {
        if ($type=='consumers') {
            $tb = 'consumers';
        }
        else{

        }
        $this->db->where($column,$_GET[$column]);
        if($id!=NULL){
            $this->db->where('id != ',$id);
        }
        $count=$this->db->count_all_results($tb);
        if($count>0)
        {
            echo "false";
        }
        else
        {
            echo "true";
        }        
    }
	public function index($action=null,$id=null)
	{
		$data['user'] 	=$user	= $this->checkLogin();
		$view_dir = 'consumers/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Consumers';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$data['new_url']	=  current_url().'/create';
				$this->template($data);
				break;

			case 'tb':
				$user = $user->id;
					$data['search'] = '';
					$search='null';
				   
					if($id!=null)
							{
					$data['search'] = $id;
					$search = $id;
							}
					if (@$_POST['search']) {
					$data['search'] = $_POST['search'];
					$search=$_POST['search'];
						   
							}
					$this->load->library('pagination');
					
					$data['contant'] 		= $view_dir.'tb';
					$config = array();
					$config["base_url"] 	= base_url()."consumers/tb";
					$config["total_rows"]  	= count($this->model->consumers($search));
					$data['total_rows']    	= $config["total_rows"];
					$config["per_page"]    	= 10;
					$config["uri_segment"]      = $this->uri->total_segments();
					$config['attributes']  	= array('class' => 'pag-link ');
					$this->pagination->initialize($config);
					$data['links']   		= $this->pagination->create_links();
					$data['page']    		= $page = ($id!=null) ? $id : 0;
					$data['search']	 		= $this->input->post('search');
					$data['update_url']		= base_url('consumers/create/');
					$data['delete_url']		= base_url('consumers/delete/');
                    $data['account_url']		= base_url('consumers/account/');
					$data['rows']    		= $this->model->consumers($search,$config["per_page"],$page);
					load_view($data['contant'],$data);
				break;

			    case 'create':
				$data['title'] 		  = 'New Consumers';
				$data['contant']      = $view_dir.'create';
				$data['remote']     = base_url().'consumers_remote/consumers/';
				$data['action_url']	  = base_url('consumers/save');
				if ($id!=null) {
					$data['action_url']	  .=  '/'.$id;
					$data['row'] = $this->model->getRow('consumers',['id'=>$id]);
					$data['remote']         = base_url().'consumers_remote/consumers/'.$id;
				}
				load_view($data['contant'],$data);
				break;

			// case 'save':
			// 	$return['res'] = 'error';
			// 	$return['msg'] = 'Not Saved!';
			// 	$saved = 0;
			// 	if ($this->input->server('REQUEST_METHOD')=='POST') {
			// 		$this->form_validation->set_rules('name', 'Name', 'required');
			// 		if ($this->form_validation->run() !== FALSE)
	        //         {
	        //             if ($id!=null) {
            //                 $config['file_name'] = rand(10000, 10000000000);
            //                 $config['upload_path'] = UPLOAD_PATH . 'consumers/';
            //                 $config['allowed_types'] = 'jpg|jpeg|png|webp|svg';
            //                 $this->load->library('upload', $config);
            //                 $this->upload->initialize($config);
            //                 if (!empty($_FILES['img']['name'])) {
            //                     $_FILES['imgs']['name'] = $_FILES['img']['name'];
            //                     $_FILES['imgs']['type'] = $_FILES['img']['type'];
            //                     $_FILES['imgs']['tmp_name'] = $_FILES['img']['tmp_name'];
            //                     $_FILES['imgs']['size'] = $_FILES['img']['size'];
            //                     $_FILES['imgs']['error'] = $_FILES['img']['error'];

            //                     if ($this->upload->do_upload('imgs')) {
            //                         $image_data = $this->upload->data();
            //                         $fileName = "consumers/" . $image_data['file_name'];
            //                         $data_insert['photo'] = $fileName;
            //                     } else {
            //                         $image = $this->model->getRow('consumers',['id'=>$id]);
            //                         $data_insert['photo'] = @$image->photo;
            //                     }
            //                 } else {
            //                     $image = $this->model->getRow('consumers',['id'=>$id]);
            //                 $data_insert['photo'] = @$image->photo;
            //                 }
            //                 $data_insert['name'] = $this->input->post('name');
            //                 $data_insert['mobile'] = $this->input->post('mobile');
            //                 $data_insert['email'] = $this->input->post('email');
			// 				if($this->model->Update('consumers',$data_insert,['id'=>$id])){
			// 					$saved = 1;
			// 				}
			// 			}
			// 			else{
                           
            //                 // Generate a random file name
            //                     $config['file_name'] = rand(10000, 10000000000);
            //                     $config['upload_path'] = UPLOAD_PATH . 'consumers/';
            //                     $config['allowed_types'] = 'jpg|jpeg|png|webp|svg';
            //                     $this->load->library('upload', $config);
            //                     $this->upload->initialize($config);
            //                     if (!empty($_FILES['img']['name'])) {
            //                         $_FILES['imgs']['name'] = $_FILES['img']['name'];
            //                         $_FILES['imgs']['type'] = $_FILES['img']['type'];
            //                         $_FILES['imgs']['tmp_name'] = $_FILES['img']['tmp_name'];
            //                         $_FILES['imgs']['size'] = $_FILES['img']['size'];
            //                         $_FILES['imgs']['error'] = $_FILES['img']['error'];

            //                         if ($this->upload->do_upload('imgs')) {
            //                             $image_data = $this->upload->data();
            //                             $fileName = "consumers/" . $image_data['file_name'];
            //                             $data_insert['photo'] = $fileName;
            //                         } else {
            //                             $data_insert['photo'] = "";
            //                         }
            //                     } else {
            //                         $data_insert['photo'] = "";
            //                     }

            //                     $data_insert['name'] = $this->input->post('name');
            //                     $data_insert['mobile'] = $this->input->post('mobile');
            //                     $data_insert['email'] = $this->input->post('email');

            //                     if ($this->model->Save('consumers', $data_insert)) {
            //                         $saved = 1;
            //                     }

			// 			}

			// 			if ($saved == 1 ) {
			// 				$return['res'] = 'success';
			// 				$return['msg'] = 'Saved.';
			// 			}
	        //         }
	        //         else
	        //         {
	        //             $return['errors'] = $this->form_validation->error_array();
	        //         }	
			// 	}
			// 	echo json_encode($return);
			// 	break;
			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('consumers',['id'=>$id])){
						$saved = 1;
						$return['res'] = 'success';
						$return['msg'] = 'Successfully deleted.';
					}
				}
				echo json_encode($return);
				break;
               case 'account':
				$data['contant']      = $view_dir.'accounts';
                $data['banks']        = $this->model->getData('consumer_account',['consumer_id'=>$id,'account_type'=>'BANK']);
                $data['upis']        = $this->model->getData('consumer_account',['consumer_id'=>$id,'account_type'=>'UPI']);
				$data['row'] = $this->model->getRow('consumers',['id'=>$id]);
				load_view($data['contant'],$data);
                break;
				case 'change_status_account':
                    $post = $this->input->post();
                    $res='false';
                    if($post['status']=='VERIFIED')
                    {
                   $res=$this->db->where('id', $post['id']) ->update('consumer_account', array(
                            'status' => $post['status'],
                            'rejected_reason' => ""
                        ));
                    }
                    else
                    {
                        $res=$this->db->where('id', $post['id'])
                        ->update('consumer_account', array(
                            'status' => $post['status'],
                            'rejected_reason' => $post['rejected_reason']
                        ));
                    }
                    
                    if($res)
                    {
                    echo 'true';
                    }
                
                break;
                case 'change_status_upi':
                    $post = $this->input->post();
                    $res='false';
                    if($post['status']=='VERIFIED')
                    {
                   $res=$this->db->where('id', $post['id']) ->update('consumer_account', array(
                            'status' => $post['status'],
                            'rejected_reason' => ""
                        ));
                    }
                    else
                    {
                        $res=$this->db->where('id', $post['id'])
                        ->update('consumer_account', array(
                            'status' => $post['status'],
                            'rejected_reason' => $post['rejected_reason']
                        ));
                    }
                    
                    if($res)
                    {
                    echo 'true';
                    }
                break;    
			default:
				// code...
				break;
		}
		
	}


    public function consumers_wallet($action=null,$p1=null,$p2=null)
	{
        // echo $action;
		$data['user'] 	=$user	= $this->checkLogin();
		$view_dir = 'consumers/consumers-wallet/';
		switch ($action) {
			case 'wallet':
				$data['title'] 		= 'Consumers Wallet';
				$data['contant'] 	= $view_dir.'index';
                $data['consumer']   = $this->model->getRow('consumers',['id'=>$p1]);
				$data['tb_url']	  	=  base_url().'consumers-wallet/tb/'.$p1;
				$this->template($data);
				break;

			case 'tb':
				$user = $user->id;
					$data['search'] = '';
					$search='null';
				   
					if($p2!=null)
							{
					$data['search'] = $p2;
					$search = $p2;
							}
					if (@$_POST['search']) {
					$data['search'] = $_POST['search'];
					$search=$_POST['search'];
						   
							}
					$this->load->library('pagination');
					
					$data['contant'] 		= $view_dir.'tb';
					$config = array();
					$config["base_url"] 	= base_url().'consumers-wallet/tb/'.$p1;
					$config["total_rows"]  	= count($this->model->consumers_walet($p1,$search));
					$data['total_rows']    	= $config["total_rows"];
					$config["per_page"]    	= 10;
					$config["uri_segment"]      = $this->uri->total_segments();
					$config['attributes']  	= array('class' => 'pag-link ');
					$this->pagination->initialize($config);
					$data['links']   		= $this->pagination->create_links();
					$data['page']    		= $page = ($p2!=null) ? $p2 : 0;
					$data['search']	 		= $this->input->post('search');
					$data['rows']    		= $this->model->consumers_walet($p1,$search,$config["per_page"],$page);
					load_view($data['contant'],$data);
				break;

			
			default:
				// code...
				break;
		}
		
	}
    
    public function consumers_withdrawals($action=null,$p1=null,$p2=null)
	{
        // echo $action;
		$data['user'] 	=$user	= $this->checkLogin();
		$view_dir = 'consumers/consumers-withdrawals/';
		switch ($action) {
			case 'withdrawals':
				$data['title'] 		= 'Consumers Withdrawals';
				$data['contant'] 	= $view_dir.'index';
                $data['consumer']   = $this->model->getRow('consumers',['id'=>$p1]);
				$data['tb_url']	  	=  base_url().'consumers-withdrawals/tb/'.$p1;
				$this->template($data);
				break;

			case 'tb':
				$user = $user->id;
					$data['search'] = '';
					$search='null';
				   
					if($p2!=null)
							{
					$data['search'] = $p2;
					$search = $p2;
							}
					if (@$_POST['search']) {
					$data['search'] = $_POST['search'];
					$search=$_POST['search'];
						   
							}
					$this->load->library('pagination');
					
					$data['contant'] 		= $view_dir.'tb';
					$config = array();
					$config["base_url"] 	= base_url().'consumers-withdrawals/tb/'.$p1;
					$config["total_rows"]  	= count($this->model->consumers_withdrawals($p1,$search));
					$data['total_rows']    	= $config["total_rows"];
					$config["per_page"]    	= 10;
					$config["uri_segment"]      = $this->uri->total_segments();
					$config['attributes']  	= array('class' => 'pag-link ');
					$this->pagination->initialize($config);
					$data['links']   		= $this->pagination->create_links();
					$data['page']    		= $page = ($p2!=null) ? $p2 : 0;
					$data['search']	 		= $this->input->post('search');
					$data['rows']    		= $this->model->consumers_withdrawals($p1,$search,$config["per_page"],$page);
					load_view($data['contant'],$data);
				break;
				
			
			default:
				// code...
				break;
		}
		
	}
    public function update_status_withdrawls()
	{
		$post = $this->input->post();
		$res='false';
		if($post['status']=='SUCCESS')
		{
	   $res=$this->db->where('id', $post['id']) ->update('consumers_withdrawals', array(
				'status' => $post['status'],
				'reject_reason' => ""
			));
		}
		else
		{
			$res=$this->db->where('id', $post['id'])
			->update('consumers_withdrawals', array(
				'status' => $post['status'],
				'reject_reason' => $post['rejected_reason']
			));
		}
		
		if($res)
		{
		echo 'true';
		}
	}
	public function fetchBankOptions() {
		$id = $_POST['id'];
		$bankOptions = $this->db->get_where('consumer_account', ['status'=>'VERIFIED','consumer_id' => $id, 'account_type' => 'BANK'])->result();
		
		$optionsHtml = '';
		$optionsHtml = '<option value="">Select</option>';
		foreach ($bankOptions as $option) {
			$optionsHtml .= '<option value="' . $option->id . '">' . $option->account_no . ' ( ' . $option->bank_name . ' )</option>';
		}
		echo $optionsHtml;
	}
	

    // Controller method to fetch UPI options
    public function fetchUpiOptions() {
		$id = $_POST['id'];
		$upiOptions = $this->db->get_where('consumer_account',['status'=>'VERIFIED','consumer_id'=>$id,'account_type'=>'UPI'])->result();
        $optionsHtml = '';
		$optionsHtml = '<option value="">Select</option>';
        foreach ($upiOptions as $option) {
            $optionsHtml .= '<option value="' . $option->id . '">' . $option->upi_id . '</option>';
        }
        echo $optionsHtml;
    }
	public function update_to_wallet()
{
    $post = $this->input->post();
    $id = $post['id'];
    $selectedMode = $post['selectedMode'];
    $amount = $post['amount'];
    $cust_id = $post['cust_id'];

    // Update the status of the withdrawal to 'SUCCESS'
    $updateResult = $this->db->where('id', $id)
                             ->update('consumers_withdrawals', array('status' => 'SUCCESS'));

    if ($updateResult) {
        // Fetch the bank/UPI details for the selected mode
        $bankOptions = $this->db->get_where('consumer_account', ['id' => $selectedMode])->row();

        if ($bankOptions) {
            // Insert the transaction into the consumer_wallet
            $insertData = array(
                'credit' => $amount,
                'consumer_id' => $cust_id,
                'date' => date('Y-m-d H:i:s'),
                'transaction_head' => 'WITHDRAWAL',
                'account_type' => $bankOptions->account_type ? $bankOptions->account_type : '',
                'account_no' => $bankOptions->account_no ? $bankOptions->account_no : '',
                'ifsc' => $bankOptions->ifsc ? $bankOptions->ifsc : '',
                'bank_name' => $bankOptions->bank_name ? $bankOptions->bank_name : '',
                'account_name' => $bankOptions->account_name ? $bankOptions->account_name : '',
                'upi_id' => $bankOptions->upi_id ? $bankOptions->upi_id : '',
				'ref_id'=>$id,
            );

            $insertResult = $this->db->insert('consumer_wallet', $insertData);

            if ($insertResult) {
                echo 'true';
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    } else {
        echo 'false';
    }
}

	
    public function withdrawals($action=null,$p1=null)
	{
        // echo $action;
		$data['user'] 	=$user	= $this->checkLogin();
		$view_dir = 'withdrawals/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Consumers Withdrawals';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$this->template($data);
				break;

			case 'tb':
				$user = $user->id;
					$data['search'] = '';
					$search='null';
				   
					if($p1!=null)
							{
					$data['search'] = $p1;
					$search = $p1;
							}
					if (@$_POST['search']) {
					$data['search'] = $_POST['search'];
					$search=$_POST['search'];
						   
							}
					$this->load->library('pagination');
					$data['contant'] 		= $view_dir.'tb';
					$config = array();
                    $config["base_url"] 	= base_url()."withdrawals/tb";
					$config["total_rows"]  	= count($this->model->withdrawals($search));
					$data['total_rows']    	= $config["total_rows"];
					$config["per_page"]    	= 10;
					$config["uri_segment"]      = $this->uri->total_segments();
					$config['attributes']  	= array('class' => 'pag-link ');
					$this->pagination->initialize($config);
					$data['links']   		= $this->pagination->create_links();
					$data['page']    		= $page = ($p1!=null) ? $p1 : 0;
					$data['search']	 		= $this->input->post('search');
					$data['rows']    		= $this->model->withdrawals($search,$config["per_page"],$page);
					load_view($data['contant'],$data);
				break;

			
			default:
				// code...
				break;
		}
		
	}
    
    
    public function bets($action=null,$p1=null)
	{
        // echo $action;
		$data['user'] 	=$user	= $this->checkLogin();
		$view_dir = 'consumer-bets/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Consumers Bets';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
                $data['games']      = $this->model->getData('games',['active'=>'1','is_deleted'=>'NOT_DELETED']);
				$data['game_schedule']      = $this->model->get_game_schedule();
				$this->template($data);
				break;

			  case 'tb':
				$user = $user->id;
					$data['search'] = '';
					$search='null';
				   
					if($p1!=null)
							{
					$data['search'] = $p1;
					$search = $p1;
							}
					if (@$_POST['search']) {
					$data['search'] = $_POST['search'];
					$search=$_POST['search'];
						   
							}
					$this->load->library('pagination');
					$data['contant'] 		= $view_dir.'tb';
					$config = array();
                    $config["base_url"] 	= base_url()."consumer-bets/tb";
					$config["total_rows"]  	= count($this->model->bets($search));
					$data['total_rows']    	= $config["total_rows"];
					$config["per_page"]    	= 10;
					$config["uri_segment"]      = $this->uri->total_segments();
					$config['attributes']  	= array('class' => 'pag-link ');
					$this->pagination->initialize($config);
					$data['links']   		= $this->pagination->create_links();
					$data['page']    		= $page = ($p1!=null) ? $p1 : 0;
					$data['search']	 		= $this->input->post('search');
					$data['rows']    		= $this->model->bets($search,$config["per_page"],$page);
					
					load_view($data['contant'],$data);
				break;
                case 'fetch_game_item':
                    if($this->input->post('game_id'))
                    {
                        $game_id= $this->input->post('game_id');
                        $this->model->fetch_game_item($game_id);
                    }
                break;
                case 'fetch_game_schedule_id':
                    if($this->input->post('game_id'))
                    {
						$date='';
						$date=$this->input->post('date');
                        $game_id= $this->input->post('game_id');
                        $this->model->fetch_game_schedule($game_id,$date);
                    }
                break;    
                case 'fetch_total_bet':
                    if ($this->input->is_ajax_request()) {
						$game_date = $this->input->post('game_date');
						$game_id = $this->input->post('game_id');
						$game_item_id = $this->input->post('game_item_id');
                        $gameScheduleId = $this->input->post('gameScheduleId');
                        $totalBet = $this->model->getTotalBet($gameScheduleId,$game_id,$game_date,$game_item_id);
                        $data['totalBet'] = $totalBet;
                        $html = $this->load->view('consumer-bets/total-bets', $data, true);
                        echo $html;
                    }
                break; 
				
				case 'mark_winner':
					if ($this->input->is_ajax_request()) {
						$item_id = $this->input->post('item_id');
						$schedule_id = $this->input->post('schedule_id');
						$datetimepost = $this->input->post('date');
						$game_id = $this->input->post('game_id');
						$winning_x = $this->input->post('winning_x');
						$current_datetime = date('Y-m-d H:i:s');
						$totalBet = $this->model->getTotalBet($schedule_id,$game_id,$datetimepost,$item_id);
						$any_winner = false;
						foreach ($totalBet as $bet) {
						   $is_winner = count($this->model->getData('game_schedule_winner', ['item_id' => $bet->id, 'schedule_id' => $bet->game_schedule_id]));
						   if ($is_winner > 0) {
							   $any_winner = true;
						   }
					   }
					   if($any_winner){
						echo json_encode(['res' => 'error', 'message' => 'Already declared winner..']);
						return;	
					   }
                        $checkactive = $this->model->checkactive_new($schedule_id);
                        if($checkactive->game_status !='ACTIVE')
						{
							echo json_encode(['res' => 'error', 'message' => 'Cannot mark bets as winners for not active game schedules.']);
							return;	
						}
						$result = $this->model->mark_as_winner_new($item_id,$schedule_id);
						if ($result) {
							$consumerData=$this->model->consumer_wallet_store($item_id,$schedule_id);
							foreach($consumerData as $consumer):
                            $Winning = $consumer->bet_value*$winning_x;
							$data = array(
								'credit'=>$Winning,
							    'debit'=>'0.00',
							    'consumer_id'=>$consumer->consumer_id,
							    'transaction_head'=>'WINNING',
							    'ref_id'=>$result,
							);
							$this->db->insert('consumer_wallet',$data);
							$this->model->Update('consumer_bets',['is_winner'=>'1'],['consumer_id'=>$consumer->consumer_id,'game_items_id'=>$item_id,'game_schedule_id'=>$schedule_id]);
							endforeach;	
							$this->model->Update('game_schedule',['status'=>'COMPLETED'],['id'=>$schedule_id]);
							echo json_encode(['res' => 'success']);
						} else {
							echo json_encode(['res' => 'error', 'message' => 'Failed to mark the bet as a winner.']);
						}
					} else {
						show_404();
					}
					break;
					case 'cancel_winner':
						if ($this->input->is_ajax_request()) {
							$bet_id = $this->input->post('id');
							$datetimepost = $this->input->post('date');

							$checkactive = $this->model->checkactive($bet_id);
							if($checkactive->game_status !='ACTIVE')
							{
								echo json_encode(['res' => 'error', 'message' => 'Cannot cancel winner for not active game schedules.']);
								return;	
							}
							// Check if the game_date is in the past
							$current_datetime = date('Y-m-d H:i:s');
							if ($datetimepost <= $current_datetime) {
								echo json_encode(['res' => 'error', 'message' => 'Cannot cancel winner status for past schedules.']);
								return;
							}
					
							$result = $this->model->mark_as_winner_cancel($bet_id);
					
							if ($result) {
								echo json_encode(['res' => 'success']);
							} else {
								echo json_encode(['res' => 'error', 'message' => 'Failed to cancel winner status.']);
							}
						} else {
							show_404();
						}
						break;
					
				
               
			default:
				// code...
				break;
		}
		
	}
  
}
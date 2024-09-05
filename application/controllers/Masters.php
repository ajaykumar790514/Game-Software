<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
class Masters extends Main {
	

	public function remote($type,$id=null,$column='name')
    {
        if ($type=='game') {
            $tb = 'games';
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
	public function game_master($action=null,$id=null)
	{
		$data['user'] 	=$user	= $this->checkLogin();
		$view_dir = 'masters/game_master/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Game Master';
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
					$config["base_url"] 	= base_url()."game-master/tb";
					$config["total_rows"]  	= count($this->model->game_master($search));
					$data['total_rows']    	= $config["total_rows"];
					$config["per_page"]    	= 10;
					$config["uri_segment"]      = $this->uri->total_segments();
					$config['attributes']  	= array('class' => 'pag-link ');
					$this->pagination->initialize($config);
					$data['links']   		= $this->pagination->create_links();
					$data['page']    		= $page = ($id!=null) ? $id : 0;
					$data['search']	 		= $this->input->post('search');
					$data['update_url']		= base_url('game-master/create/');
					$data['delete_url']		= base_url('game-master/delete/');
					$data['rows']    		= $this->model->game_master($search,$config["per_page"],$page);
					load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  = 'New Game Master';
				$data['contant']      = $view_dir.'create';
				$data['remote']     = base_url().'remote/game/';
				$data['action_url']	  = base_url('game-master/save');
				if ($id!=null) {
					$data['action_url']	  .=  '/'.$id;
					$data['row'] = $this->model->getRow('games',['id'=>$id]);
					$data['remote']         = base_url().'remote/game/'.$id;
				}
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					$this->form_validation->set_rules('name', 'Name', 'required');
					if ($this->form_validation->run() !== FALSE)
	                {
	                    if ($id!=null) {
							if($this->model->Update('games',$_POST,['id'=>$id])){
								$saved = 1;
							}
						}
						else{
							
							if($this->model->Save('games',$_POST)){
								$saved = 1;
							}
						}

						if ($saved == 1 ) {
							$return['res'] = 'success';
							$return['msg'] = 'Saved.';
						}
	                }
	                else
	                {
	                    $return['errors'] = $this->form_validation->error_array();
	                }	
				}
				echo json_encode($return);
				break;
			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('games',['id'=>$id])){
						$saved = 1;
						$return['res'] = 'success';
						$return['msg'] = 'Successfully deleted.';
					}
				}
				echo json_encode($return);
				break;

			
			default:
				// code...
				break;
		}
		
	}


	public function game_items($action=null,$id=null)
	{
		$data['user'] 	=$user	= $this->checkLogin();
		$view_dir = 'masters/game_items/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Game Items';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$data['new_url']	=  current_url().'/create';
				$data['games']        = $this->model->getData('games',['is_deleted'=>'NOT_DELETED','active'=>'1']);
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
					$config["base_url"] 	= base_url()."game-items/tb";
					$config["total_rows"]  	= count($this->model->game_items($search));
					$data['total_rows']    	= $config["total_rows"];
					$config["per_page"]    	=10;
					$config["uri_segment"]      = $this->uri->total_segments();
					$config['attributes']  	= array('class' => 'pag-link ');
					$this->pagination->initialize($config);
					$data['links']   		= $this->pagination->create_links();
					$data['page']    		= $page = ($id!=null) ? $id : 0;
					$data['search']	 		= $this->input->post('search');
					$data['update_url']		= base_url('game-items/create/');
					$data['delete_url']		= base_url('game-items/delete/');
					$data['rows']    		= $this->model->game_items($search,$config["per_page"],$page);
					load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  = 'New Game Items';
				$data['contant']      = $view_dir.'create';
				$data['action_url']	  = base_url('game-items/save');
				$data['games']        = $this->model->getData('games',['is_deleted'=>'NOT_DELETED','active'=>'1']);
 				if ($id!=null) {
					$data['action_url']	  .=  '/'.$id;
					$data['row'] = $this->model->getRow('game_items',['id'=>$id]);
				}
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					$this->form_validation->set_rules('title', 'Title', 'required');
					if ($this->form_validation->run() !== FALSE)
	                {
	                    if ($id!=null) {
							if($this->model->Update('game_items',$_POST,['id'=>$id])){
								$saved = 1;
							}
						}
						else{
							
							if($this->model->Save('game_items',$_POST)){
								$saved = 1;
							}
						}

						if ($saved == 1 ) {
							$return['res'] = 'success';
							$return['msg'] = 'Saved.';
						}
	                }
	                else
	                {
	                    $return['errors'] = $this->form_validation->error_array();
	                }	
				}
				echo json_encode($return);
				break;
				case 'check-duplicate-title':
					$game_id = $this->input->post('game_id');
					$title = $this->input->post('title');
					$is_duplicate = $this->model->check_duplicate_title($game_id, $title);
			
					echo json_encode(['is_duplicate' => $is_duplicate]);
		      break;			
			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('game_items',['id'=>$id])){
						$saved = 1;
						$return['res'] = 'success';
						$return['msg'] = 'Successfully deleted.';
					}
				}
				echo json_encode($return);
				break;

			
			default:
				// code...
				break;
		}
		
	}
	

	public function game_schedule($action=null,$id=null)
	{
		$data['user'] 	=$user	= $this->checkLogin();
		$view_dir = 'masters/game_schedule/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Game Schedule';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$data['new_url']	=  current_url().'/create';
				$data['games']        = $this->model->getData('games',['is_deleted'=>'NOT_DELETED','active'=>'1']);
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
					$config["base_url"] 	= base_url()."game-schedule/tb";
					$config["total_rows"]  	= count($this->model->game_schedule($search));
					$data['total_rows']    	= $config["total_rows"];
					$config["per_page"]    	= 10;
					$config["uri_segment"]      = $this->uri->total_segments();
					$config['attributes']  	= array('class' => 'pag-link ');
					$this->pagination->initialize($config);
					$data['links']   		= $this->pagination->create_links();
					$data['page']    		= $page = ($id!=null) ? $id : 0;
					$data['search']	 		= $this->input->post('search');
					$data['update_url']		= base_url('game-schedule/create/');
					$data['delete_url']		= base_url('game-schedule/delete/');
					$data['rows']    		= $this->model->game_schedule($search,$config["per_page"],$page);
					load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  = 'New Game Schedule';
				$data['contant']      = $view_dir.'create';
				$data['action_url']	  = base_url('game-schedule/save');
				$data['games']        = $this->model->getData('games',['is_deleted'=>'NOT_DELETED','active'=>'1']);
				if ($id!=null) {
					$data['action_url']	  .=  '/'.$id;
					$data['row'] = $this->model->getRow('game_schedule',['id'=>$id]);
				}
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					$this->form_validation->set_rules('game_id', 'Game', 'required');
					if ($this->form_validation->run() !== FALSE)
	                {
	                    if ($id!=null) {
							$schedule = $this->model->get_schedule_by_id($id);	
							$game_time = new DateTime($schedule->start_time);
							$current_time = new DateTime();
						if ($schedule->status=='COMPLETED') {
						echo json_encode(['res' => 'error', 'msg' => 'Cannot edit  of completed schedules!.']);
						die();
						}else{
						if ($game_time <= $current_time) {
							echo json_encode(['res' => 'error', 'msg' => 'Cannot edit  of past schedules']);
							die();
						} else {
							
							$datetimeString = $_POST['game_date'];
							$datetime = new DateTime($datetimeString);
							$date = $datetime->format('Y-m-d');
							$selectedDate = $date;
							$selectedTime = $_POST['start_time'];
							$selectedTimeEnd = $_POST['end_time'];
							$currentDate = date('Y-m-d');
							$currentTime = date('H:i:s');
							$selectedDateTime = new DateTime($selectedDate . ' ' . $selectedTime);

							if ($selectedDate < $currentDate || ($selectedDate == $currentDate && $selectedDateTime < new DateTime())) {
								$return['res'] = 'error';
								$return['msg'] = 'Cannot select any past time. Please select future time.';
								echo json_encode($return);
								die();
							}
							if ($this->model->is_time_slot_available($_POST['game_id'], $selectedTime, $selectedTimeEnd, $selectedDate)) {
						
								if($this->model->Update('game_schedule',$_POST,['id'=>$id])){
									$saved = 1;
								
							}
						} else {
							$return['res'] = 'error';
							$return['msg'] = 'Time schedule is not available, it clashes with existing schedules.';
							echo json_encode($return);
							die();
						}
					    }
					    }
						}
						else{
							$datetimeString = $_POST['game_date'];
							$datetime = new DateTime($datetimeString);
							$date = $datetime->format('Y-m-d');
							$selectedDate = $date;
							$selectedTime = $_POST['start_time'];
							$selectedTimeEnd = $_POST['end_time'];
							$currentDate = date('Y-m-d');
							$currentTime = date('H:i:s');
							// Check if the selected date and time is in the past
							$selectedDateTime = new DateTime($selectedDate . ' ' . $selectedTime);

							// Check if the selected date is in the past
							if ($selectedDate < $currentDate || ($selectedDate == $currentDate && $selectedDateTime < new DateTime())) {
								$return['res'] = 'error';
								$return['msg'] = 'Cannot select any past time. Please select future time.';
								echo json_encode($return);
								die();
							}
							
							// Check if the time slot is available
							if ($this->model->is_time_slot_available($_POST['game_id'], $selectedTime, $selectedTimeEnd, $selectedDate)) {
								// Time slot is available, proceed with saving
								if ($this->model->Save('game_schedule', $_POST)) {
									$saved = 1;
								}
							} else {
								// Time schedule is not available
								$return['res'] = 'error';
								$return['msg'] = 'Time schedule is not available, it clashes with existing schedules.';
								echo json_encode($return);
								die();
							}
							
							
						}

						if ($saved == 1 ) {
							$return['res'] = 'success';
							$return['msg'] = 'Saved.';
						}
	                }
	                else
	                {
	                    $return['errors'] = $this->form_validation->error_array();
	                }	
				}
				echo json_encode($return);
				break;
				case 'update_status':
					$id = $this->input->post('id');
					$status = $this->input->post('status');
					$schedule = $this->model->get_schedule_by_id($id);
					if ($schedule) {
						if ($schedule->status=='COMPLETED') {
							echo json_encode(['success' => false, 'message' => 'Cannot change status of completed schedules!.']);
						} else {
							$data = array('status' => $status);
							$result = $this->model->update_status($id, $data);
							
							if ($result) {
								echo json_encode(['success' => true,'message'=>'Status updated successfully']);
							} else {
								echo json_encode(['success' => false,'message'=>'Status Not Changed']);
							}
						}
					} else {
						echo json_encode(['success' => false, 'message' => 'Schedule not found']);
					}
					break;
							
					case 'delete':
						$return['res'] = 'error';
						$return['msg'] = 'Not Deleted!';
						if ($id != null) {
							$schedule = $this->model->get_schedule_by_id($id);	
							if ($schedule) {
								if ($schedule->status=='COMPLETED') {
									echo json_encode(['res' => 'error', 'msg' => 'Cannot delete  of completed schedules!.']);
									die();
								} else {
									if ($this->model->_delete('game_schedule', ['id' => $id])) {
										$return['res'] = 'success';
										$return['msg'] = 'Successfully deleted.';
									}
								}
							} else {
								$return['msg'] = 'Schedule not found!';
							}
						}
						echo json_encode($return);
						break;
					
			default:
				// code...
				break;
		}
		
	}
	

	

	


	




}
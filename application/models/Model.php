<?php
/**
 * 
 */
class Model extends CI_Model
{
	
	public function admin_menus($parent_menu=00)
	{
		$this->db->order_by('indexing','asc');
		if ($parent_menu!=00) {
			$this->db->where('parent',$parent_menu);
		}
		return $this->db->get('tb_admin_menu')->result();
	}
	  // BY AJAY KUMAR
      /*
     *  Select Records From Table
     */
    public function Select($Table, $Fields = '*', $Where = 1)
    {
        /*
         *  Select Fields
         */
        if ($Fields != '*') {
            $this->db->select($Fields);
        }
        /*
         *  IF Found Any Condition
         */
        if ($Where != 1) {
            $this->db->where($Where);
        }
        /*
         * Select Table
         */
        $query = $this->db->get($Table);

        /*
         * Fetch Records
         */

        return $query->result();
    }
   /*
     * Count No Rows in Table
     */
    public function Counter($Table, $Where = 1)
    {
        $rows = $this->Select($Table, '*', $Where);

        return count($rows);
    }





	public function admin_mobile_exist($mobile)
	{
		//echo $mobile;die();
		$this->db->select("mtb.*")
		->from('clinics mtb')
		->where(['mtb.contact'=>$mobile]);
	
		return $this->db->get()->num_rows();
		
	}

	public function admin_otp_exist($otp)
	{
		//echo $mobile;die();
		$this->db->select("mtb.*")
		->from('tb_admin_otp mtb')
		->where(['mtb.otp'=>$otp]);
	
		return $this->db->get()->num_rows();
		
	}
	function adminupdateRow($mobile,$data ){
		if($this->db->insert('tb_admin_otp',$data)){
			return $this->db->insert_id();
		}
		return false; 
	}
	public function admin_update_password($mobile,$data)
	{
		return $this->db->where('contact', $mobile)->update('clinics', $data);
	}
	


	

	

	function dashboard_content(){
		
	} 

 


	// main functions

 	function Save($tb,$data){
		if($this->db->insert($tb,$data)){
			return $this->db->insert_id();
		}
		return false; 
	}

	function SaveGetId($tb,$data){
	 	if($this->db->insert($tb,$data)){
	 		return $this->db->insert_id();
	 	}
	 	return false;
	}



	function getData($tb,$data=0,$order=null,$order_by=null,$limit=null,$start=null) {

		if ($order!=null) {
			if ($order_by!=null) {
				$this->db->order_by($order_by,$order);
			}
			else{
				$this->db->order_by('id',$order);
			}
		}

		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}

		if ($data==0 or $data==null) {
			return $this->db->get($tb)->result();
		}
		if (@$data['search']) {
			$search = $data['search'];
			unset($data['search']);
		}
		return $this->db->get_where($tb,$data)->result();
	}



	function getRow($tb,$data=0) {
		if ($data==0) {
			if($data=$this->db->get($tb)->row()){
				return $data;
			}
			else {
				return false;
			}
		}
		elseif(is_array($data)) {
			if($data=$this->db->get_where($tb, $data)){
				return $data->row();
			}
			else {
				return false;
			}
		}
		else {
			if($data=$this->db->get_where($tb,array('id'=>$data))){
				return $data->row();
			}
			else {
				return false;
			}
		}
	}

	function Update($tb,$data,$cond) {
		$this->db->where($cond);
	 	if($this->db->update($tb,$data)) {

	 		return true;
	 	}

	 	echo $this->db->last_query();die();
	 	return false;
	}
function Update_data($tb,$cond,$data) {
		$this->db->where('id',$cond);
	 	if($this->db->update($tb,$data)) {
	 		return true;
	 	}
	 	return false;
	}


	function Delete($tb,$data) {
		if (is_array($data)){
			$this->db->where($data);
			if($this->db->delete($tb)){
				return true;
			}
		}
		else{
			$this->db->where('id',$data);
			if($this->db->delete($tb)){
				return true;
			}
		}
		return false;
	}

	function _delete($tb,$data) {
		if (is_array($data)){
			$this->db->where($data);
			if($this->db->update($tb,['is_deleted'=>'DELETED'])){
				return true;
			}
		}
		else{
			$this->db->where('id',$data);
			if($this->db->update($tb,['is_deleted'=>'DELETED'])){
				return true;
			}
		}
		return false;
	}


	// Masters

	public function game_master($search,$limit=null,$start=null)
	{
		$this->db->select("a.*");
		$this->db->from('games a');
		$this->db->where('a.is_deleted','NOT_DELETED');
		if (@$_POST['name']) {
			$this->db->like('a.name',$_POST['name']);
		}
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.added','DESC');
		return $this->db->get()->result();
	}

	public function game_items($search,$limit=null,$start=null)
	{
		$this->db->select("a.*,b.name as game_name");
		$this->db->from('game_items a');
		$this->db->join('games b','b.id=a.game_id','left');
		$this->db->where('a.is_deleted','NOT_DELETED');
		if (@$_POST['name']) {
			$this->db->like('a.title',$_POST['name']);
			$this->db->or_like('b.name',$_POST['name']);
		}
		if (@$_POST['game_id']) {
			$this->db->where('b.id',$_POST['game_id']);
		}
		
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.added','DESC');
		return $this->db->get()->result();
	}

	public function check_duplicate_title($game_id, $title) {
        $this->db->where('game_id', $game_id);
        $this->db->where('title', $title);
        $query = $this->db->get('game_items'); // replace with your table name
        return $query->num_rows() > 0;
    }

	public function game_schedule($search, $limit = null, $start = null)
	{
		$this->db->select("a.*, b.name as game_name");
		$this->db->from('game_schedule a');
		$this->db->join('games b', 'b.id = a.game_id', 'left');
		$this->db->where('a.is_deleted', 'NOT_DELETED');
		
		if (!empty($_POST['name'])) {
			$this->db->like('b.name', $_POST['name']);
		}
		if (!empty($_POST['game_id'])) {
			$this->db->where('b.id', $_POST['game_id']);
		}
		if (!empty($_POST['date'])) {
			$date = $_POST['date'];
			// Using parameter binding to avoid SQL injection and handle the date format
			$this->db->where("DATE_FORMAT(a.game_date, '%Y-%m-%d') =", $date);
		}
		if ($limit !== null) {
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.added', 'DESC');
		
		return $this->db->get()->result();
	}
	
	public function get_schedule_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('game_schedule');
		$this->db->where('id', $id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function update_status($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('game_schedule', $data);
    }
	
	public function update_status_withdrawls($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('consumers_withdrawals', $data);
    }
	public function get_game_schedule()
{
    $current_date = date('Y-m-d');
    $this->db->select("a.*, b.name as game_name");
    $this->db->from('game_schedule a');
    $this->db->join('games b', 'b.id = a.game_id', 'left');
    // $this->db->where('a.active', '1');
    $this->db->where('a.is_deleted', 'NOT_DELETED');
    // $this->db->where('a.status', 'ACTIVE');
    $this->db->where("DATE_FORMAT(a.game_date, '%Y-%m-%d') <= ", $current_date);
    $this->db->group_by('DATE_FORMAT(a.game_date, "%Y-%m-%d")');
    $this->db->order_by('a.game_date', 'DESC');
    return $this->db->get()->result();
}
public function checkactive_new($id)
{
    $this->db->select("b.status as game_status");
    $this->db->from('game_schedule b');
    $this->db->where('b.id', $id);
    return $this->db->get()->row();
}
public function checkactive($id)
{
    $this->db->select("a.*, b.status as game_status");
    $this->db->from('consumer_bets a');
    $this->db->join('game_schedule b', 'b.id = a.game_schedule_id', 'left');
    $this->db->where('a.id', $id);
    return $this->db->get()->row();
}


	public function consumers($search,$limit=null,$start=null)
	{
		$this->db->select("a.*");
		$this->db->from('consumers a');
		$this->db->where('a.is_deleted','NOT_DELETED');
		if (@$_POST['name']) {
			$this->db->like('a.name',$_POST['name']);
			$this->db->or_like('a.mobile',$_POST['name']);
			$this->db->or_like('a.email',$_POST['name']);
		}
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.added','DESC');
		return $this->db->get()->result();
	}	

	public function consumers_walet($id,$search,$limit=null,$start=null)
	{
		$this->db->select("a.*");
		$this->db->from('consumer_wallet a');
		$this->db->where('a.consumer_id',$id);
		if (@$_POST['start_date']) {
			$start_date = $_POST['start_date'] .' 00:00:00';    
			$this->db->where('a.date >=',$start_date);
		}

		if (@$_POST['end_date']) {
			$end_date = $_POST['end_date'] . ' 23:59:59';
			$this->db->where('a.date <=',$end_date);
		}
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.date','DESC');
		return $this->db->get()->result();
	}	
	
	public function consumers_withdrawals($id,$search,$limit=null,$start=null)
	{
		$this->db->select("a.*");
		$this->db->from('consumers_withdrawals a');
		$this->db->where('a.consumer_id',$id);
		if (@$_POST['start_date']) {
			$start_date = $_POST['start_date'] .' 00:00:00';    
			$this->db->where('a.request_date >=',$start_date);
		}

		if (@$_POST['end_date']) {
			$end_date = $_POST['end_date'] . ' 23:59:59';
			$this->db->where('a.request_date <=',$end_date);
		}
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.request_date','DESC');
		return $this->db->get()->result();
	}
	
	
	public function withdrawals($search,$limit=null,$start=null)
	{
		$this->db->select("a.*,b.name ,b.mobile,b.email");
		$this->db->from('consumers_withdrawals a');
		$this->db->join('consumers b','b.id=a.consumer_id','left');
		if (@$_POST['name']) {
			$this->db->like('b.name',$_POST['name']);
			$this->db->or_like('b.mobile',$_POST['name']);
			$this->db->or_like('b.email',$_POST['name']);
		}
		if (@$_POST['start_date']) {
			$start_date = $_POST['start_date'] .' 00:00:00';    
			$this->db->where('a.request_date >=',$start_date);
		}

		if (@$_POST['end_date']) {
			$end_date = $_POST['end_date'] . ' 23:59:59';
			$this->db->where('a.request_date <=',$end_date);
		}
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.request_date','DESC');
		return $this->db->get()->result();
	}
	public function fetch_game_item($game_id)
    {
        $data = $this->db->get_where('game_items',['game_id' => $game_id , 'is_deleted' => 'NOT_DELETED','active'=>'1'])->result();
        echo "<option value=''>Select Game Item</option>";
        foreach($data as $val)
        {
            echo "<option value='" . $val->id . "'>" . $val->title . "</option>";
        }
    }

public function fetch_game_schedule($game_id,$date)
{
	$this->db->select("*")
             ->from('game_schedule ')
             ->where(['game_id'=>$game_id,'is_deleted' => 'NOT_DELETED']);
			 if(!empty($date))
			 {
				$this->db->where('DATE(game_date)',$date);
			 }
			 $query = $this->db->get();
			 $data =$query->result();

    echo "<option value=''>Select Game Schedule</option>";

    foreach ($data as $val) {
        $startTime = new DateTime($val->start_time);
        $formattedStartTime = $startTime->format('g:i A');
        
        $endTime = new DateTime($val->end_time);
        $formattedEndTime = $endTime->format('g:i A');
	    $date =date('d-m-Y', strtotime($val->game_date)) ;
		echo "<option value='" . $val->id . "'>" . date('h:i A', strtotime($formattedStartTime)) . " - " . date('h:i A', strtotime($formattedEndTime)) . ' ( '.$date.' )' . "</option>";

    }
}

		public function bets($search, $limit = null, $start = null)
		{
			// Initialize the query
			$this->db->select("a.*, b.title as item_title, c.start_time, c.end_time, d.name as game_name, c.game_date, e.name as consumer_name, e.mobile")
             ->from('consumer_bets a')
             ->join('game_items b', 'b.id = a.game_items_id', 'left')
             ->join('game_schedule c', 'c.id = a.game_schedule_id', 'left')
             ->join('games d', 'd.id = c.game_id', 'left')
             ->join('consumers e', 'e.id = a.consumer_id', 'left')
            //  ->where('c.status', 'ACTIVE');
			->order_by('b.seq','ASC');


			// Apply filters if set
			if (!empty($_POST['status'])) {
				$this->db->where('c.status', $_POST['status']);
			}
			if (!empty($_POST['game_id'])) {
				$this->db->where('d.id', $_POST['game_id']);
			}
			if (!empty($_POST['game_date'])) {
				$this->db->where("DATE_FORMAT(c.game_date, '%Y-%m-%d') =", $_POST['game_date']);
			}
			if (!empty($_POST['game_item_id'])) {
				$this->db->where('a.game_items_id', $_POST['game_item_id']);
			}
			if (!empty($_POST['game_schedule_id'])) {
				$this->db->where('a.game_schedule_id', $_POST['game_schedule_id']);
			}

			// Apply limit for pagination if set
			if ($limit !== null && $start !== null) {
				$this->db->limit($limit, $start);
			}

			// Get results
			$query = $this->db->get();
			return $query->result();
		}

		// public function getTotalBet($gameScheduleId, $game_id = null, $game_date = null) {
		// 	$this->db->select('a.*, COUNT(a.id) as total_bets_one');
		// 	$this->db->from('consumer_bets a'); 
		// 	$this->db->join('game_schedule c', 'c.id = a.game_schedule_id', 'left');
		// 	$this->db->join('games d', 'd.id = c.game_id', 'left');
		// 	$this->db->where('a.game_schedule_id', $gameScheduleId);
			
		// 	if (!empty($game_id)) {
		// 		$this->db->where('d.id', $game_id);
		// 	}
			
		// 	if (!empty($game_date)) {
		// 		$this->db->where("DATE_FORMAT(c.game_date, '%Y-%m-%d') =", $game_date);
		// 	}
		
		// 	$this->db->group_by('a.game_items_id');
			
		// 	$query = $this->db->get();
		// 	return $query->result();
		// }
		
		public function getTotalBet($gameScheduleId, $game_id = null, $game_date = null,$game_item_id=null) {
			$this->db->select('t1.*,t2.id as game_schedule_id,t2.game_date,t2.winning_x');
			$this->db->from('game_items t1');
			$this->db->join('game_schedule t2', 't1.game_id = t1.game_id', 'left');
			$this->db->join('games t3', 't3.id = t1.game_id', 'left');
			$this->db->order_by('t1.seq','ASC');
			if (!empty($game_id)) {
				$this->db->where('t1.game_id', $game_id);
			}
				$this->db->where('t2.id', $gameScheduleId);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function getTotalValue($item_id,$game_id,$schedule_id){
			$this->db->select('t1.*,COUNT(t1.id) as total_bets_one,SUM(t1.bet_value) as total_value');
			$this->db->from('consumer_bets t1');
			$this->db->where('t1.game_schedule_id', $schedule_id);
			$this->db->where('t1.game_items_id', $item_id);
			$query = $this->db->get();
			return $query->row();
		}

		public function consumer_wallet_store($item_id,$schedule_id)
		{
			$this->db->select('t1.*');
			$this->db->from('consumer_bets t1');
			$this->db->where('t1.game_schedule_id', $schedule_id);
			$this->db->where('t1.game_items_id', $item_id);
			$query = $this->db->get();
			return $query->result();
		}
	public function is_time_slot_available($game, $start_time_string, $end_time_string, $date)
	{
		$start_time = date('H:i:s', strtotime($start_time_string));
		$end_time = date('H:i:s', strtotime($end_time_string));
	
		$this->db->where("DATE_FORMAT(game_date, '%Y-%m-%d') =", $date)
				 ->where('game_id', $game)
				 ->group_start()
					 ->where("'$start_time' < end_time", null, false)
					 ->where("'$end_time' > start_time", null, false)
				 ->group_end();
	
		$query = $this->db->get('game_schedule');
		return $query->num_rows() == 0; 
	}
	public function mark_as_winner($bet_id) {
        $this->db->set('is_winner', '1');
        $this->db->where('id', $bet_id);
        return $this->db->update('consumer_bets');
    }

	public function mark_as_winner_new($item_id,$schedule_id) {
         $this->db->insert('game_schedule_winner',['item_id'=>$item_id,'schedule_id'=>$schedule_id]);
		 return $this->db->insert_id();
    }
	
	public function mark_as_winner_cancel($bet_id) {
        $this->db->set('is_winner', '0');
        $this->db->where('id', $bet_id);
        return $this->db->update('consumer_bets');
    }
	

}

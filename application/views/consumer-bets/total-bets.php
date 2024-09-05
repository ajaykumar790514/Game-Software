<div class="row">
    <?php $any_winner = false;
     foreach ($totalBet as $bet) {
        $is_winner = count($this->model->getData('game_schedule_winner', ['item_id' => $bet->id, 'schedule_id' => $bet->game_schedule_id]));
        if ($is_winner > 0) {
            $any_winner = true;
        }
    }
     foreach ($totalBet as $bet):
       $result= $this->model->getTotalValue($bet->id,$bet->game_id,$bet->game_schedule_id);
       $is_winner = count($this->model->getData('game_schedule_winner',['item_id'=>$bet->id,'schedule_id'=>$bet->game_schedule_id]))?>
        <div class="col-md-2">
            <div class="card bg-primary text-white text-center">
                <div class="card-body">
                    <span class="card-text text-white text-center">Item ( <?= @$bet->title; ?> )</span><br>
                    <span class="card-text text-white text-center">Value  Rs.<?= @$result->total_value; ?></span><br>
                    <span class="card-text text-white text-center">Total Bet <?= @$result->total_bets_one; ?></span>
                </div>
                <?php if ($any_winner): 
                    if($is_winner > 0):?>
                        <button class="btn btn-danger btn-sm" onclick="cancelWinner('')" > Winner</button>
                    <?php endif;else: ?>
                        <button class="btn btn-success btn-sm" onclick="isWinner('<?=$bet->id;?>','<?=@$bet->game_schedule_id;?>','<?=$bet->game_date;?>','<?=$bet->winning_x;?>','<?=$bet->game_id;?>')">Winner</button>
                    <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>


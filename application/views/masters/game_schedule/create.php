<script type="text/javascript">
$(".validate-form").validate({
  rules: {
        name:"required",
        description: "required",
        min_bet: "required",
        max_bet: "required",
        winning_x: "required",
        game_date: "required",
        start_time:"required",
        end_time:"required",
        status:"required",
    },
    messages : {
        game_id:"Please select game",
        description: "Please enter description",
        min_bet: "Please enter min bet",
        max_bet: "Please enter max bet",
        winning_x: "Please enter winning x ",
        game_date: "Please select game date",
        start_time:"Pleas enter start time",
        end_time:"please enter end time",
        status:"Please select status",
    }
});
</script>

<div class="card-content collapse show">
    <div class="card-body">
    <!-- form -->
    <form class="form ajaxsubmit validate-form reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            <div class="row">
             <div class="col-6">
             <div class="form-group">
                <label for="name">Game</label>
                <select name="game_id" id="" class="form-control">
                    <option value="">Select</option>
                    <?php foreach($games as $game):?>
                    <option value="<?=$game->id;?>" <?php if(@$row->game_id==$game->id){echo "selected";};?>><?=$game->name;?></option>
                    <?php endforeach;?>
                </select>
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                <label for="name">Winning X</label>
                <input type="number" class="form-control" placeholder="Winning X" name="winning_x" value="<?=@$row->winning_x?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                <label for="name">Min Bet</label>
                <input type="number" class="form-control" placeholder="Min bet" name="min_bet" value="<?=@$row->min_bet?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                <label for="name">Max Bet</label>
                <input type="number" class="form-control" placeholder="Max Bet" name="max_bet" value="<?=@$row->max_bet?>" >
                <label class="error text-danger"></label>
            </div>
            </div>

            <div class="col-6">
             <div class="form-group">
                <label for="name">Status</label>
                <select name="status" id="" class="form-control">
                    <option value="">Select</option>
                    <option value="ACTIVE" <?php if(@$row->status=='ACTIVE'){echo "selected";};?>>ACTIVE</option>
                    <option value="CANCELLED" <?php if(@$row->status=='CANCELLED'){echo "selected";};?>>CANCELLED</option>
                    <option value="COMPLETED" <?php if(@$row->status=='COMPLETED'){echo "selected";};?>>COMPLETED</option>
                    <option value="PENDING" <?php if(@$row->status=='PENDING'){echo "selected";};?>>PENDING</option>
                </select>
                <label class="error text-danger"></label>
            </div>
            </div>
         
            <div class="col-6">
            <div class="form-group">
                <label for="name">Game Date</label>
                <input type="date" class="form-control"  name="game_date" value="<?=@$row->game_date?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                <label for="name">Start Time</label>
                <input type="time" class="form-control"  name="start_time" value="<?=@$row->start_time?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                <label for="name">End Time</label>
                <input type="time" class="form-control"  name="end_time" value="<?=@$row->end_time?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
          </div>
        </div>
        <div class="form-actions text-right">
            <button type="reset" data-dismiss="modal" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Cancel
            </button>
            <button type="submit" class="btn btn-primary mr-1"  >
                <i class="ft-check"></i> Save
            </button>
        </div>
    </form>
    <!-- End: form -->
 </div>
</div>


<script type="text/javascript">
$(".validate-form").validate({
  rules: {
        title:{
            required:true,
        },
        game_id: "required",
    },
    messages : {
        title: "Please enter title",
        game_id: "Please select game",
    }
});
</script>

<div class="card-content collapse show">
    <div class="card-body">
    <!-- form -->
    <form class="form ajaxsubmit validate-form reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            <div class="row">
             <div class="col-12">
             <div class="form-group">
                <label for="name">Select Game</label>
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
                <label for="name">Title</label>
                <input type="text" class="form-control" placeholder="Enter title" name="title" value="<?=@$row->title?>" >
                <label class="error text-danger"></label>
                <label class="error1 text-danger"></label>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                <label for="name">SEQ</label>
                <input type="number" class="form-control" placeholder="Enter SEQ" name="seq" value="<?=@$row->seq?>" >
                <label class="error text-danger"></label>
                <label class="error1 text-danger"></label>
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

<script>
    $(document).ready(function() {
        $('input[name="title"]').on('change', function() {
            var game_id = $('select[name="game_id"]').val();
            var title = $('input[name="title"]').val();

            if(game_id && title) {
                $.ajax({
                    url: '<?= base_url('game-items/check-duplicate-title') ?>',
                    type: 'POST',
                    data: {game_id: game_id, title: title},
                    dataType: 'json',
                    success: function(response) {
                        if(response.is_duplicate) {
                            $('label.error1').text('This title already exists for the selected game.');
                            $('button[type="submit"]').attr('disabled', 'disabled');
                        } else {
                            $('label.error1').text('');
                            $('button[type="submit"]').removeAttr('disabled');
                        }
                    }
                });
            } else {
                $('label.error1').text('');
                $('button[type="submit"]').removeAttr('disabled');
            }
        });
    });
</script>


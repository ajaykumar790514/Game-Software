<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block"><?=$title?></h3>
                <div class="breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?=base_url()?>">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <?=$title?>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Base style table -->
            <section id="base-style">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                              
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-header p-1">
                                <form autocomplete="off" class="form dynamic-tb-search" action="<?=$tb_url?>" 
                                          method="POST" enctype="multipart/form-data" tagret-tb="#tb" >
                                        <div class="row justify-content-center">
                                        <div class="col-sm-2">
                                                <div class="form-group mb-0">
                                                    <label for="game_id">Game</label>
                                                   <select class="form-control input-sm game_id" name="game_id" id="game_id"  onchange="fetch_games(this.value)">
                                                      <option value="">Select</option>
                                                      <?php foreach($games as $game):?>
                                                       <option value="<?=$game->id;?>"><?=$game->name;?></option>
                                                        <?php endforeach;?>
                                                   </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group mb-0">
                                                    <label for="game_id">Game Items</label>
                                                   <select class="form-control input-sm game_item_id" id="game_item_id" name="game_item_id">
                                                      <option value="">Select</option>
                                                   </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group mb-0">
                                                    <label for="game_id">Game Date</label>
                                                    <select class="form-control input-sm game_date" id="game_date" name="game_date" onchange="fetch_dates(this.value)">
                                                      <option value="">Select</option>
                                                      <?php foreach($game_schedule as $date):?>
                                                     <option value="<?= date('Y-m-d', strtotime($date->game_date)) ?>"><?= date('d-m-Y', strtotime($date->game_date)) ?></option>
                                                        <?php endforeach;?>
                                                   </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group mb-0">
                                                    <label for="game_id">Game Schedule</label>
                                                   <select class="form-control input-sm game_schedule_id" id="game_schedule_id" name="game_schedule_id">
                                                      <option value="">Select</option>
                                                   </select>
                                                </div>
                                            </div>

                                            <div class="col-auto">
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-sm mt-2 mr-1"> Filter</button>
                                                    <button type="reset" class="btn btn-danger btn-sm mt-2"> Reset</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </form>
                            </div>
                            <div class="card-content collapse show d-none" id="tb">
                                

                            </div>
                            <div class="card-content collapse show">
                            <div class="card-body card-dashboard d-none" id="bet-show">
                            <h5><b>Total Bets</b></h5>
                                <div id="bet-data"></div>
                            </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Base style table -->
        </div>
    </div>
</div>
<!-- END: Content-->



<script type="text/javascript">
   function fetch_games(game_id)
   {
    var date = $('#game_date').val();
    $('#tb').removeClass('d-none');
    $.ajax({
        url: "<?php echo base_url('consumer-bets/fetch_game_item'); ?>",
        method: "POST",
        data: {
            game_id:game_id
        },
        success: function(data){
            $(".game_item_id").html(data);
        },
    });

   }

   function fetch_dates(date)
   {
    var game_id = $('#game_id').val();
    $.ajax({
        url: "<?php echo base_url('consumer-bets/fetch_game_schedule_id'); ?>",
        method: "POST",
        data: {
            game_id:game_id,date:date
        },
        success: function(data){
            $(".game_schedule_id").html(data);
        },
    });
    $.ajax({
        url: "<?php echo base_url('consumer-bets/fetch_game_schedule_id'); ?>",
        method: "POST",
        data: {
            game_id:game_id,date:date
        },
        success: function(data){
            $(".game_schedule_id").html(data);
        },
    });
   }
   $(document).ready(function() {
    function fetchTotalBet(gameScheduleId) {
        var game_id = $('#game_id').val();
        var game_date = $('#game_date').val();
        if (gameScheduleId) {
            $.ajax({
                url: '<?=base_url();?>consumer-bets/fetch_total_bet',
                method: 'POST',
                data: {game_item_id:$('#game_item_id').val(),gameScheduleId: gameScheduleId,game_date:game_date,game_id:game_id }, 
                dataType: 'html',
                success: function(response) {
                        $('#bet-show').removeClass('d-none');
                        $('#bet-data').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else{
            $('#bet-show').addClass('d-none');
        }
    }

   
    $('.game_schedule_id').change(function() {
        var gameScheduleId = $(this).val();
        fetchTotalBet(gameScheduleId);
    });
});

  
   

function isWinner(item_id,schedule_id,game_date,winning_x,game_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to mark this bet as a winner?",
        // icon: 'warning',  // Make sure the SweetAlert2 version supports this parameter
        showCancelButton: true,
        confirmButtonText: 'Yes, mark as winner!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
       if(result.value==true){
            $.ajax({
                url: '<?=base_url();?>consumer-bets/mark_winner', // Change to your endpoint
                type: 'POST',
                data: { item_id: item_id ,schedule_id:schedule_id,date:game_date,winning_x:winning_x,game_id:game_id},
                dataType: 'json',
                success: function(response) {
                    if (response.res == 'success') {
                        Swal.fire(
                            'Marked!',
                            'The bet has been marked as a winner.',
                            'success'
                        ).then(() => {
                            location.reload(); // Refresh the page or update the UI as needed
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            response.message || 'There was an issue marking the bet as a winner.',
                            'error'
                        );
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelled',
                'The bet remains unchanged.',
                'info'
            );
        }
    });
}
function cancelWinner() {
            Swal.fire(
                'Already  Declared Winner...',
            );
        }
// function cancelWinner(betId,date) {
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "Do you want to cancel the winner status for this bet?",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Yes, cancel winner!',
//         cancelButtonText: 'No, keep winner status!',
//         reverseButtons: true
//     }).then((result) => {
//        if(result.value==true){
//             $.ajax({
//                 url: '<?=base_url();?>consumer-bets/cancel_winner', // Change to your endpoint
//                 type: 'POST',
//                 data: { id: betId ,date:date },
//                 dataType: 'json',
//                 success: function(response) {
//                     if (response.res == 'success') {
//                         Swal.fire(
//                             'Cancelled!',
//                             'The winner status has been cancelled.',
//                             'success'
//                         ).then(() => {
//                             location.reload(); // Refresh the page or update the UI as needed
//                         });
//                     } else {
//                         Swal.fire(
//                             'Error!',
//                             response.message || 'There was an issue cancelling the winner status.',
//                             'error'
//                         );
//                     }
//                 }
//             });
//         } else if (result.dismiss === Swal.DismissReason.cancel) {
//             Swal.fire(
//                 'Cancelled',
//                 'The bet remains marked as a winner.',
//                 'info'
//             );
//         }
//     });
// }

</script>

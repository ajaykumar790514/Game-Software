<div class="card-body card-dashboard">
   <!-- <div class="row"> -->
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
           <thead>
               <tr>
                   <th>Sr. no.</th>
                   <th>Game Name</th>
                   <th>Min Bet</th>
                   <th>Max Bet</th>
                   <th>Winning X</th>
                   <th>Start Time</th>
                   <th>End Time</th>
                   <th>Game Date</th>
                   <th>Status</th>
                   <th class="text-center">Active</th>
                   <th style="width: 180px;">Action</th>
               </tr>
           </thead>
           <tbody>
               <?php $i=$page;
               foreach ($rows as $row) { ?>
               <tr >
                   <td class="sr_no"><?=++$i?></td>
                   <td><?=$row->game_name?></td>
                   <td><?=$row->min_bet?></td>
                   <td><?=$row->max_bet?></td>
                   <td><?=$row->winning_x?></td>
                   <td><?= date('g:i A', strtotime($row->start_time)) ?></td>
                   <td><?= date('g:i A', strtotime($row->end_time)) ?></td>
                   <td width="150px">
                   <?php
                    if (!empty($row->game_date)) {
                        $date = new DateTime($row->game_date);
                        echo htmlspecialchars($date->format('d M Y'));
                    } else {
                        echo "N/A"; 
                    }
                    ?>
                   </td>
                   <!-- <td><?=$row->status?></td> -->
                   <td width="250px">
                    <select name="status" class="form-control input-sm" 
                        <?php if ($row->status == 'CANCELLED' || $row->status == 'COMPLETED') echo 'disabled'; ?>>
                        <option value="">Select</option>
                        <option value="ACTIVE" <?php if(@$row->status=='ACTIVE'){echo "selected";};?>>ACTIVE</option>
                        <option value="CANCELLED" <?php if(@$row->status=='CANCELLED'){echo "selected";};?>>CANCELLED</option>
                        <option value="COMPLETED" <?php if(@$row->status=='COMPLETED'){echo "selected";};?>>COMPLETED</option>
                        <option value="PENDING" <?php if(@$row->status=='PENDING'){echo "selected";};?>>PENDING</option>
                    </select>
                </td>

                   <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status2" value="<?=($row->active==1) ? 0 : 1?>" data="<?=$row->id?>,game_schedule,id,active" ><i class="<?=($row->active==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                   </td>
                  
                   <td>
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Game Schedule - <?=$row->game_name?>" data-url="<?=$update_url?><?=$row->id?>" title="Update">
                           <i class="la la-pencil-square"></i>
                       </a>
                       <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$row->id?>" title="Delete" >
                           <i class="la la-trash"></i>
                       </a>
                   </td>
               </tr> 
               <?php } ?>
               
               
           </tbody>
           
       </table>

   </div>

   <div class="row">
        <div class="col-md-6 text-left">
            <span>Showing <?= (@$rows) ? $page+1 : 0 ?> to <?=$i?> of <?=$total_rows?> entries</span>
        </div>
        <div class="col-md-6 text-right">
            <?=$links?>
        </div>
    </div>
<!-- </div> -->
<script>
  $(document).ready(function() {
    $('select[name="status"]').on('change', function() {
        var status = $(this).val();
        var id = $(this).closest('tr').find('.changeStatus').attr('data').split(',')[0];

          Swal.fire({
            title: 'Are you sure?',
            text: "You want to change the status?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, change it!',
            cancelButtonText: 'No, keep it'
           }).then((result) => {
           if(result.value==true){
                $.ajax({
                    url: '<?= base_url('game-schedule/update_status') ?>',
                    type: 'POST',
                    data: {id: id, status: status},
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Changed!',
                                response.message,
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'An error occurred while updating the status.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});

</script>
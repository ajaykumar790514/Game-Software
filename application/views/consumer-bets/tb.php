<div class="card-body card-dashboard">
   <!-- <div class="row"> -->
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
           <thead>
               <tr align="center">
                   <th>Sr. no.</th>
                   <th>Consumer Name</th>
                   <th>Game</th>
                   <th>Game Item</th>
                   <th>Schedule Date</th>
                   <th>Game Schedule</th>
                   <th>Bet Value</th>
                   <!-- <th>Is Winner</th> -->
                   <!-- <th>Action</th> -->
               </tr>
           </thead>
           <tbody>
               <?php $i=$page;
               foreach ($rows as $row) {?>
               <tr align="center" >
                   <td class="sr_no"><?=++$i?></td>
                   <td><?=$row->consumer_name;?> ( <?=$row->mobile;?> )</td>
                   <td><?=$row->game_name?></td>
                   <td><?=$row->item_title?></td>
                   <td><?= date('d-m-Y h:i A', strtotime($row->game_date)) ?></td>
                   <td>
                    <?php
                    $startTime = new DateTime($row->start_time);
                    $formattedStartTime = $startTime->format('g:i A');

                    $endTime = new DateTime($row->end_time);
                    $formattedEndTime = $endTime->format('g:i A');
                    
                    echo htmlspecialchars($formattedStartTime . ' - ' . $formattedEndTime);
                    ?>
                </td>

                   <td>Rs. <?=$row->bet_value?></td>
                   <!-- <td>
                    <?php if ($row->is_winner == 1): ?>
                      Yes
                    <?php else: ?>
                        No
                    <?php endif; ?>
                </td> -->
                   <!-- <td>
                    <?php if ($row->is_winner == 1): ?>
                        <button class="btn btn-danger btn-sm" onclick="cancelWinner('<?=$row->id;?>','<?=$row->game_date;?>')" >Cancel Winner</button>
                        
                    <?php else: ?>
                        <button class="btn btn-success btn-sm" onclick="isWinner('<?=$row->id;?>','<?=$row->game_date;?>')">Winner</button>
                    <?php endif; ?>
                </td> -->

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

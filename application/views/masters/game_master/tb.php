<div class="card-body card-dashboard">
   <div class="row">
        <div class="col-sm-12 col-md-9">
        </div>
        <div class="col-sm-12 col-md-3">
            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                    <input type="search" class="form-control form-control-sm static-tb-search" tbtarget="#mytable"  placeholder="Search Game  Name" aria-controls="DataTables_Table_0" >
            </div>
        </div>
    </div>
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
                   <th>Color</th>
                   <!-- <th>Description</th> -->
                   <th class="text-center">Status</th>
                   <th style="width: 180px;">Action</th>
               </tr>
           </thead>
           <tbody>
               <?php $i=$page;
               foreach ($rows as $row) { ?>
               <tr >
                   <td class="sr_no"><?=++$i?></td>
                   <td><?=$row->name?></td>
                   <td><?=$row->min_bet?></td>
                   <td><?=$row->max_bet?></td>
                   <td><?=$row->winning_x?></td>
                   <td style="position: relative;">
                        <?php if (!empty($row->color)): ?>
                            <div style="width: 30px;cursor:pointer; height: 30px; border-radius: 50%; background-color: <?= htmlspecialchars($row->color) ?>; position: relative;">
                                <div style="display: none; position: absolute; top: 0; left: 100%; width: 100px; height: 50px; background-color: <?= htmlspecialchars($row->color) ?>; border-radius: 5px; z-index: 1000;"></div>
                            </div>
                        <?php else: ?>
                            No Color
                        <?php endif; ?>
                    </td>
                   <!-- <td><?//=$row->description?></td> -->
                   <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($row->active==1) ? 0 : 1?>" data="<?=$row->id?>,games,id,active" ><i class="<?=($row->active==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                   </td>
                  
                   <td>
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Game - <?=$row->name?>" data-url="<?=$update_url?><?=$row->id?>" title="Update">
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
    document.querySelectorAll('td > div').forEach(function(circle) {
        circle.addEventListener('mouseenter', function() {
            const popup = circle.querySelector('div');
            popup.style.display = 'block';
        });
        circle.addEventListener('mouseleave', function() {
            const popup = circle.querySelector('div');
            popup.style.display = 'none';
        });
    });
</script>
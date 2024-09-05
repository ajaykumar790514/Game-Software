<div class="card-body card-dashboard">
   <!-- <div class="row"> -->
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style text-center" id="mytable">
           <thead>
               <tr>
                   <th>Sr. no.</th>
                   <th>Game Name</th>
                   <th>Title</th>
                   <th>SEQ</th>
                   <th class="text-center">Status</th>
                   <th style="width: 180px;">Action</th>
               </tr>
           </thead>
           <tbody>
               <?php $i=$page;
               foreach ($rows as $row) { ?>
               <tr >
                   <td class="sr_no"><?=++$i?></td>
                   <td><?=$row->game_name?></td>
                   <td><?=$row->title?></td>
                   <td class="text-center">
                   <input type="number" value="<?=$row->seq;?>" data="<?=$row->id;?>,game_items,id,seq" class="change-indexing" min="0" style="text-align:center;width:80px">
                   </td>
                   <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($row->active==1) ? 0 : 1?>" data="<?=$row->id?>,game_items,id,active" ><i class="<?=($row->active==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                   </td>
                  
                   <td>
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Game Item - <?=$row->game_name?>" data-url="<?=$update_url?><?=$row->id?>" title="Update">
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

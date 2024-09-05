<div class="card-body card-dashboard">
   <p class="card-text text-danger">Please do not modify</p>
   <div class="row">
        <div class="col-sm-12 col-md-6">
            <!-- <div class="dataTables_length" id="DataTables_Table_0_length">
                <label>
                    Show 
                    <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-control form-control-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select> 
                    entries
                </label>
            </div> -->
        </div>
        <div class="col-sm-12 col-md-6">
            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                <label>
                    <input type="search" class="form-control form-control-sm" id="tb-search" placeholder="Search" aria-controls="DataTables_Table_0" >
                </label>
            </div>
        </div>
    </div>
   <!-- <div class="row"> -->
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
           <thead>
               <tr>
                   <th>Sr. no.</th>
                   <th>Title</th>
                   <th>Indexing</th>
                   <th class="text-center">Status</th>
                   <th style="width: 180px;">Action</th>
               </tr>
           </thead>
           <tbody>
               <?php $i=0;
               foreach ($rows as $row) { 
                if ($row->parent=='') { ?>
               <tr class="table-inverse">
                   <td><?=++$i?></td>
                   <td><?=$row->title?></td>
                   <td class="text-center">
                        <input type="number" value="<?=$row->indexing?>" data="<?=$row->id?>,tb_admin_menu,id,indexing" class="change-indexing" min="0">
                    </td>
                   
                   <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($row->status==1) ? 0 : 1?>" data="<?=$row->id?>,tb_admin_menu,id,status" ><i class="<?=($row->status==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                   </td>
                  
                   <td>
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Admin Menu - <?=$row->title?>" data-url="<?=$update_url?><?=$row->id?>" title="Update">
                           <i class="la la-pencil-square"></i>
                       </a>

                       <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$row->id?>" title="Delete" >
                           <i class="la la-trash"></i>
                       </a>
                   </td>
               </tr> 

                   <?php $j=0;
                   foreach ($rows as $c_row) { 
                    if ($c_row->parent==$row->id) { ?>
                   <tr>
                       <td class="text-right"><?=++$j?></td>
                       <td><?=nbs(5)?><?=$c_row->title?></td>
                       <td class="text-center">
                            <input type="number" value="<?=$c_row->indexing?>" data="<?=$c_row->id?>,tb_admin_menu,id,indexing" class="change-indexing" min="0">
                        </td>
                       <!-- <td><?=$c_row->indexing?></td> -->
                       
                       <td class="text-center">
                           <span class="changeStatus" data-toggle="change-status" value="<?=($c_row->status==1) ? 0 : 1?>" data="<?=$c_row->id?>,tb_admin_menu,id,status" ><i class="<?=($c_row->status==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                       </td>
                      
                       <td>
                           <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Admin Menu - <?=$c_row->title?>" data-url="<?=$update_url?><?=$c_row->id?>" title="Update">
                               <i class="la la-pencil-square"></i>
                           </a>

                           <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$c_row->id?>" title="Delete" >
                               <i class="la la-trash"></i>
                           </a>
                       </td>
                   </tr> 
                   <?php } } ?>


               <?php } } ?>
               
               
           </tbody>
           
       </table>

   </div>

 
<!-- </div> -->

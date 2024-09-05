<div class="card-body card-dashboard">
   <div class="row">
       <div class="col-sm-8"></div>
        <div class="col-sm-4">
            <div id="DataTables_Table_0_filter col-12" class="dataTables_filter">
                    <input type="search" class="col-12 form-control form-control-sm static-tb-search" tbtarget="#mytable"  placeholder="Search Name / Email / Mobile..." aria-controls="DataTables_Table_0" >
            </div>
        </div>
    </div>
   <!-- <div class="row"> -->
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
           <thead>
               <tr align="center">
                   <th>Sr. no.</th>
                   <th>Photo</th>
                   <th>Name</th>
                   <th>Mobile</th>
                   <th>Email</th>
                   <th class="text-center">Status</th>
                   <th style="width: 180px;">Action</th>
               </tr>
           </thead>
           <tbody>
               <?php $i=$page;
               foreach ($rows as $row) {
                if ($row->photo != null) {
                    $result =  '<img src="' . IMGS_URL.$row->photo . '" height="70px" width="70px" style="border-radius:5px">';
                } else {
                    $result = '<h1 style="height:70px;width:70px;border-radius:10px;padding-top:15px;font-size:3rem;text-align:center;text-transform:capitalize;background:#7271CF;color:#FFF">' . substr($row->name, 0, 1) . '</h1>';
                }?>
               <tr align="center" >
                   <td class="sr_no"><?=++$i?></td>
                   <td><?=$result;?></td>
                   <td><?=$row->name?></td>
                   <td><?=$row->mobile?></td>
                   <td><?=$row->email?></td>
                   <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($row->active==1) ? 0 : 1?>" data="<?=$row->id?>,consumers,id,active" ><i class="<?=($row->active==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                   </td>
                  
                   <td  align="center">
                       <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Consumers - <?//=$row->name?>" data-url="<?//=$update_url?><?//=$row->id?>" title="Update">
                           <i class="la la-pencil-square"></i>
                       </a> -->
                       <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$row->id?>" title="Delete" >
                           <i class="la la-trash"></i>
                       </a>
                       <br>
                       <a target="_blank" href="<?=base_url('consumers-wallet/'.$row->id);?>"  title="Wallet" class="btn btn-sm btn-primary" style="position: relative;left: 38px;">
                        Wallet
                       </a>
                       <br>
                       <a target="_blank" href="<?=base_url('consumers-withdrawals/'.$row->id);?>"  title="Withdrawals" class="btn btn-sm btn-primary" style="position: relative;left: 24px;top:3px">
                       Withdrawals
                       </a>
                       <a href="javascript:void(0)" data-toggle="modal" class="btn btn-sm btn-primary" data-target="#showModal" data-whatever=" Consumers  Accounts- <?=$row->name?>" data-url="<?=$account_url?><?=$row->id?>" title="Accounts" style="position: relative;left: 32px;top:5px">
                          Accounts
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



<div class="card-content collapse show">
    <div class="card-body">

       <div class="row">
         <div class="h5">Bank Accounts</div>
          <div class="table-responsive pt-1">
            <table class="table table-bordered base-style" id="mytable">
               <thead>
               <tr align="center">
                   <th>Sr. no.</th>
                   <th>Account No</th>
                   <th>IFSC Code</th>
                   <th>Bank Name</th>
                   <th>Account Name</th>
                   <th>Verify Status</th>
                   <th>Active Status</th>
               </tr>
               </thead>
                <tbody>
                    <?php $i=1; foreach($banks as $bank):?>
                <tr align="center">
                   <td><?=$i;?></td>
                   <td><?=$bank->account_no;?></td>
                   <td><?=$bank->ifsc;?></td>
                   <td><?=$bank->bank_name;?></td>
                   <td><?=$bank->account_name;?></td>
                   <td class="text-center statusCol">
                        
                        <?php if( $bank->status == 'VERIFIED' ): ?>

                            <span class="changeStatus">
                                <i class="la la-check-circle"></i>
                            </span>

                        <?php elseif( $bank->status == 'REJECTED' ):?>
                            <span class="changeStatus">
                                <i class="icon-close"></i>
                            </span>

                            <?php else: ?>

                        <div class="input-group-sm mb-3" style="width:150px">
                            <?php 
                                $array = array(
                                    '' => 'Select',
                                    'VERIFIED' => 'Verified',
                                    'PENDING' => 'Pending',
                                    'REJECTED' => 'Rejected'
                                );
                                echo form_dropdown('status', $array, set_value('status', $bank->status), 'class="form-control input-sm"' )
                            ?>
                            <input type="text" class="form-control input-sm" name="rejected_reason" value="<?= $bank->rejected_reason ?>" style="display:<?= ($bank->status == 'REJECTED') ? 'block' : 'none' ?>;" placeholder="Rejected Reason" />
                            <button class="btn btn-sm btn-outline-primary btn-block status-btn" data="<?= $bank->id ?>"><i class="la la-save"></i></button>
                        </div>
                        <?php endif; ?>
                    </td>
                   <td>
                   <span class="changeStatus" data-toggle="change-status" value="<?=($bank->active==1) ? 0 : 1?>" data="<?=$bank->id?>,consumer_account,id,active" ><i class="<?=($bank->active==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                   </td>
                </tr>
                <?php $i++; endforeach;?>
              </tbody>
          </table>
       </div>

         <div class="h5">UPI Accounts</div>
         <div class="table-responsive pt-1">
            <table class="table table-bordered base-style" id="mytable">
               <thead>
               <tr align="center">
                   <th>Sr. no.</th>
                   <th>UPI ID</th>
                   <th>Verify Status</th>
                   <th>Active Status</th>
               </tr>
               </thead>
             <tbody>
             <?php $i2=1; foreach($upis as $upi):?>
                <tr align="center">
                   <td><?=$i2;?></td>
                   <td><?=$upi->upi_id;?></td>
                   <td class="text-center statusCol2">
                        
                     
                   <?php if( $upi->status == 'VERIFIED' ): ?>

                    <span class="changeStatus">
                        <i class="la la-check-circle"></i>
                    </span>

                    <?php elseif( $upi->status == 'REJECTED' ):?>
                    <span class="changeStatus">
                        <i class="icon-close"></i>
                    </span>

                    <?php else: ?>

                        <div class="input-group-sm mb-3" style="width:150px">
                            <?php 
                                $array = array(
                                    '' => 'Select',
                                    'VERIFIED' => 'Verified',
                                    'PENDING' => 'Pending',
                                    'REJECTED' => 'Rejected'
                                );
                                echo form_dropdown('status2', $array, set_value('status2', $upi->status), 'class="form-control input-sm"');
                            ?>
                            <input type="text" class="form-control input-sm" name="rejected_reason2" value="<?= $upi->rejected_reason ?>" style="display:<?= ($upi->status == 'REJECTED') ? 'block' : 'none' ?>;" placeholder="Rejected Reason" />
                            <button class="btn btn-sm btn-outline-primary btn-block status-btn2" data="<?= $upi->id ?>"><i class="la la-save"></i></button>
                        </div>
                        <?php endif; ?>
                    </td>
                   <td>
                   <span class="changeStatus" data-toggle="change-status" value="<?=($upi->active==1) ? 0 : 1?>" data="<?=$upi->id?>,consumer_account,id,active" ><i class="<?=($upi->active==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                   </td>
                </tr>
                <?php $i2++; endforeach;?>
           </tbody>
          </table>
       </div>
       </div>
    
 </div>
</div>


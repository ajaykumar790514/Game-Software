<style>
    .changeStatus
    {
        font-size:1rem;
    }
</style>
<div class="card-body card-dashboard">
  
   <!-- <div class="row"> -->
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
           <thead>
               <tr>
                   <th>Sr. no.</th>
                   <th>Request Date</th>
                   <th>Status</th>
                   <th>Reason</th>
                   <th>Payment Method</th>
                   <th>Amount</th>
               </tr>
           </thead>
           <tbody>
               <?php $i=$page;
               $TAmount = 0;
               foreach ($rows as $row) {?>
               <tr  data-id="<?=$row->id;?>">
                   <td class="sr_no"><?=++$i?></td>
                   <td>
                      <?php
                    if (!empty($row->request_date)) {
                        $date = new DateTime($row->request_date);
                        echo $data= htmlspecialchars($date->format('d F Y g:i A'));
                    } else {
                        echo $data="N/A"; 
                    }
                    ?>
                    </td>
                    <td class="statusCol_<?= $row->id ?>">
                        
                        <?php if( $row->status == 'SUCCESS' ): ?>

                            <span class="changeStatus">
                               Success  <i class="la la-info text-primary" data-toggle="modal" data-target="#exampleModal<?=$row->id;?>"></i>
                            </span>

                        <?php elseif( $row->status == 'REJECTED' ):?>
                            <span class="changeStatus">
                               Rejected
                            </span>

                            <?php elseif( $row->status == 'FAILED' ):?>
                            <span class="changeStatus">
                                Failed
                            </span>

                            <?php else: ?>

                        <div class="input-group-sm mb-3" style="width:150px">
                            <?php 
                                $array = array(
                                    '' => 'Select',
                                    'SUCCESS' => 'Success',
                                    'PENDING' => 'Pending',
                                    'REJECTED' => 'Rejected',
                                    'FAILED'=>'Failed',
                                );
                                echo form_dropdown('status', $array, set_value('status', $row->status), 'class="form-control input-sm"' )
                            ?>
                            <input type="text" class="form-control input-sm" name="rejected_reason" value="<?= $row->reject_reason ?>" style="display:<?= ($row->status == 'REJECTED') ? 'block' : 'none' ?>;" placeholder="Rejected Reason" />
                            <button class="btn btn-sm btn-outline-primary btn-block status-btn" data="<?= $row->id ?>"><i class="la la-save"></i></button>
                        </div>
                        <?php endif; ?>
                    </td>

                    <td><?=$row->reject_reason;?></td>
                    <td><?=$row->payment_method;?></td>
                   <td>Rs. <?=$row->amount?></td>
               </tr> 

             <!-- View Tra -->
                <div class="modal fade" id="exampleModal<?=$row->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Request Date <?=$data;?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php $rs = $this->db->get_where('consumer_wallet',['ref_id'=>$row->id])->row();?>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <p>Account Type :- <?=$rs->account_type;?></p>
                                </div>
                                <div class="col-12">
                                    <p>Details</p>
                                    <hr>
                                    <?php 
                                    if($rs->account_type=='BANK'){
                                    ?>
                                    <p>Account NO :- <?=$rs->account_no;?></p>
                                    <p>Account Name :- <?=$rs->account_name;?></p>
                                    <p>Bank Name:- <?=$rs->bank_name;?></p>
                                    <p>IFSC :- <?=$rs->ifsc;?></p>
                                    <?php }else{?>
                                    <p>UPI ID :- <?=$rs->upi_id;?></p>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>
                
               <!-- Payment Modal -->
               <div class="modal fade" id="myModal_<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Request Date <?=$data;?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                          <div class="row justify-content-center">
                            <input type="hidden" id="cust_id_<?= $row->id ?>" value="<?=$row->consumer_id;?>">
                            <input type="hidden" id="row_id_<?= $row->id ?>" value="<?=$row->id;?>">
                            <input type="hidden" id="amount_<?= $row->id ?>" value="<?=$row->amount;?>">
                            <div class="col-md-6">
                            <p class="text-center">Select Payment Mode</p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paymentMode" id="bankRadio<?=$row->id;?>" value="bank" data-id="bank" onclick="handlePaymentMode(<?=$row->id;?>)">
                                <label class="form-check-label" for="bankRadio<?=$row->id;?>">Bank</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paymentMode" id="upiRadio<?=$row->id;?>" value="upi" data-id="upi" onclick="handlePaymentMode(<?=$row->id;?>)">
                                <label class="form-check-label" for="upiRadio<?=$row->id;?>">UPI</label>
                            </div>
                        </div>

                          </div>
                      </div>
                      <select name="paymentMode_upi_id" class="form-control upi_id_<?= $row->id ?>" id="upiOptions_<?=$row->id;?>" style="display: none;">
                    </select>
                    <select  name="paymentMode_upi_id" class="form-control bank_id_<?= $row->id ?> " id="bankOptions_<?=$row->id;?>" style="display: none;">
                    </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  type="button" onclick="payButton('<?=$row->id;?>')" class="btn btn-primary">Submit</button>
                    </div>
                    </div>
                </div>
                </div>
               <?php 
               $TAmount = $TAmount+$row->amount;
             } ?>
               <tr >
                <th style="text-align: right;" colspan="4">Total</th>
                <th><b style="font-size:1.2rem">Rs. <?=bcdiv($TAmount, 1, 2);?></b></th>
               </tr>
               
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
 <!-- Modal -->
     

<!-- </div> -->
<script>
    $(document).ready(function(){
        $('body').on('change', 'select[name=status]', function(){
        let status = $(this).val();
        let rowId = $(this).closest('tr').data('id'); 
        if (status == 'REJECTED') {
            $(this).parents('.input-group-sm').find('input[name=rejected_reason]').fadeIn('slow');
            $(this).closest('td').find('.status-btn').show();
        } else {
            $(this).parents('.input-group-sm').find('input[name=rejected_reason]').fadeOut('slow');
            $(this).closest('td').find('.status-btn').show();
        }
        
        if (status == 'SUCCESS') {
            $(this).closest('td').find('.status-btn').hide(); 
            $('#myModal_' + rowId).modal('show'); // Show the modal corresponding to the row
        }
    });

    $('body').on('click', '.status-btn', function(){
        let id = $(this).attr('data');
        let status = $(this).parents('.input-group-sm').find('select[name=status]').val();
        let rejected_reason = $(this).parents('.input-group-sm').find('input[name=rejected_reason]').val();
        $.post(`<?= base_url('Consumers/update_status_withdrawls') ?>`, {id:id,status:status,rejected_reason:rejected_reason}, function(data){
            if( data == 'true' ){
                if(status=="SUCCESS")
                {
                    $('.statusCol_'+id).html("<span class='changeStatus'>Success</span>");
                    alert_toastr("success","success");
                }
                else if(status=="REJECTED")
                {
                    $('.statusCol_'+id).html("<span class='changeStatus'>Rejected</span>");
                    alert_toastr("success","success");
                } else if(status=="FAILED")
                {
                    $('.statusCol_'+id).html("<span class='changeStatus'>Failed");
                    alert_toastr("success","success");
                }else{
                    alert_toastr("success","success"); 
                }
            }else{
                alert_toastr("error","error");
            }
        });
    });
});


</script>
<script>
   function payButton(id) {
        var upiId = $('.upi_id_'+id).val();
        var bankId = $('.bank_id_'+id).val();
        var selectedMode = upiId || bankId;
        var cust_id = $("#cust_id_"+id).val();
        var amount = $("#amount_"+id).val();
        
        if (!selectedMode) {
            alert('Please select a payment mode.');
            return;
        }
        $.ajax({
            url: '<?=base_url();?>Consumers/update_to_wallet',
            type: 'POST',
            data:{id:id,cust_id :cust_id,selectedMode:selectedMode,amount:amount},
            success: function(response) {
                if( response == 'true' ){
                    $('.statusCol_'+id).html("<span class='changeStatus'>Success  <i class='la la-info text-primary' data-toggle='modal' data-target='#exampleModal"+id+"'></i></span>");
                    location.reload();
                    alert_toastr("success","success");
                    $('#myModal_'+id).modal('hide');
            }else{
                alert_toastr("error","error");
            }
            },
            error: function(xhr, status, error) {
                console.error('Error loading UPI options:', error);
            }
        });
    }
function loadBankOptions(id) {
        var cust_id = $("#cust_id_"+id).val();
        $.ajax({
            url: '<?=base_url();?>Consumers/fetchBankOptions',
            type: 'POST',
            data:{id :cust_id},
            success: function(response) {
                $('#bankOptions_'+id).html(response); 
            },
            error: function(xhr, status, error) {
                console.error('Error loading bank options:', error);
            }
        });
    }

    function loadUpiOptions(id) {
        var cust_id = $("#cust_id_"+id).val();
        $.ajax({
            url: '<?=base_url();?>Consumers/fetchUpiOptions',
            type: 'POST',
            data:{id :cust_id},
            success: function(response) {
                $('#upiOptions_'+id).html(response); 
            },
            error: function(xhr, status, error) {
                console.error('Error loading UPI options:', error);
            }
        });
    }
function handlePaymentMode(rowId) {
    $('input[name="paymentMode"]').change(function() {
        var selectedMode = $(this).val();
        // Adjust the selector to target the radio buttons specific to the row
        var bankRadioId = '#bankRadio' + rowId;
        var upiRadioId = '#upiRadio' + rowId;
    //    alert(selectedMode);
        if (selectedMode === 'bank') {
            loadBankOptions(rowId); 
            $(bankRadioId).prop('checked', true); // Ensure the radio button is selected
            $('#bankOptions_'+rowId).show();
            $('#upiOptions_'+rowId).hide();
        } else if (selectedMode === 'upi') {
            loadUpiOptions(rowId); 
            $(upiRadioId).prop('checked', true); // Ensure the radio button is selected
            $('#bankOptions_'+rowId).hide();
            $('#upiOptions_'+rowId).show();
        }
    });
}
</script>
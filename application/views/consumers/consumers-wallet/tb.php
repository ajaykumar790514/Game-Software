<div class="card-body card-dashboard">
  
   <!-- <div class="row"> -->
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
           <thead>
               <tr>
                   <th>Sr. no.</th>
                   <th>Transation Head</th>
                   <!-- <th>Ref By</th> -->
                   <th>Date</th>
                   <th>Debit</th>
                   <th>Credit</th>
               </tr>
           </thead>
           <tbody>
               <?php $i=$page;
               $TDebit = $TCredit =0;
               foreach ($rows as $row) {?>
               <tr  >
                   <td class="sr_no"><?=++$i?></td>
                   <td><?=$row->transaction_head;?></td>
                   <!-- <td><?=$row->ref_id?></td> -->
                   <td>
                      <?php
                    if (!empty($row->date)) {
                        $date = new DateTime($row->date);
                        echo htmlspecialchars($date->format('d F Y g:i A'));
                    } else {
                        echo "N/A"; 
                    }
                    ?>
                    </td>
                   <td>Rs. <?=$row->debit?></td>
                   <td>Rs. <?=$row->credit?></td>
               </tr> 
               <?php 
               $TDebit = $TDebit+$row->debit;
               $TCredit = $TCredit+$row->credit;
             } ?>
               <tr >
                <th style="text-align: right;" colspan="3">Total</th>
                <th><b style="font-size:1.2rem">Rs. <?=bcdiv($TDebit, 1, 2);?></b></th>
                <th><b style="font-size:1.2rem">Rs.  <?=bcdiv($TCredit, 1, 2);?></b></th>
               </tr>
               <tr >
                <th style="text-align: right;" colspan="3">Balance</th>
                <th colspan="2">Rs. <?php echo bcdiv(abs($TCredit-$TDebit), 1, 2) ;?></th>
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
 
<!-- </div> -->

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
                                <h4 class="card-title">
                                    <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="New <?=$title?>" data-url="<?=$new_url?>" class="btn btn-primary btn-sm" class="btn btn-primary btn-sm add-btn"> 
                                        <i class="ft-plus"></i> Add New <?//=$title?>
                                    </a> -->
                                </h4>
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
                            <div class="card-content collapse show" id="tb">
                                

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
    
$(document).ready(function(){
    $('body').on('change', 'select[name=status]', function(){
        let status = $(this).val();
        if( status == 'REJECTED' ){
            $(this).parents('.input-group-sm').find('input[name=rejected_reason]').fadeIn('slow');
        }else{
            $(this).parents('.input-group-sm').find('input[name=rejected_reason]').fadeOut('slow');
        }
    });

    $('body').on('click', '.status-btn', function(){
        let id = $(this).attr('data');
        let status = $(this).parents('.input-group-sm').find('select[name=status]').val();
        let rejected_reason = $(this).parents('.input-group-sm').find('input[name=rejected_reason]').val();
        $.post(`<?= base_url('consumers/change_status_account') ?>`, {id:id,status:status,rejected_reason:rejected_reason}, function(data){
            if( data == 'true' ){
                if(status=="VERIFIED")
                {
                    $('.statusCol').html("<span class='changeStatus'><i class='la la-check-circle'></i></span>");
                    alert_toastr("success","success");
                }
                else if(status=="REJECTED")
                {
                    $('.statusCol').html("<span class='changeStatus'><i class='icon-close'></i></span>");
                    alert_toastr("success","success");
                }
                else{
                    alert_toastr("success","success"); 
                }
            }else{
                alert_toastr("error","error");
            }
        });
    });



    $('body').on('change', 'select[name=status2]', function(){
        let status = $(this).val();
        if( status == 'REJECTED' ){
            $(this).parents('.input-group-sm').find('input[name=rejected_reason2]').fadeIn('slow');
        }else{
            $(this).parents('.input-group-sm').find('input[name=rejected_reason2]').fadeOut('slow');
        }
    });

    $('body').on('click', '.status-btn2', function(){
        let id = $(this).attr('data');
        let status = $(this).parents('.input-group-sm').find('select[name=status2]').val();
        let rejected_reason = $(this).parents('.input-group-sm').find('input[name=rejected_reason2]').val();
        $.post(`<?= base_url('consumers/change_status_upi') ?>`, {id:id,status:status,rejected_reason:rejected_reason}, function(data){
            if( data == 'true' ){
                if(status=="VERIFIED")
                {
                    $('.statusCol2').html("<span class='changeStatus'><i class='la la-check-circle'></i></span>");
                    alert_toastr("success","success");
                }
                else if(status=="REJECTED")
                {
                    $('.statusCol2').html("<span class='changeStatus'><i class='icon-close'></i></span>");
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


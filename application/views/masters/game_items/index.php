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
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="New <?=$title?>" data-url="<?=$new_url?>" class="btn btn-primary btn-sm" class="btn btn-primary btn-sm add-btn"> 
                                        <i class="ft-plus"></i> Add New <?=$title?>
                                    </a>
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
                            <div class="card-header p-1">
                                <form autocomplete="off" class="form dynamic-tb-search" action="<?=$tb_url?>" 
                                          method="POST" enctype="multipart/form-data" tagret-tb="#tb" >
                                        <div class="row justify-content-center">
                                        <div class="col-sm-3">
                                                <div class="form-group mb-0">
                                                    <label for="game_id">Game</label>
                                                   <select class="form-control input-sm game_id" name="game_id" id="game_id" >
                                                      <option value="">Select</option>
                                                      <?php foreach($games as $game):?>
                                                       <option value="<?=$game->id;?>"><?=$game->name;?></option>
                                                        <?php endforeach;?>
                                                   </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                            <div class="form-group mb-0">
                                                    <label for="name">Search Game Name / Game Title</label>
                                                    <input autocomplete="false" name="name" id="name" class="form-control input-sm" placeholder="Search Game Name / Game Title" />
                                                </div>
                                            </div>

                                            <div class="col-auto">
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-sm mt-2 mr-1"> Filter</button>
                                                    <button type="reset" class="btn btn-danger btn-sm mt-2"> Reset</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </form>
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


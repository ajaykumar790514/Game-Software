


<div class="content-wrapper">
    <!-- <div class="content-wrapper-before"></div> -->
    <div class="content-header row">
    </div>
    <div class="content-body">
        <section id="minimal-statistics-bg">
            <div class="row">
                <div class="col-12 mt-3 mb-1">
                    <!-- <h4 class="text-uppercase">Statistics</h4> -->
                    <!-- <p></p> -->
                </div>
            </div>
            <?php if($user->user_role==7){?>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="<?=base_url();?>appointments">
                    <div class="card bg-gradient-x-purple-blue">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-top">
                                        <i class="la la-stethoscope text-white font-large-4 float-left"></i>
                                    </div>
                                    <div class="media-body text-white text-right align-self-bottom mt-3">
                                        <span class="d-block mb-1 font-medium-1">Total Appointments </span>
                                        <h1 class="text-white mb-0"><?=$app;?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                <a href="<?=base_url();?>patients">
                    <div class="card bg-gradient-x-purple-red">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-top">
                                        <i class="icon-users icon-opacity text-white font-large-4 float-left"></i>
                                    </div>
                                    <div class="media-body text-white text-right align-self-bottom mt-3">
                                        <span class="d-block mb-1 font-medium-1">Total Patients</span>
                                        <h1 class="text-white mb-0"><?=$patient;?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>

                <!-- <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card bg-gradient-x-blue-green">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-top">
                                        <i class="icon-users icon-opacity text-white font-large-4 float-left"></i>
                                    </div>
                                    <div class="media-body text-white text-right align-self-bottom mt-3">
                                        <span class="d-block mb-1 font-medium-1">Total Users</span>
                                        <h1 class="text-white mb-0">0</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card bg-gradient-x-orange-yellow">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-top">
                                        <i class="icon-tag icon-opacity text-white font-large-4 float-left"></i>
                                    </div>
                                    <div class="media-body text-white text-right align-self-bottom mt-3">
                                        <span class="d-block mb-1 font-medium-1">Total packages</span>
                                        <h1 class="text-white mb-0">0</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <?php }?>
            <div class="row">
                
                

              
            </div>
        </section>
    </div>
</div>


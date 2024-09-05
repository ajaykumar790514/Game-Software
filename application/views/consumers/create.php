<script type="text/javascript">
$(".validate-form").validate({
  rules: {
        name:{
            required:true,
            remote:"<?=$remote?>"
        },
        mobile: "required",
        email: "required",
    },
    messages : {
        name:{
            remote: "Name already exist !"
        },
        mobile: "Please enter mobile",
        email: "Please enter email",
    }
});
</script>

<div class="card-content collapse show">
    <div class="card-body">
    <!-- form -->
    <form class="form ajaxsubmit validate-form reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            <div class="row">
             <div class="col-6">
             <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Name" name="name" value="<?=@$row->name?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-6">
             <div class="form-group">
                <label for="name">Photo</label>
                <input type="file" class="form-control" name="img"  >
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                <label for="name">Mobile</label>
                <input type="number" class="form-control" placeholder="Mobile" name="mobile" value="<?=@$row->mobile?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email" value="<?=@$row->email?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
           
          </div>
        </div>
        <div class="form-actions text-right">
            <button type="reset" data-dismiss="modal" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Cancel
            </button>
            <button type="submit" class="btn btn-primary mr-1"  >
                <i class="ft-check"></i> Save
            </button>
        </div>
    </form>
    <!-- End: form -->
 </div>
</div>


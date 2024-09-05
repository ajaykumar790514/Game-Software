<script type="text/javascript">
$(".validate-form").validate({
  rules: {
        name:{
            required:true,
            remote:"<?=$remote?>"
        },
        description: "required",
        min_bet: "required",
        max_bet: "required",
        winning_x: "required",
        color: "required"
    },
    messages : {
        name:{
            remote: "Game name already exist !"
        },
        description: "Please enter description",
        min_bet: "Please enter min bet",
        max_bet: "Please enter max bet",
        winning_x: "Please enter winning x ",
        color: "Please enter color"
    }
});
</script>

<div class="card-content collapse show">
    <div class="card-body">
    <!-- form -->
    <form class="form ajaxsubmit validate-form reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            <div class="row">
             <div class="col-12">
             <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Name" name="name" value="<?=@$row->name?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                <label for="name">Min Bet</label>
                <input type="number" class="form-control" placeholder="Min bet" name="min_bet" value="<?=@$row->min_bet?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                <label for="name">Max Bet</label>
                <input type="number" class="form-control" placeholder="Max Bet" name="max_bet" value="<?=@$row->max_bet?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                <label for="name">Winning X</label>
                <input type="number" class="form-control" placeholder="Winning X" name="winning_x" value="<?=@$row->winning_x?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
                <label for="name">Color</label>
                <input type="text" class="form-control" placeholder="Color" name="color" value="<?=@$row->color?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
            <div class="col-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="5" id="editor" class="form-control" name="description"><?=@$row->description?></textarea>
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
<script>
CKEDITOR.replace( 'editor', {
toolbar: [
{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
'/',
{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
'/',
{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
{ name: 'others', items: [ '-' ] },
]
});
</script>

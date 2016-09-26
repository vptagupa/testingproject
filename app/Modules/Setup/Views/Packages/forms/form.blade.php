<?php 
    $data = App\Modules\Setup\Models\HotelPackage::where('index_id',decode(Request::get('key')))->get();
    $data = isset($data[0]) ? $data[0] : [];
 ?>
<!-- BEGIN FORM-->
<form class="horizontal-form form_crud" action="#" method="POST">
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                @include('errors.event')
            </div>
        </div>
        <h4><b>Information</b></h4>
        <input type="hidden" name="key" id="key" value="{{ encode(getObjectValue($data,'index_id')) }}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Package Name <small><i class="text-danger">*</i></small></label>
                    <input type="text" placeholder="" class="form-control input-xs" name="name" id="name" value="{{ getObjectValue($data,'package') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Price <small><i class="text-danger">*</i></small></label>
                    <input type="text" placeholder="0.0" class="form-control numberonly input-xs" name="price" id="price" value="{{ getObjectValue($data,'price') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
    </div>
    <div class="form-actions right">
        <button class="btn default btn_reset" type="button">Reset</button>
        <button class="btn gray hide" id="BtnAdd" type="button"><i class="fa fa-plus"></i> Add</button>
        <button class="btn blue btn_action btn_save" type="button"><i class="fa fa-check"></i> Save</button>
    </div>
</form>
<!-- END FORM-->
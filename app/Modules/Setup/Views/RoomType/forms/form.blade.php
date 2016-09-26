<?php $data = isset($data) ? $data : array(); ?>
<!-- BEGIN FORM-->
<form class="horizontal-form form_crud" action="#" method="POST">
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                @include('errors.event')
            </div>
        </div>
        <h4><b>Information</b></h4>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Name <small><i class="text-danger">*</i></small></label>
                    <input type="text" placeholder="First Name" class="form-control input-xs" name="name" id="name" value="{{ getObjectValue($data,'name') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
         <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Description</label>
                    <textarea class="form-control" name="description">{{ getObjectValue($data,'description') }}</textarea>
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
         <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Extra Bed Amount <small><i class="text-danger">*</i></small></label>
                    <input type="text" placeholder="First Name" class="form-control numberonly input-xs" name="BedAmount" id="BedAmount" value="{{ getObjectValue($data,'bed_amount') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
         <!--/row-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Color</label>
                    <input type="text" placeholder="Color" class="form-control not-required input-xs" name="color" id="color" value="{{ getObjectValue($data,'color') }}">
                </div>
            </div>
            <!--/span-->
             <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Icon</label>
                    <input type="text" placeholder="Icon" class="form-control not-required input-xs" name="icon" id="icon" value="{{ getObjectValue($data,'icon') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
    </div>
    <div class="form-actions right">
        <button class="btn default btn_reset" type="button">Reset</button>
        <button class="btn blue btn_action btn_save" type="button"><i class="fa fa-check"></i> Save</button>
    </div>
</form>
<!-- END FORM-->
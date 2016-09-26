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
                    <label class="control-label">Code</label>
                    <input type="text" placeholder="Code" class="form-control input-xs" name="code" id="code" value="{{ getObjectValue($data,'code') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
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
    </div>
    <div class="form-actions right">
        <button class="btn default btn_reset" type="button">Reset</button>
        <button class="btn blue btn_action btn_save" type="button"><i class="fa fa-check"></i> Save</button>
    </div>
</form>
<!-- END FORM-->
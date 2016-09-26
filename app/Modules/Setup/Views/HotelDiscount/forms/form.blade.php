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
                    <label class="control-label">
                        Is Permanent? 
                        <input type="checkbox" name="isPermanent" class="form-control" {{ getObjectValue($data,'is_permanent')  ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
         <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Code <small><i class="text-danger">*</i></small></label>
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
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Discount in percent <small><i class="text-danger">*</i></small></label>
                    <input type="text" placeholder="First Name" class="form-control input-xs" name="discount" id="discount" value="{{ getObjectValue($data,'discount') }}">
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
                    <label class="control-label">Effective Date</label>
                    <input type="text" placeholder="Date" class="form-control input-xs not-required date-picker" name="EffectiveDate" id="EffectiveDate" value="{{ toSystemFrontDateTime(getObjectValue($data,'effective_date')) }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">In Effective Date</label>
                    <input type="text" placeholder="Date" class="form-control input-xs not-required date-picker" name="InEffectiveDate" id="InEffectiveDate" value="{{ toSystemFrontDateTime(getObjectValue($data,'in_effective_date')) }}">
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
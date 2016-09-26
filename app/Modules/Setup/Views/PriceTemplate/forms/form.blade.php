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
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Value <small><i class="text-danger">*</i> <b>h</b>:Hour, <b>d</b>:Day, <b>w</b>:Weekly, <b>m</b>:Monthly</small></label>
                    <input type="text" placeholder="Value" class="form-control input-xs" name="value" id="value" value="{{ getObjectValue($data,'value') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Room Type</label>
                    <select class="form-control select2" id="RoomType" name="RoomType">
                        <option value="">Select...</option>
                        @foreach(App\Modules\Setup\Models\RoomType::get() as $row)
                            <option {{ getObjectValue($data,'room_type_id') == $row->index_id ? 'selected' : '' }} value="{{ encode($row->index_id) }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Complimentary</label>
                    <select class="form-control select2 not-required" id="complimentary" name="complimentary">
                        <option value="">None</option>
                        @foreach(App\Modules\Setup\Models\Complimentary::where('is_deleted',0)->get() as $row)
                            <option {{ getObjectValue($data,'complimentary_id') == $row->index_id ? 'selected' : '' }} value="{{ encode($row->index_id) }}">{{ $row->complimentary }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Amount <small><i class="text-danger">*</i></small></label>
                    <input type="text" placeholder="0.0" class="form-control input-xs" name="amount" id="amount" value="{{ getObjectValue($data,'amount') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Is Default?</label>
                    <input type="checkbox" name="IsDefault" id="IsDefault" {{ getObjectValue($data,'is_default') ? 'checked' : '' }}>

                    <label class="control-label">Is Custom?</label>
                    <input type="checkbox" name="IsCustom" id="IsCustom" {{ getObjectValue($data,'is_custom') ? 'checked' : '' }}>
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
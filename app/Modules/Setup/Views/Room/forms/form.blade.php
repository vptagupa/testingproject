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
                    <label class="control-label">Room No <small><i class="text-danger">*</i></small></label>
                    <input type="text" placeholder="Room No" class="form-control input-xs" name="RoomNo" id="RoomNo" value="{{ getObjectValue($data,'room_no') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Name <small><i class="text-danger">*</i></small></label>
                    <input type="text" placeholder="Name" class="form-control input-xs" name="name" id="name" value="{{ getObjectValue($data,'room_name') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
         <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Description</label>
                    <textarea class="form-control" name="description">{{ getObjectValue($data,'room_description') }}</textarea>
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
         <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Room Floor</label>
                    <select class="form-control select2" id="roomFloor" name="roomFloor">
                        <option value="">Select...</option>
                        @foreach(App\Modules\Setup\Models\HotelFloor::get() as $row)
                            <option {{ getObjectValue($data,'room_floor_id') == $row->index_id ? 'selected' : '' }} value="{{ encode($row->index_id) }}">{{ $row->name }}</option>
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
                    <label class="control-label">Room Type</label>
                    <select class="form-control select2" id="roomType" name="roomType">
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
                    <label class="control-label">Has Minimum Person
                        <input type="checkbox" placeholder="Name" class="" {{ getObjectValue($data,'has_min_person') ? 'checked' : '' }} name="HasMin" id="HasMin">
                    </label>
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Has Packs if Max
                        <input type="checkbox" placeholder="Name" class="" {{ getObjectValue($data,'has_max_pax') ? 'checked' : '' }} name="HasPacks" id="HasPacks">
                    </label>
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Min. Person</label>
                    <input type="text" placeholder="Name" class="form-control input-xs" name="MinPerson" id="MinPerson" value="{{ getObjectValue($data,'min_person') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Max Person</label>
                    <input type="text" placeholder="Name" class="form-control input-xs" name="MaxPerson" id="MaxPerson" value="{{ getObjectValue($data,'max_person') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Per Person Amount</label>
                    <input type="text" placeholder="Name" class="form-control input-xs" name="PerAmount" id="PerAmount" value="{{ getObjectValue($data,'per_person_amount') }}">
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
<?php $data = isset($data) ? $data : array(); ?>
<!-- BEGIN FORM-->
<form class="horizontal-form form_crud" action="#" method="POST">
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                @include('errors.event')
            </div>
        </div>
         <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Rooms</label>
                    <?php 
                        $data = Request::get('data');
                    ?>
                    @foreach(jsonToArray($data)[0] as $row)
                    <?php $row = getRawData($row); ?>
                    <span class="label label-success">{{ getObjectValue($row,'room') }}</span>
                    @endforeach
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Per Person Amount</label>
                    <input type="text" placeholder="0.0" class="form-control input-xs" name="PerAmount" id="PerAmount" value="{{ getObjectValue($data,'per_person_amount') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
    </div>
</form>
<!-- END FORM-->
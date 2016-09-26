<?php 
    $data = App\Modules\Setup\Models\Complimentary::where('index_id',decode(Request::get('key')))->get();
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
                    <label class="control-label">Complimentary <small><i class="text-danger">*</i></small></label>
                    <input type="text" placeholder="" class="form-control input-xs" name="name" id="name" value="{{ getObjectValue($data,'complimentary') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Category</label>
                    <select class="form-control select2" id="category" name="category">
                        <option value="">Select...</option>
                        @foreach(App\Modules\Products\Models\Category::get() as $row)
                            <option {{ getObjectValue($data,'category_id') == $row->index_id ? 'selected' : '' }} value="{{ encode($row->index_id) }}">{{ $row->name }}</option>
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
                    <label class="control-label">Product</label>
                    <select class="form-control select2" id="product" name="product">
                    </select>
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Price <small><i class="text-danger">*</i></small></label>
                    <input type="text" placeholder="0.0" class="form-control input-xs" name="price" id="price" value="{{ getObjectValue($data,'price') }}">
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
    </div>
    <div class="form-actions right">
        <button class="btn default btn_reset" type="button">Reset</button>
        <button class="btn gray" id="BtnAdd" type="button"><i class="fa fa-plus"></i> Add</button>
        <button class="btn blue btn_action btn_save" type="button"><i class="fa fa-check"></i> Save</button>
    </div>
</form>
<!-- END FORM-->
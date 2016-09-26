<?php $table = isset($table) ? $table : array();$fo = false; ?>
<table class="table table-striped table-hover table_scroll" id="TablePackage">
    <thead>
        <tr>
            <th width="5%">&nbsp;</th>
            <th>Product</th>
            <th width="10%">Quantity</th>
            <th wdith="10">Price</th>
        </tr>
    </thead>
    <tbody>
    @foreach(App\Modules\Setup\Models\HotelPackageItems::data()->where('link_id',decode(Request::get('key')))->get() as $row)
        <tr data-id="{{ encode($row->index_id) }}">
            <td>
                <i class="fa fa-trash font-red cursor-pointer remove">&nbsp;</i>
            </td>
            <td class="product" data-id="{{ $row->product_id }}">{{ $row->product }}</td>
            <td class="quantity"><input type="text" class="form-control quantity center" value="{{ $row->quantity }}"></td>
            <td class="price">{{ number_format($row->price,2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<table class="table table-striped table-hover table_scroll hide" id="TableDefault">
    <tbody> 
        <tr>
            <td>
                <i class="fa fa-trash font-red cursor-pointer remove">&nbsp;</i>
            </td>
            <td class="product"></td>
            <td class="quantity">
                <input type="text" class="form-control quantity center">
            </td>
            <td class="price"></td>
        </tr>
    </tbody>
</table>
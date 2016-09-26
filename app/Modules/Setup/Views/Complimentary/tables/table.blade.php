<?php $table = isset($table) ? $table : array();$fo = false; ?>
<table class="table table-striped table-hover table_scroll" id="TableCompl">
    <thead>
        <tr>
            <th width="5%">&nbsp;</th>
            <th>Product</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
    @foreach(App\Modules\Setup\Models\ComplimentaryItems::data()->where('link_id',decode(Request::get('key')))->get() as $row)
        <tr data-id="{{ encode($row->index_id) }}">
            <td>
                <i class="fa fa-trash font-red cursor-pointer remove">&nbsp;</i>
            </td>
            <td class="product" data-id="{{ $row->product_id }}">{{ $row->product }}</td>
            <td class="price">{{ $row->price }}</td>
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
            <td class="price"></td>
        </tr>
    </tbody>
</table>
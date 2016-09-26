<?php $table = isset($table) ? $table : array(); ?>
<table class="table table-striped table-hover table_scroll" id="TableComplDisplay">
    <thead>
        <tr>
            <th width="5%">&nbsp;</th>
            <th>Package</th>
            <th>Price</th>
            <th width="5%">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    @foreach(App\Modules\Setup\Models\HotelPackage::data()->where('is_deleted',0)->get() as $row)
        <tr data-id="{{ encode($row->index_id) }}">
            <td>
                <i class="fa fa-trash font-red cursor-pointer removeData">&nbsp;</i>
            </td>
            <td>{{ $row->package }}</td>
            <td>{{ number_format($row->price,2) }}</td>
            <td><span class="label label-default cursor-pointer aSel"><i class="fa fa-arrow-right"></i></span></td>
        </tr>
    @endforeach
    </tbody>
</table>

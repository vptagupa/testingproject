<?php $table = isset($table) ? $table : array(); ?>
<table class="table table-striped table-hover table_scroll" id="TableRooms">
    <thead>
        <tr>
            <th><input type="checkbox" class="chk-header"></th>
            <th>No.</th>
            <th>Name</th>
            <th>Room Type</th>
            <th>Room Floor</th>
            <th>Min. Person?</th>
            <th>Min. Person</th>
            <th>Max Person</th>
            <th>Per Person Amount</th>
            <th width="10">Status</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach (App\Modules\Setup\Models\Room::getAll() as $row)
        <tr data-id="{{ encode($row->room_id) }}"  data-status="{{ $row->is_room_inactive }}" class="without-bg">
            <td><input type="checkbox" class="chk-child"></td>
            <td>{{ $row->room_no }}</td>
            <td><a href="javascript:void(0)" class="a_select">{{ $row->room_name }}</a></td>
            <td>{{ $row->type }}</td>
            <td>{{ $row->floor }}</td>
            <td class="center"><?= $row->has_min_person ? "<span class='label label-success label-round'><i class='fa fa-check' ></i></span>" : "<span class='label label-default label-round'><i class='fa fa-check'></i></span>"; ?></td>
            <td>{{ $row->min_person }}</td>
            <td>{{ $row->max_person }}</td>
            <td>{{ number_format($row->per_person_amount,2) }}</td>
            <td class="center"><?= !$row->is_room_inactive ? "<span class='label label-success label-round'><i class='fa fa-check' ></i></span>" : "<span class='label label-default label-round'><i class='fa fa-check'></i></span>"; ?></td>
        </tr>
    @endforeach
    </tbody>
</table>
<?php $table = isset($table) ? $table : array(); ?>
<table class="table table-striped table-hover table_scroll">
    <thead>
        <tr>
            <th><input type="checkbox" class="chk-header"></th>
            <th>Code</th>
            <th>Name</th>            
            <th width="10">Status</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach ($table as $row)
        <tr data-id="{{ encode($row->index_id) }}"  data-status="{{ $row->is_inactive }}" class="without-bg">
            <td><input type="checkbox" class="chk-child"></td>
            <td>{{ $row->code }}</td>
            <td><a href="javascript:void(0)" class="a_select">{{ $row->name }}</a></td>
            <td class="center"><?= !$row->is_inactive ? "<span class='label label-success label-round'><i class='fa fa-check' ></i></span>" : "<span class='label label-default label-round'><i class='fa fa-check'></i></span>"; ?></td>
        </tr>
    @endforeach
    </tbody>
</table>
<?php $table = isset($table) ? $table : array(); ?>
<table class="table table-striped table-hover table_scroll">
    <thead>
        <tr>
            <th><input type="checkbox" class="chk-header"></th>
            <th>Code</th>
            <th>Name</th>            
            <th>Value</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Complimentary</th>
            <th width="10">Default?</th>
            <th width="10">Custom?</th>
            <th width="10">Active?</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1;$data = []; ?>
    @foreach ($table as $row)
        @if (!in_array($row->room_type_id,$data))        
        <tr data-id="{{ encode($row->index_id) }}"  data-status="{{ $row->is_inactive }}" class="without-bg">
            <td colspan="10">{{ $row->room_type }}</td>
        </tr>
        @endif
        <tr data-id="{{ encode($row->index_id) }}"  data-status="{{ $row->is_inactive }}" class="without-bg">
            <td><input type="checkbox" class="chk-child"></td>
            <td>{{ $row->code }}</td>
            <td><a href="javascript:void(0)" class="a_select">{{ $row->name }}</a></td>
            <td>{{ $row->value }}</td>
            <td>{{ $row->room_type }}</td>
            <td class="right">{{ number_format($row->amount,2) }}</td>
            <td>{{ $row->complimentary }}</td>
            <td class="center"><?= $row->is_default ? "<span class='label label-success label-round'><i class='fa fa-check' ></i></span>" : "<span class='label label-default label-round'><i class='fa fa-check'></i></span>"; ?></td>
            <td class="center"><?= $row->is_custom ? "<span class='label label-success label-round'><i class='fa fa-check' ></i></span>" : "<span class='label label-default label-round'><i class='fa fa-check'></i></span>"; ?></td>
            <td class="center"><?= !$row->is_inactive ? "<span class='label label-success label-round'><i class='fa fa-check' ></i></span>" : "<span class='label label-default label-round'><i class='fa fa-check'></i></span>"; ?></td>
        </tr>
        <?php $data[] = $row->room_type_id; ?>
    @endforeach
    </tbody>
</table>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Config</th>
			<th>Value</th>
		</tr>
	</thead>
	<tbody>
	@foreach($data as $row)
		<tr data-id="{{ encode($row->index_id) }}">
			<td>{{ $row->name }}</td>
			<td>
				@if($row->datatype == 'boolean')
					<input type="checkbox" {{ $row->value == '1' ? 'checked' : '' }} class="make-switch" data-size="small">
				@else
					<input type="text" class="form-control value" value="{{ $row->value }}">
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
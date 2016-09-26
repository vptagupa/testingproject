<table class="table table-hover">
	<thead>
		<tr>
			<th>Module</th>
			<th>Page</th>
			<th>Action</th>
			<th>Device</th>
			<th>Browser</th>
			<th>Date</th>
		</tr>
	</thead>
	@foreach(userLogs()->where('created_by',decode(Request::get('id')))->orderBy('created_date','desc')->get() as $row)
	<?php
		$browser = $row->browser;
		$browser = strToArray($browser);
		$browser = strToArray($browser[1]);
		$browser = getRawData($browser);
	?>
	<tr>
		<td>
			{{ ucfirst($row->module) }}
		</td>
		<td>
			{{ ucfirst($row->controller) }}
		</td>
		<td>
			{{ ucfirst($row->action) }}
		</td>
		<td>
			{{ ucfirst($row->device) }}
		</td>
		<td>
			{{ str_replace('"','',substr($browser, 7)) }}
		</td>
		<td>
			{{ $row->created_date }}
		</td>
	</tr>
	@endforeach
</table>
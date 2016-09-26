{{ print_r($data) }}
@foreach($data as $row)
<li>
	<a href="javascript:;">
	<span class="time">just now</span>
	<span class="details">
	<span class="label label-sm label-icon label-success">
	<i class="fa fa-plus"></i>
	</span>
	{{ ucfirst(strtolower($row->Subject)) }} </span>
	</a>
</li>
@endforeach
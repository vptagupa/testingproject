<table class="table table-striped table-bordered table-hover" id="DataTableLogs">
	<thead>
		<tr role="row" class="heading">
			<!-- <th width="10%">
				Module
			</th>
			<th width="15%">
				Page
			</th> -->
			<th width="15%">
				Action
			</th>
			<th width="15%">
				Message
			</th>
			<th width="10%">
				Browser
			</th>
			<th width="10%">
				Device
			</th>
			<th width="10%">
				I.P.
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</th>
			<th width="20%">
				Date 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</th>
			<th width="20%">
				User
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</th>
			<th width="10%">
				Actions
			</th>
		</tr>
		<tr role="row" class="filter">
			<!-- <td>
				<input type="text" class="form-control form-filter input-sm" name="module">
			</td>
			<td>
				<input type="text" class="form-control form-filter input-sm" name="page">
			</td> -->
			<td>
		        <input type="text" class="form-control form-filter input-sm" name="action">
			</td>
			<td>
				<input type="text" class="form-control form-filter input-sm" name="message">
			</td>
			<td>
				<input type="text" class="form-control form-filter input-sm" name="browser">
			</td>	
			<td>
				<input type="text" class="form-control form-filter input-sm" name="device">
			</td>
			<td>
				<input type="text" class="form-control form-filter input-sm" name="ip_address">
			</td>
			<td>
				<div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
					<input type="text" class="form-control form-filter input-sm" readonly name="log_date_from" placeholder="From">
					<span class="input-group-btn">
					<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>
				<div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
					<input type="text" class="form-control form-filter input-sm" readonly name="log_date_to" placeholder="To">
					<span class="input-group-btn">
					<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>
			</td>
			<td>
				<input type="text" class="form-control form-filter input-sm" name="log_by">
			</td>
			<td>
				<div class="margin-bottom-5">
					<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button>
				</div>
				<button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Reset</button>
			</td>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

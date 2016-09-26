<div class="row">
	<div class="col-md-3">
		<ul class="ver-inline-menu tabbable margin-bottom-10">
			<li class="active">
				<a data-toggle="tab" href="#tab_1">
				<i class="fa fa-briefcase"></i> General Questions </a>
				<span class="after">
				</span>
			</li>
			<li>
				<a data-toggle="tab" href="#tab_2">
				<i class="fa fa-group"></i> Account </a>
			</li>
			<li>
				<a data-toggle="tab" href="#tab_3">
				<i class="fa fa-leaf"></i> Scholarship </a>
			</li>
		</ul>
	</div>
	<div class="col-md-9">
		<div class="tab-content">
			<div id="tab_1" class="tab-pane active">
				<div id="accordion1" class="panel-group">
					@include($views.'general.panel')
				</div>
			</div>
			<div id="tab_2" class="tab-pane">
				<div id="accordion2" class="panel-group">
					@include($views.'accounts.panel')
				</div>
			</div>
			<div id="tab_3" class="tab-pane">
				<div id="accordion3" class="panel-group">
					@include($views.'scholarship.panel')
				</div>
			</div>
		</div>
	</div>
</div>
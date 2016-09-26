<div class="tabbable-custom">
	<ul class="nav nav-tabs ">
		<li class="active">
			<a href="#tabProfile" data-toggle="tab" class="tabUser">
				Profile
			 </a>
		</li>
		<li>
			<a href="#tabAvatar" data-toggle="tab" class="tabUser">
				Avatar
			</a>
		</li>
		<li>
			<a href="#tabAccount" data-toggle="tab" class="tabUser">
				Account
			</a>
		</li>
		<li> 
			<a href="#tabLogs" data-toggle="tab" class="tabUser">
				Logs
			</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabProfile">
			@include($views.'forms.user')
		</div>
		<div class="tab-pane" id="tabAvatar">
			@include($views.'forms.avatar')
		</div>
		<div class="tab-pane" id="tabAccount">
			@include($views.'forms.account')
		</div>
		<div class="tab-pane" id="tabLogs" style="height: 500px !important;overflow: scroll !important">
			@include($views.'tables.logs')
		</div>
	</div>
</div>
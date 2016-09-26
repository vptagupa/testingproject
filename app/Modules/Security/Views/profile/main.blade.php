<?php
    function isActiveProfile(array $page,$prefix = '') {
        $controller = explode('?',str_replace(url(),'',getUrlSegment()))[0];
        foreach($page as $key => $value){
            if ( strtolower('http'.$controller) === strtolower(url().'/'.$prefix.strtolower($value)) ) return 'active ';
        }
        return '';
    }
?>
<div class="row margin-top-20">
	<div class="col-md-12">
		<!-- BEGIN PROFILE SIDEBAR -->
		<div class="profile-sidebar">
			<!-- PORTLET MAIN -->
			<div class="portlet light profile-sidebar-portlet">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="{{ url('photo/getUserPhoto?date='.date('ymdhms')) }}" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						 {{ getUserFullName() }}
					</div>
					<div class="profile-usertitle-job">
						 {{ getUserPosition() }}
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="{{ isActiveProfile(array('profile')) }}">
							<a href="{{ url('profile') }}">
							<i class="icon-home"></i>
							Overview </a>
						</li>
						<li class="{{ isActiveProfile(array('account'),'profile/') }}">
							<a href="{{ url('profile/account') }}">
							<i class="icon-settings"></i>
							Account Settings </a>
						</li>
						<li class="{{ isActiveProfile(array('help'),'profile/') }}">
							<a href="{{ url('profile/help') }}">
							<i class="icon-info"></i>
							Help </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
			<!-- END PORTLET MAIN -->
		</div>
		<!-- END BEGIN PROFILE SIDEBAR -->
		<!-- BEGIN PROFILE CONTENT -->
		<div class="profile-content">
			@if($tab == 'main')
				@include($views.'sub.dashboard')
			@elseif ($tab == 'account')
				@include($views.'sub.account')
			@elseif ($tab == 'help')
				@include($views.'sub.help')
			@endif
		</div>
		<!-- END PROFILE CONTENT -->
	</div>
</div>
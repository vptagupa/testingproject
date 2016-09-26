<?php $data = userJoins()
				->select([
					'UserID','UserName','u.Email',
					'u.MobileNo','p.PositionTitle',
					'd.Department','g.GroupName'
				])
				->where('u.ID',getUserID())->get();
	$data = isset($data[0]) ? $data[0] : [];
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title tabbable-line">
				<div class="caption caption-md">
					<i class="icon-globe theme-font hide"></i>
					<span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
				</div>
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="javascript:void(0)" data-target="#tab_1_1" data-toggle="tab">Personal Info</a>
					</li>
					<li>
						<a href="javascript:void(0)" data-target="#tab_1_2" data-toggle="tab">Change Avatar</a>
					</li>
					<li>
						<a href="javascript:void(0)" data-target="#tab_1_3" data-toggle="tab">Change Password</a>
					</li>
					<li class="hide">
						<a href="javascript:void(0)" data-target="#tab_1_4" data-toggle="tab">Privacy Settings</a>
					</li>
				</ul>
			</div>
			<div class="portlet-body">
				<div class="tab-content">
					<!-- PERSONAL INFO TAB -->
					<div class="tab-pane active" id="tab_1_1">
						<form role="form" action="#" id="formProfile">
							<div class="form-group">
								<label class="control-label">Username</label>
								<input type="text" placeholder="Username" class="form-control not-required" readonly value="{{ getObjectValue($data,'UserID') }}" />
							</div>
							<div class="form-group">
								<div class="col-md-12" style="padding-left: 0 !important;">
									<label class="control-label">Full Name</label>
									<input type="text" placeholder="Name" name="FullName" class="form-control" value="{{ getObjectValue($data,'UserName') }}"/>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="email" placeholder="Email" name="Email" class="form-control not-required" value="{{ getObjectValue($data,'Email') }}"/>
							</div>
							<div class="form-group">
								<label class="control-label">Mobile Number</label>
								<input type="text" placeholder="Mobile Number" name="Mobile" class="form-control" value="{{ getObjectValue($data,'MobileNo') }}"/>
							</div>
							<div class="form-group">
								<label class="control-label">Group</label>
								<input type="text" placeholder="Group" name="Group" readonly class="form-control not-required" value="{{ getObjectValue($data,'GroupName') }}"/>
							</div>
							<div class="form-group">
								<label class="control-label">Position</label>
								<input type="text" placeholder="Position" name="Position" readonly class="form-control not-required" value="{{ getObjectValue($data,'PositionTitle') }}"/>
							</div>
							<div class="form-group">
								<label class="control-label">Department</label>
								<input type="text" placeholder="Department" name="Department" readonly class="form-control not-required" value="{{ getObjectValue($data,'Department') }}"/>
							</div>
							<div class="margiv-top-10">
								<a href="javascript:void(0)" class="btn green-haze" id="btnUpdateProfile">
								Save Changes </a>
								<a href="javascript:void(0)" class="btn default">
								Cancel </a>
							</div>
						</form>
					</div>
					<!-- END PERSONAL INFO TAB -->
					<!-- CHANGE AVATAR TAB -->
					<div class="tab-pane" id="tab_1_2">
						<form action="#" role="form">
							<div class="form-group">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
										<img src="{{ url('photo/getUserPhoto?date='.date('ymdhms')) }}" width="200" height="200" alt=""/>
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;">
									</div>
									<div>
										<span class="btn default btn-file">
										<span class="fileinput-new">
										Select image </span>
										<span class="fileinput-exists">
										Change </span>
										<input type="file" name="..."  accept="image/x-png, image/jpeg" id="file">
										</span>
										<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
										Remove </a>
									</div>
								</div>
								<div class="clearfix margin-top-10">
									<span class="label label-danger">NOTE! </span>
									<span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
								</div>
							</div>
							<div class="margin-top-10">
								<a href="javascript:void(0)" class="btn green-haze" id="btnUpdateAvatar">
								Submit </a>
								<a href="javascript:void(0)" class="btn default">
								Cancel </a>
							</div>
						</form>
					</div>
					<!-- END CHANGE AVATAR TAB -->
					<!-- CHANGE PASSWORD TAB -->
					<div class="tab-pane" id="tab_1_3">
						<form action="#" id="formPassword">
							<div class="form-group">
								<label class="control-label">Current Password</label>
								<input type="password" class="form-control" name="CurrentPassword"/>
							</div>
							<div class="form-group">
								<label class="control-label">New Password</label>
								<input type="password" class="form-control" name="NewPassword"/>
							</div>
							<div class="form-group">
								<label class="control-label">Re-type New Password</label>
								<input type="password" class="form-control" name="ConfirmPassword"/>
							</div>
							<div class="margin-top-10">
								<a href="javascript:void(0)" class="btn green-haze" id="btnUpdatePassword">
								Change Password </a>
								<a href="javascript:void(0)" class="btn default">
								Cancel </a>
							</div>
						</form>
					</div>
					<!-- END CHANGE PASSWORD TAB -->
					<!-- PRIVACY SETTINGS TAB -->
					<div class="tab-pane" id="tab_1_4">
						<form action="#">
							<table class="table table-light table-hover">
								<tr>
									<td>
										Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus..
									</td>
									<td>
										<label class="uniform-inline">
										<input type="radio" name="optionsRadios1" value="option1"/>
										Yes </label>
										<label class="uniform-inline">
										<input type="radio" name="optionsRadios1" value="option2" checked/>
										No </label>
									</td>
								</tr>
								<tr>
									<td>
										Enim eiusmod high life accusamus terry richardson ad squid wolf moon
									</td>
									<td>
										<label class="uniform-inline">
										<input type="checkbox" value=""/> Yes </label>
									</td>
								</tr>
								<tr>
									<td>
										Enim eiusmod high life accusamus terry richardson ad squid wolf moon
									</td>
									<td>
										<label class="uniform-inline">
										<input type="checkbox" value=""/> Yes </label>
									</td>
								</tr>
								<tr>
									<td>
										Enim eiusmod high life accusamus terry richardson ad squid wolf moon
									</td>
									<td>
										<label class="uniform-inline">
										<input type="checkbox" value=""/> Yes </label>
									</td>
								</tr>
							</table>
							<!--end profile-settings-->
							<div class="margin-top-10">
								<a href="#" class="btn green-haze">
								Save Changes </a>
								<a href="#" class="btn default">
								Cancel </a>
							</div>
						</form>
					</div>
					<!-- END PRIVACY SETTINGS TAB -->
				</div>
			</div>
		</div>
	</div>
</div>
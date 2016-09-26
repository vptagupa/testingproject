<!-- BEGIN FORM-->
<form action="#" id="FormSupport">
	<h3 class="form-section">Feedback</h3>
	<p>
		 If you have any suggestions/inquiries or technical support, please fill up this form and we will response to you as soon as possible.
	</p>
	<div class="form-group">
		<div class="input-icon">
			<i class="fa fa-check"></i>
			<select class="form-control" name="TypeID" placeholder="Type">
				<option value="">- TYPE -</option>
				<option value="1">General</option>
				<option value="2">Account</option>
				<option value="3">Scholars</option>
				<option value="4">Institution</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="input-icon">
			<i class="fa fa-check"></i>
			<select class="form-control" name="PriorityID" placeholder="Priority">
				<option value="1">Normal</option>
				<option value="2">Urgent</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="input-icon">
			<i class="fa fa-check"></i>
			<input type="text" class="form-control" placeholder="Subject" maxlength="150" name="Subject">
		</div>
	</div>
	<div class="form-group">
		<div class="input-icon">
			<i class="fa fa-user"></i>
			<input type="text" class="form-control" placeholder="Name" name="FullName" value="{{ getUserFullName() }}">
		</div>
	</div>
	<div class="form-group">
		<div class="input-icon">
			<i class="fa fa-envelope"></i>
			<input type="email" class="form-control" placeholder="Email" name="Email" value="{{ getUserEmail() }}">
		</div>
	</div>
	<div class="form-group">
		<textarea class="form-control" rows="3=6" name="FeedBack" maxlength="500" placeholder="Feedback"></textarea>
	</div>
	<button type="button" id="Submit" class="btn green">Submit</button>
</form>
<!-- END FORM-->
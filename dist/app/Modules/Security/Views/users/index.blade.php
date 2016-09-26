<div data-ng-app="UserModule" data-ng-controller="UserController">

	<!-- include tables -->
	@include('Security.Views.users.tables.users')
	<!-- include tables -->

	<!-- include modal -->
	@include('Security.Views.users.modals.modal')
	<!-- include modal -->

     <!-- Floating Action Button -->
    <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
        <a class="btn-floating btn-large">
            <i class="mdi-action-stars"></i>
        </a>
        <ul>
            <li><a  href="javascript:;" class="btn-floating modal-trigger red" data-ng-click="showForm()" title="Add new record"><i class="large mdi-content-add-circle-outline"></i></a></li>
            <li><a href="javascript:;" class="btn-floating yellow darken-1"><i class="large mdi-device-now-widgets"></i></a></li>
            <li><a href="javascript:;" class="btn-floating green"><i class="large mdi-editor-insert-invitation"></i></a></li>
            <li><a href="javascript:;" class="btn-floating blue"><i class="large mdi-communication-email"></i></a></li>
        </ul>
    </div>
    <!-- Floating Action Button -->
</div>
<div id="modal2" class="modal modal-fixed-footer">
    <div class="modal-content">
       <!-- include user form -->
       @include('Security.Views.users.forms.user')
       <!-- include user form -->
    </div>
    <div class="modal-footer">
        <button name="action" type="submit" class="btn waves-effect btn-flat waves-light modal-action" data-ng-click="submit()"><i class="mdi-content-save left"></i>Submit</button>
        <button name="action" type="submit" class="btn waves-effect btn-flat waves-light modal-action modal-close"><i class="mdi-hardware-keyboard-backspace left"></i>Close</button>
    </div>
</div>
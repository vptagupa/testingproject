<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            Access <small>Auto Save</small>&nbsp;<accountselected><small><i></i></small></accountselected>
        </div>
        <div class="tools">
            @if(isPermissionHas('access','read'))
            <button class="btn hide bg-purple-wisteria btn_access_save text-success btn-sm" type="button"><i class="fa fa-save"></i> Save</button>
            @endif
        </div>
    </div>
    <div class="portlet-body">
    	<div class="row">
    		<div class="col-md-12">
       			@include('Security.Views.access.content.sub.access.access')
       		</div>
   		</div>
    </div>
</div>

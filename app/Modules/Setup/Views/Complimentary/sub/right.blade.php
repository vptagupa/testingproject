<div class="portlet box green-haze">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>list
        </div>
        <div class="tools">
        </div>
        <div class="actions">
            <div class="btn-group">
                <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn bg bg-purple btn-sm dropdown-toggle" aria-expanded="false">
                Actions <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:void(0)" class="a_status">
                        <i class="fa fa-check  font-blue"></i> Active/Deactivate</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class='a_remove'>
                        <i class="fa fa-trash font-red"></i> Remove</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="portlet-body">
    	<div class="row">
            <div class="col-md-12">
                <div class="tabbable-custom">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tabProducts" data-toggle="tab">
                                Products
                             </a>
                        </li>
                        <li>
                            <a href="#tabList" data-toggle="tab">
                                List
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabProducts">
                            @include($views.'tables.table')
                        </div>
                        <div class="tab-pane" id="tabList">
                            @include($views.'tables.complimentary')
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </div>
</div>

<div class="portlet box green-haze">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>System Logs
        </div>
        <div class="tools">
        </div>
        <div class="actions">
            <div class="btn-group">
                <a class="btn btn-default btn-circle" href="javascript:;" data-toggle="dropdown">
                <i class="fa fa-share"></i> Tools <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:;" data-export="excel" class="export">
                        Export to Excel </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-export="pdf" class="export">
                        Export to PDF </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="portlet-body">
    	<div class="row">
	       	<div class="col-md-12 table_wrapper">
		      @include($views.'tables.logs')
			</div>
		</div>
    </div>
</div>


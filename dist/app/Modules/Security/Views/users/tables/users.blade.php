<table id="data-table-simple" datatable="ng" class="responsive-table display" cellspacing="0">
    <thead>
        <tr>
            <td width="3%"></td>
            <th>Name</th>
            <th>User ID</th>
            <th>Email</th>
            <th>Mobie No.</th>
            <th>Role</th>
            <th>LastLoginDate</th>
            <th></th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <td width="3%"></td>
            <th>Name</th>
            <th>User ID</th>
            <th>Email</th>
            <th>Mobie No.</th>
            <th>Role</th>
            <th>LastLoginDate</th>
            <th></th>
        </tr>
    </tfoot>

    <tbody>
        <tr data-ng-repeat="data in masterlist">
            <td><i class="mdi-action-account-box small"></i></td>
            <td>{% data.name %}</td>
            <td>{% data.user_id %}</td>
            <td>{% data.email %}</td>
            <td>{% data.mobile_no %}</td>
            <td>{% data.group %}</td>
            <td></td>
            <td>
                <a class="btn waves-effect waves-light cyan darken-2 btn-small" title="Edit" data-ng-click="edit(data.id)"><i class="mdi-editor-border-color center"></i></a>
                <a class="btn waves-effect waves-light red btn-small" data-ng-click="delete(data.id)" title="Delete"><i class="mdi-action-delete center"></i></a>
            </td>
        </tr>
    </tbody>
</table>
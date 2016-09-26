<table id="data-table-simple" class="responsive-table display" cellspacing="0">
    <thead>
        <tr>
            <td width="3%"></td>
            <th>Name</th>
            <th>User ID</th>
            <th>Email</th>
            <th>Mobie No.</th>
            <th>Role</th>
            <th>LastLoginDate</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <td width="3%"></td>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
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
        </tr>
    </tbody>
</table>
<table class="table table-bordered table-striped">
    <tr>
        <th colspan="6" class="text-center">
            Users Table
        </th>
    </tr>
    <tr>
        <th></th>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Status</th>
        <th class="text-center">
            <button type="button" class="btn btn-sm btn-primary" ng-click="model.showAddModal()">Add User</button>
        </th>
    </tr>
    <tr ng-repeat="user in model.users track by $index">
        <td>
            <input type="checkbox"/>
        </td>
        <td>{{user.firstname}} {{user.lastname}}</td>
        <td>{{user.username}}</td>
        <td>{{user.email}}</td>
        <td>
            <span ng-if="user.active" class="label label-success">Enabled</span>
            <span ng-if="!user.active" class="label label-danger">Disabled</span>
        </td>
        <td class="text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Edit" data-toggle="modal" data-target="#edit-user-modal" ng-click="model.showEditModal(user)">
                    <i class="glyphicon glyphicon-pencil"></i>
                </button>
                <button type="button" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Update Security" data-toggle="modal" data-target="#edit-user-credentials-modal" ng-click="model.showEditCredentialsModal(user)">
                    <i class="glyphicon glyphicon-lock"></i>
                </button>
                <button type="button" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" data-toggle="modal" data-target="#delete-user-modal" ng-click="model.showDeleteModal(user)">
                    <i class="glyphicon glyphicon-trash"></i>
                </button>
            </div>
        </td>
    </tr>
</table>
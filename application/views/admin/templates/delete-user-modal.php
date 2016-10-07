<div id="delete-user-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete User</h4>
            </div>
            <div class="modal-body">
                <p ng-hide="model.isUserDeleted">
                    <strong>{{model.user.firstname}} {{model.user.lastname}} [{{model.user.username}}]</strong> will no longer access <span ng-if="model.user.gender.value==0">his</span> <span ng-if="model.user.gender.value==1">her</span> account after clicking delete.
                </p>
                <div class="alert alert-success" role="alert" ng-show="model.isUserDeleted">
                    User successfully deleted!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" ng-show="model.isUserDeleted">Close</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" ng-hide="model.isUserDeleted">Cancel</button>
                <button type="button" class="btn btn-primary" ng-click="model.deleteUser(model.user.user_id)"  ng-hide="model.isUserDeleted">Delete</button>
            </div>
        </div>
    </div>
</div>
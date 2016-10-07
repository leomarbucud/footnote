<div id="add-user-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update User</h4>
            </div>
            <div class="modal-body">
                <form name="addUserForm" class="form-horizontal" method="post" autocomplete="off" data-toggle="validator" ng-submit="model.addUser()" role="form" ng-hide="model.isUserAdded">
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label">Username:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name='username' ng-model="model.user.username" placeholder="Username" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label">Email:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="email" name='email' ng-model="model.user.email" placeholder="Email" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label">Password:</label>
                        <div class="col-sm-9">
                            <input id="register-password" class="form-control" type="password" name='password' ng-model="model.user.password" placeholder="Password" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label">Confirm Password:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="password" name='password' data-match="#register-password" required placeholder="Re-type Password" data-match-error="Oops, password did not match."/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </form>
                <div class="alert alert-success" role="alert" ng-show="model.isUserAdded">
                    {{model.message}}
                </div>
                <div class="alert alert-info" role="alert" ng-show="model.isUserExist">
                    {{model.message}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="model.addUser()" ng-disabled="!addUserForm.$valid" ng-hide="model.isUserAdded">Save changes</button>
            </div>
        </div>
    </div>
</div>
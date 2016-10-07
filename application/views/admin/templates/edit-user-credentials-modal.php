<div id="edit-user-credentials-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update User Credentials</h4>
            </div>
            <div class="modal-body">
                <form name="updateUserInfoForm" class="form-horizontal" method="post" autocomplete="off" data-toggle="validator" ng-submit="model.updateUserInfo(model.user.user_id)" role="form" ng-hide="model.isUserUpdated">

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
                            <input class="form-control" type="text" name='email' ng-model="model.user.email" placeholder="Email" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label">Password:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="password" name='password' ng-model="model.user.password" placeholder="Password will be reset"/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status:</label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" ng-model="model.user.active" value="1">
                                    Enable
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" ng-model="model.user.active" value="0">
                                    Disable
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="alert alert-success" role="alert" ng-show="model.isUserUpdated">
                    User info successfully updated!
                </div>
                <div class="alert alert-info" role="alert" ng-show="model.isNoChanages">
                    No changes has been made!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="model.updateUserCredentials(model.user.user_id)" ng-disabled="!updateUserInfoForm.$valid" ng-hide="model.isUserUpdated">Save changes</button>
            </div>
        </div>
    </div>
</div>
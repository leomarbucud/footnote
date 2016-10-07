<div id="edit-user-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update User</h4>
            </div>
            <div class="modal-body">
                <form name="updateUserInfoForm" class="form-horizontal" method="post" autocomplete="off" data-toggle="validator" ng-submit="model.updateUserInfo(model.user.user_id)" role="form" ng-hide="model.isUserUpdated">

                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label">First Name:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name='firstname' ng-model="model.user.firstname" placeholder="First Name" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label">Last Name:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name='lastname' ng-model="model.user.lastname" placeholder="Last Name" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Middle Name:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name='middlename' ng-model="model.user.middlename" placeholder="Middle Name" />
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label">Date of birth:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name='birthdate' ng-model="model.user.birthdate" placeholder="Date of birth"  required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label">Address:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name='address' ng-model="model.user.address" placeholder="Address" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label">Gender:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="gender" ng-model="model.user.gender" required ng-options="opt.text for opt in model.gender track by opt.value">
                            </select>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Bio:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="3" name="bio" ng-model="model.user.bio" ></textarea>
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
                <button type="button" class="btn btn-primary" ng-click="model.updateUserInfo(model.user.user_id)" ng-disabled="!updateUserInfoForm.$valid" ng-hide="model.isUserUpdated">Save changes</button>
            </div>
        </div>
    </div>
</div>
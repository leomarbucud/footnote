<form id="update-security-" name="updateUserSecurityForm" ng-submit="updateUserSecurity(updateUserSecurityForm)" class="form-horizontal" method="post" autocomplete="off" data-toggle="validator" role="form" ng-hide="userSecurityUpdated">
    <div class="form-group has-feedback">
        <label class="col-sm-3 control-label">Current Password:</label>
        <div class="col-sm-9">
            <input class="form-control" type="password" name='password_c' placeholder="Old password" ng-model="formDataUserSecurity.password_c" required/>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group has-feedback">
        <label class="col-sm-3 control-label">New Password:</label>
        <div class="col-sm-9">
            <input id="new-password" class="form-control" type="password" name='password' placeholder="New Password" ng-model="formDataUserSecurity.password" required/>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Confirm Password:</label>
        <div class="col-sm-9">
            <input class="form-control" type="password" name='password_v' placeholder="Confirm Password" data-match="#new-password" ng-model="formDataUserSecurity.password_v" required data-match-error="Oops, password did not match."/>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary" ng-disabled="!updateUserSecurityForm.$valid">Update</button>
        </div>
    </div>
</form>
<div class="alert alert-success" role="alert" ng-show="userSecurityUpdated">
    User password successfully updated!
</div>
<div class="alert alert-danger" role="alert" ng-show="userSecurityError">
    User old password is incorrect!
</div>

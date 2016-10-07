<form id="update-info-" name="updateUserInfoForm" class="form-horizontal" method="post" autocomplete="off" data-toggle="validator" ng-submit="updateUserInfo(updateUserInfoForm)" role="form" ng-hide="userInfoUpdated">
<!--    <div class="form-group has-feedback">-->
<!--        <label class="col-sm-3 control-label">Username:</label>-->
<!--        <div class="col-sm-9">-->
<!--            <input class="form-control" type="text" value="--><?//=$account['username']?><!--" disabled/>-->
<!--        </div>-->
<!--    </div>-->

    <div class="form-group has-feedback">
        <label class="col-sm-3 control-label">First Name:</label>
        <div class="col-sm-9">
            <input class="form-control" type="text" name='firstname' ng-model="formDataUserInfo.firstname" placeholder="First Name" required/>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group has-feedback">
        <label class="col-sm-3 control-label">Last Name:</label>
        <div class="col-sm-9">
            <input class="form-control" type="text" name='lastname' ng-model="formDataUserInfo.lastname" placeholder="Last Name" required/>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Middle Name:</label>
        <div class="col-sm-9">
            <input class="form-control" type="text" name='middlename' ng-model="formDataUserInfo.middlename" placeholder="Middle Name" />
        </div>
    </div>
    <div class="form-group has-feedback">
        <label class="col-sm-3 control-label">Date of birth:</label>
        <div class="col-sm-9">
            <input class="form-control" type="text" name='birthdate' ng-model="formDataUserInfo.birthdate" placeholder="Date of birth"  required/>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group has-feedback">
        <label class="col-sm-3 control-label">Address:</label>
        <div class="col-sm-9">
            <input class="form-control" type="text" name='address' ng-model="formDataUserInfo.address" placeholder="Address" required/>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group has-feedback">
        <label class="col-sm-3 control-label">Gender:</label>
        <div class="col-sm-9">
            <select class="form-control" name="gender" ng-model="formDataUserInfo.gender" required ng-options="opt.text for opt in gender track by opt.value">
                <option value="">--Select gender--</option>
            </select>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Bio:</label>
        <div class="col-sm-9">
            <textarea class="form-control" rows="3" name="bio" ng-model="formDataUserInfo.bio" ></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary" ng-disabled="!updateUserInfoForm.$valid" >Update</button>
        </div>
    </div>
</form>
<div class="alert alert-success" role="alert" ng-show="userInfoUpdated">
    User info successfully updated!
</div>
<div class="alert alert-info" role="alert" ng-show="userInfoNoChanges">
    No changes has been made!
</div>
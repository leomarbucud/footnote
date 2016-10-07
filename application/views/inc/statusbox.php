<div ng-controller="uploadPostController">
    <form id="share-box-" name="myForm" class="share-box">
        <input type="hidden" value="<?=BASE_URL?>post/upload" ng-model="uploadUrl" />
        <div class="share">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="">
                        <textarea name="text" cols="40" rows="10" id="status_message" class="form-control message" style="height: 62px; overflow: hidden;" placeholder="Share your travels" ng-model="text" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4" >
                            <img ng-show="myForm.file.$valid" ngf-thumbnail="picFile" class="img-thumbnail">
                            <button ng-click="picFile = null" ng-show="picFile" class="btn btn-danger btn-sm btn-block">Cancel</button>
                        </div>
                    </div>
<!--                    <div class="progress" ng-show="picFile.progress >= 0">-->
<!--                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:{{picFile.progress}}%" ng-bind="picFile.progress + '%'">-->
<!--                            60%-->
<!--                        </div>-->
<!--                    </div>-->
                    <div ng-show="picFile.result" class="alert alert-success m-b-0" role="alert">Upload Successful</div>
                    <div class="err" ng-show="errorMsg" class="alert alert-danger m-b-0" role="alert">{{errorMsg}}</div>
                    <div ng-show="myForm.postImg.$error.maxSize" class="alert alert-danger m-b-0" role="alert">File too large
                        {{errorFile.size / 1000000|number:1}}MB: max 2M</div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group m-y-0">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-map-marker"></i> Location</button>
                                    <button type="file" class="btn btn-default" name="postImg" ngf-select ng-model="picFile" accept="image/*" ngf-max-size="5MB" required ngf-model-invalid="errorFile"/><i class="glyphicon glyphicon-camera"></i> Photo</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group m-y-0">
                                <button type="submit" class="btn btn-primary btn-block" ng-disabled="!myForm.$valid"
                                        ng-click="uploadPic(picFile)">Post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
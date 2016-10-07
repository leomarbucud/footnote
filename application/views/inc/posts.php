<div class="post-list" ng-controller="postController">
    <?php
//    foreach()
//    ?>
<!--    <div class="media post panel panel-default">-->
<!--        <div class="media-left">-->
<!--            <a href="#">-->
<!--                <img class="media-object img-circle" src="--><?//=BASE_URL?><!--assets/images/user-placeholder-50x50.png" alt="...">-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="media-body">-->
<!--            <h4 class="media-heading">Leomar Bucud</h4>-->
<!--            <small>26 mins</small>-->
<!--            <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>-->
<!--            <div class="image-grid">-->
<!--                <img data-action="zoom" src="https://bootstrap-themes.github.io/application/assets/img/instagram_10.jpg" >-->
<!--            </div>-->
<!--            <div class="post-reactions">-->
<!--                <span class="pull-left"><i class="glyphicon glyphicon-heart-empty"></i> 50</span>-->
<!--                <span class="pull-right"><i class="glyphicon glyphicon-comment"></i> 24</span>-->
<!--            </div>-->
<!--            <div class="post-actions">-->
<!--                <div class="form-group m-y-0">-->
<!--                    <div class="btn-group">-->
<!--                        <button type="button" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-heart color-red"></i> Heart</button>-->
<!--                        <button type="button" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-comment"></i> Comment</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="media comment">-->
<!--                <div class="media-left">-->
<!--                    <a href="#">-->
<!--                        <img class="media-object img-circle" src="--><?//=BASE_URL?><!--assets/images/user-placeholder-50x50.png" alt="...">-->
<!--                    </a>-->
<!--                </div>-->
<!--                <div class="media-body">-->
<!--                    <strong>Leomar Bucud</strong>: Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="media comment">-->
<!--                <div class="media-left">-->
<!--                    <a href="#">-->
<!--                        <img class="media-object img-circle" src="--><?//=BASE_URL?><!--assets/images/user-placeholder-50x50.png" alt="...">-->
<!--                    </a>-->
<!--                </div>-->
<!--                <div class="media-body">-->
<!--                    <strong>Leomar Bucud</strong>: Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="comment-box">-->
<!--                <textarea name="message" cols="40" rows="10" id="status_message" class="form-control message" style="height: 35px; overflow: hidden;" placeholder="Comment"></textarea>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <div class="media post panel panel-default" ng-repeat="(key, post) in Posts track by $index">
        <div class="media-left">
            <a href="#">
                <img class="media-object img-circle" src="<?=BASE_URL?>assets/images/user-placeholder-50x50.png" alt="...">
            </a>
        </div>
        <div class="media-body">
            <div class="pull-right dropdown" ng-show="post.my_post">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                        <a href="#"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                    </li>
                </ul>
            </div>
            <h4 class="media-heading">{{post.firstname}} {{post.lastname}}</h4>
            <small>{{post.post_created}}</small>
            <p ng-bind-html="post.post_text | noHTML | newlines"></p>
            <div ng-show="post.media_hash">
                <img src="<?=BASE_URL?>photo/img/{{post.media_hash}}" class="img-responsive" data-action="zoom"/>
            </div>
            <div class="post-reactions p-t-1">
                <span class="pull-left"><i class="glyphicon glyphicon-heart color-red"></i> {{(( (5 * post.hearts_5) + (4 * post.hearts_4) + (3 * post.hearts_3) + (2 * post.hearts_2) + (1 * post.hearts_1)) / (post.hearts_5 + post.hearts_4 + post.hearts_3 + post.hearts_2 + post.hearts_1)) | number:1}}</span>
<!--                <span class="pull-right"><i class="glyphicon glyphicon-comment"></i> 24</span>-->
            </div>
            <div class="post-actions">
                <div class="form-group m-y-0">
                    <div class="btn-group dropup">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" ng-class="{'btn-danger': post.hearts_given}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="glyphicon glyphicon-heart color-red" ng-class="{'color-white': post.hearts_given}"></i> Rate <span class="-caret"></span>
                        </button>
                        <ul class="dropdown-menu">
<!--                            <li>-->
<!--                                <span href="javascript:void(0)" ng-click="heart($index,1)">-->
<!--                                    <i class="glyphicon glyphicon-heart-empty"></i>-->
<!--                                </span>-->
<!--                                <span href="javascript:void(0)" ng-click="heart($index,2)">-->
<!--                                    <i class="glyphicon glyphicon-heart-empty"></i>-->
<!--                                </span>-->
<!--                                <span href="javascript:void(0)" ng-click="heart($index,3)">-->
<!--                                    <i class="glyphicon glyphicon-heart-empty"></i>-->
<!--                                </span>-->
<!--                                <span href="javascript:void(0)" ng-click="heart($index,4)">-->
<!--                                    <i class="glyphicon glyphicon-heart-empty"></i>-->
<!--                                </span>-->
<!--                                <span href="javascript:void(0)" ng-click="heart($index,5)">-->
<!--                                    <i class="glyphicon glyphicon-heart-empty"></i>-->
<!--                                </span>-->
<!--                            </li>-->
                            <li>
                                <a href="javascript:void(0)" ng-click="heart($index,1)">
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" ng-click="heart($index,2)">
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" ng-click="heart($index,3)">
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" ng-click="heart($index,4)">
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" ng-click="heart($index,5)">
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                    <i class="glyphicon glyphicon-heart color-red"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <span>
                        <ng-pluralize count="post.hearts_given"
                                      when="{'0': 'Not rated yet.',
                                             'one': 'You gave a rating of 1 heart.',
                                             'other': 'You gave a rating of {{post.hearts_given}} hearts.'}">
                        </ng-pluralize>
                    </span>
<!--                    <div class="btn-group">-->
<!--                        <button type="button" class="btn btn-default btn-sm" ng-class="{'btn-danger': post.hearts_given}" ng-click="heart($index)" ng-disabled="post.hearts_given"><i class="glyphicon glyphicon-heart color-red" ></i> Rate</button>-->
<!--                        <button type="button" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-comment"></i> Comment</button>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="media post panel panel-default">
    <div class="media-left">
        <a href="#">
            <img class="media-object img-circle" src="<?=BASE_URL?>assets/images/user-placeholder-50x50.png" alt="...">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading"><?=$account['firstname'].' '.$account['lastname']?></h4>
        <small>26 mins</small>
        <p><?=$text?></p>
        <div class="post-reactions">
            <span class="pull-left"><i class="glyphicon glyphicon-heart-empty"></i> 50</span>
            <span class="pull-right"><i class="glyphicon glyphicon-comment"></i> 24</span>
        </div>
        <div class="post-actions">
            <div class="form-group m-y-0">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-heart"></i> Heart</button>
                    <button type="button" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-comment"></i> Comment</button>
                </div>
            </div>
        </div>
        <div class="comment-box">
            <textarea name="message" cols="40" rows="10" id="status_message" class="form-control message" style="height: 35px; overflow: hidden;" placeholder="Comment"></textarea>
        </div>
    </div>
</div>
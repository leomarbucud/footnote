<div class="bio panel panel-default">
    <figure class="cover-photo" style="background-image: url(<?=BASE_URL.'assets/images/mountain-scenery-wallpaper-1920x1200.jpg'?>);"></figure>
    <div class="details panel-body">

        <a href="<?=BASE_URL?>account" class="avatar">
            <img src="<?=BASE_URL.'assets/images/user-placeholder-100x100.png'?>" width="100" height="100">
        </a>

        <h5 class="m-t-0">
            <a href="<?=BASE_URL?>account">
                <?php if($account['firstname'] == '' && $account['lastname'] == ''): ?>
                <?=$account['username']?>
                <?php else: ?>
                <?=$account['firstname'].' '.$account['lastname']?>
                <?php endif; ?>
            </a>
        </h5>

        <p><?=$account['bio']?></p>

        <ul class="overview">
            <li>
                <a href="#userModal" class="aku" data-toggle="modal">
                    Followers
                    <h5 class="m-y-0">12M</h5>
                </a>
            </li>

            <li>
                <a href="#userModal" class="aku" data-toggle="modal">
                    Travels
                    <h5 class="m-y-0">1</h5>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">About</div>
    <div class="panel-body">
        <ul class="none-list">
            <li><span class="dp h xh all"></span>Went to <a href="#">Oh, Canada</a>
            </li><li><span class="dp h ajw all"></span>Became friends with <a href="#">Obama</a>
            </li><li><span class="dp h abu all"></span>Worked at <a href="#">Github</a>
            </li><li><span class="dp h ack all"></span>Lives in <a href="#">San Francisco, CA</a>
            </li><li><span class="dp h adt all"></span>From <a href="#">Seattle, WA</a>
            </li></ul>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Photos</div>
        <div class="panel-body">

            <img data-action="zoom" src="https://bootstrap-themes.github.io/application/assets/img/instagram_10.jpg" style="width: 87px; height: 88px;">


    </div>
</div>
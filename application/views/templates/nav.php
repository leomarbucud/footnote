<header class="navbar navbar-footnote navbar-fixed-top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?=BASE_URL?>" class="navbar-brand">
                <!--                    <img src="--><?//=BASE_URL?><!--assets/images/footnote-logo-200x200.png" width="20" height="20" />-->
                Footnote
            </a>
        </div>

        <nav id="navbar-collapse" class="collapse navbar-collapse" role="navigation">
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control" type="search" id="search" name='search' placeholder="Search Footnote..." required/>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($account)) : ?>
                <li>
                    <a href="#">Notifications <span class="badge">8</span></a>
                </li>
                <li>
                    <a href="#">Messages <span class="badge">42</span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="<?=BASE_URL?>assets/images/user-placeholder-50x50.png" class="profile-image img-circle" width="20" height="20"></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?=BASE_URL?>account/">
                                <?php if($account['firstname'] == '' && $account['lastname'] == ''): ?>
                                    <?=$account['username']?>
                                <?php else: ?>
                                    <?=$account['firstname'].' '.$account['lastname']?>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?=BASE_URL?>account/edit">Edit Account</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?=BASE_URL?>account/logout">Logout</a></li>
                    </ul>
                </li>
                <?php else : ?>
                <li>
                    <a href="<?=BASE_URL?>about">About</a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<?php $this->load->view('templates/header',$data); ?>


<?php $this->load->view('templates/nav',$data); ?>

    <main class="main container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view('inc/user-info',$data); ?>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit your information</div>
                    <div class="panel-body">
                        <?php $this->load->view('inc/edit-info',$data); ?>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Security</div>
                    <div class="panel-body">
                        <?php $this->load->view('inc/edit-security',$data); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
<!--                <div class="panel panel-default">-->
<!--                    <div class="panel-heading">Current Location</div>-->
<!--                    <div class="panel-body">-->
<!--                        <div class="my-location">-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
        </div>
    </main>


<?php $this->load->view('templates/footer'); ?>
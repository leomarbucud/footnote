<?php $this->load->view('templates/header',$data); ?>

    <main class="main container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>Oops!</h1>
                    <p>
                        Your account might not be activated yet. Please activate it first.
                    </p>
                    <p>
                        <small>If this occured after account activation, please contact the system administrator</small>
                    </p>
                    <p><a class="btn btn-primary btn-lg" href="<?=BASE_URL?>" role="button">Go Back</a></p>
                </div>
            </div>
        </div>
    </main>


<?php $this->load->view('templates/footer'); ?>
<?php $this->load->view('templates/header',$data); ?>


    <?php $this->load->view('templates/nav',$data); ?>

    <main class="main container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view('inc/user-info',$data); ?>
            </div>
            <div class="col-md-6">
                <?php $this->load->view('inc/statusbox',$data); ?>
                <?php $this->load->view('inc/posts',$data); ?>
            </div>
            <div class="col-md-3" ng-controller="geolocationController">
                <div class="panel panel-default">
                    <div class="panel-heading">Current Location</div>
                    <div class="panel-body">
                        <div class="my-location" ng-show="currentLocation">
                            {{currentLocation}}
                        </div>
                        <div id="location-map" style="height: 250px;" >
                            <span ng-hide="currentLocation">Please wait, we are detecting your location...</span>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">You may also want to visit:</div>
                    <div class="panel-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item" ng-repeat="(key, place) in nearByPlaces">
                                <h5 class="list-group-item-heading">{{place.name}}</h5>
                                <p class="list-group-item-text">{{place.vicinity}}</p>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>


<?php $this->load->view('templates/footer'); ?>
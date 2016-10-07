(function(){

    var footnote = angular.module('footnote', ['ngSanitize','ngFileUpload']);

    footnote.filter('newlines', function () {
            return function(text) {
                return text.replace(/\n/g, '<br/>');
            }
        })
        .filter('noHTML', function () {
            return function(text) {
                return text
                    .replace(/&/g, '&amp;')
                    .replace(/>/g, '&gt;')
                    .replace(/</g, '&lt;');
            }
        });

    footnote.controller('uploadPostController', ['$scope', 'Upload', '$timeout', function ($scope, Upload, $timeout) {

        $scope.uploadPic = function(file) {
            file.upload = Upload.upload({
                url: '/zero/post/upload',
                data: {text: $scope.text, postImg: file},
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;
                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                // Math.min is to fix IE which reports 200% sometimes
                file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
        }
    }]);

    footnote.controller('geolocationController',['$scope', '$http', function($scope, $http){

        if (navigator.geolocation) navigator.geolocation.getCurrentPosition(onPositionUpdate);

        function onPositionUpdate(position) {
            var googleApiKey = "AIzaSyAHhJTqvMbixe8tZcprHVS_mDnVKy_X4Rg";
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + lng + "&sensor=true&key="+googleApiKey;
            
            $http.get(url)
                .then(function(result) {
                    var address = result.data.results[0].formatted_address;
                    $scope.currentLocation = address;
                });

            initialize(lat,lng);

        }

        var map,
            infowindow,
            myLocation;

        function initialize(lat, lng) {
            myLocation = new google.maps.LatLng(lat,lng);

            map = new google.maps.Map(document.getElementById('location-map'), {
                center: myLocation,
                zoom: 15
            });

            var request = {
                location: myLocation,
                radius: '10000',
                keyword: 'tourist spots',
                types: ['park','zoo','church']
            };

            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, callback);
        }

        function callback(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                
                $scope.$apply(function(){
                    $scope.nearByPlaces = results;
                });

                createMarker(myLocation);
                
            }
        }
        function createMarker(myLocation) {
            var marker = new google.maps.Marker({
                map: map,
                position: myLocation
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }

    }]);

    footnote.directive('loading',   ['$http' ,function ($http)
    {
        return {
            restrict: 'A',
            link: function (scope, elem)
            {
                scope.isLoading = function () {
                    return $http.pendingRequests.length > 0;
                };

                scope.$watch(scope.isLoading, function (v)
                {
                    if(v){
                        $(elem).show();
                    }else{
                        $(elem).hide();
                    }
                });
            }
        };

    }]);
}());
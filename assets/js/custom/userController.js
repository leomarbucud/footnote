(function() {

    var app = angular.module("footnote");

    var userController = function($scope, $http) {

        $scope.gender = [
            {value: '0', text: 'Male'},
            {value: '1', text: 'Female'}
        ];

        $http.get('/zero/account/getDetails')
             .then(function(response){
                 $scope.formDataUserInfo = response.data;
                 $scope.formDataUserInfo.gender = $scope.gender[$scope.formDataUserInfo.gender];
             });

        $scope.registerUser = function() {
            $http.post('/zero/account/register',
                $scope.formDataRegUserInfo
            ).then(function (response)  {
                $scope.userRegFeedback = response.data;
                console.log(response);
            });
        };

        $scope.updateUserInfo = function(form) {

            //console.log($scope.formDataUserInfo);
            $http.post('/zero/account/update',
                $scope.formDataUserInfo
            ).then(function (response)  {
                console.log(response.data.status);
                if(response.data.status == 'success') {
                    $scope.userInfoUpdated = true;
                    $scope.userInfoNoChanges = false;
                } else if(response.data.status == 'fail' ) {
                    $scope.userInfoNoChanges = true;
                }
            });
        };

        $scope.updateUserSecurity = function(form) {
            console.log($scope.formDataUserSecurity);
            //updateSecurity
            $http.post('/zero/account/updateSecurity',
                $scope.formDataUserSecurity
            ).then(function (response)  {
                console.log(response.data.status);
                if(response.data.status == 'success') {
                    $scope.userSecurityUpdated = true;
                    $scope.userSecurityError = false;
                } else if(response.data.status == 'fail' ) {
                    $scope.userSecurityError = true;
                }
            });
        };

    };

    app.controller("userController",userController);

}());
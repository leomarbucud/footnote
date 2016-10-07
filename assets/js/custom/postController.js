(function() {

    var app = angular.module("footnote");

    var postController = function($scope, $http) {

        $http.get(BASE_URL + 'zero/post/getAllPosts')
            .then(function(response){
                $scope.Posts = response.data;
                //(5*252 + 4*124 + 3*40 + 2*29 + 1*33) / (252+124+40+29+33)
                // console.log(response);
            });
        $scope.heart = function(index, rating) {
            $http.get(BASE_URL + 'post/heartPost/' + $scope.Posts[index].post_id + '/' + rating)
                .then(function(response){
                    if(response.data.hearts) {
                        $scope.Posts[index].hearts_1 = response.data.hearts.hearts_1;
                        $scope.Posts[index].hearts_2 = response.data.hearts.hearts_2;
                        $scope.Posts[index].hearts_3 = response.data.hearts.hearts_3;
                        $scope.Posts[index].hearts_4 = response.data.hearts.hearts_4;
                        $scope.Posts[index].hearts_5 = response.data.hearts.hearts_5;
                    }
                    //console.log(response);

                    $scope.Posts[index].hearts_given = rating;
                    console.log($scope.Posts[index]);
                });

        };
    };

    app.controller("postController",postController);

}());
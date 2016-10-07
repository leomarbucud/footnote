(function(){
    "use strick";

    var app = angular.module("admin", []);

    app.controller('adminController',function($http){
        var self = this;
        fetchUsers($http).then(function(users){
            self.users = users;
        });
        self.gender = [
            {value: '0', text: 'Male'},
            {value: '1', text: 'Female'}
        ];
        self.userId = null;
        self.user = null;
    });


    function fetchUsers($http) {
        return $http.get('/zero/admin/getusers')
                    .then(function(response){
                        return response.data;
                    });
    }



    function getUsers($http) {

        var model = this;



        model.$onInit = function() {

        };

        model.showEditModal = function(user) {
            var id = user.user_id;
            $http
                .get('/zero/admin/getUserById/'+id)
                .then(function(response) {
                    model.onModalShow(
                        {$event :
                            {user: response.data}
                        }
                    );
                });
            $('#edit-user-modal')
                .modal().find('form').validator();
        };

        model.showDeleteModal = function(user) {
            model.onModalShow(
                {$event :
                    {user: user}
                }
            );
            $('#delete-user-modal').modal();
        };

        model.showEditCredentialsModal = function(user) {
            var id = user.user_id;
            $http
                .get('/zero/admin/getUserById/'+id)
                .then(function(response) {
                    model.onModalShow(
                        {$event :
                        {user: response.data}
                        }
                    );
                });
            $('#edit-user-credentials-modal')
                .modal().find('form').validator();
        };

        model.showAddModal = function() {
            $('#add-user-modal')
                .modal().find('form').validator();
        };
    }

    app.component('userTable', {
        bindings : {
            users : '<',
            onModalShow : '&'
        },
        templateUrl : '/zero/templates/userTable',
        controllerAs : 'model',
        controller : ['$http', getUsers]
    });

    app.component('editUserModal', {
        bindings : {
            users : '<',
            user : '<',
            gender : '<',
            updateUserInfo : '&',
            onUserUpdate : '&'
        },
        templateUrl : '/zero/templates/editUserModal',
        controllerAs : 'model',
        controller : function($http) {
            var model = this;
            model.updateUserInfo = function(id) {
                $http.post('/zero/admin/updateUserInfo/' + id,
                    model.user
                ).then(function (response)  {
                    if(response.data.status == 'success') {
                        fetchUsers($http).then(function(users){
                            model.onUserUpdate(
                                {$event:
                                    {users: users}
                                }
                            );
                        });
                        model.isUserUpdated = true;
                        model.isNoChanages = false;
                    } else if(response.data.status == 'fail' ) {
                        model.isNoChanages = true;
                        model.isUserUpdated = false;
                    }
                });
            };

            $('#edit-user-modal').on('hidden.bs.modal', function (e) {
                model.isUserUpdated = false;
                model.isNoChanages = false;
            });
        }
    });

    app.component('editUserCredentialsModal', {
        bindings : {
            users : '<',
            user : '<',
            gender : '<',
            updateUserCredentials : '&',
            onUserUpdate : '&'
        },
        templateUrl : '/zero/templates/editUserCredentialsModal',
        controllerAs : 'model',
        controller : function($http) {
            var model = this;
            model.updateUserCredentials = function(id) {
                $http.post('/zero/admin/updateUserCredentials/' + id,
                    model.user
                ).then(function (response)  {
                    if(response.data.status == 'success') {
                        fetchUsers($http).then(function(users){
                            model.onUserUpdate(
                                {$event:
                                    {users: users}
                                }
                            );
                        });
                        model.isUserUpdated = true;
                        model.isNoChanages = false;
                    } else if(response.data.status == 'fail' ) {
                        model.isNoChanages = true;
                        model.isUserUpdated = false;
                    }
                });
            };

            $('#edit-user-credentials-modal').on('hidden.bs.modal', function (e) {
                model.isUserUpdated = false;
                model.isNoChanages = false;
            });
        }
    });

    app.component('deleteUserModal',{
        bindings: {
            user: '<',
            onUserDelete: '&'
        },
        templateUrl : '/zero/templates/deleteUserModal',
        controllerAs : 'model',
        controller: function($http) {
            var model = this;
            model.deleteUser = function(id) {
                $http.post('/zero/admin/deleteUser/',
                    model.user
                ).then(function(response)  {
                    if(response.data.status == 'success') {
                        fetchUsers($http).then(function(users){
                            model.onUserDelete(
                                {$event:
                                    {users: users}
                                }
                            );
                        });
                        model.isUserDeleted = true;
                    } else if(response.data.status == 'fail' ) {
                        model.isUserDeleted = false;
                    }
                });
            };

            $('#delete-user-modal').on('hidden.bs.modal', function (e) {
                model.isUserDeleted = false;
            });
        }
    });

    app.component('addUserModal',{
        bindings: {
            user: '=',
            onUserAdd: '&',
            addUser: '&'
        },
        templateUrl: '/zero/templates/addUserModal',
        controllerAs: 'model',
        controller: function($http) {
            var model = this;
            model.addUser = function() {
                $http.post('/zero/admin/addUser/',
                    model.user
                ).then(function(response) {
                    if(response.data.status == 'success') {
                        fetchUsers($http).then(function(users){
                            model.onUserAdd(
                                {$event:
                                    {users: users}
                                }
                            );
                        });
                        model.message = "User successfully added.";
                        model.isUserAdded = true;
                        model.isUserExist = false;
                    } else if(response.data.status == 'fail' ) {
                        model.isUserAdded = false;
                        if(response.data.message) {
                            model.isUserExist = true;
                            model.message = response.data.message;
                        }
                    }
                });
            };
        }
    });

}());
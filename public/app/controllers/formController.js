app.controller('profileController', function($scope, $http, ModalService) {
    // create a blank object to handle form data.
    $scope.user ='';



    // calling our submit function.
    $scope.submitForm = function() {
        // Posting data to php file

        $http({

            method  : 'POST',
            url     : 'http://sales.dev/edit_profile',
            data    : $.param($scope.user), //forms user object
            headers : {'Content-Type': 'application/x-www-form-urlencoded'}
        })
            .success(function(data) {
                if (data.errors) {
                    // Showing errors.
                    // $scope.errorName = data.errors.name;
                    // $scope.errorUserName = data.errors.username;
                    // $scope.errorEmail = data.errors.email;
                } else {
                    $scope.message = data.message;
                }

                console.log(data);

                ModalService.showModal({
                    templateUrl: "agents",
                    controller: "profileController"
                }).then(function(modal) {

                    //it's a bootstrap element, use 'modal' to show it
                    modal.element.modal();
                    modal.close.then(function(result) {
                        console.log(result);
                    });
                });


            });
    };
});


app.controller('agentController', function($scope, $http, ModalService) {
    // create a blank object to handle form data.
    $scope.agent ='';



    // calling our submit function.
    $scope.newAgent = function() {
        // Posting data to php file

        $http({

            method  : 'POST',
            url     : 'http://sales.dev/new_agent',
            data    : $.param($scope.agent), //forms user object
            headers : {'Content-Type': 'application/x-www-form-urlencoded'}
        })
            .success(function(data) {
                // if (data.errors) {
                //     // Showing errors.
                //     // $scope.errorName = data.errors.name;
                //     // $scope.errorUserName = data.errors.username;
                //     // $scope.errorEmail = data.errors.email;
                // } else {
                //     $scope.message = data.message;
                // }
                //
                // console.log(data);

                ModalService.showModal({
                    template: "modal.htm",
                    controller: "agentController"
                }).then(function(modal) {

                    //it's a bootstrap element, use 'modal' to show it
                    modal.element.modal();
                    modal.close.then(function(result) {
                        console.log(result);
                    });
                });


            });
    };
});


app.controller('performanceController', function($scope, $http, ModalService) {
    // create a blank object to handle form data.
    $scope.performance ='';



    // calling our submit function.
    $scope.newPerformance = function() {
        // Posting data to php file

        $http({

            method  : 'POST',
            url     : 'http://sales.dev/new_performance',
            data    : $.param($scope.performance), //forms user object
            headers : {'Content-Type': 'application/x-www-form-urlencoded'}
        })
            .success(function(data) {
                // if (data.errors) {
                //     // Showing errors.
                //     // $scope.errorName = data.errors.name;
                //     // $scope.errorUserName = data.errors.username;
                //     // $scope.errorEmail = data.errors.email;
                // } else {
                //     $scope.message = data.message;
                // }
                //
                // console.log(data);

                ModalService.showModal({
                    template: "modal.htm",
                    controller: "performanceController"
                }).then(function(modal) {

                    //it's a bootstrap element, use 'modal' to show it
                    modal.element.modal();
                    modal.close.then(function(result) {
                        console.log(result);
                    });
                });


            });
    };
});
app.controller('myCtrl', function($scope) {
    $scope.name = "John Doe";
});


app.controller('itemsController', function($scope, $http) {

    $scope.items = [];
    $scope.lastpage=1;

    $scope.init = function() {
        $scope.lastpage=1;
        $http({
            url: '/agents/',
            method: "GET",
            params: {page:  $scope.lastpage}
        }).success(function(data, status, headers, config) {
            $scope.items = data.data;
            $scope.currentpage = data.current_page;
        });
    };

    $scope.init();

});
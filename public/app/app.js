var app = angular.module('myApp', ['angularModalService'],function($interpolateProvider){

        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');


})

.constant('API_URL', 'http://sales.dev/');

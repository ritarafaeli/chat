var myApp = angular.module('myApp', ['ngRoute']);

myApp.controller('mainController', ['$scope', '$location', '$log', '$routeParams', '$http', function($scope, $location, $log, $routeParams, $http) {

    $scope.visitor_firstname;
    $scope.visitor_email;
    $scope.message;
    $scope.chat_id;
    $scope.messages;
    $scope.errors;
    $scope.isChatInitiated = false;

    $scope.visitorInitiateChat = function() {
        $scope.errors = '';
        $http({
            url: 'chat/create',
            method: 'POST',
            responseType: 'arraybuffer',
            data: {
                visitor_firstname: $scope.visitor_firstname,
                visitor_email: $scope.visitor_email,
                message: $scope.message
            },
            headers: {
                'Content-type': 'application/json',
            }
        }).success(function(data){
            $scope.chat_id = data.id;
            $scope.isChatInitiated = true;
        }).error(function(response){
        });
    }

    $scope.sendMessage = function() {
        $scope.errorsLipsum = "";
        $http.post('chat/post/'+$scope.chat_id, {
                message: $scope.message
            })
            .success(function(response) {

            }).error(function(response) {
                $scope.errors = response;
            }
        );
    }

    $scope.downloadTranscript = function() {
        $http({
            url: 'chat/transcript/'+$scope.chat_id,
            method: 'GET',
            responseType: 'arraybuffer'
        }).success(function(data){
            var blob = new Blob([data], {
                type: "text/csv;charset=utf-8;"
            });
            saveAs(blob, 'ChatTranscript' + $scope.chat_id + '.csv');
        }).error(function(response){
            $scope.errors = response;
        });
    }

}]);

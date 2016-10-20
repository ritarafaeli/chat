<!DOCTYPE html>
<html lang="en-us" ng-app="myApp">
<head>
    <title>Rita Rafaeli - Chat App</title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/main.css')}}">
    <script src="{{URL::asset('assets/js/FileSaver.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/js/angular.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/js/angular-route.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/js/app.js')}}"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="panel panel-default" ng-controller="mainController">
    <div class="container body-content" ng-cloak>
        <div class="panel-group panel-primary">
            <div class="panel-heading">Chat</div>
            <div class="panel-body">
                <div class='alert alert-danger' role="alert" ng-show="errors">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    Please correct the form errors below and try again.
                </div>
                <div ng-hide="isChatInitiated">
                    <form role="form" ng-submit="visitorInitiateChat()">
                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                        <div class='form-group'>
                            <label>Name:</label>
                            <input type='text' ng-model='visitor_name'>
                        </div>
                        <div class='form-group'>
                            <label>Email:</label>
                            <input type='text' ng-model='visitor_email'>
                        </div>
                        <div class='form-group'>
                            <label>Message:</label>
                            <input type='text' ng-model='message'>
                        </div>
                        <button type='submit' class="btn btn-primary" ng-disabled="message == '' || visitor_email == '' || visitor_name == ''">Start Chat</button>
                    </form>
                </div>
                <div ng-show="isChatInitiated">
                    <div ng-repeat="message in messages">
                        @{{ message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

var app = angular.module('suggestionApp', []);

app.controller('dbCtrl', function ($scope, $http) {
    $http.get("./src/api.php")
        .success(function(data){
            $scope.data = data;
            
        })
        .error(function() {
            $scope.data = "error in fetching data";
        });
});

app.controller('postController', function($scope, $http) {
  // Blank object to handle form data
  $scope.suggestion = {};

  // Calling submit function
  $scope.submitForm = function(){
    // Post data to PHP file
    $http({
      method : 'POST',
      url : './src/post.php',
      data : $scope.suggestion,
      headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
    })

    .success(function(data){
      if (data.errors){
        $scope.errorName = data.errors.name;
        $scope.errorSuggestion = data.errors.suggestion;
      } else {
        $scope.message = data.message;
        location.reload();
      }
    });
  };


});
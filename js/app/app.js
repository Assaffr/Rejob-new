var app = angular.module('App', []);

app.controller("MainController", function( $scope, fileUpload, FormFactory ) {
	//console.log('FormController has just run');
	$scope.visitor = {};
	$scope.FormSuccess = false;
	$scope.FormFail = false;
	$scope.FormMsg ="";
	
	
	
	$scope.applyFileName = function(){
		
		console.log($scope.visitor.cvFile)
		
		if( $scope.visitor.cvFile != undefined)
			$scope.visitor.cand_cv_path = $scope.visitor.cvFile.split(/[,\\]+/).pop();

		console.log($scope.visitor.cand_cv_path)
	};
	
	
	
	$scope.sendForm = function ( object ){
		
		
		if( $scope.Form.$valid ){
			
			FormFactory.Form( $scope.myFile , angular.toJson( object ) )
			.success( function( result ){
			 if ( result[0] == true ){
				$scope.FormSuccess = true;
				$scope.FormMsg =""
				$scope.Formfail = false;
			}else{
				$scope.FormMsg = result;
				$scope.FormSuccess = false;
				$scope.Formfail = true;
				console.log( result )
			}
		
				});
				
			}else{
				$scope.FormFail = true
			}	
			//console.log ( angular.toJson( object ) );
		}

	
});

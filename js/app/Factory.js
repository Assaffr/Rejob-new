app.factory( 'FormFactory', ['$http', function( $http ) {
	var FormFactory = {};
	
	FormFactory.Form = function( file, rawData ){
		var fd = new FormData();
        fd.append('file', file);
        fd.append('raw', rawData);
		
		return  $http.post( "receiver/mvc.php", fd ,{
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        } );
	};
	

	
	return FormFactory;
}]);



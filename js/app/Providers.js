app.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function( file, uploadUrl, rawData ){
        var fd = new FormData();
        fd.append('file', file);
        fd.append('raw', rawData);
        return $http.post(uploadUrl, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        })
    }
}]);
/*
app.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            console.log('model = '+model)
            var modelSetter = model.assign;
            console.log("modelSetter = "+modelSetter)	
            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                    console.log("modelSetter2 = "+modelSetter)
                });
            });
        }
    };
}]);
*/
app.directive('validFile', ['$parse', function ($parse) {
    return {
    	restrict: 'A',
    	require: 'ngModel',
        link: function (scope, el, attrs, ngModel) {
        	var model = $parse(attrs.validFile)
        	var modelSetter = model.assign;
        	ngModel.$render = function () {
            	ngModel.$setViewValue(el.val());
                scope.visitor.cand_cv_path = "קורות חיים";
            };

            el.bind('change', function () {
            	scope.$apply(function () {
                	modelSetter(scope, el[0].files[0]);
                	ngModel.$render();
                	scope.visitor.cand_cv_path = el.val().split(/[,\\]+/).pop();
                });
            });
        }
    };
}]);





















var demoApp = angular.module('demoApp',['ngRoute']);
//配置路由
demoApp.config(['$routeProvider',function($routeProvider) {
     /* 路由参数:  
        1、提供两个方法匹配路由，分别是when和otherwise，when方法需要两个参数，  
            otherwise方法做为when方法的补充只需要一个参数，其中when方法可以被多次调用。  
        2、第1个参数是一个字符串，代表当前URL中的hash值。  
        3、第2个参数是一个对象，配置当前路由的参数，如视图、控制器等。  
            a、template 字符串形式的视图模板  
            b、templateUrl 引入外部视图模板  
            c、controller 视图模板所属的控制器  
            d、redirectTo跳转到其它路由  
        4、获取参数，在控制中注入$routeParams可以获取传递的参数  */
        $routeProvider
        .when('/ProductList', {
            controller: "ProductController",
            templateUrl: "./ProductList.html"
        })
        .when('/ProductEdit', {
            controller: "ProductController",
            templateUrl: "./ProductEdit.html"
        })
        .otherwise({
            redirectTo: '/'
        });
    }]);
demoApp.controller("ProductController",function($scope,$route,$routeParams,$location,ProductFactory){
    $scope.products = [];
    var init= function() {
        $scope.products = ProductFactory.getProducts();//获取产品
    }
    init();//给model增加product数据

    var initProductEdit= function() {
        var code = $routeParams.code;
        if (code==undefined) {
            $scope.currentProduct = {};
        } else {
            $scope.currentProduct = ProductFactory.loadProductByCode(code);
        }
    }


    $scope.$on('$viewContentLoaded', function() {
        var tempalteUrl = $route.current.templateUrl;
         console.log(tempalteUrl)
        if (tempalteUrl=="./ProductEdit.html") {
            initProductEdit();
        }else if (tempalteUrl=="./ProductList.html") {//大小写要和temlateUrl中的大小写保持一致
            var code = $routeParams.code;
            if (code!=undefined) {
                $scope.deleteProduct(code);
            }
        }
    });
    $scope.saveProduct= function() {
        ProductFactory.saveProduct($scope.currentProduct);
        $location.search('code', null);
        $location.path('/');
    }

    $scope.deleteProduct= function(code) {
        ProductFactory.deleteProduct(code);
        $location.search('code', null);
        $location.path('/');
    }

})
//定义controllers对象
/*var controllers={};
controllers.ProductController=function($scope,$route,$routeParams,$location,ProductFactory) {//$scope指的是模板
    $scope.products = [];
    var init= function() {
        $scope.products = ProductFactory.getProducts();//获取产品
    }
    var initProductEdit= function() {
        var code = $routeParams.code;
        if (code==undefined) {
            $scope.currentProduct = {};
        } else {
            $scope.currentProduct = ProductFactory.loadProductByCode(code);
        }
    }

    $scope.$on('$viewContentLoaded', function() {
        var tempalteUrl = $route.current.templateUrl;
        if (tempalteUrl=="./ProductEdit.html") {
            initProductEdit();
        }else if (tempalteUrl=="./ProductList.html") {//大小写要和temlateUrl中的大小写保持一致
            var code = $routeParams.code;
            if (code!=undefined) {
                $scope.deleteProduct(code);
            }
        }
    });

    init();

    $scope.saveProduct= function() {
        ProductFactory.saveProduct($scope.currentProduct);
        $location.search('code', null);
        $location.path('/');
    }

    $scope.deleteProduct= function(code) {
        ProductFactory.deleteProduct(code);
        $location.search('code', null);
        $location.path('/');
    }
}

//将所有的控制器赋值给app模块
demoApp.controller(controllers);*/



//定义工厂service
demoApp.factory('ProductFactory', function () {
    //初始化产品数组
    var products = [
    {code:'P001',name:'Lumia 950XL',description:'win10系统最好的手机，带有黑科技色彩',category:'mobile'},
    {code:'P002',name:'Lumia 950',description:'win10系统次好的手机，相比XL低个档次',category:'mobile'},
    {code:'P003',name:'Surface Pro Book',description:'微软最具创新的笔记本',category:'Notebook'},
    {code:'P004',name:'Surface Pro 4',description:'微软最好的PC/平板二合一产品',category:'Surface'},
    {code:'P005', name: 'Surface 4', description: '微软次好的PC/平板二合一产品', category: 'Surface' },
    {code:'P006',name:'Surface Phone',description:'传说中微软下一代win10系统超旗舰手机',category:'mobile'}
    ];
    var factory = {};//六组产品数据
    factory.getProducts= function() {
        return products;
    }

    factory.loadProductByCode= function(code) {//寻找产品数据
        var productFound={};
        for (var i = 0; i < products.length; i++) {
            if (products[i].code==code) {
                productFound = products[i];
                break;
            }
        }
        return productFound;
    }

    factory.saveProduct= function(product) {//传入产品，寻找产品数据中对应的产品
        var tempProduct = factory.loadProductByCode(product.code);

        if (tempProduct == null||tempProduct == undefined) {//没找到，是个新产品
            tempProduct = {};
            tempProduct.code = product.code;
            tempProduct.name = product.name;
            tempProduct.description = product.description;
            tempProduct.category = product.category;
        } else{
            
            tempProduct.code = product.code;
            tempProduct.name = product.name;
            tempProduct.description = product.description;
            tempProduct.category = product.category;

            products.push(tempProduct);
        }
    }
    factory.deleteProduct= function(code) {
        var tempProduct = factory.loadProductByCode(code);

        if (tempProduct!=null) {
            products.remove(tempProduct);
        }
    }
    return factory;
});


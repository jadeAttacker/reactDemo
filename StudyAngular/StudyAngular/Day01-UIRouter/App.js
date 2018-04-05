var myApp = angular.module('myApp', ['ngRoute']);
myApp.config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.when("/page01", {
        templateUrl: "page01.html",
        controller: "page01Controller"
    }).when("/page02", {
        templateUrl: "page02.html",
        controller: "page02Controller"
    }).when("/page03", {
        templateUrl: "page03.html",
        controller: "page03Controller"
    });
    //$urlRouterProvider.when("", "/PageTab");
    //$stateProvider
    //    .state("PageTab", {
    //        url: "/PageTab",
    //        templateUrl: "TabPage.html"
    //    })
    //    .state("pagetab.page1", {
    //        url: "/page1",
    //        templateUrl: "page01.html"
    //    })
    //    .state("pagetab.page2", {
    //        url: "/page2",
    //        templateUrl: "page02.html"
    //    })
    //    .state("pageTab.page3", {
    //        url: "/page3",
    //        templateUrl: "page)3.html"
    //    });
});
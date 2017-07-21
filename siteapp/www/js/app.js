angular.module('underscore', [])
.factory('_', function() {
  return window._; // assumes underscore has already been loaded on the page
});

angular.module('OnlyBaddiesApp', [
  'ionic',
  'OnlyBaddiesApp.common.directives',
  'OnlyBaddiesApp.app.services',
  'OnlyBaddiesApp.app.filters',
  'OnlyBaddiesApp.app.controllers',
  'OnlyBaddiesApp.auth.controllers',
  'underscore',
  'angularMoment',
  'ngCordova',
  'monospaced.elastic'
])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
  });
})

.config(function($stateProvider, $urlRouterProvider) {
  $stateProvider

  //SIDE MENU ROUTES
  .state('app', {
    url: "/app",
    abstract: true,
    templateUrl: "views/app/side-menu.html"
    // controller: 'AppCtrl'
  })


  .state('app.category_feed', {
    url: "/category_feed/:categoryId",
    views: {
      'menuContent': {
        templateUrl: "views/app/feed.html",
        controller: "CategoryFeedCtrl"
      }
    },
    resolve: {
      loggedUser: function(AuthService){
        return AuthService.getLoggedUser();
      },
      feed: function(FeedService, $stateParams){
        // Default page is 1
        var page = 1;
        return FeedService.getFeedByCategory(page, $stateParams.categoryId);
      },
      category: function(CategoryService, $stateParams){
        return CategoryService.getCategory($stateParams.categoryId);
      }
    }
  })

  .state('app.trend_feed', {
    url: "/trend_feed/:trendId",
    views: {
      'menuContent': {
        templateUrl: "views/app/feed.html",
        controller: "TrendFeedCtrl"
      }
    },
    resolve: {
      loggedUser: function(AuthService){
        return AuthService.getLoggedUser();
      },
      feed: function(FeedService, $stateParams){
        // Default page is 1
        var page = 1;
        return FeedService.getFeedByTrend(page, $stateParams.trendId);
      },
      trend: function(TrendsService, $stateParams){
        return TrendsService.getTrend($stateParams.trendId);
      }
    }
  })


  .state('app.browse', {
    url: "/browse",
    views: {
      'menuContent': {
        templateUrl: "views/app/browse.html",
        controller: "BrowseCtrl"
      }
    },
    resolve: {
      trends: function(TrendsService){
        return TrendsService.getTrends();
      },
      categories: function(CategoryService){
        return CategoryService.getCategories();
      }
    }
  })


  .state('app.post', {
    url: "/post/:postId",
    views: {
      'menuContent': {
        templateUrl: "views/app/post/details.html",
        controller: 'PostDetailsCtrl'
      }
    },
    resolve: {
      post: function(FeedService, $stateParams){
        return FeedService.getPost($stateParams.postId);
      }
    }
  })


  //AUTH ROUTES
  .state('facebook-sign-in', {
    url: "/facebook-sign-in",
    templateUrl: "views/auth/facebook-sign-in.html",
    controller: 'WelcomeCtrl'
  })

  .state('dont-have-facebook', {
    url: "/dont-have-facebook",
    templateUrl: "views/auth/dont-have-facebook.html",
    controller: 'WelcomeCtrl'
  })

  .state('create-account', {
    url: "/create-account",
    templateUrl: "views/auth/create-account.html",
    controller: 'CreateAccountCtrl'
  })

  .state('welcome-back', {
    url: "/welcome-back",
    templateUrl: "views/auth/welcome-back.html",
    controller: 'WelcomeBackCtrl'
  })
;



  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/facebook-sign-in');
});

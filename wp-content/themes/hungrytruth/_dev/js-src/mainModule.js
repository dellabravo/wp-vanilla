angular.module('MainApp', ['angularSmoothscroll', 'truncate'])

// services
// ----------------
.service('Main', function(){
  var user = "user";
  return {
    getUser: function () { return user }
  }
})

// controllers
// -------------
.controller('MainCtrl', ['$scope', function($scope){
  
}])
// Directives
// -------------
.directive('icon', [ function () {
  return {
    scope:{glyph: "@icon", place: "@place"}, 
    restrict: "A",
    transclude: true,
    template : "<span class='icon- ' ng-transclude></span>",
    link:function(scope, element, attrs) {}
  };
}])

// fdlpop / overlay
.directive('jsfdlpop', [ function () {
  return {
    scope:{ target: "@" }, 
    restrict: "AC",
    link:function(scope, element, attrs) {
      $(element).click(function () {
        $(".js-light-" + scope.target).fadeIn(200);
        $(".js-fade-" + scope.target).fadeIn(200);
      });
      $(".black_overlay, .close-myoverlay").click(function () {
        $("[class*='js-light'], [class*='js-fade']").fadeOut(200);
      })
    }
  };
}])

// popover
.directive('fdlPopover', [ function () {
  return {
    scope:{ placement:"@" }, 
    restrict: "AC",
    transclude: true,
    template : "<span ng-transclude></span>",
    link:function(scope, element, attrs) {
      var popTarget = ".js-popover-content";
      var popPlacement = scope.placement || "top";
      $(element).popover({
       html : true,
       placement: popPlacement,
       content: function() {
         return $(popTarget).html();
       }
     });
       // toggle behavior
       $(element).on('click', function () {
         $("[data-fdl-popover]").not(this).popover('hide');
       });
       
     }
   };
 }])

/*
 ## backtotop ##

 Used to reference to top of a page after page is scrolled.

 API:

 - id:        The id of the html element used to attach jquery handlers.

 - to:        id name of the element that the scroll has to return to.
               If no value is provided, it defaults to the top of the page.

 - backtotop: The text displated on the link back to top of the page.

 */
 .directive('backtotop', [ '$window', '$timeout', function ($window, $timeout) {
  return {
    scope: {id: "@", to: "@", backtotop: "@"}, 
    restrict: "AC",
    template : "<a data-smooth-scroll-jquery data-target= href=''><span></span></a>",
    link:function(scope, element, attrs) {
      var selector = "#";
      $($window).scroll(function() {
        if ($(this).scrollTop()) {
          $(selector + scope.id+':hidden').stop(true, true).fadeIn();
        } else {
          $timeout(function () {
            $(selector + scope.id).stop(true, true).fadeOut();
          }, 500);
        }
      });
    }
  };
}])

// handler for top mini nav
.directive('jsTopMobileNav', [ '$window', '$timeout', function ($window, $timeout) {
  return {
    scope: {}, 
    restrict: "AC",
    transclude: true,
    template : "<div ng-transclude></div>",
    link:function(scope, element, attrs) {
      $(element).click(function () {
       if($(element).hasClass("nav-open")) {
         $("#fdl-mininav-expand").slideUp(200);
         $(element).removeClass("nav-open")
       } else {
         $("#fdl-mininav-expand").slideDown(200);
         $(element).addClass("nav-open")
       }
     })
    }
  };
}])

// show viewport width for debugging
.directive('jsVpwidth', [ '$window', '$timeout', function ($window, $timeout) {
  return {
    scope: {}, 
    restrict: "AC",
    transclude: true,
    template : "<div ng-transclude></div>",
    link:function(scope, element, attrs) {
      $(element).text(window.innerWidth);
      function reportVpWidth() {
        $(element).text(window.innerWidth);
      }
      var thReportVpWidth = _.throttle(reportVpWidth);
      $(window).resize(thReportVpWidth);
    }
  }
}])

// slide down subnav on scroll
.directive('jsStickyNav', [ '$window', '$timeout', function ($window, $timeout) {
  return {
    scope: {}, 
    restrict: "AC",
    transclude: true,
    template : "<div ng-transclude></div>",
    link:function(scope, element, attrs) {
      // helper for getting the height.
      function getDocHeight() {
        var D = document;
        return Math.max(
          D.body.scrollHeight, D.documentElement.scrollHeight,
          D.body.offsetHeight, D.documentElement.offsetHeight,
          D.body.clientHeight, D.documentElement.clientHeight
          );
      }
      function stickyNav () {
         if ($($window).scrollTop() + $($window).height() > getDocHeight() - 100) {
           $(element).slideUp(200);
         }
        else if ($($window).scrollTop() > 700) {
           $(element).slideDown(300);
         }
         else {
           $(element).slideUp(300);
         } 
      }
      var throttledStickyNav = _.throttle(stickyNav, 500);
       $(window).scroll(throttledStickyNav);
    }
  }
}])


// filters
// ------------
.filter('paginate', function() {
  return function(d, start, pageSize, skipFilter) {
    if (!d || skipFilter) return d;
    start = +start;
    start--;
    pageSize = +pageSize;
    return  d.slice(start*pageSize, (start*pageSize)+pageSize);
  };
})

// timeago filter: calculates the current time - a date.
// eg: 2 days ago, 3 minutes ago, etc ...
.filter("timeago", function () {
    //time: the time
    //local: compared to what time? default: now
    //raw: wheter you want in a format of "5 minutes ago", or "5 minutes"
    return function (time, local, raw) {
      if (!time) return "never";

      if (!local) {
        (local = Date.now())
      }

      if (angular.isDate(time)) {
        time = time.getTime();
      } else if (typeof time === "string") {
        time = new Date(time).getTime();
      }

      if (angular.isDate(local)) {
        local = local.getTime();
      }else if (typeof local === "string") {
        local = new Date(local).getTime();
      }

      if (typeof time !== 'number' || typeof local !== 'number') {
        return;
      }

      var
      offset = Math.abs((local - time) / 1000),
      span = [],
      MINUTE = 60,
      HOUR = 3600,
      DAY = 86400,
      WEEK = 604800,
      MONTH = 2629744,
      YEAR = 31556926,
      DECADE = 315569260;

      if (offset <= MINUTE)              span = [ '', raw ? 'now' : 'less than a minute' ];
      else if (offset < (MINUTE * 60))   span = [ Math.round(Math.abs(offset / MINUTE)), 'min' ];
      else if (offset < (HOUR * 24))     span = [ Math.round(Math.abs(offset / HOUR)), 'hr' ];
      else if (offset < (DAY * 7))       span = [ Math.round(Math.abs(offset / DAY)), 'day' ];
      else if (offset < (WEEK * 52))     span = [ Math.round(Math.abs(offset / WEEK)), 'week' ];
      else if (offset < (YEAR * 10))     span = [ Math.round(Math.abs(offset / YEAR)), 'year' ];
      else if (offset < (DECADE * 100))  span = [ Math.round(Math.abs(offset / DECADE)), 'decade' ];
      else                               span = [ '', 'a long time' ];

      span[1] += (span[0] === 0 || span[0] > 1) ? 's' : '';
      span = span.join(' ');

      if (raw === true) {
        return span;
      }
      return (time <= local) ? span + ' ago' : 'in ' + span;
    }
})
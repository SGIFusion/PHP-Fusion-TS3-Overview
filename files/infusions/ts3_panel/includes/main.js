var app=angular.module('refresh_div',[])
.controller('refresh_control',function($scope,$interval){
      var c=0;
      $scope.message="This DIV is refreshed "+c+" time.";
      var timer=$interval(function(){
        $scope.message="This DIV is refreshed "+c+" time.";
        c++;
        if(c===100)
          {
            $scope.message="Restarting the timer again :-)";
            c=0;
          }
      },100);

      $scope.killtimer=function(){
        if(angular.isDefined(timer))
          {
            $interval.cancel(timer);
            timer=undefined;
            $scope.message="Timer is killed :-(";
          }
      };
});
$( document ).ready(function(){
  $(".button-collapse").sidenav();


   var instance = M.Sidenav.getInstance(".mobile-demo");

   $(".button-collapse").click(function() {
     instance.open();
   });
});

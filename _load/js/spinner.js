$(document).ready(function() {
		var spin = 0;  
		
  setInterval(function(){
   spin+=0.5;
   
  $(".spin").rotate(spin);

  },10);
      });
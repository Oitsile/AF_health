$(document).ready(function () {"use strict";
		$('#idtooltip').hide();
		$("#junior-add").hide();
		$("#sidebar-d2d").hide();
		$("#sidebar-hos").hide();
		$("#sidebar-com").hide();

		$("#sidebar-j-d2d").hide();
		$("#sidebar-j-hos").hide();
		$("#sidebar-j-com").hide();

		$("#sidebar-s-d2d").hide();
		$("#sidebar-s-hos").hide();
		$("#sidebar-s-com").hide();

		$("#add_spouse").hide();
		$("#addchild").hide();
		//$('#dc01').hide();
		
	
	/*=================================*/
							   
							   
	
$("#cover-selector").change(function(){
        $(this).find("option:selected").each(function(){
			var value1 = $(this).attr("value");
            if(value1==1){                
				$("#sidebar-d2d").show('fast');
				$("#sidebar-hos").hide('fast');
				$("#sidebar-com").hide('fast');

				$("#sidebar-j-d2d").hide('fast');
				$("#sidebar-j-hos").hide('fast');
				$("#sidebar-j-com").hide('fast');

				$("#sidebar-s-d2d").hide('fast');
				$("#sidebar-s-hos").hide('fast');
				$("#sidebar-s-com").hide('fast');
				
				$("#add_spouse").show('fast');
				$("#addchild").show('fast');
				$('select[name*="addchild"] option[value="0"]').show();
				$('select[name*="addchild"] option[value="200"]').show();
				$('select[name*="addchild"] option[value="201"]').hide();
				$('select[name*="addchild"] option[value="200"]').attr("selected",true);
				$('select[name*="addchild"] option[value="201"]').attr("selected",false);
			}

			else if(value1==2){                
				$("#sidebar-d2d").hide('fast');
				$("#sidebar-hos").show('fast');
				$("#sidebar-com").hide('fast');

				$("#sidebar-j-d2d").hide('fast');
				$("#sidebar-j-hos").hide('fast');
				$("#sidebar-j-com").hide('fast');

				$("#sidebar-s-d2d").hide('fast');
				$("#sidebar-s-hos").hide('fast');
				$("#sidebar-s-com").hide('fast');
				
				$("#add_spouse").show('fast');
				$("#addchild").show('fast');
				$('select[name*="addchild"] option[value="0"]').show();
				$('select[name*="addchild"] option[value="200"]').show();
				$('select[name*="addchild"] option[value="201"]').hide();
				$('select[name*="addchild"] option[value="200"]').attr("selected",true);
				$('select[name*="addchild"] option[value="201"]').attr("selected",false);
			}

			else if(value1==3){                
				$("#sidebar-d2d").hide('fast');
				$("#sidebar-hos").hide('fast');
				$("#sidebar-com").show('fast');

				$("#sidebar-j-d2d").hide('fast');
				$("#sidebar-j-hos").hide('fast');
				$("#sidebar-j-com").hide('fast');

				$("#sidebar-s-d2d").hide('fast');
				$("#sidebar-s-hos").hide('fast');
				$("#sidebar-s-com").hide('fast');
				
				$("#add_spouse").show('fast');
				$("#addchild").show('fast');
				$('select[name*="addchild"] option[value="0"]').show();
				$('select[name*="addchild"] option[value="200"]').show();
				$('select[name*="addchild"] option[value="201"]').hide();
				$('select[name*="addchild"] option[value="200"]').attr("selected",true);
				$('select[name*="addchild"] option[value="201"]').attr("selected",false);
			}

			else if(value1==5){                
				$("#sidebar-d2d").hide('fast');
				$("#sidebar-hos").hide('fast');
				$("#sidebar-com").hide('fast');

				$("#sidebar-j-d2d").show('fast');
				$("#sidebar-j-hos").hide('fast');
				$("#sidebar-j-com").hide('fast');

				$("#sidebar-s-d2d").hide('fast');
				$("#sidebar-s-hos").hide('fast');
				$("#sidebar-s-com").hide('fast');
				
				$("#add_spouse").hide('fast');
				$("#addchild").show('fast');
				$('select[name*="addchild"] option[value="0"]').show();
				$('select[name*="addchild"] option[value="200"]').show();
				$('select[name*="addchild"] option[value="201"]').hide();
				$('select[name*="addchild"] option[value="200"]').attr("selected",true);
				$('select[name*="addchild"] option[value="201"]').attr("selected",false);
			}

			else if(value1==6){                
				$("#sidebar-d2d").hide('fast');
				$("#sidebar-hos").hide('fast');
				$("#sidebar-com").hide('fast');

				$("#sidebar-j-d2d").hide('fast');
				$("#sidebar-j-hos").show('fast');
				$("#sidebar-j-com").hide('fast');

				$("#sidebar-s-d2d").hide('fast');
				$("#sidebar-s-hos").hide('fast');
				$("#sidebar-s-com").hide('fast');

				$("#add_spouse").hide('fast');
				$("#addchild").show('fast');
				$('select[name*="addchild"] option[value="0"]').show();
				$('select[name*="addchild"] option[value="200"]').show();
				$('select[name*="addchild"] option[value="201"]').hide();
				$('select[name*="addchild"] option[value="200"]').attr("selected",true);
				$('select[name*="addchild"] option[value="201"]').attr("selected",false);
			}

			else if(value1==7){                
				$("#sidebar-d2d").hide('fast');
				$("#sidebar-hos").hide('fast');
				$("#sidebar-com").hide('fast');

				$("#sidebar-j-d2d").hide('fast');
				$("#sidebar-j-hos").hide('fast');
				$("#sidebar-j-com").show('fast');

				$("#sidebar-s-d2d").hide('fast');
				$("#sidebar-s-hos").hide('fast');
				$("#sidebar-s-com").hide('fast');

				$("#add_spouse").hide('fast');
				$("#addchild").show('fast');
				$('select[name*="addchild"] option[value="0"]').show();
				$('select[name*="addchild"] option[value="200"]').show();
				$('select[name*="addchild"] option[value="201"]').hide();
				$('select[name*="addchild"] option[value="200"]').attr("selected",true);
				$('select[name*="addchild"] option[value="201"]').attr("selected",false);
			}

			
			else if(value1==4){                
				$("#sidebar-d2d").hide('fast');
				$("#sidebar-hos").hide('fast');
				$("#sidebar-com").hide('fast');

				$("#sidebar-j-d2d").hide('fast');
				$("#sidebar-j-hos").hide('fast');
				$("#sidebar-j-com").hide('fast');

				$("#sidebar-s-d2d").show('fast');
				$("#sidebar-s-hos").hide('fast');
				$("#sidebar-s-com").hide('fast');

				$("#add_spouse").show('fast');
				$("#addchild").show('fast');
				$('select[name*="addchild"] option[value="0"]').show();
				$('select[name*="addchild"] option[value="200"]').show();
				$('select[name*="addchild"] option[value="201"]').hide();
				$('select[name*="addchild"] option[value="200"]').attr("selected",true);
				$('select[name*="addchild"] option[value="201"]').attr("selected",false);
			}

			else if(value1==105){                
				$("#sidebar-d2d").hide('fast');
				$("#sidebar-hos").hide('fast');
				$("#sidebar-com").hide('fast');

				$("#sidebar-j-d2d").hide('fast');
				$("#sidebar-j-hos").hide('fast');
				$("#sidebar-j-com").hide('fast');

				$("#sidebar-s-d2d").hide('fast');
				$("#sidebar-s-hos").show('fast');
				$("#sidebar-s-com").hide('fast');

				$("#add_spouse").show('fast');
				$("#addchild").show('fast');
				$('select[name*="addchild"] option[value="0"]').show();
				$('select[name*="addchild"] option[value="200"]').show();
				$('select[name*="addchild"] option[value="201"]').hide();
				$('select[name*="addchild"] option[value="200"]').attr("selected",true);
				$('select[name*="addchild"] option[value="201"]').attr("selected",false);
			}

			else if(value1==106){                
				$("#sidebar-d2d").hide('fast');
				$("#sidebar-hos").hide('fast');
				$("#sidebar-com").hide('fast');

				$("#sidebar-j-d2d").hide('fast');
				$("#sidebar-j-hos").hide('fast');
				$("#sidebar-j-com").hide('fast');

				$("#sidebar-s-d2d").hide('fast');
				$("#sidebar-s-hos").hide('fast');
				$("#sidebar-s-com").show('fast');

				$("#add_spouse").show('fast');
				$("#addchild").show('fast');
				$('select[name*="addchild"] option[value="0"]').show();
				$('select[name*="addchild"] option[value="200"]').show();
				$('select[name*="addchild"] option[value="201"]').hide();
				$('select[name*="addchild"] option[value="200"]').attr("selected",true);
				$('select[name*="addchild"] option[value="201"]').attr("selected",false);
			}
			
			
            else{
				$("#add_spouse").hide();
				$('select[name*="addchild"] option[value="0"]').hide();
				$('select[name*="addchild"] option[value="200"]').hide();
				$('select[name*="addchild"] option[value="201"]').hide();
				$("#junior-add").hide('fast');
            }
        });
}).change();
							   
$("#inso").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("value")==='Salary'){
				$('select[name*="payper"] option[value="Not Employed"]').hide();
            }
            else{
				$('select[name*="payper"] option[value="Not Employed"]').show();
            }
        });
}).change();
							   
/*============== ID Number Tooltip ===================*/
							   
$('#idinfo').click(function(e){
   if($('#idtooltip').css("display") === 'none'){
      $('#idtooltip').slideDown("fast");
	  $('.overlay').fadeIn("fast");
   }

   else{
      $('#idtooltip').slideUp("fast");
	   $('.overlay').fadeOut("fast");
   }
	e.stopPropagation();
});

$(document).on( "click", function( e) {  
     e.stopPropagation();
	$('#idtooltip').slideUp("fast");
	$('.overlay').fadeOut("fast");
});

	
/*=================================*/

	});
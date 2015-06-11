
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
	$(document).ready(function(){

		$(".recent_projects").hide();

		$("#img_1").load(function(){
			//alert('asdasd');
            
				//alert('as');
			     $(".recent_projects").slideDown(1400);
			     $('.recent_projects').show();
            
        });
        $("#img_2").load(function(){
            //alert('asdasd');
            
                //alert('as');
                 $(".recent_projects").slideDown(1400);
                 $('.recent_projects').show();
            
        });

        $("#img_3").load(function(){
            //alert('asdasd');
            
                //alert('as');
                 $(".recent_projects").slideDown(1400);
                 $('.recent_projects').show();
            
        });
		
		$('#templatemo_menu>ul>li>a').click(function(e) {
		$('#templatemo_menu>ul>li>a').removeClass('current');

        if (!$(this).hasClass('current')) {
            $(this).addClass('current');
        }
		});
		
		
	});
	
	
	 $('.looper').looper({
    interval: 1000
    });

        jQuery(function($){
            $('#bulletLooper').on('shown', function(e){
                $('.looper-nav > li', this)
                        .removeClass('active')
                        .eq(e.relatedIndex)
                            .addClass('active');
            });
        });
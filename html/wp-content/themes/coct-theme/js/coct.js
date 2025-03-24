
/* Tabs */



jQuery(document).ready(function($) {
        
    
    /* Economic Analysis Page Tabs */
    $('.tab-button-container div').click(function(){

        var t = $(this).attr('id');

        if($(this).hasClass('tab-inactive')){ //this is the start of our condition 

            $('.tab-button-container div').addClass('tab-inactive'); 
            $(this).removeClass('tab-inactive');
    
            $('.tab_content').hide();
            $('.tab_content').css('visibility','hidden');
            
            $('#'+t+'_content').show();
            $('#'+t+'_content').css('visibility','visible');

        }

       
    });

     


})




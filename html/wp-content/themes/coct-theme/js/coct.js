
/* Tabs */



jQuery(document).ready(function($) {
        
    
        /* Department Page Show / Hide main tabs */
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
        /* End of department Page Show / Hide main tabs */

        /* Department page Data stories text / background opacity hover */
        $('.data_story_link').hover(function(){
    
            var item_id = $(this).attr('id');            
            //console.log('#' + item_id + ' .data_story_image_text');
            $( '#' + item_id + ' .data_story_image_text' ).toggle();   
            $( '#' + item_id + ' .data_story_image_wrapper' ).toggleClass("data_story_image_on_hover");    
            
        });   
        /* End of Department page Data stories text / background opacity hover */

        /* Department meta info popup */
        $('#meta_info_popup_show').click(function(){        
            $('#meta_info_popup_content').show();       
        });
        /* Close poupup */
        $('#meta_info_popup_content svg').click(function(){                
            $('#meta_info_popup_content').hide();
        
        });
        /* End of Department meta info popup */
     


})




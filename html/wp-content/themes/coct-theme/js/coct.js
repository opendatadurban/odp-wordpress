/* Initialise jQuery on Page ready */
jQuery(document).ready(function($) {
        
    
        /* Department Page Show / Hide main tabs */
        $('.tab_button_container div').click(function(){

            var t = $(this).attr('id');

            if($(this).hasClass('tab_inactive')){ //this is the start of our condition 

                $('.tab_button_container div').addClass('tab_inactive'); 
                $(this).removeClass('tab_inactive');
        
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
     
        /* Department overview stats info1 popup */
        $('.tab_stats_info_block #dept_stat1_info_popup').click(function(){        
            $('.tab_stats_info_block .statistics_info_popup_content').hide();       
            /* Then open the right popup */
            $('.tab_stats_info_block #dept_stat1_info_popup_content').show();       
        });
        /* Department overview stats info2 popup */
        $('.tab_stats_info_block #dept_stat2_info_popup').click(function(){        
            $('.tab_stats_info_block .statistics_info_popup_content').hide();       
            /* Then open the right popup */
            $('.tab_stats_info_block #dept_stat2_info_popup_content').show();       
        });
        /* Department overview stats info3 popup */
        $('.tab_stats_info_block #dept_stat3_info_popup').click(function(){        
            $('.tab_stats_info_block .statistics_info_popup_content').hide();       
            /* Then open the right popup */
            $('.tab_stats_info_block #dept_stat3_info_popup_content').show();       
        });
        /* Close poupup */
        $('.tab_stats_info_block svg').click(function(){                
            // Close all popups
            $('.tab_stats_info_block .statistics_info_popup_content').hide();               
        });
        /* End of Department overview stats info popup */     

})




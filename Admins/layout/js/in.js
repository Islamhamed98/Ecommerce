$(function() {

    'use strict';
    
    // Hide Placeholder From Focus
    $('[placeholder]').focus(function(){
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
    });

    // Convert Password Field To Text Field On Hover Eye 
    
    
        $('.form-group .show-pass').hover(function(){
            $('.password').attr(type,'text');
        },function(){

            $('.password').attr(type,'password');
       
        });
 

});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    $('.carousel').carousel({
        interval: 4000
    });
});
$(".animenu__toggle").click(function () {
   
    $(".dm").toggle();  
    $(".mt").toggle();
});
    
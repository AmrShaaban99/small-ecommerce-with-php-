$(function(){
    'use strict';
    //Hide Placeholder On Form Focus
   var newplace = '';
 $('[placeholder]').focus(function () {

  newplace = $(this).attr('placeholder');
  $(this).attr('placeholder', '');
 }).blur(function () {
  $(this).attr('placeholder', newplace);
 });
    $('input').each(function(){
       if($(this).attr('required') === 'required'){
           $(this).after('<span class="asterisk">*</span>');
       }
   });
   $('.confirm').click(function(){
       return confirm('Are you sure ?');
   });
   $('.cat h3').click(function(){
      $(this).next('.full-view').fadeToggle(200) ;
   });
   
   $('.option span').click(function(){
      $(this).addClass('active').siblings('span').removeClass('active');
      if($(this).data('view')=='full'){
          $('.cat .full-view').fadeIn(200)
      }else{
          $('.cat .full-view').fadeOut(200)
      }
   });
});
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

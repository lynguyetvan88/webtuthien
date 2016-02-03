// CSS3 animated & responsive dropdown menu
// Latest version: https://github.com/catalinred/Animenu

(function(){
  var animenuToggle = document.querySelector('.animenu__toggle'),
      animenuNav    = document.querySelector('.animenu__nav'),
      animenu_Nav    = document.querySelector('.animenu'),
      hasClass = function( elem, className ) {
        return new RegExp( ' ' + className + ' ' ).test( ' ' + elem.className + ' ' );
      },
      toggleClass = function( elem, className ) {
        var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ' ) + ' ';
        if( hasClass(elem, className ) ) {
          while( newClass.indexOf( ' ' + className + ' ' ) >= 0 ) {
            newClass = newClass.replace( ' ' + className + ' ' , ' ' );
          }
          elem.className = newClass.replace( /^\s+|\s+$/g, '' );
        } else {
          elem.className += ' ' + className;
        }
      },           
      animenuToggleNav =  function (){        
        toggleClass(animenuToggle, "animenu__toggle--active");
        toggleClass(animenuNav, "animenu__nav--open");  
        toggleClass(animenu_Nav, "animenu__avt");  
      }

  if (!animenuToggle.addEventListener) {
      animenuToggle.attachEvent("onclick", animenuToggleNav);
     
  }
  else {
      animenuToggle.addEventListener('click', animenuToggleNav);
     
  }
})()
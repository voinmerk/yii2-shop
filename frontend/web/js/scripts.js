$( document ).ready(function () {
  // tooltips on hover
  $('[data-toggle=\'tooltip\']').tooltip({container: 'body', html: true});

  // Makes tooltips work on ajax generated content
  $(document).ajaxStop(function() {
  	$('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
  });

  $.event.special.remove = {
  	remove: function(o) {
  		if (o.handler) {
  			o.handler.apply(this, arguments);
  		}
  	}
  }

  // tooltip remove
  $('[data-toggle=\'tooltip\']').on('remove', function() {
  	$(this).tooltip('destroy');
  });

  // Tooltip remove fixed
  $(document).on('click', '[data-toggle=\'tooltip\']', function(e) {
  	$('body > .tooltip').remove();
  });

  $(document).on('click', '[data-toggle=\'tooltip\']', function(e) {
  	$('body > .tooltip').remove();
  });

  // Categories Menu
  /*$('.categories .nav > li.dropdown').on('click', function(event) {
    event.preventDefault();

		// var selected = $(this);

    //alert('666');

    toggleNav();

    //alert('asdasd');
  });

  function toggleNav(){
		var navIsVisible = ( !$('.categories .nav > li.dropdown').hasClass('active') ) ? true : false;

		$('.categories .nav > li.dropdown').toggleClass('active', navIsVisible);
		// $('.cd-dropdown-trigger').toggleClass('dropdown-is-active', navIsVisible);

		if( !navIsVisible ) {
			$('.sub-categories').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
				$('.sub-categories').css('display', 'none');

				$('.categories .nav > li.active').removeClass('active');
			});
		}
	}*/
});

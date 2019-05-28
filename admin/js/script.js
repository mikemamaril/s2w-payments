(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	
	$(window).load(function() {
		$('#airdatepicker').airdatepicker({
			language: 'en',
			multipleDatesSeparator: ' - ',
			range: true,
			dateFormat: 'M d, yyyy',
			toggleSelected: true,
			todayButton: new Date()
		});
		$('#s2w-clear-cache').on('click', function() {
			if( !confirm('Are you sure you want to clear the cache?')) {
				return false;
			}
		});

		$('#search-payments').on('submit', function(evt) {
			var $form = $(this);
			var $Input = $('#airdatepicker');

			if ($Input.val() == '') {
				alert('Specify a date or date range first');
				return false;
			} else {
				$form.css('padding', '8px 16px');
				var $overlay = $("<div/>").css({
					'background-color' : 'rgba(255,255,255,0.9)',
					'width': '100%',
					'height': '100%',
					'position': 'absolute',
					'top': '0px',
					'left': '0px',
					'zIndex': '100',
					'opacity': '1',
					'display': 'none',
	
					'letter-spacing': '2px',
					'text-align': 'center',
					'line-height': '46px'
				}).attr('id', 'overlay')
				.html('WORKING');
				$form.append($overlay);
	
				$overlay.fadeIn(200, function() {
				});
			}
		});
	});
})( jQuery );

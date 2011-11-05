 (function($) {
	 $.fn.eip = function() {
	 	return this.each(function() {
	 		alert($(this).text());
	 	});
	 };
 })(jQuery);
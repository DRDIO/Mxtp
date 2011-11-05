	function search(){
		 
   		 $.post("ajax/search",{
	       query: $('#query').val(),
	       page: 0
	     }, function(html) {
	    	 $('ul.results_list').empty();
	    	 $('ul.results_list').append(html);
	    	 document.getElementById("results").scrollTop = 1;
	     });

	     last_search = $('#query').val();
	     page = 1;
	}


	var scroll_count = 0;

	function more(){
		if(scroll_count == 0){
			scroll_count++;
			loading = '<img src="/image/loading.gif" id="loading" />';
			$('#results').append(loading);
		   	$.post("ajax/search",{
			       query: last_search,
			       page: page
			 }, function(html) {
				 $("#loading").remove();
				 $('ul.results_list').append(html);
				 scroll_count = 0;
			 });
			     
			 page++;
		}
	}
	
   	function set_results_position(){
   	   	result_element = document.getElementById("results");
   		current_position = result_element.scrollTop;
   		client_height = result_element.clientHeight;
   		scroll_height = result_element.scrollHeight;

   		if(current_position + client_height == scroll_height){
			more();
   		}
   	}
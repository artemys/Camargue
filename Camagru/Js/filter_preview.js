(function(){
	var		filter_choice = document.querySelector('#choice'),
			filter_prev = document.querySelector('#filter_prev')

  	console.log('1');
  	filter_choice.addEventListener('change', function() {
  		console.log('2');
  		var idx=filter_choice.selectedIndex;
    	var val=filter_choice.options[idx].value;
   
    	filter_prev.classList.remove('filter1');
    	filter_prev.classList.remove('filter2');
    	filter_prev.classList.remove('filter3');

    	filter_prev.classList.add(val);

  	});
})();
// function pouet(){
	var jaime = document.getElementsByClassName('jaime');
	Array.prototype.forEach.call(jaime, function(el) {
		el.addEventListener('click', function() {
			i = 0;

			var request = new XMLHttpRequest();
			var photo_id = el.id;
			if (el.classList.contains('jaime')){
				el.innerHTML = 'Jaime plus';
				el.classList.add('jaimepas');
				el.classList.remove('jaime');
				request.open('POST', '../Controlers/jaime.php', true);
			} else {
				el.innerHTML = 'Jaime';
				el.classList.remove('jaimepas');
				el.classList.add('jaime');
				request.open('POST', '../Controlers/jaimepas.php', true);
			}
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			var data = 'photo_id=' + photo_id;
			request.send(data);

		});
	});
// }

// function poney(){
	var jaimepas = document.getElementsByClassName('jaimepas');
	Array.prototype.forEach.call(jaimepas, function(el) {
		el.addEventListener('click', function() {
			i = 1;
			var request = new XMLHttpRequest();
			var photo_id = el.id;
			if (el.classList.contains('jaime')){
				el.innerHTML = 'Jaime plus';
				el.classList.add('jaimepas');
				el.classList.remove('jaime');
				request.open('POST', '../Controlers/jaime.php', true);
			} else {
				el.innerHTML = 'Jaime';
				el.classList.remove('jaimepas');
				el.classList.add('jaime');
				request.open('POST', '../Controlers/jaimepas.php', true);
			}
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			var data = 'photo_id=' + photo_id;
			request.send(data);

		});
	});
// }

// function livechange(){
// 	if (i == 0)
// 		poney();
// 	else
// 		pouet();
// }
// var i = 0;
// livechange();
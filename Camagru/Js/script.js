(function() {
  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      filter       = document.querySelector('#filter_prev'),
      filter_button = document.querySelector('#filter_button'),
      width = 320,
      height = 0;

  navigator.getMedia = ( navigator.getUserMedia || 
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);
  navigator.getMedia(
    { 
      video: true, 
      audio: false 
    },
    function(stream) {
      if (navigator.mozGetUserMedia) 
      { 
        video.mozSrcObject = stream;
      } 
      else 
      {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var img = canvas.toDataURL('image/png');
    photo.setAttribute('src', img); //enfaite la on dit que la source div qui s'appelle photo deviens data

    var data = "img=" + img;
    var request = new XMLHttpRequest();
    request.open('POST', '../Controlers/save_photo.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    console.log("coucou");
    request.send(data);
    // request.send(filter);
  }

  startbutton.addEventListener('click', function(ev){
    takepicture();
    ev.preventDefault();
  }, false);
})();
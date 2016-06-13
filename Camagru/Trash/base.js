(function () {

    var canvas=document.getElementById("canvas");
    startbutton  = document.querySelector('#startbutton'),
    var dataUrl=canvas.toDataURL();

$.ajax({
  type: "POST",
  url: "http://localhost/saveCanvasDataUrl.php",
  data: {image: dataUrl}
})
.done(function(respond){console.log("done: "+respond);})
.fail(function(respond){console.log("fail");})
.always(function(respond){console.log("always");})


})();
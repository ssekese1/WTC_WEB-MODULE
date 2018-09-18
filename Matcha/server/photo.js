(function() {
    var video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        photo = document.getElementById('img'),

        vendorURL = window.URL || window.webkitURL;

    navigator.getMedia = navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia;
    navigator.getMedia({
            video: true,
            audio: false
        },
        function(stream) {
            video.src = vendorURL.createObjectURL(stream);
            video.play();
        },
        function(error) {
            alert("There was an error capturing a picture!")
        });
    document.getElementById('capture').addEventListener('click', function() {
        context.drawImage(video, 0, 0, 400, 300);
        var img = canvas.toDataURL('image/jpeg');
        var pic = document.getElementById('img');
        pic.value = img;
        alert("Image saved to gallery");
        document.getElementById('save').submit();
    });
    // function drawOnCanvas(file) {
    //     var reader = new FileReader();
      
    //     reader.onload = function (e) {
    //       var dataURL = e.target.result,
    //           c = document.querySelector('canvas'), // see Example 4
    //           ctx = c.getContext('2d'),
    //           img = new Image();
      
    //       img.onload = function() {
    //         c.width = img.width;
    //         c.height = img.height;
    //         ctx.drawImage(img, 0, 0);
    //       };
      
    //       img.src = dataURL;
    //     };
      
    //     reader.readAsDataURL(file);
    //   }

})();
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
        context.drawImage(sup_src, 0, 0, 400, 300);
        var img = canvas.toDataURL('image/jpeg');
        var pic = document.getElementById('img');
        pic.value = img;
        alert("Image saved to gallery");
        document.getElementById('save').submit();
    });


})();
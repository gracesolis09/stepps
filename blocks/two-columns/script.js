jQuery(function ($) {
  document.addEventListener('DOMContentLoaded', function () {
    var video = document.getElementById('videoBg');
    var promise = video.play();
    video.removeAttribute('controls');
    if (promise !== undefined) {
      promise.then(_ => {
        // Autoplay started!
      }).catch(error => {
        // Autoplay was prevented.
        // Show a play button so the user can start playback.
        video.muted = true;
        video.play();
      });
    }
  });
});
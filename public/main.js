/* Toast notifications disappers */
var toastContainer = document.querySelector('.toast-container');
var closeButton = document.querySelector('.toast-close');

// by clicking
if (toastContainer) {
  closeButton.addEventListener('click', closeToast);

  function closeToast() {
    toastContainer.remove();
  }
}

// by timing
if (toastContainer) {
  var duration = 3000;
  setTimeout(function() {
    toastContainer.remove();
  }, duration);
}
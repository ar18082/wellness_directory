window.addEventListener('load', function() {
    let container = document.querySelector('.container_slider');
    let images = document.querySelectorAll('.container_slider_img');

    let currentIndex = 0;
    let slideInterval = setInterval(nextSlide, 5000); 

    function nextSlide() {
        currentIndex = (currentIndex + 1) % images.length;
        container.scrollTo({
            left: images[currentIndex].offsetLeft,
            behavior: 'smooth'
        });
    }
});

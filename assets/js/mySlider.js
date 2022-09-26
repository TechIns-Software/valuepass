var currentImage = 0;
var previous;
var isHold = false;
const sliderItem = document.getElementById('sliderElement');
setInterval(()=> {
    if (isHold) {
        return;
    }
    if (currentImage + 1 === lengthImagesSlider) {
        previous = currentImage;
        currentImage = 0;
    } else if (currentImage === 0){
        previous = lengthImagesSlider - 1;
        currentImage = currentImage + 1;
    } else {
        previous = currentImage;
        currentImage = currentImage + 1;

    }
    const backgroundImage = `image${currentImage}`;
    const previousImage = `image${previous}`;
    console.log(backgroundImage, previousImage);
    sliderItem.classList.remove(previousImage);
    sliderItem.classList.add(backgroundImage);
}, 3000);

sliderItem.addEventListener('mousedown', ()=> {
    isHold = true;
});
sliderItem.addEventListener('mouseup', ()=> {
    isHold = false;
});
sliderItem.addEventListener('touchstart', ()=> {
    isHold = true;
});
sliderItem.addEventListener('touchend', ()=> {
    isHold = false;
});



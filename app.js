const imgCont = document.getElementById('img-container');
const imgEl = imgCont.querySelectorAll('img');

for (let i = 0; i < imgEl.length; i++) {
    document.getElementById('dot-container').innerHTML += `<span class="dot"></span>`;
}

document.addEventListener('DOMContentLoaded', () => {
    let slideIndex = 0;
    const imgCont = document.getElementById('img-container');
    const slidesImg = imgCont.querySelectorAll('img');
    const dotCont = document.getElementById('dot-container');
    const dots = dotCont.querySelectorAll('.dot');
    
    function showSlides(n) {
        if (n >= slidesImg.length) { slideIndex = 0 }
        if (n < 0) { slideIndex = slidesImg.length - 1 }
        
        slidesImg.forEach((img, index) => {
            img.style.display = (index === slideIndex) ? 'block' : 'none';
        });
        
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === slideIndex);
        });
    }
    
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }
    
    function currentImg(n) {
        showSlides(slideIndex = n);
    }

    function autoSlides() {
        showSlides(slideIndex += 1);
    }
    
    document.querySelector('.prev').addEventListener('click', () => plusSlides(-1));
    document.querySelector('.next').addEventListener('click', () => plusSlides(1));

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => currentImg(index));
    });

    setInterval(autoSlides, 3000);
    showSlides(slideIndex);
});



document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', ()=> {
        console.log('get data: ');
    });
});


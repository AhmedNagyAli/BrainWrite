document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.featured-posts-slider', {
        loop: false,
        slidesPerView: 1,
        spaceBetween: 0,
        centeredSlides: false,
        autoHeight: false,
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
            renderBullet: function(index, className) {
                return `<span class="${className}">${index + 1}</span>`;
            },
        },
        observer: true,
        observeParents: true,
        observeSlideChildren: true
    });

    // Force update after images load
    const images = document.querySelectorAll('.featured-posts-slider img');
    images.forEach(img => {
        img.addEventListener('load', () => {
            swiper.update();
        });
    });
});


function loadPosts(url) {
    fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
        .then(res => res.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const postsHtml = doc.body.firstElementChild; // if your partial is the grid div itself
            document.getElementById('posts-wrapper').innerHTML = postsHtml.innerHTML;
            window.scrollTo({ top: document.getElementById('posts-wrapper').offsetTop, behavior: 'smooth' });
        });
}

function loadSportsPosts(url) {
    fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
        .then(res => res.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const postsHtml = doc.querySelector('#sports-pagination').parentElement;
            document.getElementById('sports-wrapper').innerHTML = postsHtml.innerHTML;
            window.scrollTo({ top: document.getElementById('sports-wrapper').offsetTop, behavior: 'smooth' });
        });
}


function loadSection(url, sectionId) {
    fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById(sectionId).innerHTML = html;
            window.scrollTo({
                top: document.getElementById(sectionId).offsetTop,
                behavior: 'smooth'
            });
        });
}
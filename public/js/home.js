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

function loadTechPosts(url) {
    fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
        .then(res => res.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const postsHtml = doc.querySelector('#tech-pagination').parentElement;
            document.getElementById('tech-wrapper').innerHTML = postsHtml.innerHTML;
            window.scrollTo({ top: document.getElementById('tech-wrapper').offsetTop, behavior: 'smooth' });
        });
}

function loadSection(url, sectionId) {
    fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
        .then(res => res.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const newContent = doc.querySelector(`#section-content-${sectionId}`);
            const target = document.querySelector(`#${sectionId}`);

            if (newContent && target) {
                target.innerHTML = newContent.innerHTML;
                window.scrollTo({
                    top: target.offsetTop,
                    behavior: 'smooth'
                });
            }
        });
}



//navbar search input

document.addEventListener('DOMContentLoaded', function() {
    const initSearch = (inputId, resultsId) => {
        const input = document.getElementById(inputId);
        const resultsBox = document.getElementById(resultsId);

        input.addEventListener('input', function() {
            const query = this.value.trim();

            if (query.length < 2) {
                resultsBox.classList.add('hidden');
                resultsBox.innerHTML = '';
                return;
            }

            fetch(`/search/posts?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(posts => {
                    if (!posts.length) {
                        resultsBox.innerHTML = `<div class="px-4 py-2 text-red-700 text-sm">لا توجد نتائج</div>`;
                    } else {
                        resultsBox.innerHTML = posts.map(post => `
                            <a href="/posts/${post.slug}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-100">
                                <img src="/storage/${post.image}" alt="${post.title}" class="w-18 h-18 object-cover flex-shrink-0">
                                <div class="text-lg font-medium text-gray-800 truncate">${post.title}</div>
                            </a>
                        `).join('');
                    }

                    resultsBox.classList.remove('hidden');
                })
                .catch(() => {
                    resultsBox.classList.add('hidden');
                });
        });

        // Hide on outside click
        document.addEventListener('click', (e) => {
            const target = e.target;
            if (!input.contains(target) && !resultsBox.contains(target)) {
                resultsBox.classList.add('hidden');
            }
        });
    };

    // Initialize desktop search
    initSearch('navbar-search', 'search-results');

    // Initialize mobile search
    initSearch('mobile-navbar-search', 'mobile-search-results');
});
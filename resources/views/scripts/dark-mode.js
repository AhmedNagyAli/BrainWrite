document.getElementById('darkModeToggle').addEventListener('click', function() {
    document.documentElement.classList.toggle('dark');
    // Optional: store preference
    if (localStorage.getItem('theme') === 'dark') {
        localStorage.removeItem('theme');
    } else {
        localStorage.setItem('theme', 'dark');
    }
});

// Load saved theme on page load
if (localStorage.getItem('theme') === 'dark') {
    document.documentElement.classList.add('dark');
}
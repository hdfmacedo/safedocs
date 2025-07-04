document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('dark-toggle');
    if (!btn) return;
    btn.addEventListener('click', function () {
        var isDark = document.body.classList.toggle('dark');
        if (isDark) {
            document.cookie = 'dark=1; path=/;';
        } else {
            document.cookie = 'dark=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        }
    });
});

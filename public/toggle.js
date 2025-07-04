document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('dark-toggle');
    if (!btn) return;
    btn.addEventListener('click', function () {
        if (document.body.classList.contains('dark')) {
            document.cookie = 'dark=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        } else {
            document.cookie = 'dark=1; path=/;';
        }
        location.reload();
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-btn').forEach(function(btn){
        btn.addEventListener('click', function(){
            var row = btn.closest('tr');
            row.querySelectorAll('.view').forEach(function(el){ el.style.display = 'none'; });
            row.querySelectorAll('.edit-input').forEach(function(el){ el.style.display = ''; });
            btn.style.display = 'none';
            var buttons = row.querySelector('.edit-buttons');
            if (buttons) buttons.style.display = '';
        });
    });

    document.querySelectorAll('.cancel-btn').forEach(function(btn){
        btn.addEventListener('click', function(){
            var row = btn.closest('tr');
            row.querySelectorAll('.edit-input').forEach(function(el){ el.style.display = 'none'; });
            row.querySelectorAll('.view').forEach(function(el){ el.style.display = ''; });
            row.querySelector('.edit-btn').style.display = '';
            btn.parentElement.style.display = 'none';
        });
    });
});

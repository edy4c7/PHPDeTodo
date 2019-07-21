(function ($) {
    //カスタムイベント設定
    $('.todo-item').each(function (i, e) {
        $(e).children('.chk-done').on('change', function () {
            $(e).trigger('done-change');
        });
        $(e).children('.btn-delete').on('click', function () {
            $(e).trigger('delete');
        });
    });

    $('.todo-item').on({
        'done-change': function () {
            $.ajax({
                url: 'update.php',
                method: 'POST',
                data: { 'id': $(this).data('todo-id') },
            })
            .done(function () {
                location.reload();
            })
            .fail(function() {
                window.alert('Error!');
            })
        },
        'delete': function() {
            if(!window.confirm('消しちゃうの?')) return;
            $.ajax({
                url: 'delete.php',
                method: 'POST',
                data: { 'id': $(this).data('todo-id') },
            })
            .done(function () {
                location.reload();
            })
            .fail(function() {
                window.alert('Error!');
            })
        }
    });
})(jQuery);
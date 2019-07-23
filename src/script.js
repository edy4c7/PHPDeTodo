(function ($) {
  //カスタムイベント設定
  $('.todo-item').each(function (i, val) {
    $(val).children('.chk-done').on('change', function (e) {
      $(val).trigger('done-change', {
        'done': $(e.target).prop('checked')
      });
    });
    $(val).children('.btn-delete').on('click', function () {
      $(val).trigger('delete');
    });
  });

  $('.todo-item').on({
    'done-change': function (e, param) {
      $.ajax({
        url: 'update.php',
        method: 'POST',
        data: {
          id: $(e.target).data('todo-id'),
          done: param.done
        },
      })
        .done(function () {
          location.reload();
        })
        .fail(function () {
          window.alert('Error!');
        })
    },
    'delete': function () {
      if (!window.confirm('消しちゃうの?')) return;
      $.ajax({
        url: 'delete.php',
        method: 'POST',
        data: { 'id': $(this).data('todo-id') },
      })
        .done(function () {
          location.reload();
        })
        .fail(function () {
          window.alert('Error!');
        })
    }
  });
})(jQuery);

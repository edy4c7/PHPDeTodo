(() => {
  // カスタムイベント登録
  document.querySelectorAll(".todo-item").forEach((itemTodo) => {
    itemTodo.querySelectorAll(".chk-done").forEach((itemDone) => {
      itemDone.addEventListener("change", (e) => {
        itemTodo.dispatchEvent(new CustomEvent("update", {
          detail: {
            done: e.target.checked
          }
        }));
      });
    });
    itemTodo.querySelectorAll(".btn-delete").forEach((itemDel) => {
      itemDel.addEventListener("click", () => {
        itemTodo.dispatchEvent(new CustomEvent("delete"));
      });
    });
  });

  document.querySelectorAll(".todo-item").forEach((item) => {
    item.addEventListener("update", (e) => {
      postJSONAsync("update.php", {
        id: e.target.dataset.todoId,
        done: e.detail.done
      })
      .then(emitTodoListUpdate)
      .catch(() => window.alert('error!'));
    });
    item.addEventListener("delete", (e) => {
      postJSONAsync("delete.php", {
        id: e.target.dataset.todoId,
      })
      .then(emitTodoListUpdate);
    });
  });

  document.querySelector('.todo-list').addEventListener("update", () => {
    location.reload();
  });

  function postJSONAsync(url, data){
    return new Promise((resolve, reject) => {
      let xhr = new XMLHttpRequest();
      xhr.addEventListener('load', resolve);
      xhr.addEventListener('error', reject);
      xhr.open("POST", url, true);
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.send(JSON.stringify(data));
    });
  }

  function emitTodoListUpdate() {
    document.querySelector('.todo-list').dispatchEvent(new CustomEvent("update"));
  }
})();

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>留言板</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- 引入 Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- 引入 Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    body {
      background-color: #343a40; /* 設定整體背景色為深色 */
      color: #fff; /* 設定文字顏色為白色 */
    }
    .form-group label {
      color: #fff; /* 設定表單標籤文字顏色為白色 */
    }
    .card {
      background-color: #212529; /* 設定卡片背景色為深色 */
      color: #fff; /* 設定卡片文字顏色為白色 */
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="mt-5">留言板</h1>

    <!-- 留言表單 -->
    <form id="message-form" class="mt-4">
      <div class="form-group">
        <label for="name">姓名</label>
        <input type="text" class="form-control" id="name" placeholder="請輸入姓名" required>
      </div>
      <div class="form-group">
        <label for="message">留言</label>
        <textarea class="form-control" id="message" rows="3" placeholder="請輸入留言" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">送出留言</button>
    </form>

    <!-- 顯示留言區域 -->
    <div id="message-list" class="mt-5">
      <!-- 這裡的留言會動態產生 -->
    </div>
  </div>

  <!-- 引入 Bootstrap JS -->

  <script>
    $(document).ready(function() {
      // 加載留言內容
      loadMessages();

      // 提交留言表單
      $('#message-form').on('submit', function(event) {
        event.preventDefault();

        // 獲取表單數值
        var name = $('#name').val();
        var message = $('#message').val();

        // 清空表單數值
        $('#name').val('');
        $('#message').val('');

        // 呼叫 API 儲存留言
        $.ajax({
          url: 'api/save_message.php',
          type: 'POST',
          dataType: 'json',
          data: {
            name: name,
            message: message
          },
          success: function(response) {
            // 添加新留言到留言區域
            console.log('success');
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
          }
        });
      });

      // 加載留言內容的函數
      function loadMessages() {
        $.ajax({
          url: 'api/get_message.php',
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            // 顯示留言內容
            $.each(response.list, function(index, message) {
    
              var messageElement = 
              $('<div class="card mb-3"><div class="card-body"><h5 class="card-title">' + 
                message.name + '</h5><p class="card-text">' + 
                message.message + '</p></div></div>');

              $('#message-list').append(messageElement);
            });
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
          }
        });
      }
    });
  </script>
</body>
</html>

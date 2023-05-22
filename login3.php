<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登入頁面3</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- 引入 Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- 引入 Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    body {
      background-color: #343a40; /* 設定整體背景色為深色 */
    }
    .card {
      background-color: #212529; /* 設定卡片背景色為深色 */
      color: #fff; /* 設定文字顏色為白色 */
    }
  </style>

  <script>
    $(document).ready(function() {
      $('form').on('submit', function(event) {
        event.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
          url: 'api/login3.php',
          method: 'POST',
          dataType: 'json',
          data: {
            username: username,
            password: password
          },
          success: function(response) {
            console.log(response);
            if(response.success == 1) {
              var name = response.name;
              $('#result').text('歡迎，' + name + '！'); // 在頁面上顯示名稱
            } else {
              $('#result').text('登入失敗');
            }
          },
          error: function() {
            alert('異常');
          }
        });
      });
    });
  </script>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 mt-5">
        <div class="card bg-dark">
          <div class="card-header">
            <h4 class="text-white">登入</h4>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="username" class="text-white">使用者名稱</label>
                <input type="text" class="form-control" id="username" placeholder="輸入使用者名稱">
              </div>
              <div class="form-group">
                <label for="password" class="text-white">密碼</label>
                <input type="password" class="form-control" id="password" placeholder="輸入密碼">
              </div>
              <button type="submit" class="btn btn-primary">登入</button>
            </form>
          </div>
          <div class="card-footer">
            <div id="result" class="text-white"></div>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>
</html>

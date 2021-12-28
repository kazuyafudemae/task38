<!doctype html>
<html lang="ja">
<style>
  body {
    background-color: #fffacd;
  }
  h1 {
    font-size: 16px;
    color: #ff6666;
  }
  #button {
    width: 200px;
    text-align: center;
  }
  #button a {
    padding: 10px 20px;
    display: block;
    border: 1px solid #2a88bd;
    background-color: #ffffff;
    color: #2a88bd;
    text-decoration: none;
    box-shadow: 2px 2px 3px #f5deb3;
  }
  #button a:hover {
    background-color: #2a88bd;
    color: #ffffff;
  }
</style>
<body>
<h1>
メールアドレス認証
</h1>
<p>
  以下のボタンを押下し、有効なメールアドレスである確認を行ってください。
</p>
<p id="button">
  <a href="https://procir-study.site/Fudemae225/task38/blog/public/account/check_mail?token={{ $mail_check_user->token }}">このメールアドレスを有効化する</a>
</p>
</body>
</html>

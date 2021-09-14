<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<style>
  .inner-body{
    width: 540px;
    height: 540px;
    background-repeat: no-repeat;
    background-position: center;
    margin-left: auto;
    margin-right: auto !important;
    font-family: "Segoe UI",Arial,sans-serif;
  }
  .heading-panel h3 {
    font-size: 30px;
    text-align: center;
    padding-top: 19px;
    color: #fff;
    margin-bottom: 10px;
  }
  .body-panel {
    margin-top: 148px;
    color: #fff;
  }
  .body-panel p {
    text-align: center;
  }
  .body-panel p.small {
    text-align: center;
    font-size: 12px;
  }
  .body-panel a {
    padding: 12px;
    border: 1px solid #fff;
    color: #fff;
    text-decoration: none;
    border-radius: 7px;
    margin-left: auto;
    margin-right: auto;
    display: block;
    width: 16%;
    text-align: center;
  }
  .heading-panel img{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 47%;
  }
  @media only screen and (max-width: 600px) {
    .inner-body {
      width: 100% !important;
      display: block;
      margin-left: auto;
      margin-right: auto !important;
    }
    .footer {
      width: 100% !important;
    }
  }
</style>
<body>
  <div class="row inner-body" style="background-image: url('{{ asset('images/signup-login-right.png') }}')">
    <div class="heading-panel">
      <h3>Welcome to</h3>
      <img src="{{ asset('images/banner-icon-land.png') }}">
    </div>
    <div class="body-panel">
      <p>Please verify your e-mail to <br> confirm the registration</p>
      <a href="{{ $details['ver_link'] }}">Confirm</a>
      <p class="small">If you receive this by mistake, please <br> ignore and delete this Email.</p>
    </div>
  </div>
</body>
</html>
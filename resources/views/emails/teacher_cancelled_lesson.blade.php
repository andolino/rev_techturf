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
    width: 500px !important;
    height: 540px;
    margin-left: auto;
    margin-right: auto !important;
    font-family: "Segoe UI",Arial,sans-serif;
  }
  .body-panel {
    color: rgb(48, 46, 46);
    background-color: #fff;
    height: auto;
    padding: 20px;
    border: 0.5px solid #ddd;
    padding-bottom: 90px;
  }
  .body-panel p {
    text-align: center;
    margin-top: 0;
    margin-bottom: 0;
    color: #535353;
  }
  .body-panel p.small {
    text-align: center;
    font-size: 12px;
  }
  .body-panel h3 {
    font-size: 28px;
    text-align: center;
    margin-top: 0;
    color: #535353;
  }
  .heading-panel{
    background-repeat: no-repeat;
    background-position: top right;
  }
  .heading-panel img{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 47%;
    
  }

  #list-booked {
    padding-left: 0;
    padding: 18px;
    margin: 15px;
    background: #f6f8f9;
  }
  #list-booked li {
    list-style-type: none;
    color: #777474;
  }
  .inner-body table {
    width:100%;
    background: #8e9eab;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to top, #eef2f3, #f7f8f9);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to top, #eef2f3, #f7f8f9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

  }
  .inner-body table tr td {
    padding: 8px;
    font-size: 9px;
    text-align: center;
  }
  .inner-body table tr td a{
    text-decoration: none;
    color: #888484;
  }
  .footer-panel {
    background: #4f4f4f;
    padding-top: 9px;
    padding-bottom: 9px;
  }
  .footer-panel p{
    text-align: center;
    font-size: 14px;
    color: #f0f0f0;
    margin: 0;
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
  <div class="row inner-body">
    <div class="heading-panel" style="background-image: url('{{ asset('images/booked-banner-email.png') }}')">
      <img src="{{ asset('images/banner-icon-land.png') }}">
    </div>
    <div class="body-panel">
      <h3>Your lesson has been <br>cancelled!</h3>
      <ul id="list-booked">
        <li><strong>Name of Teacher:</strong> {{ $details['data']['teacher_name'] }} </li>
        <li><strong>Date:</strong> {{ $details['data']['date'] }}</li>
        <li><strong>Time:</strong> {{ $details['data']['time'] }}</li>
        <li><strong>Type of Lesson:</strong> {{ $details['data']['type_of_lesson'] }} </li>
        {{-- <li><strong>Trial Lesson:</strong> </li> --}}
      </ul>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, vitae ve 
      </p>
    </div>
    <table>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="">Terms of Use</a></td>
        <td><a href="">Privacy Policy</a></td>
        <td><a href="">Cookies Policy</a></td>
        <td><a href="">EULA</a></td>
        <td><a href="">Legal Notices</a></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    <div class="footer-panel">
      <p>
        @2020 Heygo All Rights reserved.
      </p>
    </div>
  </div>
</body>
</html>
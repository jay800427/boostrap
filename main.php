<?php
     //初始化 curl
     $curl = curl_init();

     //設定發出請求的瀏覽器
     curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36");

     //設定接受所有https 憑證，不做驗證
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);

     //設定跟隨重新導向
     curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);

     //重新導向時自動設定訪客來源 referer
     curl_setopt($curl, CURLOPT_AUTOREFERER,true);

     // 將回傳資料寫入變數，而不是直接輸出
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 

     curl_setopt($curl, CURLOPT_URL, "https://cloud.culture.tw/frontsite/trans/emapOpenDataAction.do?method=exportEmapJson&typeId=M");

     $data = curl_exec($curl);

     curl_close($curl);
 
     // 將JSON文字轉為可使用的陣列
     // true 轉陣列，false 轉物件
     $json = json_decode($data, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>首頁</title>
  <link rel="stylesheet" href="./css/all.min.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/work.css">
  <link rel="stylesheet" href="./css/dataTables.bootstrap4.min.css">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="./images/event.ico" type="image/x-icon">
  <style>
    body{
      background: linear-gradient(#ACBB78,#F7F8F8);
      font-family: 'Noto Sans TC','Baloo Bhai', cursive;
    }
    .navbar{
    box-shadow: 5px 5px 5px #888888;
            }

    #footer, #part, #part1, #part2{
          display:none;
      }
    #loading{
        height: 100vh;
        position: fixed;
        z-index: 999;
  
    }
  </style>
</head>

<body>
<div id="particles"></div>
    
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" style="font-size:20px;" href="index.html">My Book Store</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav navbar-right">
      <li class="nav-item">
        <a class="nav-link" href="event.html">首頁 <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="main.php">書店資訊</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="msg.html">連絡我們</a>
      </li>
    </ul>
  </div>
</div>
</nav>

<div class="container-fluid" id="loading">
  <div class="row h-100">
      <div class="col-12 align-self-center text-center">
          <img src="./images/gear.svg" alt="">
          <p class="text-dark">Loading...</p>
      </div>
  </div>
</div>

<div class="container" id="part">
    <div class="row">
            <div class="col-12 my-3">
                
                <hr class="bg-black">
            </div>
  </div>
</div>

  <div class="container" id="part1">
    <div class="row">
            <div class="col-12 my-3">
                <h1 class="text-center text-black">Unique BookStore</h1>
                <hr class="bg-black">
            </div>
      <div class="col-12 my-3">
        <table class="table table-hover table-bordered" id="box">
          <thead class="thead-dark">
            <tr>
              <th>店名</th>
              <th>地址</th>
              <th>網站</th>
              <th>電話</th>
              <th>信箱</th>
              <th>營業時間</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($json as $value) {
            ?>
            <tr>
              <td><?=$value['name']?></td>
              <td><?=$value['address']?></td>
              <td><a href="<?=$value['website']?>"><?=$value['name']?></a></td>
              <td><?=$value['phone']?></td>
              <td><?=$value['email']?></td>
              <td><?=$value['openTime']?></td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="container-fluid bg-secondary text-white text-center" id="footer">
            <div class="row">
                <div class="col-12">
                        <ul class="nav justify-content-center">
                                <li class="nav-item">
                                  <a class="nav-link text-white" href="#"><i class="fab fa-facebook-square"></i></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link text-white" href="#"><i class="fab fa-twitter-square"></i></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link text-white" href="#"><i class="fab fa-line"></i></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link text-white" href="#"><i class="fab fa-instagram"></i></a>
                                </li>
                              </ul>
                    <h6>&copy;<script>document.write(new Date().getFullYear())</script>&nbsp;泰&nbsp;山&nbsp;網&nbsp;頁&nbsp;班&nbsp;製&nbsp;作</h6>
                </div>
            </div>
        </div>
  <script src="./js/jquery-3.4.1.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap4.min.js"></script>
  <script src="./js/Chart.min.js"></script>
  <script>
  $("#box").DataTable({
            language:{
                url: './datatables/chinese.json'
            },
            columnDefs:[
                {
                    targets: 3,
                    orderable:false,
                    searchable:false
                }
            ]
        })
    </script>

  <script>
    $(window).on('load', function(){
        $("#loading").fadeOut(2000,function(){
            $("#footer").fadeIn(); 
            $("#part").fadeIn(); 
            $("#part1").fadeIn(); 
        })
    })

</script>
</body>

</html>
<!DOCTYPE html>
<html>
<head>
<title>Busisness Card</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}

.nav-item{
  font-size: 12px;
  text-align: center;
}

.w3-twothird{
  text-align: center;
}
.button{
  padding: 0;
  border: none;
  background: none;
  float: right;
}
.button:hover{
  background-color: #e7e7e7;
}
.navbar-toggler:hover{
  background-color: #e7e7e7;
}
.nav-button{
  padding: 0;
  border: none;
  background: none;
}
.nav-button:hover{
  background-color: #e7e7e7;
}
.buttonscan{
  padding: 0;
  border: none;
  background: none;
  margin:auto;
  display:block;
}
.buttonscan:hover{
  background-color: #e7e7e7;
}

</style>
</head>

<nav class="navbar navbar-expand-sm bg">
  <div class="container-fluid">
    <button class="nav-button">
      <a href="/" class="navbar-brand fs-3 ms-3 text-black"><img width="39" height="42" src="{{ asset('logos/logo.png') }}"></a>
    </button> 
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#btn">
          <i class='bx bx-menu'></i>
      </button>
      <div class="collapse navbar-collapse" id="btn">
          <ul class="navbar-nav ms-auto">
            <button class="nav-button">
              <li class="nav-item">
                  <a href="#" class=" nav-link mx-4 text-black p-2 fs-6"><i class='bx bx-money' style='color:#009688'></i></a>
                  <label for="bx bx-money">SUBSCRIPTION</label>
              </li>
            </button>
            <button class="nav-button">
              <li class="nav-item">
                  <a href="#" class=" nav-link mx-4 text-black p-2 fs-6"><i class='bx bx-qr' style='color:#009688'  ></i></a>
                  <label for="bx bx-money">MY QR</label>
              </li>
            </button>
            <button class="nav-button">
              <li class="nav-item">
                  <a href="#" class=" nav-link mx-4 text-black p-2 fs-6"><i class='bx bx-user-plus' style='color:#009688'></i></a>
                  <label for="bx bx-user-plus">ADD USER</label>
              </li>
            </button>
            <button class="nav-button">
              <li class="nav-item">
                  <a href="#" class="nav-link mx-4 text-black p-2 fs-6"><i class='bx bxs-contact' style='color:#009688'></i></a>
                  <label for="bx bxs-contact">CONTACTS</label>
              </li>
            </button>
            <button class="nav-button">
              <li class="nav-item">
                  <a href="#" class="nav-link mx-4 text-black p-2 fs-6"><i class='bx bx-log-out' style='color:#009688'></i></a>
                  <label for="bx bx-log-out">LOG OUT</label>
              </li>
            </button>  
          </ul>
      </div>
    </div>
  </nav>

<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="logos/about.jpg" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            <b>Hi! I am</b>
            <h1><b>ZARIF</b></h1>
          </div>
        </div>
        <br>
        <div class="container">
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Trainee</p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>No.12, Jalan Hijau 11/11, Bandar Tasik Puteri, 48020, Rawang Selangor</p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>zarifthebiz@gmail.com</p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>01127203058</p>
          <hr>
          <button class="buttonscan">
            <a href="#" class=" nav-link mx-3 text-center p-2 fs-1">
              <i class='bx bx-scan' style='color:#009688' >
                <p>
                  <h3><label for="bx bx-scan">SCAN</label></h3>
                </p>
              </i>
            </a>
          </button>
          <!--<p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b></p>
          <p>Adobe Photoshop</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">90%</div>
          </div>
          <p>Photography</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:80%">
              <div class="w3-center w3-text-white">80%</div>
            </div>
          </div>
          <p>Illustrator</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:75%">75%</div>
          </div>
          <p>Media</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:50%">50%</div>
          </div>
          <br>

          <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Languages</b></p>
          <p>English</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-teal" style="height:24px;width:100%"></div>
          </div>
          <p>Spanish</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-teal" style="height:24px;width:55%"></div>
          </div>
          <p>German</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-teal" style="height:24px;width:25%"></div>
          </div>-->
          <br>
        </div>
      </div>
      <br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    <div>
          <button class="button">
            <a href="#" class=" nav-link mx-4 text-black p-3 fs-6"><i class='bx bxs-edit-alt' style='color:#009688' ></i></a>
          </button>
        </div>
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        
        <i class="bx bxs-user fa-fw w3-margin-right w3-padding-16 w3-xxlarge w3-text-teal"></i>
        <h2 class="w3-text-grey">Profile</h2>
        <hr>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Name :</b></h5>
          <h5 class="w3-opacity"><i class="fa fa-user fa-fw w3-margin-right w3-large w3-text-teal"></i><b>MUHAMMAD ZARIF HIRZI BIN MOHD YAZID</b></h5>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Email :</b></h5>
          <h5 class="w3-opacity"><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><b>zarifthebiz@gmail.com</b></h5>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Phone Number :</b></h5>
          <h5 class="w3-opacity"><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><b>01127203058</b></h5>
          <br>
        </div>
      </div>

      <div class="w3-container w3-card w3-white">
        <i class="fa fa-building fa-fw w3-margin-right w3-xxlarge w3-padding-16 w3-text-teal"></i>
        <h2 class="w3-text-grey ">Company</h2>
        <hr>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>iScada Net Sdn.Bhd</b></h5>
          <h6 class="w3-text-grey">Company No: 202001010585</h6>
          <h6 class="w3-text-grey">+603-6150 0559</h6>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Location</b></h5>
          <h6 class="w3-text-grey">Wisma iS.net, B7-2-10, B7-3-10, B7-3A-10, Jalan Teknologi 2/1E, Kota Damansara, Petaling Jaya, 47810, Selangor</h6>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Email</b></h5>
          <h6 class="w3-text-grey">customercare@isnet.my</h6>
          <hr>
          <img src="logos/isnet.logo.png" alt="">
        </div>
      </div>

    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

<!--<footer class="w3-container w3-teal w3-center w3-margin-top">
  <p>Find me on social media.</p>
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
  <p>Privacy Policy<a href="https://www.w3schools.com/w3css/default.asp" target="_blank"></a></p>
  <p>© 2024 Iscada Net Sdn Bhd. All Rights Reserved</p>
</footer>-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

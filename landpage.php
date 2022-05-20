<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing page</title>


  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/vendors.css" rel="stylesheet">
</head>

<style>
  body {
    background-color: lightgrey;
    font-family: 'Playfair Display', serif;
  }
</style>

<body>


  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-info static-top">
    <div class="container">



      <div id="logo">
        <a href="index.html" class="fs-3 fw-bolder">
          <!-- <img src="img/logo.svg" width="150" height="36" alt="" class="logo_normal">
            <img src="img/logo_sticky.svg" width="150" height="36" alt="" class="logo_sticky"> -->
          VALUE~PASS
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <section id="hero">

    <div class="container py-4">
      <div class="row">
        <div class="col-lg-4 col-md-12  py-2 d-block">



          <div class="hero-text">
            <h2> Discover everything you need to know about your Vacation Experiences
              unforgettable activities experiences
            </h2>

            <h5>With our activitysave Voucherspasses, visit bucket list attractions, enjoy top tours, and discover plenty of hidden gems - all of which are handpicked by our local experts.</h5>
          </div>



        </div>




        <div class="col-lg-8 col-md-12 py-2 ">

          <div class="lightbox">
            <div class="row">
              <div class="col-6 ">
                <a href="assets/img/10.jpg" data-toggle="lightbox" data-caption="This describes the image">
                  <img src="assets/img/10.jpg" class="img-fluid img-thumbnail" alt="Click To Enlarge" />
                </a>

              </div>
              <div class="col-6">
                <a href="assets/img/2.jpg" data-toggle="lightbox" data-caption="This describes the image">
                  <img src="assets/img/2.jpg" class="img-fluid img-thumbnail" alt="Click To Enlarge" />
                </a>
              </div>

              <div class="col-3">
                <a href="assets/img/2.jpg" data-toggle="lightbox" data-caption="This describes the image">
                  <img src="assets/img/2.jpg" class="img-fluid img-thumbnail" alt="Click To Enlarge" />
                </a>
              </div>

              <div class="col-3">
                <a href="assets/img/4.jpg" data-toggle="lightbox" data-caption="This describes the image">
                  <img src="assets/img/4.jpg" class="img-fluid img-thumbnail" alt="Click To Enlarge" />
                </a>
              </div>


              <div class="col-3 ">
                <a href="assets/img/4.jpg" data-toggle="lightbox" data-caption="This describes the image">
                  <img src="assets/img/4.jpg" class="img-fluid img-thumbnail" alt="Click To Enlarge" />
                </a>
              </div>

              <div class="col-3">
                <a href="assets/img/10.jpg" data-toggle="lightbox" data-caption="This describes the image">
                  <img src="assets/img/10.jpg" class="img-fluid img-thumbnail" alt="Click To Enlarge" />
                </a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-3" id="howworks">
    <div class="container px-4">
      <div class="row">
        <div class="col-lg-12 text-center  ">
          <h2>Spend less money doing it more </h2>
          <h4> How it works: </h4>
          <div class="row">

            <div class="advantages  col-lg-3 col-md-12  ">
              <h4>Go save</h4>
              <p>
                You'll save far more with us compared to buying separate attraction tickets.
              </p>
            </div>

            <div class="advantages  col-lg-3 col-md-12 ">
              <h4>Go see it all and get free Vouchers</h4>
              <p>
                From unmissable experiences, we’ve got you covered
              </p>
            </div>

            <div class="advantages col-lg-3 col-md-12  ">
              <h4>Go your way</h4>
              <p>
                You control your sightseeing – mix pre-booked activities with other flexible experiences.
              </p>
            </div>

            <div class="advantages col-lg-3 col-md-12 ">
              <h4>All to your smartphone </h4>
              <p>
                Just show your pass at each attraction to enter - it's that easy!
              </p>
            </div>

          </div>


        </div>

      </div>
    </div>
  </section>

  <section>
    <div class="newsletter-subscribe mt-5 container">
      <div class="container">
        <div class="intro">
          <h2 class="text-center newsletter">Subscribe to our Newsletter</h2>
          <p class="text-center">Hey… want to save even more?
            Sign up today and more save + extrafree Vouchers
          </p>
        </div>
        <form class="form-inline" method="post">
          <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Your Email"></div>
          <div class="form-group"><select class="form-select" name="" id="">

              <option value="" disabled selected> Choose your Voucher ValuePass </option>
              <option value="2 Vouchers for 14€"> 2 Vouchers for 14€</option>
              <option value="3 Vouchers from21€ + extra 1 free Voucher value10€"> 3 Vouchers from21€ + extra 1 free Voucher value10€</option>
              <option value="4 Vouchers from28€ +extra 2 freeVoucher value 20€"> 4 Vouchers from28€ +extra 2 freeVoucher value 20€</option>
              <option value="5 Vouchers from35€ +extra 2 freeVoucher value 30€"> 5 Vouchers from35€ +extra 2 freeVoucher value 30€</option>
              <option value="6 Vouchers from42€ + extra 3 freeVoucher value40€"> 6 Vouchers from42€ + extra 3 freeVoucher value40€</option>
              <option value="7 Vouchers from49€ +extra3 freeVoucher value50€"> 7 Vouchers from49€ +extra3 freeVoucher value50€</option>

            </select></div>

          <div class="form-group"><button class="btn btn-primary" type="button">Subscribe </button></div>
        </form>
      </div>
    </div>
  </section>


  <section class="wrapper">
    <div class="container">
      <div class="row">

        <div class="col-lg-3  col-md-4 col-sm-6">
          <div class="card text-white card-has-bg click-col" style="background-image:url('https://source.unsplash.com/600x900/?tech,street');">
            <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tech,street" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
            <div class="card-img-overlay d-flex flex-column">
              <div class="card-body">
  
              </div>
              <div class="card-footer">
                <h4 class="card-title mt-0 "><a class="text-white" herf="#">Mykonos</a></h4>
                <small class="card-meta mb-2">25 Advetures</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3  col-md-4 col-sm-6">
          <div class="card text-white card-has-bg click-col" style="background-image:url('https://source.unsplash.com/600x900/?island');">
            <img class="card-img d-none" src="https://source.unsplash.com/600x900/?island" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
            <div class="card-img-overlay d-flex flex-column">
              <div class="card-body">
  
              </div>
              <div class="card-footer">
                <h4 class="card-title mt-0 "><a class="text-white" herf="#">Naxos</a></h4>
                <small class="card-meta mb-2">25 Advetures</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3  col-md-4 col-sm-6">
          <div class="card text-white card-has-bg click-col" style="background-image:url('https://source.unsplash.com/600x900/?naxos');">
            <img class="card-img d-none" src="https://source.unsplash.com/600x900/?naxos" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
            <div class="card-img-overlay d-flex flex-column">
              <div class="card-body">
  
              </div>
              <div class="card-footer">
                <h4 class="card-title mt-0 "><a class="text-white" herf="#">Samos</a></h4>
                <small class="card-meta mb-2">25 Advetures</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3  col-md-4 col-sm-6">
          <div class="card text-white card-has-bg click-col" style="background-image:url('https://source.unsplash.com/600x900/?samos');">
            <img class="card-img d-none" src="https://source.unsplash.com/600x900/?samos" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
            <div class="card-img-overlay d-flex flex-column">
              <div class="card-body">
  
              </div>
              <div class="card-footer">
                <h4 class="card-title mt-0 "><a class="text-white" herf="#">Mykonos</a></h4>
                <small class="card-meta mb-2">25 Advetures</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3  col-md-4 col-sm-6">
          <div class="card text-white card-has-bg click-col" style="background-image:url('https://source.unsplash.com/600x900/?tech,street');">
            <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tech,street" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
            <div class="card-img-overlay d-flex flex-column">
              <div class="card-body">
  
              </div>
              <div class="card-footer">
                <h4 class="card-title mt-0 "><a class="text-white" herf="#">Mykonos</a></h4>
                <small class="card-meta mb-2">25 Advetures</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3  col-md-4 col-sm-6">
          <div class="card text-white card-has-bg click-col" style="background-image:url('https://source.unsplash.com/600x900/?tech,street');">
            <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tech,street" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
            <div class="card-img-overlay d-flex flex-column">
              <div class="card-body">
  
              </div>
              <div class="card-footer">
                <h4 class="card-title mt-0 "><a class="text-white" herf="#">Mykonos</a></h4>
                <small class="card-meta mb-2">25 Advetures</small>
              </div>
            </div>
          </div>
        </div>

        


      </div>

    </div>
  </section>






  <script src="assets/js/common_scripts.js"></script>
  <!-- <script src="assets/js/main.js"></script> -->
  <script src="assets/js/validate.js"></script>
</body>

</html>
<!-- resources/views/register.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--bootstrap-5.3.3-dist/css/bootstrap.css-->
</head>
<style>
    body{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      background-size: cover auto;
      background-repeat: no-repeat;
      background-position: center;
    
    }

    .center {
      text-align: center;
      }

    .row{
      backdrop-filter: invert(15%);      
    }
    a:link {
      color: blue;
    }

/* mouse over link */
    a:hover {
      color: red;
    }


</style>

<nav class="navbar navbar-expand-md bg">
  <div class="container-fluid">
      <a href="/" class="navbar-brand fs-3 ms-3 text-black"><img width="42" height="45" src="{{ asset('logos/logo.png') }}"></a>
  </div>
</nav>

<body class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat" style="background-image: url('/logos/bg-1.jpg')">
    
    <div class="container py-5 h-120">
      <div class=" justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card card-registration my-4">
            <div class="row g-0">
              <div class="col-xl-6 d-none d-xl-block">
                <img src="logos/img4.png"
                  alt="Sample photo" class="img-fluid"
                  style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
              </div>
              <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
                <div class="p-3 p-md-4 p-xl-5">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-5">
                        <h2 class="h3">Registration</h2>
                        <h3 class="fs-6 fw-normal text-secondary m-0">Enter your details to register</h3>
                      </div>
                    </div>
                  </div>
                  <form action="{{route('register.post')}}" method="POST">
                    @csrf
                    <div class="row gy-3 gy-md-4 overflow-hidden">
                      <div class="col-12">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="name" required>
                      </div>
                      <div class="col-12">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                      </div>
                      <div class="col-12">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" id="password" value="" required>
                      </div>
                      <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree" required>
                          <label class="form-check-label text-secondary" for="iAgree">
                            I agree to the <a href="#!" class="link-primary text-decoration-none">terms and conditions</a>
                          </label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button class="btn bsb-btn-xl btn-primary" type="submit">Sign up</button>
                        </div>
                      </div>
                    </div>
                  </form>
                  <div class="row">
                    <div class="col-12">
                      <hr class="mt-5 mb-4 border-secondary-subtle">
                      <p class="m-0 text-secondary text-end">Already have an account? <a href="login  " class="link-primary text-decoration-none">Sign in</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
    
</body>
</html>

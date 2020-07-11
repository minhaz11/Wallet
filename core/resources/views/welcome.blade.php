<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$setting->site_name}}</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <style>
      body{
        font-family: 'Poppins', sans-serif;
      }
        .bg{
            background: url('{{asset('assets/landing_page')}}/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
    </style>
</head>
<body class="bg">
<div class="container  shadow p-3 mb-5 bg-white rounded">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border">
        <a class="navbar-brand text-primary font-weight-bold" href="{{route('land')}}"><span><i class="fas fa-wallet"></i></span>{{$setting->site_name}}  </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto ">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('land')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle btn btn-primary text-white border round" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Get Start
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{route('login')}}">Login</a>
                <a class="dropdown-item" href="{{route('register')}}">Sign Up</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('admin.login')}}">Admin Login</a>
              </div>
            </li>
           
          </ul>
          <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form> -->
        </div>
      </nav>
</div>
      
<div class="container mt-5 ">
          <div class="row ">
              <div class="col-md-12 shadow p-3 mb-5 bg-white rounded">  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div class="carousel-caption d-none d-md-block text-center">
                        <h5>Deposit Your Money</h5>
                        <p>With the most secure trust</p>
                      </div>
                    <img class="d-block w-100" src="{{asset('assets/landing_page')}}/1.jpg" alt="First slide">
                    
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('assets/landing_page')}}/2.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Transfer Your money</h5>
                        <p>Transfer money to your friend any time</p>
                      </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('assets/landing_page')}}/3.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Refer Your friend</h5>
                        <p>Refer your friend to get attractive bonus</p>
                      </div>
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
           
            <div class="row mt-5 ml-1  w-100 shadow p-2 mb-5 bg-white rounded" data-aos="flip-right" >
                <div class="col-md-12">
                    <h2 class="text-center text-primary mb-2">Our Services</h2>
                    <div class="jumbotron jumbotron-fluid bg-light border shadow-lg p-3 mb-5 bg-white rounded mt-4">
                        <!-- <div class="container"> -->
                            <div class="row ml-4">
                                <div class="col-md-4">
                                    <div class="card text-center mb-3 border border rounded" style="width: 18rem;">
                                        <div class="card-body">
                                          <h5 class="card-title text-info">Money Transaction</h5>
                                          <p class="card-text">With supporting text below as a natural lead-in to additional content.With supporting text below as a natural lead-in to additional content.</p>
                                          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                        </div>
                                      </div>
                                    <div class="card text-center mb-3 border border rounded" style="width: 18rem;">
                                        <div class="card-body">
                                          <h5 class="card-title text-info">Online Shopping</h5>
                                          <p class="card-text">With supporting text below as a natural lead-in to additional content.With supporting text below as a natural lead-in to additional content.</p>
                                          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                        </div>
                                      </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center mb-3 border border rounded" style="width: 18rem;">
                                        <div class="card-body">
                                          <h5 class="card-title text-info">Secure Payment</h5>
                                          <p class="card-text text-justify">With supporting text below as a natural lead-in to additional content.With supporting text below as a natural lead-in to additional content.</p>
                                          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                        </div>
                                      </div>
                                    <div class="card text-center mb-3 border border rounded" style="width: 18rem;">
                                        <div class="card-body">
                                          <h5 class="card-title text-info">24/7 Support</h5>
                                          <p class="card-text text-justify">With supporting text below as a natural lead-in to additional content.With supporting text below as a natural lead-in to additional content.</p>
                                          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                        </div>
                                      </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center mb-3 border border rounded" style="width: 18rem;">
                                        <div class="card-body">
                                          <h5 class="card-title text-info">Referral System</h5>
                                          <p class="card-text text-justify">With supporting text below as a natural lead-in to additional content.With supporting text below as a natural lead-in to additional content.</p>
                                          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                        </div>
                                      </div>
                                    <div class="card text-center mb-3 border border rounded" style="width: 18rem;">
                                        <div class="card-body">
                                          <h5 class="card-title text-info">Monthly Interest</h5>
                                          <p class="card-text text-justify">With supporting text below as a natural lead-in to additional content.With supporting text below as a natural lead-in to additional content.</p>
                                          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                        </div>
                                      </div>
                                </div>
                            </div>
                          
                        <!-- </div> -->
                      </div>
                </div>
            </div>
            <div class="row mt-5 ml-1  w-100 shadow p-2 mb-5 bg-white rounded" data-aos="flip-right" >
                <div class="col-md-12">
                    <h2 class="text-center text-primary mb-2">Logs</h2>
                    <div class="jumbotron jumbotron-fluid bg-light border shadow-lg p-3 mb-5 bg-white rounded mt-4">
                        <!-- <div class="container"> -->
                            <div class="row ml-4">
                                <div class="col-md-4">
                                    <div class="card text-center mb-3 border border rounded" style="width: 25rem;">
                                        <div class="card-body">
                                          <h5 class="card-title text-info">Total Money Transaction</h5>
                                        <h1 class="text-primary font-weight-bold">{{$totalTrx->sum('amount')}} BDT</h1>
                                          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                        </div>
                                      </div>
                                    <div class="card text-center mb-3 border border rounded" style="width: 25rem;">
                                        <div class="card-body">
                                          <h5 class="card-title text-info">Total Users</h5>
                                          <h1 class="text-primary font-weight-bold">{{$totalUser->count()}} </h1>
                                          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                        </div>
                                      </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card ml-5 ml-auto" style="width: 28rem;">
                                        <img class="card-img-top " src="{{asset('assets/landing_page/logs.jpg')}}" alt="Card image cap">
                                            {{-- <div class="card-body">
                                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div> --}}
                                          </div>
                                    
                                </div>
                                
                            </div>
                          
                        <!-- </div> -->
                      </div>
                </div>
            </div>
            <div class="row mt-5 ml-1  w-100 shadow p-3 mb-5 bg-white rounded" data-aos="flip-right">
                <div class="col-md-12">
                    <h2 class="text-center text-primary mb-2">About Us</h2>
                    <div class="jumbotron jumbotron-fluid bg-light border shadow-lg p-3 mb-5 bg-white rounded mt-4">
                        <!-- <div class="container"> -->
                            <div class="row ml-4">
                                <div class="col-md-4">
                                    {{-- <div class="card text-center mb-3 border border rounded mr-2" style="width: 22rem;">
                                        <div class="card-body">
                                          <h5 class="card-title text-info">Online Money Transaction</h5>
                                          <p class="card-text text-justify">With supporting text below as a natural lead-in to additional content.</p>
                                          
                                        </div>
                                      </div> --}}
                                      <h3 class="text-cener text-info">Let's Introduce</h3>
                                      <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam nulla animi blanditiis eos minima placeat autem maiores optio, unde culpa ab ea amet inventore qui laboriosam consectetur adipisci delectus quibusdam iste facere molestiae. Soluta deserunt repellat ad, perspiciatis quidem nulla odit vitae recusandae adipisci quas cumque, molestiae consequatur, a officiis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam nulla animi blanditiis eos minima placeat autem maiores optio, unde culpa ab ea amet inventore qui laboriosam consectetur adipisci delectus quibusdam iste facere molestiae. </p>
                                    
                                </div>
                                <div class="col-md-8">
                                    <div class="card ml-2 mt-3" style="width: 40rem;">
                                    <img class="card-img-top " src="{{asset('assets/landing_page/abt.jpg')}}" alt="Card image cap">
                                        {{-- <div class="card-body">
                                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div> --}}
                                      </div>
                                   
                                </div>
                                
                            </div>
                          
                        <!-- </div> -->
                      </div>
                </div>
            </div>
            
            <div class="row mt-5 ml-1  w-100 shadow p-3 mb-5 bg-white rounded" data-aos="flip-right">
                <div class="col-md-12">
                    <h2 class="text-center text-primary mb-2">Contact Us</h2>
                    <div class="jumbotron jumbotron-fluid bg-light border shadow-lg p-3 mb-5 bg-white rounded mt-4">
                        <!-- <div class="container"> -->
                            <div class="row ml-4 ">
                                <div class="col-md-12">
                                    <form class="mt-5 mb-5 mr-3">
                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                          </div>
                                          <div class="form-group col-md-6">
                                            <label for="inputPassword4">Phone</label>
                                            <input type="text" class="form-control" id="inputPassword4" placeholder="Phone">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="inputAddress">Address</label>
                                          <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                        </div>
                                        <div class="form-group">
                                          <label for="inputAddress2">Address 2</label>
                                          <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <label for="inputCity">City</label>
                                            <input type="text" class="form-control" id="inputCity">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="inputState">State</label>
                                            <select id="inputState" class="form-control">
                                              <option selected>Choose...</option>
                                              <option>...</option>
                                            </select>
                                          </div>
                                          <div class="form-group col-md-2">
                                            <label for="inputZip">Zip</label>
                                            <input type="text" class="form-control" id="inputZip">
                                          </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                      </form>
                                    
                                </div>
                               
                                
                            </div>
                          
                        <!-- </div> -->
                      </div>
                </div>
            </div>
          </div>
      

     </div>
     <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
     <script>
      AOS.init();
    </script>
</body>
</html>
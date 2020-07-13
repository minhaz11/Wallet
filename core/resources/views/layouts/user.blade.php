<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/523c3912de.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand font-weight-bold" href="#">User Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show mx-auto h-25" role="alert">
                            {{ session('status') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </div>
                    @endif
            <!-- <form class="form-inline my-2 my-lg-0 mx-auto width 50%">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form> -->
            <ul class="navbar-nav ml-auto mr-5">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Settings
                </a>
                <div class="dropdown-menu width 25%" aria-labelledby="navbarDropdown">
                <a class="dropdown-item border" href="{{route('user.profile')}}">Profile</a>
                <a class="dropdown-item border" href="{{route('user.edit.password')}}">Update password</a>
                 
                  <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="dropdown-item border">logout</button>
                  
                 </form>
                  
                  
                </div>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Balance : {{ number_format(Auth::user()->Balance, 2) }} BDT</a>
            </li>
           
           
          </ul>
         
        </div>
      </nav>
    <div class="container-fluid">
       <div class="row">
        <div class="col-md-3 border rounded mt-3 shadow p-3 mb-5 bg-white rounded">
        <img class=" ml-5 mt-2 w-75 h-30" src="{{asset('assets/img')}}/{{Auth::user()->photo}}" alt="Card image cap">
                 <li class="list-group-item mt-2 text-center shadow p-3 mb-5 bg-white rounded "><strong>{{Auth::user()->name}}</strong></li>
                @if(Auth::user()->referrer)
                 <span class="list-group-item text-muted  text-center"><strong>Referenced by : {{Auth::user()->referrer->username}}</strong></span>
                 @endif
            
                
            <ul class="list-group mt-3 mb-5 font-weight-bold">
              <p class="text-center text-info">Your Referral Link</p>
              <input type="text" class="form-control text-primary mb-3"  value="{{ Auth::user()->referral_link }}" readonly>
            
              <a href="{{route('user.trx.logs')}}" class="btn btn-info text-uppercase font-weight-bold mb-3">
                    Transaction log
                  </a>
                  
                 
                  {{-- <button type="button" class="btn btn-primary text-uppercase font-weight-bold mb-3" data-toggle="modal" data-target="#exampleModal">
                    Add Balance
                  </button> --}}
                  <button type="button" class="btn btn-success text-uppercase font-weight-bold mb-3" data-toggle="modal" data-target="#transfer">
                   Send Money
                  </button>
                  
                  {{-- <a href="#" class="btn btn-success text-uppercase font-weight-bold mb-1">Send Money</a> --}}
                 
                  <a href="{{route('user.referral.log')}}" class="btn btn-warning text-uppercase font-weight-bold mb-3">Referral log</a>
                  <a href="{{route('user.referral.bonuses')}}" class="btn btn-primary text-uppercase font-weight-bold mb-3">Referral Bonuses</a>
                 
                <a href="{{route('user.referral.form')}}" class="btn btn-secondary text-uppercase font-weight-bold mb-3">Refer a Friend</a>
                  
                  
              </ul>
        </div>
        <!--modal-->
        <!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button> --}}
  
  <!-- Modal add money-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Balance</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form >
                {{-- <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="username" name="username">
                 
                </div> --}}
                <div class="form-group">
                  <label for="exampleInputPassword1">Amount</label>
                  <input type="text" class="form-control" name="amount" id="exampleInputPassword1" placeholder="BDT">
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>
  <!--Modal send money-->
  <div class="modal fade" id="transfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Transer Balance</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('transaction')}}" method="POST">
               @csrf
          <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control @error('username') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="username" name="username">
                  @error('username')
                          <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                          </span>
                   @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Amount</label>
                  <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" id="exampleInputPassword1" placeholder="BDT">
                  @error('amount ')
                  <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                  </span>
                 @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Send</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>

        <div class="col-md-9">
            @yield('content')
            @include('alert.error')
            @include('alert.errors')
            @include('alert.success')
        </div>
       </div>
    </div>
  
    
</body>
</html>
@extends('layouts.user')

@section('content')
<div class="card bg-light mb-3 mt-3" style="max-width: 70rem;">
    <div class="card-header">Transaction Log</div>
    <div class="card-body">
        <form >
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="username" name="username">
             
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Amount</label>
              <input type="text" class="form-control" name="amount" id="exampleInputPassword1" placeholder="amount">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>
  
@endsection
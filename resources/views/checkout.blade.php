@extends('layouts.app')
   
@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h1>Checkout</h1>
            <h4>Your total: RM {{ $total }}</h4>
            <form action="{{ route('checkout')}}" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-group">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="" id=""  class="form-group">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="" id=""  class="form-group">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="" id=""  class="form-group">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
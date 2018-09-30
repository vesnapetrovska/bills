@extends('partials.main')

@section('custom_styles')
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom fonts for this template -->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

<!-- Custom styles for this template -->
<link href="css/landing-page.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
        <div class='li-bg'>

            id: <b>{{$bill->id}}</b><br>
            status: <b>{{($bill->status == 1) ? 'unpaid' : 'paid'}}</b><br>
            month: <b>{{$bill->month}}</b><br>
            price: <b>{{$bill->price}} </b><br>
            description: {{$bill->description}}<br>

        </div>
      </div>
</div>

<div class="row">
  <div class="col-md-6">
        <form  action="{{route('pay', $bill->id)}}" method="post">
        {{csrf_field()}}

        <label for="name">Name:</label>
        <input class="form-control" type="text" name="name" value="" required>

        <label for="exp">Expiration date:</label>
        <input class="form-control" type="date" name="exp" value="">

        <label for="card">Card number:</label>
        <input class="form-control" type="text" name="card" value="" required>

        <label for="cvc">CVC:</label>
        <input  class="form-control" type="text" name="cvc" value="">

        <label for="">Price:</label>
        <p>{{$bill->price}}</p>

        <input type="submit" name="" value="Confirm">
        </form>
      </div>
    </div>

</div>
    <!-- Footer -->


@endsection

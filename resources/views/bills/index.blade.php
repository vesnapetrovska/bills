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


@foreach($bills as $bill)
<ul>
  <li class='li-bg'>
      id: <b>{{$bill->id}}</b><br>
      status: <b>{{($bill->status == 1) ? 'unpaid' : 'paid'}}</b><br>
      month: <b>{{$bill->month}}</b><br>
      price: <b>{{$bill->price}} </b><br>
      description: {{$bill->description}}<br>
     @if($bill->status==1)
      <a class='btn btn-primary' href='{{route("paybill", $bill->id)}}'>Pay</a>
         @endif
  </li>
</ul>
@endforeach
    <!-- Footer -->


@endsection

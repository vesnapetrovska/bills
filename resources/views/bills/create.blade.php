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
        <form  action="{{route('storebill')}}" method="post">
        {{csrf_field()}}

        <label for="email">User:</label>
        <input class="form-control" type="text" name="email" value="{{$email}}" disabled>

        <!-- <label for="user_id">User:</label> -->
        <input class="form-control" type="hidden" name="user_id" value="{{$id}}" required>

        <label for="month">Month:</label>
        <input class="form-control" type="date" name="month" value="">

        <label for="price">Price:</label>
        <input class="form-control" type="text" name="price" value="" required>

        <label for="description">Description:</label>
        <input  class="form-control" type="text" name="description" value="">

        <input type="submit" name="" value="Send Bill">
        </form>
      </div>
    </div>

</div>
    <!-- Footer -->


@endsection

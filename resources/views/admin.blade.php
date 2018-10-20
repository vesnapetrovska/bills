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
<div class="col-md-8">




<table class="table">
  <tr>
   <th>Name</th>
   <th>Role</th>
   <th>Email</th>
  <th>Email verification</th>
  <th>No. of unpaid bills</th>
  <th>Actions</th>
 </tr>
@foreach($users as $user)
<tr>
    <td>{{ $user->name }}</td>
    <td>{{ ($user->role_id == 1) ? 'user' : 'admin' }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ ($user->email_verified_at == null) ? 'not verified' : $user->email_verified_at }}</td>
    <td>{{ $user->bills()->where('status', 1)->get()->count()}}</td>
    <td><a class="btn btn-sm btn-primary" href="{{route('createbill', $user->id)}}">Add a new bill</a></td>
    <td><a class="btn btn-sm btn-primary" href="{{route('makeadmin', $user->id)}}">Make admin</a></td>
  </tr>

@endforeach
</table>

    <!-- Footer -->
</div>
  </div>
    </div>
@endsection

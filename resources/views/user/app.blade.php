@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users $index => as $user)
                        <tr>
                            <th scope="row">{{ ++$index}}</th>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->phone}}</td>
                        </tr>
                    @endforeach   
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection



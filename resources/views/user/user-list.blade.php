@extends('layouts.app')

@section('content')
   <div class="container mt-5">
    <div class="card">
      <div class="card-header">
          <div class="d-flex flex-row justify-content-between align-items-center">
            <h5>Users List</h5>
          </div>
      </div>
      <div class="card-body">
          <div class="row mt-4">
            <div class="col-md-12">
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
                      @foreach ($users as $index => $user)
                        <tr>
                            <th scope="row">{{ ++$index }}.</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                      @endforeach  
                    </tbody>
                  </table>
            </div>
          </div><!--row-->
      </div><!--card-body-->
  </div><!--card-->
   </div>
@endsection



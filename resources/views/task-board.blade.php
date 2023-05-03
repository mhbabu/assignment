@extends('layouts.app')

@section('content')
   <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        @include('layouts.includes.message')
      </div>
    </div>
    <div class="card">
      <div class="card-header">
          <div class="d-flex flex-row justify-content-between align-items-center">
            <h5>Task Board</h5>
              <div class="d-flex">
                 <a class="btn btn-sm btn-primary m-1" title="New Task Category" href="{{ route('task-categories.create') }}"><i class="fa fa-plus-circle"></i> Create Category</a>
                 <a class="btn btn-sm btn-primary m-1" title="New Task" href=""><i class="fa fa-plus-circle"></i> Create Task</a>
              </div><!--col-->
          </div>
      </div>
      <div class="card-body">
          <div class="row mt-4">
            @if(isset($taskCategories) && $taskCategories->count() > 0)
              @foreach ($taskCategories as $taskCategory)
                <div class="col-md-4 mt-3">
                  <div class="card">
                    <div class="card-header">
                      <div class="dropdown">
                        <a class="dropdown-toggle text-black" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; cursor: pointer;">
                          {{ $taskCategory->name }}
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ route('task-categories.edit', $taskCategory->id) }}"> Edit</a></li>
                          <li><a class="dropdown-item" href="{{ url('task-categories/delete', $taskCategory->id) }}" onclick="return confirm(`Are you Sure`)">Delete</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <a class="text-black" style="text-decoration: none; cursor: pointer;">One</a>
                          <a class="dropdown-toggle text-black" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; cursor: pointer;">
                          </a>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Edit</a></li>
                            <li><a class="dropdown-item" href="#">Delete</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <h5 class="text-center">Empty</h5>  
            @endif  
          </div><!--row-->
      </div><!--card-body-->
  </div><!--card-->
   </div>
@endsection



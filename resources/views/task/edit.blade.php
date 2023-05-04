@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="fa fa-edit"></i> Update Category</div>
                    {!! Form::open(['route' => ['tasks.update', $task->id], 'method' => 'PATCH']) !!}
                        <div class="card-body">
                            <div class="row mb-3">
                                {!! Form::label('category_id', 'Category',['class'=> 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-6">
                                    {!! Form::select('category_id', $taskCategories, $task->category_id,['class'=>$errors->has('category_id')?'form-control is-invalid':'form-control required','autofocus' => true,'placeholder' => 'Select Category']) !!}
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                {!! Form::label('name', 'Name',['class'=> 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('name',$task->name,['class'=>$errors->has('name')?'form-control is-invalid':'form-control required','placeholder'=>'Name']) !!}
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('task-boards') }}" class="btn btn-secondary float-start"> Back </a>
                            <button type="submit" class="btn btn-primary float-end"> Update </button>
                            <div class="clearfix"></div>
                        </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection



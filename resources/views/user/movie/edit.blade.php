@extends('user.main.app')
@push('style')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" />
@endpush
@section('content')
<?php $page = substr((Route::currentRouteName()), 6, strpos(str_replace('staff.','',Route::currentRouteName()), ".")); ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="text-capitalize">Edit Task</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('user.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">Task Page</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="card">
    <form role="form" method="POST" action="{{ route('user.movie.update',$datas->id)}}" class="validate" id="validate" enctype="multipart/form-data">
      <div class="card-body">
        @method('PATCH')
        @csrf
        <div class="form-group col-md-12">
          <label for="name">Title<span class="text-danger">*</span></label>
          <input type="text"  class="form-control @error('name') is-invalid @enderror max" id="name" placeholder="Enter name" name="name" maxlength="30" autocomplete="off" value="{{ $datas->name }}" autofocus>
          @error('name')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-md-12">
          <label for="description">Description<span class="text-danger">*</span></label>
          <textarea class="form-control" id="description" name="description">{{ $datas->description }}
          </textarea>
          @error('description')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-md-12">
          <label for="start_at">Date and Time:<span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="text" class="form-control" id="start_at" placeholder="Enter date and time" name="start_at" value="{{ $datas->start_at}}">
          </div>
          @error('start_at')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Update Task">Update</button>
      </div>
    </form>
  </div>
</section>
@endsection
@push('javascript')


@extends('user.main.app')
@push('style')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" />
@endpush
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 pl-1">
        <h1 class="text-capitalize">Add Movie</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('user.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">Movie Page</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="card card-info">
    <form role="form" method="POST" action="{{route('user.movie.store')}}" class="validate" id="validate" enctype="multipart/form-data">
      <div class="card-body">
        @csrf
        <div class="row">
          <div class="form-group col-md-12">
            <label for="name">Movie Title<span class="text-danger">*</span></label>
            <input type="name"  class="form-control @error('name') is-invalid @enderror max" id="name" placeholder="Enter name " name="name" autocomplete="off" autofocus value="{{ old('name') }}">
            @error('name')
            <span class="text-danger font-italic" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group col-md-12">
            <label for="description">Description<span class="text-danger">*</span></label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}
            </textarea>
            @error('description')
            <span class="text-danger font-italic" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group col-md-12">
          <label for="image">Choose Image<span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="file" class="form-control d-none" id="image" name="image" value="{{ old('image') }}">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQl1xtOkMGh312RKiJXUPbwyODQ7hdHgHFqYR5RwBGHiKaKz9eO&s" id="profile-img-tag" width="200px" onclick="document.getElementById('image').click();" alt="your image" class="img-thumbnail img-fluid editback-gallery-img center-block pull-left" />
          </div>
          @error('image')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group col-md-12">
          <label for="start_at">Date and Time:<span class="text-danger" >*</span></label>
          <div class="input-group">
            <input type="text" class="form-control" id="start_at" placeholder="Enter date and time" name="start_at" value="{{ old('start_at') }}" >
          </div>
          @error('start_at')
          <span class="text-danger font-italic" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        </div>
      </div>
      <div class="card-footer justify-content-between">
        <button type="submit" class="btn btn-info text-capitalize">Save</button>
      </div>
    </form>
  </div>
</section>
@endsection
@push('javascript')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $('#start_at').datetimepicker({
      // format: 'LT'
      format: 'YYYY-MM-DD HH:mm'
    });
</script>
<script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#profile-img-tag').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#image").change(function(){
    // alert("milan");
    readURL(this);
  });
</script>
@endpush

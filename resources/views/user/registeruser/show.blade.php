@extends('user.main.app')
@section('content')
<section class="content">
  <div class="card">
    <div class="card-body">
      <form role="form" method="POST" action="{{route('user.user-search',['id'=>$id])}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
        <input type="hidden" name="user_id" class="token" value="{{ $id }}">
        <div class="card-body pb-1">
          <div class="form-row d-flex align-items-end">
            <div class="col-md-4">
              <div class="form-group">
                <label>Choose Movie:</label>
                <select class="form-control" name="movie_id" id="movie_id">
                  <option value="">--Please select--</option>
                  @foreach($movies as $key => $movie)
                  <option value="{{$movie->id}}" {{old('movie_id') == $movie ?'selected':''}}>{{$movie->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <!-- <div class="col-md-4">
              <div class="form-group">
                <label for="movie_id">Choose Movie:</label>
                <select class="form-control" name="movie_id" id="movie_id">
                  <option value="">--Please select--</option>
                </select>
              </div>
            </div> -->
            <div class="col-md-4">
              <div class="form-group">
                <button type="submit" class="btn btn-info btn-block">Search Now!</button>
              </div>
            </div>
          </div>
        </div>
      </form>

      <div class="table-responsive">
        <table class="table table-bordered table-hover m-0 table-sm">
          <thead class="bg-dark">
            <tr class="text-center">
              <th width="10">SN</th>
              <th>Seat NO.</th>
              <th>Movie</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($datas as $key=>$data)             
            <tr class="text-center">
              <td>{{$key+1}}</td>
              <td class="text-center">R{{$data->getSeatName->row}}C{{$data->getSeatName->column}}</td>
              <td class="text-center">{{$data->getSeatName->getMovieName->name}}</td>
              <td>
                 <a href="{{ route('user.seat.active',$data->id)}}" data-placement="top" title="{{ $data->is_occupied == '0' ? 'Click to Book' : 'Click to Unbook' }}">
                  <i class="fa {{ $data->is_occupied == '1' ? 'fa-check check-css' : 'fa-times cross-css' }}"></i>
                </a>
              </td>
              <td>
                <a href="{{ route('user.task.edit',$data->id) }}" class="btn btn-xs btn-outline-info" data-placement="top" title="Update"><i class="fas fa-edit"></i></a>
                <form action="{{ route('user.task.destroy',$data->id) }}" method="post" class="d-inline-block delete-confirm" data-placement="top" title="Permanent Delete">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-xs btn-outline-danger" type="submit"><i class="fa fa-trash"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</section>
@endsection
@push('javascript')
<script>
  function updateStatus(taskId) {
    $.ajax({
      url: '/user/task/' + taskId + '/toggle-status', 
      type: 'PATCH',
      data: {
        _token: '{{ csrf_token() }}',
      },
      success: function(response) {
        const statusElement = $('span[onclick="updateStatus(' + taskId + ')"]');
        if (response.status === 'Completed') {
          statusElement.removeClass('badge-warning text-dark').addClass('badge-success').text('Completed');
        } else {
          statusElement.removeClass('badge-success').addClass('badge-warning text-dark').text('Pending');
        }
      },
      error: function(event) {
        // console.log(error);
        alert('Error updating status');
        return('false');
      }
    });
  }
</script>
@endpush
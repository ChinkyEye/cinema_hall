@extends('user.main.app')
@section('content')
<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="row">
        @if($seats_count == 0)
        <a href="{{ route('user.seat.createSeating',['ids' => $movie_id]) }}" class="btn btn-sm btn-info text-capitalize rounded-0" data-toggle="tooltip" data-placement="top" title="Click to generate" >Click to Generate</a>
        @else
         <a href="{{ route('user.seat.createSeating',['ids' => $movie_id]) }}" class="btn btn-sm btn-info text-capitalize rounded-0 disabled" data-toggle="tooltip" data-placement="top" title="Click to generate" >Click to Generate</a>
        @endif

      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover m-0 table-sm">
          <thead class="bg-dark">
            <tr class="text-center">
              <th width="10">SN</th>
              <th>Seat No.</th>
              <th>Category</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
             @foreach($seats as $key=>$data)             
            <tr class="text-center">
              <td>{{$key+1}}</td>
              <td class="text-center"> R{{ $data->row }}C{{ $data->column }}</td>
              <td class="text-center">{{$data->type}}</td>
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
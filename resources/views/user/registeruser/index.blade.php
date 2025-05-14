@extends('user.main.app')
@section('content')
<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <a href="" class="btn btn-sm btn-info text-capitalize rounded-0" data-toggle="tooltip" data-placement="top" title="Add Address">Add Task</a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover m-0 table-sm">
          <thead class="bg-dark">
            <tr class="text-center">
              <th width="10">SN</th>
              <th>User Name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($bookings as $key=>$data)             
            <tr class="text-center">
              <td>{{$key+1}}</td>
              <td class="text-center">{{$data->getUserName->name}}</td>
              <td>
                <a href="{{ route('user.registeruser.show',$data->id) }}" class="btn btn-xs btn-outline-info" data-placement="top" title="Click to view booking"><i class="fas fa-eye"></i></a>
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
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>To-Do</title>
  <meta name="description" content="Library HTML Template">
  <meta name="keywords" content="industry, html">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{URL::to('/')}}/favicon.ico" rel="shortcut icon"/>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{URL::to('/')}}/backend/css/all.min.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/backend/plugins/pace-progress/themes/black/pace-theme-flat-top.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{URL::to('/')}}/backend/css/adminlte.min.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/backend/css/toastr.min.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/backend/css/style.back.css">
  <style type="text/css">
    *{
      font-size: 13px;
    }
  </style>
  @stack('style')
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    @include('user.main.header')
    @include('user.main.sidebar')
    <div class="content-wrapper">
      @yield('content')
    </div>
    @include('user.main.footer')
  </div>
  <script src="{{URL::to('/')}}/backend/js/jquery.min.js"></script>
  <script src="{{URL::to('/')}}/backend/js/bootstrap.bundle.min.js"></script>
  <script src="{{URL::to('/')}}/backend/plugins/pace-progress/pace.min.js"></script>
  <script src="{{URL::to('/')}}/backend/js/adminlte.js"></script>
  <script src="{{URL::to('/')}}/backend/js/demo.js"></script>
  <script src="{{URL::to('/')}}/backend/js/toastr.min.js"></script>
  <script src="{{URL::to('/')}}/backend/js/toggle.main.js"></script>
  @stack('javascript')
  <script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
    case 'info':
      toastr.info("{{ Session::get('message') }}");
      break;

    case 'warning':
      toastr.warning("{{ Session::get('message') }}");
      break;

    case 'success':
      toastr.success("{{ Session::get('message') }}");
      break;

    case 'error':
      toastr.error("{{ Session::get('message') }}");
      break;
    }
    @endif
  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>
    $('.delete-confirm').on('click', function (e) {
      event.preventDefault();
      const url = $(this).attr('action');
      var token = $('meta[name="csrf-token"]').attr('content');
      swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
        dangerMode: true,
        closeOnClickOutside: false,
      }).then(function(value) {
        if(value == true){
          $.ajax({
            url: url,
            type: "POST",
            data: {
              _token: token,
              '_method': 'DELETE',
            },
            success: function (data) {
              swal({
                title: "Success!",
                type: "success",
                text: "\n Click OK",
                icon: "success",
                showConfirmButton: false,
              }).then(location.reload(true));
              
            },
            error: function (data) {
              swal({
                title: 'Opps...',
                text: "\n Please refresh your page",
                type: 'error',
                timer: '1500'
              });
            }
          });
        }else{
          swal({
            title: 'Cancel',
            text: "Data is safe.",
            icon: "success",
            type: 'info',
            timer: '1500'
          });
        }
      });
    });
  </script> 
</body>
</html>



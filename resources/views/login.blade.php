@extends('baselogin')
@section('content')


<!-- Main Section -->
<section class="main-section">

    @if(\Session::has('alert'))
    <div class="alert alert-danger">
        <div>{{Session::get('alert')}}</div>
    </div>
    @endif
    @if(\Session::has('alert-success'))
    <div class="alert alert-success">
        <div>{{Session::get('alert-success')}}</div>
    </div>
    @endif

    <div class="bg-form-login">
        <form action="{{ url('/admin/loginpost') }}" method="post">
        {{-- <form method="POST" id="formsubmit"> --}}
            {{ csrf_field() }}

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password"></input>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-md btn-primary btn_login">Login</button>
                {{-- <button type="button" class="btn btn-md btn-primary btn_login">Login</button> --}}
            </div>
        </form>
    </div>
</section>

{{-- login with ajax --}}
{{-- <script>
    $(".btn_login").click(function (e) {
        e.preventDefault();
        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/loginpost",
            data: {
                email: email,
                password: password
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                switch (response.data.statuscode) {
                    case 2001:
                        Swal.fire({
                            title: 'Sukses!',
                            type: 'success',
                            text: response.data.message,
                        }).then( (result) =>{
                            if(result){
                                window.location.href = "http://127.0.0.1:8000/admin"
                            }
                        })
                        break;
                    case 4001:
                        Swal.fire({
                            title: 'Gagal!',
                            text: response.data.message,
                            type: 'warning',
                            confirmButtonText: 'ok'
                        })
                        break;
                    case 4002:
                        Swal.fire({
                            title: 'Gagal!',
                            text: response.data.message,
                            type: 'error',
                            confirmButtonText: 'ok'
                        })
                        break;
                    default:
                        break;
                }
            }
        });
    });

</script> --}}

<!-- /.main-section -->
@endsection

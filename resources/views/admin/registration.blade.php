

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laravel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="content">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .error-message {
        color: red;
    }

</style>

</head>

<body>

<main class="signup-form">
   <div class="cotainer">
      <div class="row justify-content-center">
         <div class="col-md-4">

            <div class="card" style="margin-top: 50px;">

               <h3 class="card-header text-center">Register User</h3>
               <div class="card-body">
                  <form action="{{ route('register.admin') }}" method="POST">
                     @csrf
                     <div class="form-group mb-3">
                        <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                           required autofocus>
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                     </div>

                     <div class="form-group mb-3">
                        <input type="text" placeholder="Email" id="email" class="form-control"
                           name="email" required autofocus>
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                     </div>
                     <div class="form-group mb-3">
                        <input type="password" placeholder="Password" id="password" class="form-control"
                           name="password" required>
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                     </div>

                     <div class="form-group mb-3">
                        <input type="password" name="c_password" id="c_password" placeholder=" Confirm Password" class="form-control" required>
                        @if ($errors->has('c_password'))
                            <span class="text-danger">{{ $errors->first('c_password') }}</span>
                        @endif
                    </div>


                     

                    <div class="form-group mb-3" style="float: right;text-align: right;" >

                    <a href="{{ route('login-admin') }}">Already have account?</a> <br>

                            </div>


                     <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                     </div>


                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        $('#country-dd').on('change', function () {
            var idCountry = this.value;
            $("#state-dd").html('');
            $.ajax({
                url: "{{url('api/fetch-states')}}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state-dd').html('<option value="">Select State</option>');
                    $.each(result.states, function (key, value) {
                        $("#state-dd").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city-dd').html('<option value="">Select City</option>');
                }
            });
        });
        $('#state-dd').on('change', function () {
            var idState = this.value;
            $("#city-dd").html('');
            $.ajax({
                url: "{{url('api/fetch-cities')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#city-dd').html('<option value="">Select City</option>');
                    $.each(res.cities, function (key, value) {
                        $("#city-dd").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });

        // Validation rules and messages
        $("form").validate({
            rules: {
                country: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                }
            },
            messages: {
                country: {
                    required: "<span class='error-message'>Please select a country.</span>"
                },
                state: {
                    required: "<span class='error-message'>Please select a state.</span>"
                },
                city: {
                    required: "<span class='error-message'>Please select a city.</span>"
                }
            }
        });
    });
</script>
</body>





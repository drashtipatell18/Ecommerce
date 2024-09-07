<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            background: url('https://example.com/background.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            /* Slightly more opaque */
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            /* Increased max width */
            padding: 30px;
            /* Increased padding */
        }

        .btn-custom {
            width: 100%;
            background-color: #5864bd;
            /* Updated button color */
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h3>Reset Password</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('post_reset', ['token' => $token]) }}" class="login">
                    @csrf
                    <div class="form-group">
                        <label>New Password</label>
                        <input class="au-input au-input--full form-control @error('new_password') is-invalid @enderror"
                            type="password" name="new_password" placeholder="Password">
                        @error('new_password')
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input
                            class="au-input au-input--full form-control @error('confirm_password') is-invalid @enderror"
                            type="password" name="confirm_password" placeholder="Password">
                        @error('confirm_password')
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn-custom" type="submit">submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include jQuery Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $.validator.addMethod("customEmail", function(value, element) {
                return this.optional(element) || /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(value);
            }, "Please enter a valid email address");

            $('#login').validate({ // Use .validate() method
                rules: {
                    email: {
                        required: true,
                        customEmail: true
                    },
                    password: {
                        required: true,
                        minlength: 8 // Added minlength rule
                    }
                },
                messages: {
                    email: {
                        required: 'Please enter an email',
                        email: 'Please enter a valid email'
                    },
                    password: {
                        required: "Please enter password",
                        minlength: "Password must be at least 8 characters"
                    }
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });
            $('#login').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'), // Use the form's action URL
                    method: 'POST',
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        toastr.success('Login successful!'); // Show success message
                        window.location.href = '/dashboard'; // Redirect to the dashboard
                    },
                    error: function(xhr) {
                        toastr.error('Login failed!'); // Show error message
                    }
                });
            });
            setTimeout(function() {
                $(".alert-danger").fadeOut(1000);
            }, 1000);
        });
    </script>
</body>

</html>

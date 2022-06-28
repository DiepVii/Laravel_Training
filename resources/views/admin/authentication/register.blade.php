<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="{{ asset('backend/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center ">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black mx-3 my-5" style="border-radius: 25px;">
                        <div class="card-body py-3 px-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-3 mx-1 mx-md-4 mt-2">Sign up</p>

                                    <form enctype="multipart/form-data" method="POST"
                                        action="{{ route('confirm_register') }}" class="mx-1 mx-md-4">
                                        @csrf

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Your Name</label>
                                                <input required name="name" type="text" id="form3Example1c"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class=" text-center">
                                            <span class=" text-danger">{{ $errors->first('name') }}</span>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Your Email</label>
                                                <input name="email" type="email" id="form3Example3c"
                                                    class="form-control" required />
                                            </div>
                                        </div>
                                        <div class=" text-center">
                                            <span class=" text-danger">{{ $errors->first('email') }}</span>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-address-card fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4cd">Role</label>
                                                <select name="role" class="form-control" id="">
                                                    <option value="1">Employyee</option>
                                                    <option value="0">Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4c">Password</label>
                                                <input name="password" type="password" id="form3Example4c"
                                                    class="form-control" required />
                                            </div>
                                        </div>
                                        <div class=" text-center">
                                            <span class=" text-danger">{{ $errors->first('password') }}</span>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4cd">Repeat
                                                    your password</label>
                                                <input name="confirm_password" type="password" id="form3Example4cd"
                                                    class="form-control" required />

                                            </div>
                                        </div>
                                        <div class=" text-center">
                                            <span class=" text-danger">{{ $errors->first('confirm_password') }}</span>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-image fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4cd">Image</label>
                                                <input id="fileinput" required name="image" type="file"
                                                    id="form3Example4cd" class="form-control" accept="image/*" />

                                            </div>

                                        </div>
                                        <img src="" id="image" alt="">
                                        <div class=" text-center">
                                            <span class=" text-danger">{{ $errors->first('image') }}</span>
                                        </div>

                                        {{-- <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                id="form2Example3c" />
                                            <label class="form-check-label" for="form2Example3">
                                                I agree all statements in <a href="#!">Terms of service</a>
                                            </label>
                                        </div> --}}

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg">Register</button>

                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">

                                            <p class="small fw-bold mt-2 pt-1 mb-0">You have an account? <a
                                                    href="{{ route('login') }}" class="link-danger">Login</a>
                                            </p>

                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script>
    fileinput.onchange = evt => {
        const [file] = fileinput.files
        if (file) {
            $("#image").css({
                "width": "150px",
                "height": "150px"
            })
            image.src = URL.createObjectURL(file)
        }
    }
</script>

</html>

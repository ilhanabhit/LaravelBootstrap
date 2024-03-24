
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Forget Password Form Using Bootstrap 5</title>
	<!-- Bootstrap 5 CDN Link -->
    <link rel="stylesheet" href="{{ asset('css/sstyle.css') }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS Link -->
	<link rel="stylesheet" href="style.css">
</head>
<body> 
    <section class="wrapper">
		<div class="container">
			<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
				<div class="logo">
					<img decoding="async" src="images/logo.png" class="img-fluid" alt="logo">
				</div>
				<form class="rounded bg-white shadow p-5">
					<h3 class="text-dark fw-bolder fs-4 mb-2">Forget Password ?</h3>

					<div class="fw-normal text-muted mb-4">
						Enter your email to reset your password.
					</div>  

					<div class="form-floating mb-3">
						<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
						<label for="floatingInput">Email address</label>
					</div>  

					<button type="submit" class="btn btn-primary submit_btn my-4">Submit</button>
                    <button type="submit" class="btn btn-secondary submit_btn my-4 ms-3">Cancel</button> 
				</form>
			</div>
		</div>
	</section>
</body>
</html>


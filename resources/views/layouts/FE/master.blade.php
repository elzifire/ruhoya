<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

		<title>@yield('title') - {{env("APP_NAME")}}</title>

		<!-- Fav Icon -->
		<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />

		@include("layouts.FE.partials.css")
	</head>

	<!-- page wrapper -->
	<body>
		<div class="boxed_wrapper">
			<!-- preloader -->
			<div class="loader-wrap">
				<div class="preloader">
					<div class="preloader-close">x</div>
					<div id="handle-preloader" class="handle-preloader">
						<div class="animation-preloader">
							<div class="spinner"></div>
							<div class="txt-loading">
								<span data-text-preloader="R" class="letters-loading"> R </span>
								<span data-text-preloader="U" class="letters-loading"> U </span>
								<span data-text-preloader="H" class="letters-loading"> H </span>
								<span data-text-preloader="O" class="letters-loading"> O </span>
								<span data-text-preloader="Y" class="letters-loading"> Y </span>
								<span data-text-preloader="A" class="letters-loading"> A </span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- preloader end -->

			@include("layouts.FE.partials.header")

			@yield('content')

			@include("layouts.FE.partials.footer")

			<!--Scroll to top-->
			<button
				class="scroll-top scroll-to-target"
				style="display: flex; align-items: center; justify-content: center"
				data-target="html"
			>
				<i class="fas fa-long-arrow-alt-up"></i>
			</button>
		</div>

		@include("layouts.FE.partials.js")
        
	</body>
	<!-- End of .page_wrapper -->
</html>

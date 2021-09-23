@extends('frontend.layouts.master')

@section('content')

            <div role="main" class="main">

                <section class="page-header page-header-modern bg-color-light-scale-1 page-header-lg">
					<div class="container">
						<div class="row">
							<div class="col-md-12 align-self-center p-static order-2 text-center">
								<h1 class="font-weight-bold text-dark">Contact Us</h1>
							</div>
							<div class="col-md-12 align-self-center order-1">
								<ul class="breadcrumb d-block text-center">
									<li><a href="{{asset('index')}}">Home</a></li>
									<li class="active">Contact Us</li>
								</ul>
							</div>
						</div>
					</div>
				</section>

				<div class="container py-4">

					<div class="row mb-2">
						<div class="col">

							<h2 class="font-weight-bold text-7 mt-2 mb-0">Contact Us</h2>
							<p class="mb-4">Feel free to ask for details, don't save any questions!</p>

							<form class="contact-form-recaptcha-v3" action="" method="POST">
								<div class="contact-form-success alert alert-success d-none mt-4">
									<strong>Success!</strong> Your message has been sent to us.
								</div>

								<div class="contact-form-error alert alert-danger d-none mt-4">
									<strong>Error!</strong> There was an error sending your message.
									<span class="mail-error-message text-1 d-block"></span>
								</div>

								<div class="row">
									<div class="form-group col-lg-6">
										<label class="form-label mb-1 text-2">Full Name</label>
										<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control text-3 h-auto py-2" name="name" required>
									</div>
									<div class="form-group col-lg-6">
										<label class="form-label mb-1 text-2">Email Address</label>
										<input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control text-3 h-auto py-2" name="email" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label class="form-label mb-1 text-2">Subject</label>
										<input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control text-3 h-auto py-2" name="subject" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label class="form-label mb-1 text-2">Message</label>
										<textarea maxlength="5000" data-msg-required="Please enter your message." rows="5" class="form-control text-3 h-auto py-2" name="message" required></textarea>
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<input type="submit" value="Send Message" class="btn btn-primary btn-modern" data-loading-text="Loading...">
									</div>
								</div>
							</form>

						</div>
					</div>

					<div class="row mb-5">
						<div class="col-lg-4">
							
							<div class="overflow-hidden mb-3">
								<h4 class="pt-5 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="200" data-plugin-options="{'accY': -200}">Get in <strong>Touch</strong></h4>
							</div>
							<div class="overflow-hidden mb-3">
								<p class="lead text-4 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="400" data-plugin-options="{'accY': -200}">For data privacy questions or requests please email privacy@sebpo.com.</p>
							</div>

						</div>
						<div class="col-lg-4 offset-lg-1 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="800" data-plugin-options="{'accY': -200}">

							<h4 class="pt-5">Our <strong>Office</strong></h4>
							<ul class="list list-icons list-icons-style-3 mt-2">
								<li><i class="fas fa-map-marker-alt top-6"></i> <strong>Address:</strong> 8 Abbas Garden Rd Mohakhali Dhaka 1212</li>
								<li><i class="fas fa-phone top-6"></i> <strong>Phone:</strong> 09606-221100</li>
								<li><i class="fas fa-envelope top-6"></i> <strong>Email:</strong> <a href=""><span class="__cf_email__" data-cfemail="">info@sebpo.com</span></a></li>
							</ul>
							
						</div>
						<div class="col-lg-3 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="1000" data-plugin-options="{'accY': -200}">

							<h4 class="pt-5">Business <strong>Hours</strong></h4>
							<ul class="list list-icons list-dark mt-2">
								<li><i class="far fa-clock top-6"></i> Sunday - Thursday - 10am to 6pm</li>
								<li><i class="far fa-clock top-6"></i> Saturday - Friday - Closed</li>
							</ul>

						</div>
					</div>

				</div>

				<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
				<div id="googlemaps" class="google-map m-0 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="300" style="height:450px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.135465326277!2d90.3929293149819!3d23.778189984575643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c769b6d6d371%3A0x11e0d8d4e159e3c8!2sSEBPO!5e0!3m2!1sen!2sbd!4v1631440018763!5m2!1sen!2sbd" height="450" style="border:0; width: 100%;" allowfullscreen="" loading="lazy"></iframe>
                </div>

			</div>

@endsection
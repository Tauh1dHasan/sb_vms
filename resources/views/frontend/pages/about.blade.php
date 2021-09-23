@extends('frontend.layouts.master')

@section('content')

            <div role="main" class="main">

                <section class="page-header page-header-modern bg-color-light-scale-1 page-header-lg">
					<div class="container">
						<div class="row">
							<div class="col-md-12 align-self-center p-static order-2 text-center">
								<h1 class="font-weight-bold text-dark">About Us</h1>
							</div>
							<div class="col-md-12 align-self-center order-1">
								<ul class="breadcrumb d-block text-center">
									<li><a href="{{asset('index')}}">Home</a></li>
									<li class="active">About Us</li>
								</ul>
							</div>
						</div>
					</div>
				</section>

				<div class="container pb-1">

                    <div class="row pt-5">
						<div class="col">

							<div class="row text-center pb-5">
								<div class="col-md-9 mx-md-auto">
									<div class="overflow-hidden mb-3">
										<h1 class="word-rotator slide font-weight-bold text-8 mb-0 appear-animation" data-appear-animation="maskUp">
											<span>We are SEBPO, We </span>
											<span class="word-rotator-words bg-primary">
												<b class="is-visible">Create</b>
												<b>Build</b>
												<b>Develop</b>
											</span>
											<span> Solutions</span>
										</h1>
									</div>
									<div class="overflow-hidden mb-3">
										<p class="lead mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="200">
                                            SEBPO, formerly known as ServicEngineBPO, is a leading global outsourcing partner to many of the world’s largest advertising, media, and technology companies.
										</p>
									</div>
								</div>
							</div>

							<div class="row mt-3 mb-5">
								<div class="col-md-4 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="800">
									<h3 class="font-weight-bold text-4 mb-2">Our Mission</h3>
									<p>Our mission is to be one of the world’s leading software developent organization and provider of digital solution, using our advnace technological skills and hardworking highly experienced team. We are highly motivated to reach our goal.</p>
								</div>
								<div class="col-md-4 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="600">
									<h3 class="font-weight-bold text-4 mb-2">Our Vision</h3>
									<p>Our vision is to provide a better and easier solution to many work process by developing a dynamic and user friendly system that will make life more efficient. </p>
								</div>
								<div class="col-md-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="800">
									<h3 class="font-weight-bold text-4 mb-2">Why Us</h3>
									<p>SEBPO has been consistently recognized as one of the “5000 Fastest-Growing Private Companies in America” by Inc., and as a Top Global Outsourcing Company (GO100) by the International Association of Outsourcing Professionals (IAOP) since 2014.</p>
								</div>
							</div>

						</div>
					</div>
				</div>

				<section class="section section-primary border-0 mb-0 appear-animation" data-appear-animation="fadeIn" data-plugin-options="{'accY': -150}">
					<div class="container">
						<div class="row counters counters-sm pb-4 pt-3">
							<div class="col-sm-6 col-lg-3 mb-5 mb-lg-0">
								<div class="counter">
									<i class="icons icon-user text-color-light"></i>
									<strong class="text-color-light font-weight-extra-bold" data-to="40000" data-append="+">0</strong>
									<label class="text-4 mt-1 text-color-light">Happy Clients</label>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3 mb-5 mb-lg-0">
								<div class="counter">
									<i class="icons icon-graph text-color-light"></i>
									<strong class="text-color-light font-weight-extra-bold" data-to="15">0</strong>
									<label class="text-4 mt-1 text-color-light">Years In Business</label>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3 mb-5 mb-sm-0">
								<div class="counter">
                                    <i class="icons icon-badge text-color-light"></i>
									<strong class="text-color-light font-weight-extra-bold" data-to="5">0</strong>
									<label class="text-4 mt-1 text-color-light">Rewards</label>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="counter">
                                    <i class="icons icon-user text-color-light"></i>
									<strong class="text-color-light font-weight-extra-bold" data-to="1100" data-append="+">0</strong>
									<label class="text-4 mt-1 text-color-light">Employees</label>
								</div>
							</div>
						</div>
					</div>
				</section>

				<div class="container">
					<div class="row mt-4">
						<div class="col-md-8 mx-md-auto text-center">

							<h2 class="text-color-dark font-weight-normal text-7 mb-0 pt-2">Our <strong class="font-weight-extra-bold">History</strong></h2>
							<p>How we started</p>

							<section class="timeline" id="timeline">
								<div class="timeline-body">
									<div class="timeline-date">
										<h3 class="text-primary font-weight-bold">2021</h3>
									</div>

									<article class="timeline-box left text-start appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
										<div class="timeline-box-arrow"></div>
										<div class="p-2">
											<img alt="" class="img-fluid" src="img/history/history-3.html" />
											<h3 class="font-weight-bold text-3 mt-3 mb-1">Global Outsourcing 100 list</h3>
											<p class="mb-0 text-2">Global Outsourcing 100 list by International Association of Outsourcing Professionals (IAOP)</p>
										</div>
									</article>

									<div class="timeline-date">
										<h3 class="text-primary font-weight-bold">2020</h3>
									</div>

									<article class="timeline-box right text-start appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="400">
										<div class="timeline-box-arrow"></div>
										<div class="p-2">
											<img alt="" class="img-fluid" src="img/history/history-2.html" />
											<h3 class="font-weight-bold text-3 mt-3 mb-1">Fastest Growing Private Company</h3>
											<p class="mb-0 text-2">Nation’s Fastest Growing Private Companies List for Sixth Time</p>
										</div>
									</article>

									<div class="timeline-date">
										<h3 class="text-primary font-weight-bold">2006</h3>
									</div>

									<article class="timeline-box left text-start appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="600">
										<div class="timeline-box-arrow"></div>
										<div class="p-2">
											<img alt="" class="img-fluid" src="img/history/history-1.html" />
											<h3 class="font-weight-bold text-3 mt-3 mb-1">Foundation</h3>
											<p class="mb-0 text-2">Founded in 2006, SEBPO is based in New Jersey with delivery centers in Bangladesh and El Salvador.</p>
										</div>
									</article>
								</div>
							</section>

						</div>
					</div>

				</div>

				<section class="section-default border-0">

                    <div class="container appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="300">
                        <div class="row pb-4 my-5">
                            <div class="col-md-12 order-2 order-md-1 text-center">
                                <h2 class="text-color-dark font-weight-normal text-7 mb-0 pt-2 pb-4">Our <strong class="font-weight-extra-bold">Leadership Team</strong></h2>

                                <div class="owl-carousel owl-theme nav-style-1 nav-center-images-only stage-margin mb-0" data-plugin-options="{'responsive': {'576': {'items': 1}, '768': {'items': 1}, '992': {'items': 2}, '1200': {'items': 3}}, 'margin': 25, 'loop': false, 'nav': true, 'dots': false, 'stagePadding': 40}">
                                    <a href="https://sebpo.com/about-sebpo/asm-mohiuddin-monem/"><div>
                                        <img class="img-fluid rounded-0 mb-4" src="{{asset('frontend/img/leadership/1.jpg')}}" alt="" />
                                        <h3 class="font-weight-bold text-color-dark text-4 mb-0">A.S.M. Mohiuddin Monem</h3>
                                        <p class="text-2 mb-0">CHAIRMAN & CO-FOUNDER</p>
                                    </div></a>
                                    <a href="https://www.linkedin.com/in/matthew-kochan-363236/"><div>
                                        <img class="img-fluid rounded-0 mb-4" src="{{asset('frontend/img/leadership/2.jpg')}}" alt="" />
                                        <h3 class="font-weight-bold text-color-dark text-4 mb-0">Matt Kochan</h3>
                                        <p class="text-2 mb-0">CEO and Co-Founder</p>
                                    </div></a>
                                    <a href="https://www.linkedin.com/in/kevin-kochan-a18ba71"><div>
                                        <img class="img-fluid rounded-0 mb-4" src="{{asset('frontend/img/leadership/3.jpg')}}" alt="" />
                                        <h3 class="font-weight-bold text-color-dark text-4 mb-0">Kevin Kochan</h3>
                                        <p class="text-2 mb-0">CEO</p>
                                    </div></a>
                                    <a href="https://www.linkedin.com/in/hossainakram/"><div>
                                        <img class="img-fluid rounded-0 mb-4" src="{{asset('frontend/img/leadership/4.jpg')}}" alt="" />
                                        <h3 class="font-weight-bold text-color-dark text-4 mb-0">Syed Akram Hossain</h3>
                                        <p class="text-2 mb-0">COO</p>
                                    </div></a>
                                </div>
                            </div>
                        </div>
				    </div>
				</section>

			</div>

@endsection
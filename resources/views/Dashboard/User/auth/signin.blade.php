@extends('Dashboard.layouts.master2')
@section('css')

<style>
    .loginform{display: none;}
</style>

<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid" style="background-color: #ffffff">
			<ul class="nav" style="width: 90%;margin:auto" >
				<li class="">
					<div class="dropdown  nav-itemd-none d-md-flex">
						<a href="#" class="d-flex  nav-item nav-link pl-0" data-toggle="dropdown"
						   aria-expanded="false">
							@if (App::getLocale() == 'ar')
								<span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
										src="{{URL::asset('Dashboard/img/flags/mo_flag.jpg')}}" alt="img"></span>
								<strong
									class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
							@elseif(App::getLocale() == 'fr')
								<span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
										src="{{URL::asset('Dashboard/img/flags/french_flag.jpg')}}" alt="img"></span>
								<strong
									class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
								
							@elseif(App::getLocale() == 'nds')
									<span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
											src="{{URL::asset('Dashboard/img/flags/germany_flag.jpg')}}" alt="img"></span>
									<strong
										class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
									
								@else

								
							<span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
								src="{{URL::asset('Dashboard/img/flags/us_flag.jpg')}}" alt="img"></span>
							
							@endif
							<div class="my-auto">
					</div>
					
						</a>
						<div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
							@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
								<a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
								   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
									@if($properties['native'] == "Francais")
										<i class="flag-icon flag-icon-SA"></i>
									@elseif($properties['native'] == "العربية")
										{{-- <i class="flag-icon flag-icon-ma"></i> --}}
									@elseif($properties['native'] == "Deutchland")
										{{-- <i class="flag-icon flag-icon-du"></i> --}}
									@endif
									{{ $properties['native'] }}
								</a>
							@endforeach
						</div>
					</div>
				</li>
			</ul>
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-main">
					<div class="row wd-100p mx-auto text-center">
						{{-- <div>
							<select>
								<option value="{{ LaravelLocalization::getCurrentLocaleName() }}">Arabe</option>
								<option value="{{ LaravelLocalization::getCurrentLocaleName() }}">France</option>
							</select>
						</div> --}}
						{{-- <select> --}}
                 
	{{-- </select> --}}
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('Dashboard/img/media/main_doctor.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										<div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1></div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>{{trans('Dashboard/login_trans.Welcom_back')}}</h2>
												@if ($errors->any())
                                                  <div class="alert alert-danger">
                                                    <ul>
                                                         @foreach ($errors->all() as $error)
                                                               <li>{{ $error }}</li>
                                                         @endforeach
                                                     </ul>
                                                   </div>
                                                @endif


												<div class="form-group">
													<label for="exampleFormControlSelect1">{{trans('Dashboard/login_trans.Select_Enter')}}</label>
													<select class="form-control" id="sectionChooser">
                                                      <option> {{trans('Dashboard/login_trans.Select_Enter')}}</option>													  
                                                      <option value="admin"> {{trans('Dashboard/login_trans.admin')}} </option>
													  <option value="user">{{trans('Dashboard/login_trans.user')}}</option>
													  <option value="Doctor">{{trans('Dashboard/login_trans.Doctor')}}</option>
													  <option value="ray_employee">{{trans('Dashboard/login_trans.Ray')}}</option>
													</select>
												  </div>
												  {{-- Form user --}}
                                                <div class="loginform" id="user">
												<h5 class="font-weight-semibold mb-4">{{trans('Dashboard/login_trans.user')}}</h5>
												<form method="POST" action="{{ route('login.user') }}">
													@csrf
													<div class="form-group">
														<label>{{trans('Dashboard/login.email')}}</label> <input class="form-control" placeholder="Enter your email" type="email" name="email" :value="old('email')" required autofocus>
													</div>
													<div class="form-group">
														<label>{{trans('Dashboard/login.password')}}</label> <input class="form-control" placeholder="Enter your password" type="password"
														name="password"
														required autocomplete="current-password">
													</div>
													<button type="submit" class="btn btn-main-primary btn-block">{{trans('Dashboard/login.sign_in')}}</button>
												</form>
												</div>

										   {{-- Form Admin --}}
										  <div class="loginform" id="admin">
											<h5 class="font-weight-semibold mb-4">{{trans('Dashboard/login_trans.admin')}}</h5>
											<form method="POST" action="{{ route('login.admin') }}">
												@csrf
												<div class="form-group">
													<label>{{trans('Dashboard/Login.email')}}</label> <input class="form-control" placeholder="Enter your email" type="email" name="email" :value="old('email')" required autofocus>
												</div>
												<div class="form-group">
													<label>{{trans('Dashboard/Login.password')}}</label> <input class="form-control" placeholder="Enter your password" type="password"
													name="password"
													required autocomplete="current-password">
												</div><button type="submit" class="btn btn-main-primary btn-block">{{trans('Dashboard/Login.sign_in')}} </button>
											</form>
											</div>

						                {{-- Form Doctor --}}
		                                <div class="loginform" id="Doctor">
								        	<h5 class="font-weight-semibold mb-4">{{trans('Dashboard/login_trans.Doctor')}}</h5>
											   <form method="POST" action="{{ route('login.doctor')}}">
													@csrf
												  <div class="form-group">
													<label>{{trans('Dashboard/Login.email')}}</label> <input class="form-control" placeholder="Enter your email" type="email" name="email" :value="old('email')" required autofocus>
												  </div>
										          <div class="form-group">
											    	<label>{{trans('Dashboard/Login.password')}}</label> <input class="form-control" placeholder="Enter your password" type="password"
																				name="password"
																				required autocomplete="current-password">
											        </div><button type="submit" class="btn btn-main-primary btn-block">{{trans('Dashboard/Login.sign_in')}}</button>
												</form>
											</div>
										</div>
						                {{-- Form Ray employee --}}
		                                <div class="loginform" id="ray_employee">
											<h2>الدخول موظف اشعة</h2>
											<form method="POST" action="{{ route('login.ray_employee') }}">
												@csrf
											   <div class="form-group">
												   <label>Email</label> <input  class="form-control" placeholder="Enter your email" type="email" name="email" :value="old('email')" required autofocus>
												   </div>
												   <div class="form-group">
													   <label>Password</label> <input class="form-control" placeholder="Enter your password"   type="password"name="password" required autocomplete="current-password" >
													   </div><button type="submit" class="btn btn-main-primary btn-block">Sign In</button>
													   <div class="row row-xs">
														<div class="col-sm-6">
														   <button class="btn btn-block"><i class="fab fa-facebook-f"></i> Signup with Facebook</button>
														</div>
													   <div class="col-sm-6 mg-t-10 mg-sm-t-0">
														   <button class="btn btn-info btn-block"><i class="fab fa-twitter"></i> Signup with Twitter</button>
													   </div>
													   </div>
											</form>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div><!-- End -->
				</div>
			</div><!-- End -->
		</div>
	</div>
@endsection
@section('js')
          <script>
$('#sectionChooser').change(function(){
var myID = $(this).val();
  $('.loginform').each(function(){
       myID === $(this).attr('id') ? $(this).show() : $(this).hide();
  });
});
		  </script>


@endsection
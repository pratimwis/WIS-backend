<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('login');
});

// Auth manager routes
Route::controller(AuthManager::class)->group(function () {
  Route::get('/login', 'login')->name('login');
  Route::post('/login', 'loginPost')->name('login.post');

  Route::get('/register', 'register')->name('register');
  Route::post('/register', 'registerPost')->name('register.post');
});

//consultation routes
Route::middleware('auth')->controller(Home::class)->group(function () {
  Route::get('/dashboard/home/consultation/enquiry-table', 'enquiryTable')->name('consultations.enquiry-table');
  Route::get('/dashboard/home/consultation/consultant-data', 'consultantdata')->name('consultations.consultantdata');
});

//Home page routes
Route::middleware('auth')->controller(Home::class)->group(function () {
  Route::get('/dashboard/home','homeview')->name('home');
  //banner routes
  Route::get('/dashboard/home/banner/create-banner-section', 'CreateBannerSection')->name('banner.create-banner-section');
  Route::get('/home/banner/carouselitems', 'CarouselItems')->name('banner.carouselItems');
  //We we are routes
  Route::get('/dashboard/home/whoweare/create','CreateSection')->name('whoweare.create');
  //Industries Section 6 ,'/
  Route::get('/dashboard/home/industries/create', 'CreateIndustries')->name('industries.create');
  Route::get('/home/industries/create-card', 'CreateCard')->name('industries.create-card');
  Route::get('/home/industries/card/edit/{id}', 'UpdateIndustriesCard')->name('industries.edit-industries-card');
  //We work with section(Cooperating Partners)
  Route::get('/dashboard/home/we-work-with/create', 'WeWorkWith')->name('we-work-with.create');
  Route::get('/home/we-work-with/create-card', 'CreateWeWorkWithCard')->name('WeWorkWith.create-card');
  Route::get('/home/we-work-with/card/edit/{id}', 'UpdateWeWorkWithsCard')->name('UpdateWeWorkWithsCard');
  //Client Section
  Route::get('/dashboard/home/client-slider/view', 'OurClientView')->name('client-section.view');
  Route::get('/home/client-slider/add', 'NewClientCard')->name('client-section.new');
  Route::get('/home/client-slider/edit/{id}', 'UpdateOurClientViewCard')->name('client-section.edit');




  //Our Expertise routes
  Route::get('/dashboard/home/expertise/create-expertise', 'ViewExpertiseData')->name('expertise.create-expertise-section');
  Route::get('/home/expertise/cards/edit/{id}', 'EditExpertiseCard')->name('expertise.edit-expertise-section');
  Route::get('/home/expertise/cards/create', 'CreateExpertiseCard')->name('expertise.create-expertise-section');
  //Services Routes
  Route::get('/dashboard/home/services', 'ViewServicesData')->name('service.view-service-section');
  Route::get('/home/services/cards/create', 'CreateServiceCard')->name('service.create-service-card');
  Route::get('/home/services/cards/edit/{id}', 'EditViewServicesData')->name('service.edit-service-card');
  //Book Appointment
  Route::get('/dashboard/home/appointment', 'ViewAppointmentSection')->name('appointment.view-appointment-section');




  Route::get('/home/our-development-section', 'OurDevelopmentView')->name('banner.OurDevelopmentView');
  Route::get('/home/our-development-section/create', 'CreateOurDevelopmentView')->name('CreateOurDevelopmentView.get');
  Route::get('/home/our-development-section/{id}/edit', 'editOurDevelopmentData')->name('ourdevelopment.edit');
  //expertise section
  Route::get('/home/expertise-section/view', 'expertiseView')->name('expertise.view');
  
});



Route::get('/dashboard/view', function () {
  return view('DashboardSection.DashboardViewSection.dashboardview');
})->middleware('auth')->name('dashboardview');

// Route::get('/dashboard/home', function () {
//   return view('pages.home');
// })->middleware('auth')->name('home');



//shows dashboard left side bar
Route::get('/dashboard', function () {
  return view('dashboard');
})->name('dashboard')->middleware('auth');


Route::post('/logout', function () {
  Auth::logout();
  return redirect(route('login'));
})->name('logout');

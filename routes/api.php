<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Home;
use App\Http\Controllers\ServicesController;
use App\Models\AboutUsStatSection;
use Illuminate\Support\Facades\Route;


//***************************************** Home section api's***************** ****************/

Route::post('/create-enquiry', [Home::class, 'CreateEnquiry']);
// Route::post('/home/consultation/consultant-data', [ConsultationController::class, 'consultantData']);
Route::get('/consulting', [Home::class, 'GetConsultentSection']);
Route::post('/consulting', [Home::class, 'CreateConsultentSection'])->name('consulting.post');

//Banner routes
Route::post('/home/create-banner', [Home::class, 'storeBanner'])->name('banner.store');
Route::get('/home/get-banner-data', [Home::class, 'getBannerSecData']);
Route::get('/carousel-items', [Home::class, 'getCarouselItems'])->name('carousel.get');
Route::post('/carousel-items', [Home::class, 'postCarouselItem'])->name('carousel.post');

//Our development Section
Route::get('/our-development', [Home::class, 'getOurDevelopmentData']);
Route::post('/our-development', [Home::class, 'storeOurDevelopmentData'])->name('ourdevelopment.post');
Route::put('/our-development/{id}', [Home::class, 'updateOurDevelopmentData'])->name('ourdevelopment.put');
Route::delete('/our-development/{id}', [Home::class, 'deleteOurDevelopmentData'])->name('ourdevelopment.delete');

//Expertise Section
Route::post('/expertise-slider', [Home::class, 'postExpertiseSliderData']);
Route::get('/expertise-slider', [Home::class, 'getExpertiseSliderData']);
Route::post('/expertise-slider/{id}', [Home::class, 'updateExpertiseSlidersData']);
Route::delete('/expertise-slider/{id}', [Home::class, 'deleteExpertiseSliderData']);

//Our Client Section
Route::post('/our-client', [Home::class, 'postOurClientData'])->name('clientSlider.create');
Route::get('/our-client', [Home::class, 'getOurClientData']);
Route::delete('/our-client/{id}', [Home::class, 'deleteOurClientData'])->name('clientSlider.destroy');
Route::post('/our-client/{id}', [Home::class, 'updateOurClientData'])->name('clientSlider.edit');

//facts section (service section)
Route::post('/home/second-service', [Home::class, 'postSecondServiceData'])->name('post.second.service.data');
Route::post('/home/service-cards', [Home::class, 'postSectionCardsData'])->name('post.section.cards.data');
Route::get('/section-cards', [Home::class, 'getAllSectionCards']);
Route::get('/section-cards/{id}', [Home::class, 'getSectionCardById']);
Route::put('/section-cards/{id}', [Home::class, 'updateSectionCard'])->name('update.serviceCard.data');
Route::delete('/section-cards/{id}', [Home::class, 'deleteSectionCard'])->name('delete.serviceCard.data');
Route::get('/home/service-section-data', [Home::class, 'getServicesectionData']);
//New Expertise section
Route::post('/home/expertise', [Home::class, 'postExpertiseData'])->name('post.expertise.data');
Route::post('/home/expertise-cards', [Home::class, 'postExpertiseCardsData'])->name('post.expertise.card');
Route::get('/home/expertise-cards/{id}', [Home::class, 'getExpertiseCardById']);
Route::put('/home/expertise-cards/{id}', [Home::class, 'updateExpertiseCard'])->name('update.expertise.card');
Route::delete('/home/expertise-cards/{id}', [Home::class, 'deleteExpertiseCard'])->name('delete.expertise.card');
Route::get('/home/expertise-section-data', [Home::class, 'getExpertiseData']);

//We work with section
Route::post('/home/we_work_with_title_des', [Home::class, 'postWeWorkWithTitle_des'])->name('create-titleDes.weworkwith');
Route::post('/home/we_work_with', [Home::class, 'postWeWorkWithData'])->name('post.weworkwithcard');
Route::get('/home/we_work_with/{id}', [Home::class, 'getWeWorkWithById']);
Route::post('/home/we_work_with/{id}', [Home::class, 'updateWeWorkWithData'])->name('update.weworkwithcard');
Route::delete('/home/we_work_with/{id}', [Home::class, 'deleteWeWorkWithData'])->name('delete.weworkwith.card');
Route::get('/home/we_work_with_section', [Home::class, 'getWeWorkWithSectionData']);

//Book Our Appointment
Route::post('/home/book-appointment/title-description', [Home::class, 'BookAppointment'])->name('book.appointment');
Route::get('/home/book-appointment/title-description', [Home::class, 'getBookAppointmentdata']);

//cta
Route::post('/home/ctasection', [Home::class, 'CallToAction']);
Route::get('/home/ctasection', [Home::class, 'getCallToActiondata']);


//**********************************Services api's *******************************/

//development services
Route::post('/development-services', [ServicesController::class, 'postDevelopmentServicesData']);
Route::get('/development-services', [ServicesController::class, 'getDevelopmentServicesData']);

//performance benchmarks
Route::post('/performance-benchmarks/title-description', [ServicesController::class, 'postPerformanceBenchmarksData_title_des']);
Route::get('/performance-benchmarks/title-description', [ServicesController::class, 'getPerformanceBenchmarksData_title_des']);
Route::post('/performance-benchmarks/points', [ServicesController::class, 'add_points']);
Route::get('/performance-benchmarks/points', [ServicesController::class, 'get_points']);
Route::delete('/performance-benchmarks/points/{id}', [ServicesController::class, 'delete_points']);
Route::post('/performance-benchmarks/points/{id}', [ServicesController::class, 'update_points']);
Route::get('/performance-benchmarks-data', [ServicesController::class, 'getPerformanceBenchmarksData']);

//FAQ Section
Route::resource('faq', ServicesController::class)->only(['index','store','update','destroy']);

//solutions section
Route::post('/solutions_section/title-description', [ServicesController::class, 'postSolutionData_title_des']);
Route::post('/solutions_section/points', [ServicesController::class, 'add_solution_points']);
Route::delete('/solutions_section/points/{id}', [ServicesController::class, 'delete_solutions_points']);
Route::post('/solutions_section/points/{id}', [ServicesController::class, 'update_solutions_points']);
Route::get('/solutions_section-data', [ServicesController::class, 'getSolutionsSectionData']);

//Benefits & Step-By-step guidelines
Route::post('/step-by-step_guidelines/title-description', [ServicesController::class, 'postGuidelinesData_title_des']);
Route::post('/step-by-step_guidelines/card', [ServicesController::class, 'add_guidelines_cards']);
Route::delete('/step-by-step_guidelines/card/{id}', [ServicesController::class, 'delete_guidelines_cards']);
Route::post('/step-by-step_guidelines/card/{id}', [ServicesController::class, 'update_guidelines_cards']);
Route::get('/step-by-step_guidelines-data', [ServicesController::class, 'getGuidelinesSectionData']);


//**********************************About us api's *******************************/

//state section
 
Route::post('/about_us/create_stat_about_section',[AboutUsController::class,'postAboutStatData'])->name('postHomewhoweare.create');
Route::get('/about_us/get_stat_about_section', [AboutUsController::class, 'getAboutStatData']);

//vision mission section
Route::post('/about_us/create_vision_mission',[AboutUsController::class,'postVisionMission']);
Route::get('/about_us/get_vision_mission', [AboutUsController::class, 'getVisionMission']);

//What we do section 
Route::post('/about_us/what-we-do/card', [AboutUsController::class, 'postWhatweDo']);
Route::delete('/about_us/what-we-do/card/{id}', [AboutUsController::class, 'deleteWhatWeDo']);
Route::post('/about_us/what-we-do/card/{id}', [AboutUsController::class, 'updateWhatWeDo']);
Route::get('/what-we-do-data', [AboutUsController::class, 'getWhatWeDoSectionData']);

//Our Clientele
Route::post('/about_us/our_clientele/title-description', [AboutUsController::class, 'postOurClienteleData_title_des']);
   //have all api's in home client section
Route::get('/about_us/our_clientele/get_our_clientdata', [AboutUsController::class, 'getOurClienteleData']);

//Industries section
Route::post('/about_us/industries/title-description', [AboutUsController::class, 'postIndustriesData_title_des'])->name('industries.title_des.store');
Route::post('/about_us/industries/card', [AboutUsController::class, 'postIndustriesData'])->name('industries.card.store');
Route::post('/about_us/industries/card/{id}', [AboutUsController::class, 'updateIndustriesData'])->name('industries.update');
Route::delete('/about_us/industries/card/{id}', [AboutUsController::class, 'deleteIndustriesData'])->name('industries.delete.card');
Route::get('/about_us/industries/get_Industries_data', [AboutUsController::class, 'getOurIndustriesData']);

//Client testimonial section
Route::post('/about_us/testimonial/title-description', [AboutUsController::class, 'postTestimonial_title_des']);
Route::post('/about_us/testimonial/card', [AboutUsController::class, 'postTestimonial']);
Route::post('/about_us/testimonial/card/{id}', [AboutUsController::class, 'updateTestimonial']);
Route::delete('/about_us/testimonial/card/{id}', [AboutUsController::class, 'deleteTestimonial']);
Route::get('/about_us/testimonial/get_testimonial_data', [AboutUsController::class, 'getTestimonialSectionData']);

//Join Our team
Route::post('/about_us/join-our-team/title-description', [AboutUsController::class, 'JoinOurTeam']);
Route::get('/about_us/join-our-team/title-description', [AboutUsController::class, 'getJoinOurTeamdata']);

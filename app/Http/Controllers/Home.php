<?php

namespace App\Http\Controllers;

use App\Models\AboutUsStatSection;
use App\Models\BannerSection;
use App\Models\BookAppointment;
use App\Models\Consultation;
use App\Models\ConsultingSection;
use App\Models\CarouselItem;
use App\Models\ClientLogo;
use App\Models\CtaSection;
use App\Models\Expertise;
use App\Models\ExpertiseCard;
use App\Models\ExpertiseSliderItem;
use App\Models\IndustriesTi;
use App\Models\IndustriesTitleDes;
use App\Models\OurDevelopment;
use App\Models\WebServiceInfacts;
use App\Models\WebServicesCards;
use App\Models\WeWorkWith;
use App\Models\weWorkWithTitle_des;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Home extends Controller
{

  //************* Banner Section ********************
  public function homeview(){
    $bannerSecData = BannerSection::latest()->first();
    $carouselItems = CarouselItem::all();
    return view("pages.home", compact('bannerSecData', 'carouselItems'));

  }

  public function CreateBannerSection()
  {
    $bannerSecData = BannerSection::latest()->first();
    $carouselItems = CarouselItem::all();
    return view("DashboardSection.HomeSection.BannerSection.CreateBannerSec", compact('bannerSecData','carouselItems'));
  }

  public function getBannerSecData()
  {
    $bannerSecData = BannerSection::latest()->first();
    return response()->json($bannerSecData);
  }

  public function storeBanner(Request $request)
  {
    $validatedData = $request->validate([
        'title' => 'required|string',
        'blinkingText' => 'required|string',
        'description' => 'required|string',
        'buttonText' => 'required|string',
        'backgroundImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'imageAlt' => 'required|string|max:255',
    ]);

    // Handle blinkingText conversion
    $validatedData['blinkingText'] = array_map('trim', explode(',', $validatedData['blinkingText']));

    // Find the existing banner
    $banner = BannerSection::first();

    // Handle file upload
    if ($request->hasFile('backgroundImage')) {
        $path = $request->file('backgroundImage')->store('banner_images', 'public');
        $validatedData['backgroundImage'] = $path;
    }

    if ($banner) {
        // Update existing banner
        $banner->update($validatedData);
        return redirect(route('banner.create-banner-section'))->with("success", "Updated Successfully.");
    } else {
        // Create new banner
        $banner = BannerSection::create($validatedData);
        return redirect(route('banner.create-banner-section'))->with("success", "Created Successfully.");
    }
  }

  // Fetch all Carousel Items
  public function getCarouselItems()
  {
    $carouselItems = CarouselItem::all();
    return response()->json($carouselItems);
  }


  // POST Request - Replace Carousel Items
  public function postCarouselItem(Request $request)
  {
    $request->validate([
      'title' => 'required|string',
    ]);

    // Split the input by commas and trim spaces
    $titles = array_map('trim', explode(',', $request->title));

    // Delete all existing data
    CarouselItem::truncate(); // ⚠️ This will remove all previous records

    // Insert new data
    foreach ($titles as $title) {
      if (!empty($title)) {
        CarouselItem::create(['title' => $title]);
      }
    }

    return redirect()->back()->with('success', 'Carousel items updated successfully.');
  }

  //**************************Who we are Section************************** */
  public function CreateSection(){
    $data = AboutUsStatSection::first();
    return view("DashboardSection.HomeSection.WhoWeAre.createWhoWeAre", compact('data'));
  }
  //Industries

  public function CreateIndustries()
  {
    $titleDes = IndustriesTitleDes::first();
    $cardData = IndustriesTi::all();
    return view("DashboardSection.HomeSection.Industries.CreateIndustries", compact('titleDes', 'cardData'));
  }
  public function CreateCard()
  {
    return view("DashboardSection.HomeSection.Industries.CreateCard");
  }
  public function UpdateIndustriesCard($id)
  {
    $card = IndustriesTi::find($id);
    return view("DashboardSection.HomeSection.Industries.CreateCard",compact('card'));
  }
  //We work with view 
  public function WeWorkWith()
  {
    $WeWorkTitle_des = weWorkWithTitle_des::first();
    $cardData_weWork = WeWorkWith::all();
    return view("DashboardSection.HomeSection.WeWorkWithSection.CreateSection", compact('WeWorkTitle_des', 'cardData_weWork'));
  }
  public function CreateWeWorkWithCard()
  {
    return view("DashboardSection.HomeSection.WeWorkWithSection.CreateCard");
  }
  public function UpdateWeWorkWithsCard($id)
  {
    $card = WeWorkWith::find($id);
    return view("DashboardSection.HomeSection.WeWorkWithSection.CreateCard", compact('card'));
  }



  //************* Consulting Section ****************

  public function enquiryTable()
  {
    $consultations = Consultation::latest()->get(); // Fetch all consultations, latest first
    return view('DashboardSection.HomeSection.Consulting.EnquiryTable', compact('consultations'));
  }

  public function consultantdata()
  {
    $formData = ConsultingSection::latest()->first(); // Get the latest single row
    return view('DashboardSection.HomeSection.Consulting.CreateConsultantData', compact('formData'));
  }

  public function CreateEnquiry(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'fullName'  => 'required|string|max:255',
      'email'     => 'required|email|max:255',
      'phone'     => 'required|string|max:20',
      'helpTopic' => 'required|string',
      'message'   => 'nullable|string',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => 'error',
        'errors' => $validator->errors()
      ], 422);
    }

    // Create a new consultation record in the database
    Consultation::create($request->only([
      'fullName',
      'email',
      'phone',
      'helpTopic',
      'message'
    ]));

    return response()->json([
      'status'  => 'success',
      'message' => 'Form submitted and saved successfully.'
    ], 200);
  }

  public function CreateConsultentSection(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string',
      'description' => 'required|string',
      'points' => 'required|array|min:2',
      'points.*.title' => 'required|string',
      'points.*.description' => 'required|string',
      'dropdown_options' => 'required|array',
    ]);

    // Ensure there is only one record in the database
    $consulting = ConsultingSection::first(); // Get the first record

    if ($consulting) {
      // Update existing record
      $consulting->update($validated);
      return redirect(route('consultations.consultantdata'))->with("success", "Update Successfully.");
    } else {
      // Create new record if none exists
      $consulting = ConsultingSection::create($validated);
      return redirect(route('consultations.consultantdata'))->with("success", "New record created successfully.");
    }
  }

  public function GetConsultentSection()
  {
    return response()->json(ConsultingSection::all());
  }

  //************* Our Development Section ****************

  public function OurDevelopmentView()
  {
    $ourDevelopmentData = OurDevelopment::all();
    return view('DashboardSection.HomeSection.OurDevelopment.CreateDevelopment', compact('ourDevelopmentData'));
  }
  public function getOurDevelopmentData()
  {
    return response()->json(OurDevelopment::all(), 200);
  }
  public function storeOurDevelopmentData(Request $request)
  {
    $request->validate([
      'section_id' => 'required|string|unique:our_developments,section_id',
      'title' => 'required|string',
      'bg_color' => 'required|string',
      'content' => 'required|string',
    ]);

    $data = OurDevelopment::create([
      'section_id' => $request->section_id,
      'title' => $request->title,
      'bg_color' => $request->bg_color,
      'content' => $request->content,
    ]);

    return response()->json([
      'message' => 'Data stored successfully!',
      'data' => $data
    ], 201);
  }
  public function CreateOurDevelopmentView()
  {
    return view('DashboardSection.HomeSection.OurDevelopment.Form');
  }
  public function editOurDevelopmentData($section_id)
  {
    $ourDevelopmentData = OurDevelopment::where('id', $section_id)->first();
    if (!$ourDevelopmentData) {
      return redirect()->back()->with('error', 'No data found for this section ID.');
    }
    return view('DashboardSection.HomeSection.OurDevelopment.Form', compact('ourDevelopmentData'));
  }
  public function updateOurDevelopmentData(Request $request, $id)
  {
    $request->validate([
      'section_id' => 'required|string',
      'title' => 'required|string',
      'bg_color' => 'required|string',
      'content' => 'required|string',
    ]);

    $ourDevelopmentData = OurDevelopment::find($id);
    if (!$ourDevelopmentData) {
      return redirect()->back()->with('error', 'No data found for this section ID.');
    }

    $ourDevelopmentData->section_id = $request->section_id;
    $ourDevelopmentData->title = $request->title;
    $ourDevelopmentData->bg_color = $request->bg_color;
    $ourDevelopmentData->content = $request->content;
    $ourDevelopmentData->save();

    return redirect()->route('banner.OurDevelopmentView')->with('success', 'Data updated successfully!');
  }
  public function deleteOurDevelopmentData($id)
  {
    $ourDevelopmentData = OurDevelopment::find($id);
    if (!$ourDevelopmentData) {
      return redirect()->back()->with('error', 'No data found for this section ID.');
    }
    $ourDevelopmentData->delete();
    return redirect()->route('banner.OurDevelopmentView')->with('success', 'Data deleted successfully!');
  }

  //************************** Expertise Section ********************************

  //post the slider data

  public function postExpertiseSliderData(Request $request)
  {
    $validatedData = $request->validate([
      'label' => 'required|string',
      'description' => 'required|string',
      'backgroundColor' => 'required|string',
      'expertiseArea' => 'required|string',
      'yearsOfExperience' => 'required|string',
      'keyProjects' => 'required|array',
      'teamMembers' => 'required|array',
    ]);

    ExpertiseSliderItem::create([
      'label' => $validatedData['label'],
      'description' => $validatedData['description'],
      'background_color' => $validatedData['backgroundColor'],
      'expertise_area' => $validatedData['expertiseArea'],
      'years_of_experience' => $validatedData['yearsOfExperience'],
      'key_projects' => $validatedData['keyProjects'],
      'team_members' => $validatedData['teamMembers'],
    ]);

    return response()->json([
      'message' => 'Slider item saved successfully',
      'data' => $validatedData,
    ], 201);
  }

  //Get the sliders data
  public function getExpertiseSliderData()
  {
    $expertiseData = ExpertiseSliderItem::all();
    return response()->json($expertiseData);
  }
  //delete the slider data
  public function deleteExpertiseSliderData($id)
  {
    $expertiseData = ExpertiseSliderItem::find($id);
    if ($expertiseData) {
      $expertiseData->delete();
      return response()->json(['message' => 'Expertise data deleted successfully.'], 200);
    }
    return response()->json(['message' => 'Expertise data not found.'], 404);
  }

  //edit the slider data
  public function updateExpertiseSlidersData(Request $request, $id)
  {
    $validatedData = $request->validate([
      'label' => 'required|string',
      'description' => 'required|string',
      'backgroundColor' => 'required|string',
      'expertiseArea' => 'required|string',
      'yearsOfExperience' => 'required|string',
      'keyProjects' => 'required|array',
      'teamMembers' => 'required|array',
    ]);

    $expertiseData = ExpertiseSliderItem::find($id);
    if (!$expertiseData) {
      return response()->json(['message' => 'Expertise data not found.'], 404);
    }
    // Map the validated data to the corresponding database column names.
    $expertiseData->label = $validatedData['label'];
    $expertiseData->description = $validatedData['description'];
    $expertiseData->background_color = $validatedData['backgroundColor'];
    $expertiseData->expertise_area = $validatedData['expertiseArea'];
    $expertiseData->years_of_experience = $validatedData['yearsOfExperience'];
    $expertiseData->key_projects = $validatedData['keyProjects'];
    $expertiseData->team_members = $validatedData['teamMembers'];

    $expertiseData->save();

    return response()->json(['message' => 'Expertise data updated successfully.'], 200);
  }

  //************************ Our Client Section *******************************

  public function OurClientView()
  {
    $sliders = ClientLogo::all();
    return view('DashboardSection.HomeSection.ClientSlider.clientview', compact('sliders'));
  }
  public function UpdateOurClientViewCard($id)
  {
    $sliders = ClientLogo::find($id);
    return view('DashboardSection.HomeSection.ClientSlider.form', compact('sliders'));
  }
  public function NewClientCard()
  {
    return view('DashboardSection.HomeSection.ClientSlider.form');
  }

  public function postOurClientData(Request $request)
  {
    $validated = $request->validate([
      'image_path' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
      'alt' => 'required|string|max:255',
    ]);

    if ($request->hasFile('image_path')) {
      $path = $request->file('image_path')->store('client', 'public');
      $validated['image_path'] = $path;
    }
 

    $points = ClientLogo::create($validated);

    return response()->json([
      'message' => 'Logo uploaded successfully',
      "data" => $points,
    ]);
  }
  public function getOurClientData()
  {
    $ourClientData = ClientLogo::all();
    return response()->json($ourClientData);
  }
  public function deleteOurClientData($id)
  {
    $ourClientData = ClientLogo::find($id);
    if ($ourClientData) {
      $ourClientData->delete();
      return response()->json(['message' => 'Client logo deleted successfully.'], 200);
    }
    return response()->json(['message' => 'Client logo not found.'], 404);
  }
  public function updateOurClientData(Request $request, $id)
  {
    try {
      $validated = $request->validate([
        'image_path' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        'alt' => 'required|string|max:255',
      ]);

      $client = ClientLogo::find($id);

      if (!$client) {
        return response()->json([
          'message' => 'Client logo not found.',
        ], 404);
      }

      // Check if a new image is uploaded
      if ($request->hasFile('image_path')) {
        $path = $request->file('image_path')->store('client_logo', 'public');
        $validated['image_path'] = $path;
      }

      $client->update($validated);

      return response()->json([
        'message' => 'Client logo updated successfully.',
        'data' => $client,
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while updating the client logo.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }

  //facts (Second service section)

  ///View section of service 
  public function ViewServicesData()
  {
    $titleDes = WebServiceInfacts::first();
    $cards = WebServicesCards::all();
    return view('DashboardSection.HomeSection.Services.web_services_form', compact('titleDes', 'cards'));
  }
  public function EditViewServicesData($id)
  {
    $card = WebServicesCards::find($id);
    return view('DashboardSection.HomeSection.Services.EditCards', compact('card'));
  }
  public function CreateServiceCard()
  {
    return view('DashboardSection.HomeSection.Services.EditCards');
  }
  public function postSecondServiceData(Request $request)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'services' => 'required|array',
        'services.*' => 'string',
      ]);

      $webService = WebServiceInfacts::first();

      if ($webService) {
        $webService->update($validated);
      } else {
        $webService = WebServiceInfacts::create($validated);
      }

      return response()->json([
        'message' => 'Web service content saved successfully.',
        'data' => $webService,
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while saving.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function postSectionCardsData(Request $request)
  {
    try {
      // Validate input
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'icon' => 'required|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        'icon_alt' => 'required|string',
        'image' => 'required|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        'image_alt' => 'required|string',
      ]);

      // Store icon image
      $iconPath = $request->file('icon')->store('home-service-section/icons', 'public');
      $validated['icon'] = $iconPath;

      // Store main image
      $imagePath = $request->file('image')->store('home-service-section/images', 'public');
      $validated['image'] =$imagePath;

      // Save to database
      $servicedata = WebServicesCards::create($validated);

      // Return success response
      return response()->json([
        'message' => 'Service card saved successfully.',
        'data' => $servicedata,
      ], 201);
    } catch (\Exception $e) {
      // Handle error
      return response()->json([
        'message' => 'Something went wrong while saving the guidelines card.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function getAllSectionCards()
  {
    $cards = WebServicesCards::all();

    return response()->json([
      'message' => 'Web service cards fetched successfully.',
      'data' => $cards,
    ], 200);
  }
  public function getSectionCardById($id)
  {
    $card = WebServicesCards::find($id);

    if (!$card) {
      return response()->json(['message' => 'Card not found.'], 404);
    }

    return response()->json([
      'message' => 'Card fetched successfully.',
      'data' => $card,
    ], 200);
  }
  public function updateSectionCard(Request $request, $id)
  {
    $card = WebServicesCards::find($id);

    if (!$card) {
      return response()->json(['message' => 'Card not found.'], 404);
    }

    $validated = $request->validate([
      'title' => 'sometimes|required|string',
      'description' => 'sometimes|required|string',
      'icon' => 'sometimes|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
      'icon_alt' => 'sometimes|required|string',
      'image' => 'sometimes|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
      'image_alt' => 'sometimes|required|string',
    ]);

    // Update icon if present
    if ($request->hasFile('icon')) {
      $iconPath = $request->file('icon')->store('home-service-section/icons', 'public');
      $validated['icon'] =  $iconPath;
    }

    // Update image if present
    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('home-service-section/images', 'public');
      $validated['image'] =  $imagePath;
    }

    $card->update($validated);

    return response()->json([
      'message' => 'Card updated successfully.',
      'data' => $card,
    ], 200);
  }
  public function deleteSectionCard($id)
  {
    $card = WebServicesCards::find($id);

    if (!$card) {
      return response()->json(['message' => 'Card not found.'], 404);
    }

    $card->delete();

    return response()->json([
      'message' => 'Card deleted successfully.',
    ], 200);
  }
  public function getServicesectionData()
  {
    $titleDes = WebServiceInfacts::first();
    $cards = WebServicesCards::all();

    if ($titleDes) {
      return response()->json([
        'message' => 'Services data retrieved successfully.',
        'data' => [
          'title' => $titleDes->title,
          'description' => $titleDes->description,
          'cards' => $cards,
        ],
      ]);
    } else {
      return response()->json([
        'message' => 'No Step by Step Guidelines data found.',
      ], 404);
    }
  }
  //************************Expertise section new ****************

  //View funtion
  public function ViewExpertiseData()
  {
    $expertise = Expertise::first();
    $card = ExpertiseCard::all();
    return view('DashboardSection.HomeSection.NewExpertiseSection.NewExpertiseSectionView', compact('expertise', 'card'));
  }
  public function EditExpertiseCard($id){
    $card = ExpertiseCard::find($id);
    return view('DashboardSection.HomeSection.NewExpertiseSection.EditCards',compact('card'));
  }
  public function CreateExpertiseCard()
  {
    return view('DashboardSection.HomeSection.NewExpertiseSection.EditCards');
  }

  public function postExpertiseData(Request $request)
  {
    try {

      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'alt' => 'required|string',
      ]);

      $imagePath = $request->file('image')->store('expertise', 'public');
      $validated['image'] = $imagePath;

      $expertise = Expertise::first();

      if ($expertise) {
        $expertise->update($validated);
      } else {
        $expertise = Expertise::create($validated);
      }

      return response()->json([
        'message' => 'Expertise data saved successfully.',
        'data' => $expertise,
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while saving.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function postExpertiseCardsData(Request $request)
  {
    try {
      // Validate input
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'icon' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'alt' => 'required|string',
      ]);

      // Store icon image
      $iconPath = $request->file('icon')->store('expertise/icons', 'public');
      $validated['icon'] = $iconPath;

      // Save to database
      $expertiseCard = ExpertiseCard::create($validated);

      // Return success response
      return response()->json([
        'message' => 'Expertise card saved successfully.',
        'data' => $expertiseCard,
      ], 201);
    } catch (\Exception $e) {
      // Handle error
      return response()->json([
        'message' => 'Something went wrong while saving the guidelines card.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function getExpertiseCardById($id)
  {
    $card = ExpertiseCard::find($id);

    if (!$card) {
      return response()->json(['message' => 'Card not found.'], 404);
    }

    return response()->json([
      'message' => 'Card fetched successfully.',
      'data' => $card,
    ], 200);
  }
  public function updateExpertiseCard(Request $request, $id)
  {
    $card = ExpertiseCard::find($id);

    if (!$card) {
      return response()->json(['message' => 'Card not found.'], 404);
    }

    $validated = $request->validate([
      'title' => 'sometimes|required|string',
      'description' => 'sometimes|required|string',
      'alt' => 'sometimes|required|string',
      'icon' => 'sometimes|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('icon')) {
      $iconPath = $request->file('icon')->store('expertise/icons', 'public');
      $validated['icon'] = $iconPath;
    }

    $card->update($validated);

    return response()->json([
      'message' => 'Card updated successfully.',
      'data' => $card,
    ], 200);
  }
  public function deleteExpertiseCard($id)
  {
    $card = ExpertiseCard::find($id);

    if (!$card) {
      return response()->json(['message' => 'Card not found.'], 404);
    }

    $card->delete();

    return response()->json([
      'message' => 'Card deleted successfully.',
    ], 200);
  }
  public function getExpertiseData()
  {
    $expertise = Expertise::first();
    $cards = ExpertiseCard::all();

    if ($expertise) {
      return response()->json([
        'message' => 'Expertise data retrieved successfully.',
        'data' => [
          'expertise' => $expertise,
          'cards' => $cards,
        ],
      ]);
    } else {
      return response()->json([
        'message' => 'Expertise data not found.',
      ], 404);
    }
  }
  //********************************* We Work with section ***************************

  public function postWeWorkWithTitle_des(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string',
      'description' => 'required|string',
    ]);
    $titleDes = weWorkWithTitle_des::first();

    if ($titleDes) {
      $titleDes->update($validated);
    } else {
      $titleDes = weWorkWithTitle_des::create($validated);
    }

    return response()->json([
      'message' => 'We Work with section Title & Description data saved successfully.',
      'data' => $titleDes,
    ]);
  }

  public function postWeWorkWithData(Request $request)
  {
    try {
      // Convert comma-separated string to array
      $featuresArray = array_map('trim', explode(',', $request->input('features')));
      $request->merge(['features' => $featuresArray]);
      // Validate input
      $validated = $request->validate([
        'tab_name' => 'required|string|unique:we_work_with,tab_name',
        'title' => 'required|string',
        'description' => 'required|string',
        'features' => 'required|array|min:1',
        'features.*' => 'string',
        'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'image_alt' => 'required|string',
        'icon' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'icon_alt' => 'required|string',
      ]);


      // Store image
      $imagePath = $request->file('image')->store('we-work-with/images', 'public');
      $validated['image'] =  $imagePath;

      $imagePath = $request->file('icon')->store('we-work-with/icons', 'public');
      $validated['icon'] = $imagePath;
      // Save as JSON
     // $validated['features'] = json_encode($validated['features']);

      // Store in DB
      $weWorkWith = WeWorkWith::create($validated);

      return response()->json([
        'message' => 'Data saved successfully.',
        'data' => $weWorkWith,
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Failed to save data.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function getWeWorkWithById($id)
  {
    try {
      $data = WeWorkWith::findOrFail($id);
      $data->features = json_decode($data->features);

      return response()->json($data);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Item not found.',
        'error' => $e->getMessage(),
      ], 404);
    }
  }
  public function updateWeWorkWithData(Request $request, $id)
  {
    try {
      // Convert comma-separated string to array
      $featuresArray = array_map('trim', explode(',', $request->input('features')));
      $request->merge(['features' => $featuresArray]);

      $weWorkWith = WeWorkWith::findOrFail($id);

      $validated = $request->validate([
        'tab_name' => 'required|string',
        'title' => 'required|string',
        'description' => 'required|string',
        'features' => 'required|array|min:1',
        'features.*' => 'string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image_alt' => 'nullable|string',
        'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'icon_alt' => 'nullable|string',
      ]);

      if ($request->hasFile('image')) {
        $validated['image'] =$request->file('image')->store('we-work-with/images', 'public');
      } else {
        $validated['image'] = $weWorkWith->image;
      }

      if ($request->hasFile('icon')) {
        $validated['icon'] = $request->file('icon')->store('we-work-with/icons', 'public');
      } else {
        $validated['icon'] = $weWorkWith->icon;
      }

      // $validated['features'] = json_encode($validated['features']);

      $weWorkWith->update($validated);

      return response()->json([
        'message' => 'Data updated successfully.',
        'data' => $weWorkWith,
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Failed to update data.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function deleteWeWorkWithData($id)
  {
    try {
      $weWorkWith = WeWorkWith::findOrFail($id);
      $weWorkWith->delete();

      return response()->json([
        'message' => 'Data deleted successfully.',
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Failed to delete data.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function getWeWorkWithSectionData()
  {
    $workwith_title_des = weWorkWithTitle_des::first();
    $cards = WeWorkWith::all();

    if ($workwith_title_des) {
      return response()->json([
        'message' => 'workwith_title_des data retrieved successfully.',
        'data' => [
          'workwith_title_des' => $workwith_title_des,
          'cards' => $cards,
        ],
      ]);
    } else {
      return response()->json([
        'message' => 'workwith_title_des data not found.',
      ], 404);
    }
  }
  //******************************************* Book appointment *********************************


  //View section 
  public function ViewAppointmentSection()
  {
    $data = BookAppointment::first();
    return view('DashboardSection.HomeSection.BookAppointment.book-appointment', compact('data'));
  }

  public function BookAppointment(Request $request)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        'alt' => 'required|string',
      ]);

      $titleDes = BookAppointment::first();

      if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('book_appointment', 'public');
        $validated['image'] = $imagePath;
      } else {
        $validated['image'] = $titleDes->image ?? null;
      }

      if ($titleDes) {
        $titleDes->update($validated);
      } else {
        $titleDes = BookAppointment::create($validated);
      }

      return response()->json([
        'message' => 'Book appointment content saved successfully.',
        'data' => $titleDes,
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while saving.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }

  public function getBookAppointmentdata()
  {
    $data = BookAppointment::first();
    return response()->json([
      'message' => 'Book appointment content fetched successfully.',
      'data' => $data,
    ], 201);
  }

  //cta swection

  public function CallToAction(Request $request)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'alt' => 'required|string',
      ]);

      $titleDes = CtaSection::first();

      if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('ctasection', 'public');
        $validated['image'] =  $imagePath;
      } else {
        $validated['image'] = $titleDes->image ?? null;
      }

      if ($titleDes) {
        $titleDes->update($validated);
      } else {
        $titleDes = CtaSection::create($validated);
      }

      return response()->json([
        'message' => 'Call to action content saved successfully.',
        'data' => $titleDes,
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while saving.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }

  public function getCallToActiondata()
  {
    $data = CtaSection::first();
    return response()->json([
      'message' => 'Call to action content fetched successfully.',
      'data' => $data,
    ], 201);
  }
}

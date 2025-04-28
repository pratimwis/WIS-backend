<?php

namespace App\Http\Controllers;

use App\Models\AboutUsStatSection;
use App\Models\ClientLogo;
use App\Models\ClientTestimonial;
use App\Models\ClientTestimonialTitleDes;
use App\Models\IndustriesTi;
use App\Models\IndustriesTitleDes;
use App\Models\JoinOurTeam;
use App\Models\OurClienteleTitle_des;
use App\Models\OurVisionMission;
use App\Models\whatWeDoSection;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
  //About Us stat section
    public function postAboutStatData(Request $request){
       $validated = $request->validate([
        'title' => 'required|string',
        'subtitle' => 'nullable|string',
        'description' => 'required|string',
        'stat_1_label' => 'required|string',
        'stat_1_value' => 'required|integer',
        'stat_2_label' => 'required|string',
        'stat_2_value' => 'required|integer',
        'stat_3_label' => 'required|string',
        'stat_3_value' => 'required|integer',
    ]);
    $data = AboutUsStatSection::first();

    if ($data) {
      $data->update($validated);
    } else {
      $data = AboutUsStatSection::create($validated);
    }
    return redirect()
    ->back()
    ->with('success', 'About us stats section updated successfully.');
    }
    public function getAboutStatData(){
    $statData = AboutUsStatSection::all();
    return response()->json([
      'message'=>'About us data fetched successfully.',
      'data'=>$statData
    ]);
      
    }
    //About us vision mission section
    public function postVisionMission(Request $request){
    $validated = $request->validate([
      'vision_title' => 'required|string',
      'vision_description' => 'required|string',
      'mission_title' => 'required|string',
      'mission_description' => 'required|string',
    ]);
    $data = OurVisionMission::first();

    if ($data) {
      $data->update($validated);
    } else {
      $data = OurVisionMission::create($validated);
    }
    return response()->json([
      'message' => 'Vision Mission data saved successfully.',
      'data' => $data
    ]);

    }
  public function getVisionMission()
  {
    $visionMissionData = OurVisionMission::all();
    return response()->json([
      'message' => 'Vision mission data fetched successfully.',
      'data' => $visionMissionData
    ]);
  }

  //What we do section

  public function postWhatweDo(Request $request)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $validated['description'] = $validated['description'] ?? '';
      $path = $request->file('icon')->store('what_we_do', 'public');
      $validated['icon'] = asset('storage/' . $path);

      $data = whatWeDoSection::create($validated);

      return response()->json([
        'message' => 'What we do card saved successfully.',
        'data' => $data,
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while saving.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function updateWhatWeDo(Request $request, $id)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'string',
        'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $whatWeDo = whatWeDoSection::find($id);

      if (!$whatWeDo) {
        return response()->json([
          'message' => 'Record not found.'
        ], 404);
      }

      if ($request->hasFile('icon')) {
        $path = $request->file('icon')->store('what_we_do', 'public');
        $validated['icon'] = asset('storage/' . $path);
      }

      $whatWeDo->update($validated);

      return response()->json([
        'message' => 'What we do card updated successfully.',
        'data' => $whatWeDo,
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while updating.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function deleteWhatWeDo($id)
  {
    try {
      $whatWeDo = whatWeDoSection::findOrFail($id);
      $whatWeDo->delete();

      return response()->json([
        'message' => 'What we do card deleted successfully.',
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while deleting.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function getWhatWeDoSectionData(){
    $Whatwedocards = whatWeDoSection::all();
    return response()->json([
      'message' => 'What we do cards fetched successfully.',
      'data' => $Whatwedocards
    ]);
  }
  //Our Clientele
  public function postOurClienteleData_title_des(Request $request)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
      ]);

      $titleDes = OurClienteleTitle_des::first();

      if ($titleDes) {
        $titleDes->update($validated);
      } else {
        $titleDes = OurClienteleTitle_des::create($validated);
      }

      return response()->json([
        'message' => 'Our Clientele Title & Description data saved successfully.',
        'data' => $titleDes,
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while saving the data.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function getOurClienteleData(){
    $titleDes = OurClienteleTitle_des::first();
    $ourClientData = ClientLogo::all();
    return response()->json([
      'message' => 'Our Clientele data fetched successfully.',
      'data' => [
        'title' => $titleDes->title,
        'description' => $titleDes->description,
        'ourClientData' => $ourClientData,
      ],
    ], 200);

  }

  //Industries We Serve section
  public function postIndustriesData_title_des(Request $request)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
      ]);

      $titleDes = IndustriesTitleDes::first();

      if ($titleDes) {
        $titleDes->update($validated);
      } else {
        $titleDes = IndustriesTitleDes::create($validated);
      }

      return response()->json([
        'message' => 'Our Industries Title & Description data saved successfully.',
        'data' => $titleDes,
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while saving the data.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function postIndustriesData(Request $request)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'icon' => 'required|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        'alt'=>'required|string',
      ]);

      $validated['description'] = $validated['description'] ?? '';
      $path = $request->file('icon')->store('industries', 'public');
      $validated['icon'] = $path;

      $data = IndustriesTi::create($validated);

      return response()->json([
        'message' => 'Industries card saved successfully.',
        'data' => $data,
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while saving.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function updateIndustriesData(Request $request, $id)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'icon' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $validated['description'] = $validated['description'] ?? '';

      $industry = IndustriesTi::find($id);

      if (!$industry) {
        return response()->json([
          'message' => 'Industry card not found.',
        ], 404);
      }

      if ($request->hasFile('icon')) {
        $path = $request->file('icon')->store('industries', 'public');
        $validated['icon'] = asset('storage/' . $path);
      }

      $industry->update($validated);

      return response()->json([
        'message' => 'Industry card updated successfully.',
        'data' => $industry,
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while updating.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function deleteIndustriesData($id)
  {
    try {
      $industry = IndustriesTi::find($id);

      if (!$industry) {
        return response()->json([
          'message' => 'Industry card not found.',
        ], 404);
      }

      $industry->delete();

      return response()->json([
        'message' => 'Industry card deleted successfully.',
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while deleting.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function getOurIndustriesData()
  {
    $titleDes = IndustriesTitleDes::first();
    $CardData = IndustriesTi::all();
    return response()->json([
      'message' => 'Our Clientele data fetched successfully.',
      'data' => [
        'title' => $titleDes->title,
        'description' => $titleDes->description,
        'CardData' => $CardData,
      ],
    ], 200);
  }

  //Testimonial Section
  public function postTestimonial_title_des(Request $request)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
      ]);

      $titleDes = ClientTestimonialTitleDes::first();

      if ($titleDes) {
        $titleDes->update($validated);
      } else {
        $titleDes = ClientTestimonialTitleDes::create($validated);
      }

      return response()->json([
        'message' => 'Client testimonial Title & Description data saved successfully.',
        'data' => $titleDes,
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while saving the data.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function postTestimonial(Request $request)
  {
    try {
      $validated = $request->validate([
        'message' => 'required|string',
        'name' => 'required|string',
        'role'=> 'required|string',
        'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $path = $request->file('icon')->store('Testimonial', 'public');
      $validated['icon'] = asset('storage/' . $path);

      $data = ClientTestimonial::create($validated);

      return response()->json([
        'message' => 'Testimonial card saved successfully.',
        'data' => $data,
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while saving.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function updateTestimonial(Request $request, $id)
  {
    try {
      $validated = $request->validate([
        'message' => 'required|string',
        'name' => 'required|string',
        'role' => 'required|string',
        'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $testimonial = ClientTestimonial::find($id);

      if (!$testimonial) {
        return response()->json([
          'message' => 'Testimonial card not found.',
        ], 404);
      }

      if ($request->hasFile('icon')) {
        $path = $request->file('icon')->store('industries', 'public');
        $validated['icon'] = asset('storage/' . $path);
      }

      $testimonial->update($validated);

      return response()->json([
        'message' => 'Testimonial card updated successfully.',
        'data' => $testimonial,
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while updating.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function deleteTestimonial($id)
  {
    try {
      $industry = ClientTestimonial::find($id);

      if (!$industry) {
        return response()->json([
          'message' => 'Industry card not found.',
        ], 404);
      }

      $industry->delete();

      return response()->json([
        'message' => 'Industry card deleted successfully.',
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while deleting.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function getTestimonialSectionData()
  {
    try {
      $titleDes = ClientTestimonialTitleDes::first();
      $CardData = ClientTestimonial::all();
      return response()->json([
        'message' => 'Our Clientele data fetched successfully.',
        'data' => [
          'title' => $titleDes->title,
          'description' => $titleDes->description,
          'CardData' => $CardData,
        ],
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while fetching.',
        'error' => $e->getMessage(),
      ], 500);
    }
    
  }

  public function JoinOurTeam(Request $request)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
      ]);

      $titleDes = JoinOurTeam::first();

      if ($titleDes) {
        $titleDes->update($validated);
      } else {
        $titleDes = JoinOurTeam::create($validated);
      }

      return response()->json([
        'message' => 'Join Our Team content saved successfully.',
        'data' => $titleDes,
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while saving.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function getJoinOurTeamdata(){
    $data = JoinOurTeam::first();
    return response()->json([
      'message' => 'Join Our Team content fetched successfully.',
      'data' => $data,
    ], 201);
  }
}



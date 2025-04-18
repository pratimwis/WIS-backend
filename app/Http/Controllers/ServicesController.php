<?php

namespace App\Http\Controllers;

use App\Models\DevelopmentService;
use App\Models\Faq;
use App\Models\Performance_brenchmark_points;
use App\Models\Performance_brenchmark_titleDes;
use App\Models\PerformanceBrenchmarkTitleDes;
use App\Models\SolutionsPoints;
use App\Models\SolutionTitleDes;
use App\Models\StepbyStepGuidelines;
use App\Models\StepByStepGuidelinesTitleDes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServicesController extends Controller
{
  // --------------------------------Development Services Section--------------------------------
  public function postDevelopmentServicesData(Request $request)
  {
    $validated = $request->validate([
      'heading' => 'required|string',
      'sub_heading' => 'nullable|string',
      'points' => 'required|array',
      'points.*' => 'required|string',
      'description' => 'required|string',
    ]);
    $service = DevelopmentService::first();

    if ($service) {
      $service->update($validated);
    } else {
      $service = DevelopmentService::create($validated);
    }

    return response()->json([
      'message' => 'Development Services data saved successfully.',
      'data' => $service,
    ]);
  }

  public function getDevelopmentServicesData()
  {
    $service = DevelopmentService::first();

    if ($service) {
      return response()->json([
        'message' => 'Development Services data retrieved successfully.',
        'data' => $service,
      ]);
    } else {
      return response()->json([
        'message' => 'No Development Services data found.',
      ], 404);
    }
  }
  //--------------------------------Performance Benchmarks Section--------------------------------
  public function postPerformanceBenchmarksData_title_des(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string',
      'description' => 'required|string',
    ]);
    $titleDes = PerformanceBrenchmarkTitleDes::first();

    if ($titleDes) {
      $titleDes->update($validated);
    } else {
      $titleDes = PerformanceBrenchmarkTitleDes::create($validated);
    }

    return response()->json([
      'message' => 'Performance Benchmarks Title & Description data saved successfully.',
      'data' => $titleDes,
    ]);
   
  }
  public function add_points(Request $request)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      ]);

      if ($request->hasFile('image')) {
        $path = $request->file('image')->store('benchmark_images', 'public');
        $validated['image'] = asset('storage/' . $path);
      }

      $points = Performance_brenchmark_points::create($validated);

      return response()->json([
        'message' => 'Performance Benchmark data saved successfully.',
        'data' => [
          'point' => $points,
        
        ]
      ]);
    } catch (Exception $e) {
      // Log the exact error and line number
      Log::error('Error in add_points: ' . $e->getMessage() . ' at line ' . $e->getLine());

      return response()->json([
        'message' => 'Something went wrong!',
        'error' => $e->getMessage(),
        'line' => $e->getLine()
      ], 500);
    }
  }
  public function get_points()
  {
    $points = Performance_brenchmark_points::all();

    if ($points->isNotEmpty()) {
      return response()->json([
        'message' => 'Performance Benchmark points retrieved successfully.',
        'data' => $points,
      ]);
    } else {
      return response()->json([
        'message' => 'No Performance Benchmark points found.',
      ], 404);
    }
  }
  public function delete_points($id)
  {
    $point = Performance_brenchmark_points::find($id);

    if ($point) {
      $point->delete();
      return response()->json([
        'message' => 'Performance Benchmark point deleted successfully.',
      ]);
    } else {
      return response()->json([
        'message' => 'Performance Benchmark point not found.',
      ], 404);
    }
  }
  public function update_points(Request $request, $id)
  {
    try {
      $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
      ]);

      $point = Performance_brenchmark_points::find($id);

      if ($point) {
        if ($request->hasFile('image')) {
          $path = $request->file('image')->store('benchmark_images', 'public');
          $validated['image'] = asset('storage/' . $path);
        }

        $point->update($validated);

        return response()->json([
          'message' => 'Performance Benchmark point updated successfully.',
          'data' => $point,
        ]);
      } else {
        return response()->json([
          'message' => 'Performance Benchmark point not found.',
        ], 404);
      }
    } catch (Exception $e) {
      // Log the exact error and line number
      Log::error('Error in update_points: ' . $e->getMessage() . ' at line ' . $e->getLine());

      return response()->json([
        'message' => 'Something went wrong!',
        'error' => $e->getMessage(),
        'line' => $e->getLine()
      ], 500);
    }
  }
  public function get_points_by_id($id)
  {
    $point = Performance_brenchmark_points::find($id);

    if ($point) {
      return response()->json([
        'message' => 'Performance Benchmark point retrieved successfully.',
        'data' => $point,
      ]);
    } else {
      return response()->json([
        'message' => 'Performance Benchmark point not found.',
      ], 404);
    }
  }

  public function getPerformanceBenchmarksData()
  {
    $titleDes = PerformanceBrenchmarkTitleDes::first();
    $points = Performance_brenchmark_points::all();

    if ($titleDes) {
      return response()->json([
        'message' => 'Performance Benchmarks data retrieved successfully.',
        'data' => [
          'title' => $titleDes->title,
          'description' => $titleDes->description,
          'points' => $points,
        ],
      ]);
    } else {
      return response()->json([
        'message' => 'No Performance Benchmarks data found.',
      ], 404);
    }
  }
  //-----------------------------------FAQ Section-----------------------------------
  public function store(Request $request)
  {
    $validated = $request->validate([
      'question' => 'required|string',
      'answer' => 'required|string',
    ]);

    $faq = Faq::create($validated);

    return response()->json([
      'message' => 'FAQ data saved successfully.',
      'data' => $faq,
    ]);
  }
  public function index()
  {
    $faqs = Faq::all();

    if ($faqs->isNotEmpty()) {
      return response()->json([
        'message' => 'FAQ data retrieved successfully.',
        'data' => $faqs,
      ]);
    } else {
      return response()->json([
        'message' => 'No FAQ data found.',
      ], 404);
    }
  }
  public function destroy($id)
  {
    $faq = Faq::find($id);

    if ($faq) {
      $faq->delete();
      return response()->json([
        'message' => 'FAQ data deleted successfully.',
      ]);
    } else {
      return response()->json([
        'message' => 'FAQ data not found.',
      ], 404);
    }
  }
  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'question' => 'required|string',
      'answer' => 'required|string',
    ]);

    $faq = Faq::find($id);

    if ($faq) {
      $faq->update($validated);
      return response()->json([
        'message' => 'FAQ data updated successfully.',
        'data' => $faq,
      ]);
    } else {
      return response()->json([
        'message' => 'FAQ data not found.',
      ], 404);
    }
  }
  //-----------------------------------Solution Section-----------------------------------
  public function postSolutionData_title_des(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string',
      'description' => 'required|string',
    ]);
    $titleDes = SolutionTitleDes::first();

    if ($titleDes) {
      $titleDes->update($validated);
    } else {
      $titleDes = SolutionTitleDes::create($validated);
    }

    return response()->json([
      'message' => 'Solution Section Title & Description data saved successfully.',
      'data' => $titleDes,
    ]);
  }
  public function add_solution_points(Request $request)
  {
    try {
      $validated = $request->validate([
        'description' => 'required|string|max:255',   
      ]);
      $points = SolutionsPoints::create($validated);

      return response()->json([
        'message' => 'Solutions faq points saved successfully.',
        'data' => [
          'point' => $points,

        ]
      ]);
    } catch (Exception $e) {
      Log::error('Error in add_points: ' . $e->getMessage() . ' at line ' . $e->getLine());

      return response()->json([
        'message' => 'Something went wrong!',
        'error' => $e->getMessage(),
        'line' => $e->getLine()
      ], 500);
    }
  }
  public function delete_solutions_points($id) {
    $point = SolutionsPoints::find($id);

    if ($point) {
      $point->delete();
      return response()->json([
        'message' => 'Solutions faq points deleted successfully.',
      ]);
    } else {
      return response()->json([
        'message' => 'Solutions faq points not found.',
      ], 404);
    }
  }
  public function update_solutions_points(Request $request, $id) {
    try {
      $validated = $request->validate([
        'description' => 'required|string|max:255',   
      ]);

      $point = SolutionsPoints::find($id);

      if ($point) {
        $point->update($validated);

        return response()->json([
         'message' => 'Solutions faq points updated successfully.',
          'data' => $point,
        ]);
      } else {
        return response()->json([
         'message' => 'Solutions faq points not found.',
        ], 404);
      }
    } catch (Exception $e) {
      Log::error('Error in update_points: '. $e->getMessage().'at line '. $e->getLine());

      return response()->json([
       'message' => 'Something went wrong!',
        'error' => $e->getMessage(),
        'line' => $e->getLine()
      ], 500);
    }
  }
   
  public function getSolutionsSectionData(){
    $titleDes = SolutionTitleDes::first();
    $points = SolutionsPoints::all();

    if ($titleDes) {
      return response()->json([
       'message' => 'Solutions Section data retrieved successfully.',
        'data' => [
          'title' => $titleDes->title,
          'description' => $titleDes->description,
          'points' => $points,
        ],
      ]);
    } else {
      return response()->json([
       'message' => 'No Solutions Section data found.',
      ], 404);
    }
  }
  // ------------------------------Step By Step Guidelines----------------------------------
  public function postGuidelinesData_title_des()
  {
    $validated = request()->validate([
      'title' => 'required|string',
      'description' => 'required|string',
    ]);
    $titleDes = StepByStepGuidelinesTitleDes::first();
    if ($titleDes) {
      $titleDes->update($validated);
    } else {
      $titleDes = StepByStepGuidelinesTitleDes::create($validated);
    }
    return response()->json([
      'message' => 'Step by Step Guidelines Title & Description data saved successfully.',
      'data' => $titleDes,
    ]);
  }
  public function add_guidelines_cards()
  {
    try {
      $validated = request()->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $path = request()->file('icon')->store('step_by_step_guide_images', 'public');
      $validated['icon'] = asset('storage/' . $path);

      $guideline = StepbyStepGuidelines::create($validated);

      return response()->json([
        'message' => 'Step by Step Guidelines card saved successfully.',
        'data' => $guideline,
      ], 201);
    } catch (\Illuminate\Validation\ValidationException $e) {
      return response()->json([
        'message' => 'Validation failed.',
        'errors' => $e->errors(),
      ], 422);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while saving the guidelines card.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function delete_guidelines_cards($id){
    $guideline = StepbyStepGuidelines::find($id);
    if ($guideline) {
      $guideline->delete();
      return response()->json([
       'message' => 'Step by Step Guidelines card deleted successfully.',
      ], 200);
    } else {
      return response()->json([
       'message' => 'Step by Step Guidelines card not found.',
      ], 404);
    }
  }
 public function update_points_card($id){
  
 }
  public function update_guidelines_cards($id)
  {
    try {
      $guideline = StepbyStepGuidelines::find($id);

      if (!$guideline) {
        return response()->json([
          'message' => 'Step by Step Guidelines card not found.',
        ], 404);
      }

      $validated = request()->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      // Handle optional new icon upload
      if (request()->hasFile('icon')) {
        $path = request()->file('icon')->store('step_by_step_guide_images', 'public');
        $validated['icon'] = asset('storage/' . $path);
      }

      $guideline->update($validated);

      return response()->json([
        'message' => 'Step by Step Guidelines card updated successfully.',
        'data' => $guideline,
      ], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
      return response()->json([
        'message' => 'Validation failed.',
        'errors' => $e->errors(),
      ], 422);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Something went wrong while updating the card.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  public function getGuidelinesSectionData()
  {
    $titleDes = StepByStepGuidelinesTitleDes::first();
    $cards = StepbyStepGuidelines::all();

    if ($titleDes) {
      return response()->json([
        'message' => 'Step by Step Guidelines data retrieved successfully.',
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
  
}

<?php

namespace App\Http\Controllers\Api\v1;
// namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\CreateCourseRequest;
use App\Http\Requests\Courses\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            $courses = CourseResource::collection(Course::all());
            // $courses = CourseResource::collection(
            //     Course::with('teacher', 'category')->get()
            // );

            if ($courses->isEmpty()) {
                return $this->apiResponse(null, 'لا يوجد ايي كرسات', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($courses, 'تم عرض الكرسات بنجاح', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse(null, '$e->getMessage()', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    // {
    //     "name": "2",
    //     "teacher_id": 1,
    //     "catigory_id": 1,
    //     "description": "2",
    //     "start_date": null,
    //     "end_date": null,
    //     "price": "2.00",
    //     "discount": "2.00",
    //     "url_image": "2",
    //     "status": 0
    //   }

    public function store(CreateCourseRequest $request)
    {
        // if ($image = $request->file('image')) {
        //     $path = '/images/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($path, $profileImage);
        //     $request->all()['image_url'] = "$profileImage";
        // }
        try {
            $course = new CourseResource(Course::create($request->validated()));

            return $this->apiResponse($course, 'تم الاضافة بنجاح', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    // public function store(Request $request)
    // {
    //     // $validatedData = Validator($request->all(), [
    //     //     'name' => 'required|string|max:5',
    //     //     'teacher_id' => 'required|exists:teachers,id',
    //     //     'catigory_id' => 'required|exists:catigories,id',
    //     //     'description' => 'required|string',
    //     //     'start_date' => 'nullable|date',
    //     //     'end_date' => 'nullable|date',
    //     //     'price' => 'required|numeric',
    //     //     'discount' => 'required|numeric',
    //     //     'url_image' => 'nullable|string',
    //     //     'status' => 'boolean',
    //     // ]);
    //     // if ($validatedData->fails()) {
    //     //     return $this->apiResponse(null, $validatedData->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    //     // }
    //     try {
    //         $validatedData = $request->validated();
    //         $course = Course::create($validatedData);
    //         return $this->apiResponse($course, 'Course created successfully', Response::HTTP_CREATED);
    //     } catch (ValidationException $e) {
    //         return $this->apiResponse(null, $e->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    //     } catch (\Exception $e) {
    //         return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    public function show($id)
    {
        try {
            $course = new CourseResource(Course::findOrFail($id));
            return $this->apiResponse($course, 'تم عرض الكرس بنجاح', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هذا الكرس غير موود', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateCourseRequest $request, $id)
    {
        // if ($image = $request->file('image')) {
        //     $path = '/images/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($path, $profileImage);
        //     $request->all()['image_url'] = "$profileImage";
        // }else {
        //     unset($request->all()['image_url']);
        // }
        try {
            $course = new CourseResource(Course::findOrFail($id));
            $course->update($request->validated());
            return $this->apiResponse($course, 'تم التعديل بنجاح', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هذا الكرس غير موود', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $course = new CourseResource(Course::findOrFail($id));
            $course->delete();
            return $this->apiResponse($course, 'تم الحذف بنجاح', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هذا الكرس غير موود', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

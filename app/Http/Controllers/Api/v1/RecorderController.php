<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Recorder;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Resources\RecorderResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Records\CreateRecorderRequest;
use App\Http\Requests\Records\UpdateRecorderRequest;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;


class RecorderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $student =  auth('student_api')->user();
            $Recorder = RecorderResource::collection(Recorder::where('student_id', $student->id)->get());

            if ($Recorder->isEmpty()) {
                return $this->apiResponse(null, 'لا يوجد تسجيلات لعرضها', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($Recorder, 'تم عرض التسجيلات بنجاح', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRecorderRequest $request)
    {
        try {

            $course = Course::findOrFail($request->course_id);
            $student =  Student::findOrFail($request->student_id);
            if ($student->recorders()->where('course_id', $course->id)->exists()) {
                return $this->apiResponse(true, 'student  already enrolled in this course', Response::HTTP_OK);
            }
            $Recorder = new RecorderResource(Recorder::create($request->validated()));

            return $this->apiResponse($Recorder, 'تم الاضافة بنجاح', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $Recorder = new RecorderResource(Recorder::findOrFail($id));
            return $this->apiResponse($Recorder, 'تم عرض التسجيل بنجاح', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'لايوجد تسجيل في هذا الكورس', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecorderRequest $request, $id)
    {
        try {
            $Recorder = new RecorderResource(Recorder::findOrFail($id));
            $Recorder->update($request->validated());
            return $this->apiResponse($Recorder, 'تم التعديل بنجاح', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'التسجيل غير موجود', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $Recorder = new RecorderResource(Recorder::findOrFail($id));
            $Recorder->delete();
            return $this->apiResponse($Recorder, 'تم الحذف بنجاح', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, ' التسجل غير موجود', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

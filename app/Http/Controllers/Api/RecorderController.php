<?php

namespace App\Http\Controllers\Api;

use App\Models\Recorder;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Resources\RecorderResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecorderRequest;
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
            $Recorder = RecorderResource::collection(Recorder::all());

            if ($Recorder->isEmpty()) {
                return $this->apiResponse(null, 'No Recorder found', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($Recorder, 'Recorder retrieved successfully', Response::HTTP_OK);
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
    public function store(RecorderRequest $request)
    {
        try {

            $course = Course::findOrFail($request->course_id);
            $student =  Student::findOrFail($request->student_id);
            if ($student->recorders()->where('course_id', $course->id)->exists()) {
                return $this->apiResponse(true, 'student  already enrolled in this course', Response::HTTP_OK);
            }
            $Recorder = new RecorderResource(Recorder::create($request->validated()));

            return $this->apiResponse($Recorder, 'Recorder created successfully', Response::HTTP_CREATED);
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
            return $this->apiResponse($Recorder, 'Recorder retrieved successfully', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'Recorder not found', Response::HTTP_NOT_FOUND);
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
    public function update(RecorderRequest $request, $id)
    {
        try {
            $Recorder = new RecorderResource(Recorder::findOrFail($id));
            $Recorder->update($request->validated());
            return $this->apiResponse($Recorder, 'Recorder updated successfully', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'Recorder not found', Response::HTTP_NOT_FOUND);
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
            return $this->apiResponse($Recorder, 'Recorder deleted successfully', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'Recorder not found', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

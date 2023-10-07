<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\teachers;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $Teacher = TeacherResource::collection(teachers::all());

            if ($Teacher->isEmpty()) {
                return $this->apiResponse(null, 'لا يوجد ايي معلمين لعرضهم', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($Teacher, 'تم العرض ينجاح', Response::HTTP_OK);
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
    public function store(TeacherRequest $request)
    {
        try {
            $Teacher = new TeacherResource(teachers::create($request->validated()));

            return $this->apiResponse($Teacher, 'تم الاضافة بنجاح', Response::HTTP_CREATED);
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
            $Teacher = new TeacherResource(teachers::findOrFail($id));
            return $this->apiResponse($Teacher, 'تم العرض بنجاح', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا المعلم غير موجود', Response::HTTP_NOT_FOUND);
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
    public function update(TeacherRequest $request, $id)
    {
        try {
            $Teacher = new TeacherResource(teachers::findOrFail($id));
            $Teacher->update($request->validated());
            return $this->apiResponse($Teacher, 'تم التعديل بنجاح', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا المعلم غير موجود', Response::HTTP_NOT_FOUND);
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
            $Teacher = new TeacherResource(teachers::findOrFail($id));
            $Teacher->delete();
            return $this->apiResponse($Teacher, 'تم الحذف بنجاح', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا المعلم غير موجود', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

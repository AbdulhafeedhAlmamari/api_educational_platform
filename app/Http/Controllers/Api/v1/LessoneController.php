<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\Lessone;
use App\Http\Resources\LessoneResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Lessones\CreateLessoneRequest;
use App\Http\Requests\Lessones\UpdateLessoneRequest;
use App\Models\Course;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class LessoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            
            $Lessone = LessoneResource::collection(Lessone::all());

            if ($Lessone->isEmpty()) {
                return $this->apiResponse(null, 'لا يوجد ايي دروس لعرضعها', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($Lessone, 'تم عرض الدروس بنجاح', Response::HTTP_OK);
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
    public function store(CreateLessoneRequest $request)
    {
        try {
            $Lessone = new LessoneResource(Lessone::create($request->validated()));

            return $this->apiResponse($Lessone, 'تم الاضافة بنجاح', Response::HTTP_CREATED);
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
            $Lessone = new LessoneResource(Lessone::findOrFail($id));
            return $this->apiResponse($Lessone, 'تم عرض الدرس بنجاح', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا الدرس غير موجود', Response::HTTP_NOT_FOUND);
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
    public function update(UpdateLessoneRequest $request, $id)
    {
        try {
            $Lessone = new LessoneResource(Lessone::findOrFail($id));
            $Lessone->update($request->validated());
            return $this->apiResponse($Lessone, 'تم التعديل بنجاح', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا الدرس غير موجود', Response::HTTP_NOT_FOUND);
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
            $Lessone = new LessoneResource(Lessone::findOrFail($id));
            $Lessone->delete();
            return $this->apiResponse($Lessone, 'تم الحذف بنجاح', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا الدرس غير موجود', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Recorder;
use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Resources\RecorderResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecorderRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


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
                return $this->apiResponse(null, 'لا يوجد ايي سجلات لعرضها', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($Recorder, 'تم عرض السجلات بنجاح', Response::HTTP_OK);
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
            return $this->apiResponse($Recorder, 'تم عرض السجل بنجاح', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا السجل غير موجود', Response::HTTP_NOT_FOUND);
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
            return $this->apiResponse($Recorder, 'تم التعديل بنجاح', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هاذا السجل غير موجود', Response::HTTP_NOT_FOUND);
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
            return $this->apiResponse(null, 'هاذا السجل غير موجود', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

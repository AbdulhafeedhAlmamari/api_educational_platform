<?php

namespace App\Http\Controllers\Api\v1;


use App\Models\Contact;
use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Resources\ContactResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;
    public function index()
    {
        try {
            $Contact = ContactResource::collection(Contact::all());

            if ($Contact->isEmpty()) {
                return $this->apiResponse(null, 'لا يوجد ايي رسايل حتى الان', Response::HTTP_NOT_FOUND);
            }
            return $this->apiResponse($Contact, 'تم عرض الرسايل بنجاح', Response::HTTP_OK);
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
    public function store(ContactRequest $request)
    {
        try {
            $Contact = new ContactResource(Contact::create($request->validated()));

            return $this->apiResponse($Contact, 'تم الاضافة بنجاح', Response::HTTP_CREATED);
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
            $Contact = new ContactResource(Contact::findOrFail($id));
            return $this->apiResponse($Contact, 'تم عرض الرسالة بنجاح', Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هذة الرسالة غير موجودة', Response::HTTP_NOT_FOUND);
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
    public function update(ContactRequest $request, $id)
    {
        try {
            $Contact = new ContactResource(Contact::findOrFail($id));
            $Contact->update($request->validated());
            return $this->apiResponse($Contact, 'تم التعديل بنجاح', Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هذة الرسالة غير موجودة', Response::HTTP_NOT_FOUND);
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
            $Contact = new ContactResource(Contact::findOrFail($id));
            $Contact->delete();
            return $this->apiResponse($Contact, 'تم الحذف بنجاح', Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'هذة الرسالة غير موجودة', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

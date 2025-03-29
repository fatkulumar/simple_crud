<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ResultService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SimpleCrudController extends Controller
{
    use ResultService;
    /**
     * Display a listing of the resource.
     */
    private $model = \App\Models\User::class;
    public function index()
    {
        $datas = $this->model::paginate(10);
        $this->setResult($datas)->setStatus(true)->setMessage('Data Berhasil Ditemukan')->setCode(JsonResponse::HTTP_OK);
        return $this->toJson();
        // return response()->json($datas);
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
    public function store(Request $request)
    {
        $data = $this->model::create($request->all());
        if ($data) {
            $this->setResult($data)->setStatus(true)->setMessage('Data Berhasil Disimpan')->setCode(JsonResponse::HTTP_OK);
        }else{
            $this->setResult($request)->setStatus(true)->setMessage('Data Gagal Disimpan')->setCode(JsonResponse::HTTP_CREATED);
        }
        return $this->toJson();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->model::find($id);
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->model::find($id);
        $data->update($request->all());
        if ($data) {
            $this->setResult($data)->setStatus(true)->setMessage('Data Berhasil Update')->setCode(JsonResponse::HTTP_OK);
        }else{
            $this->setResult($request)->setStatus(true)->setMessage('Data Gagal Update')->setCode(JsonResponse::HTTP_CREATED);
        }
        return $this->toJson();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->model::find($id);
        $data->delete();
        if ($data->delete() == true) {
            $this->setResult($data)->setStatus(true)->setMessage('Data Berhasil Update')->setCode(JsonResponse::HTTP_OK);
        }else{
            $this->setResult($id)->setStatus(true)->setMessage('Data Gagal Update')->setCode(JsonResponse::HTTP_CREATED);
        }
        return $this->toJson();
    }
}

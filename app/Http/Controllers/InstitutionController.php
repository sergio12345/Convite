<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\InstitutionResource;
use Illuminate\Database\QueryException;
use App\Models\Institution;

class InstitutionController extends Controller
{
    public function show()
    {
        $institutions = Institution::whereNull('deleted_at')->get();

        if(!is_null($institutions) && isset($institutions)){
            return response(['data' => new InstitutionResource($institutions)], 200);
        }

        return response(['institution' => 'id not found'], 404);
    }

}

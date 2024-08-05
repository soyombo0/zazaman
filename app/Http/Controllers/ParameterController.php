<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParameterRequest;
use App\Http\Requests\UpdateParameterRequest;
use App\Models\Parameter;
use App\Services\ParameterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\error;

class ParameterController extends Controller
{
    public function __construct(
        protected ParameterService $service
    )
    {
    }

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function store(StoreParameterRequest $request)
    {

    }

    public function show(Parameter $parameter)
    {
        //
    }

    public function update(UpdateParameterRequest $request, Parameter $parameter)
    {
        //
    }

    public function destroy(Parameter $parameter)
    {
        //
    }

    public function icon()
    {

    }

    public function storeIcon(Request $request, Parameter $parameter)
    {
        $img = $this->service->storeIcon($request, $parameter);

        return response()->json([
            'message' => 'the icon was successfully uploaded',
            'image' => $img
        ]);
    }

    public function destroyIcon(Request $request, Parameter $parameter)
    {
        $parameter = $this->service->destroyIcon($request, $parameter);

        return response()->json([
           'message' => 'the icon was deleted',
           'parameter' => $parameter
        ]);
    }

    public function storeIconGray(Request $request, Parameter $parameter)
    {
        $img = $this->service->storeIconGray($request, $parameter);

        return response()->json([
            'message' => 'the icon gray was successfully uploaded',
            'image' => $img
        ]);
    }

    public function destroyIconGray(Request $request, Parameter $parameter)
    {
        $parameter = $this->service->destroyIconGray($request, $parameter);

        return response()->json([
            'message' => 'the icon was deleted',
            'parameter' => $parameter
        ]);
    }
}

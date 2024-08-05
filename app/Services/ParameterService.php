<?php

namespace App\Services;

use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParameterService
{
    public function index(Request $request)
    {
        $parameters = Parameter::query()
            ->where('type', 2)
            ->when($request['id'], function ($q) use ($request) {
                $q->find($request['id']);
            })
            ->when($request['title'], function ($q) use ($request) {
                $q->where('title', $request['title']);
            })
            ->get();

        return $parameters;
    }

    public function storeIcon(Request $request, Parameter $parameter)
    {
        if ($parameter->type == '2') {
            $data = $request->validate([
                'image' => ['file', 'required']
            ]);
            $cloudPath = '/' . $parameter->id . '-parameter-icon';
            $originalName = $request->file('image')->getClientOriginalName();
            $storePath = config('image.directory') . $cloudPath . '/';

            Storage::cloud()->deleteDirectory(config('image.directory') . $cloudPath);

            $img = Storage::cloud()->putFileAs($storePath, $data['image'], $originalName);
            $path = Storage::cloud()->url($img);

            $parameter->icon = $path;
            $parameter->save();

            return $path;
        } else {
            return 'parameters type is not 2';
        }
    }

    public function destroyIcon(Request $request, Parameter $parameter)
    {
        $cloudPath = '/' . $parameter->id . '-parameter-icon';
        Storage::cloud()->deleteDirectory(config('image.directory') . $cloudPath);

        $parameter->icon = null;
        $parameter->save();

        return $parameter;
    }

    public function storeIconGray(Request $request, Parameter $parameter)
    {
        if ($parameter->type == '2') {
            $data = $request->validate([
                'image' => ['file', 'required']
            ]);
            $cloudPath = '/' . $parameter->id . '-parameter-icon-gray';

            Storage::cloud()->deleteDirectory(config('image.directory') . $cloudPath);

            $img = Storage::cloud()->put(config('image.directory') . $cloudPath, $data['image']);
            $path = Storage::cloud()->url($img);

            $parameter->icon_gray = $path;
            $parameter->save();

            return $path;
        } else {
            return 'parameters type is not 2';
        }
    }

    public function destroyIconGray(Request $request, Parameter $parameter)
    {
        $cloudPath = '/' . $parameter->id . '-parameter-icon-gray';
        Storage::cloud()->deleteDirectory(config('image.directory') . $cloudPath);

        $parameter->icon = null;
        $parameter->save();

        return $parameter;
    }
}

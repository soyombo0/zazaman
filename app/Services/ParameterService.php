<?php

namespace App\Services;

use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\error;

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
        if ($parameter->type !== 2) {
            throw new \Exception('parameters type is not 2');
        }

        $data = $request->validate([
            'image' => ['file', 'required']
        ]);
        $cloudPath = '/' . $parameter->id . '-parameter-icon';
        $originalName = $request->file('image')->getClientOriginalName();
        $originalSlug = str_slug(explode('.', $originalName)[0]);
        $storePath = config('image.directory') . $cloudPath;

        Storage::cloud()->deleteDirectory(config('image.directory') . $cloudPath);

        $img = Storage::cloud()->putFileAs($storePath, $data['image'], $originalSlug  . '.' .  $request->file('image')->extension());

        $parameter->icon_path = $img;
        $parameter->icon = $originalSlug;
        $parameter->save();

        return $parameter;
    }

    public function destroyIcon(Request $request, Parameter $parameter)
    {
        $cloudPath = '/' . $parameter->id . '-parameter-icon';
        Storage::cloud()->deleteDirectory(config('image.directory') . $cloudPath);

        $parameter->icon = null;
        $parameter->icon_path = null;
        $parameter->save();

        return $parameter;
    }

    public function storeIconGray(Request $request, Parameter $parameter)
    {
        if ($parameter->type !== 2) {
            throw new \Exception('parameters type is not 2');
        }
        $data = $request->validate([
            'image' => ['file', 'required']
        ]);
        $cloudPath = '/' . $parameter->id . '-parameter-icon-gray';
        $originalName = $request->file('image')->getClientOriginalName();
        $originalSlug = str_slug(explode('.', $originalName)[0]);
        $storePath = config('image.directory') . $cloudPath;

        Storage::cloud()->deleteDirectory(config('image.directory') . $cloudPath);
        $img = Storage::cloud()->putFileAs($storePath, $data['image'], $originalSlug  . '.' .  $request->file('image')->extension());

        $parameter->icon_gray_path = $img;
        $parameter->icon_gray = $originalSlug;
        $parameter->save();

        return $parameter;
    }

    public function destroyIconGray(Request $request, Parameter $parameter)
    {
        $cloudPath = '/' . $parameter->id . '-parameter-icon-gray';
        Storage::cloud()->deleteDirectory(config('image.directory') . $cloudPath);

        $parameter->icon_gray = null;
        $parameter->icon_gray_path = null;
        $parameter->save();

        return $parameter;
    }
}

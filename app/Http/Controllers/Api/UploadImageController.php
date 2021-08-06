<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $base64_image = $request->image;
        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $data = substr($base64_image, strpos($base64_image, ',') + 1);

            $data = base64_decode($data);
            Storage::disk('local')->put("test.png", $data);

            $finalSize = 500;
            $img = Image::make(storage_path('app/test.png'));
            $width = $img->width();
            $height = $img->height();
            if ($width > $height) {
                $cropSize = $height;
                $cropCoordinate = ($width - $cropSize) / 2;
                $img->crop($cropSize, $cropSize, $cropCoordinate, 0);
                $img->resize($finalSize, $finalSize);
            } else if ($width < $height) {
                $cropSize = $width;
                $cropCoordinate = ($height - $cropSize) / 2;
                $img->crop($cropSize, $cropSize, 0, $cropCoordinate);
                $img->resize($finalSize, $finalSize);
            } else {
                $cropSize = $width / 2; //crop 1/2 of images
                $cropCoordinate = ($width - $cropSize) / 2;
                $img->crop($cropSize, $cropSize, $cropCoordinate, $cropCoordinate);
                $img->resize($finalSize, $finalSize);
            }

            $newImgName = Str::random(8);
            $img->save(storage_path('app/public/' . $newImgName . '.png'));
        }
        return [
            'url' => asset('storage/' . $newImgName . '.png')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

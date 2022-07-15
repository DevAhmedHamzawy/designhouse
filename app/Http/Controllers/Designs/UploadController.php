<?php

namespace App\Http\Controllers\Designs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\UploadImage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $this->validate($request, [
            'image' => ['required', 'mimes:png,jpeg,gif,bmp', 'max:2048']
        ]);

        // get the image
        $image = $request->file('image');
        $image_path = $image->getPathname();
        
        // get the original file name and replace any spaces with _
        // Business card.png = timestamp()_business_card.png

        $filename = time()."_".preg_replace('/\$+/', '_', strtolower($image->getClientOriginalName()));

        // move the image to the temporary location (tmp)
        $tmp = $image->storeAs('uploads/original', $filename, 'tmp');

        // create the database record for design
        $design = auth()->user()->designs()->create([
            'image' => $filename,
            'disk' => config('site.upload_disk')
        ]);


        // dispatch a job to handle image manipulation
        $this->dispatch(new UploadImage($design));

        return response()->json($design, 200);



    }
}

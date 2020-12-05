<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\BannerImage;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function bannerImage(Request $request)
    {
        $option['menu'] = 'banner';

        if ($request->isMethod('POST')) {

            $this->validate($request, [
                'banner_image' => 'required|mimes:jpg,png,jpeg,gif,bmp|nullable'
            ]);

            $bannerImage = new BannerImage();
            if (isset($request->banner_image)) {
                $bannerImage->title = uploadImage($request->banner_image, 'public/admin/images/uploads/banners');
            }
            $bannerImage->status = 'inactive';
            if ($bannerImage->save()) {
                return redirect()->back()->with('success', 'Banner image uploaded successfully.');
            }
            return redirect()->back()->with('error', 'Banner image not uploaded.');
        }

        $option['activeBannerImage']  = BannerImage::where(['status' => 'active'])->first(['id', 'title', 'status']);
        $option['bannerImages'] = BannerImage::get(['id', 'title', 'status']);

        return view('admin.banner.banner_image', $option);
    }

    public function activateBannerImage($id)
    {
        $oldActiveImage = BannerImage::where(['status' => 'active'])->first(['id', 'status']);
        if (!empty($oldActiveImage)) {
            $oldActiveImage->status = 'inactive';
            $oldActiveImage->save();
        }
   
        if (BannerImage::where(['id' => $id])->update(['status' => 'active'])) {
            return redirect('banner-image')->with('success', 'Image activated successfully.');
        }
    }

    public function deleteBannerImage($id)
    {
        $bannerImage = BannerImage::find($id, ['id', 'title', 'status']);

        if (!empty($bannerImage)) {
            if ($bannerImage->status == 'active') {
                return redirect('banner-image')->with('error', 'Active Banner Image can\'t be deleted.'); 
            } else {
                if ($bannerImage->delete()) {
                    $imagePath = 'public/admin/images/uploads/banners/' . $bannerImage->title;
                    if (file_exists($imagePath)) {
                        @unlink($imagePath);
                        return redirect('banner-image')->with('success', 'Banner Image deleted successfully.');
                    }
                }
            }
        } else {
            return redirect('banner-image')->with('error', 'Banner Image not found.');
        }
        
    }
}



<?php

use App\Model\BannerImage;
use App\Model\Page;
use Intervention\Image\Facades\Image;

function getPages()
{
	$pages = Page::where('status', 'active')->get();
	if (empty($pages)) {
		return null;
	}
	return $pages;
}

function excerpt(string $content, int $limit = 25)
{
	if (strlen($content) > $limit) {
        return substr_replace($content, "..", $limit);
    } else {
        return $content;
    }
}


/**
 * Method uploadImage
 *
 * @param $file $file [explicite description]
 * @param $location $location [explicite description]
 * @param $size $size [explicite description]
 * @param $old $old [explicite description]
 * @param $thumb $thumb [explicite description]
 *
 * @return void
 */
function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if (!empty($old)) {
        removeFile($location . '/' . $old);
        removeFile($location . '/thumb_' . $old);
    }

    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $image    = Image::make($file);

    if (!empty($size)) {
        $size = explode('x', strtolower($size));
        $image->resize($size[0], $size[1]);
    }
    $image->save($location . '/' . $filename);

    if (!empty($thumb)) {
        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1], function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($location . '/thumb_' . $filename);

    }

    return $filename;
}

function makeDirectory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}

function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

function getBannerImage()
{
    $bannerImage = BannerImage::where(['status' => 'active'])->first(['title']);
    if (!empty($bannerImage)) {
        return $bannerImage->title;
    }
}

function menuActive($routeName, $type = null)
{
    if ($type == 1) {
        $class = 'menu--open';

    } elseif($type == 2) {
        $class = 'active';
    }
    if (is_array($routeName)) {
        foreach ($routeName as $key => $value) {
            if (request()->routeIs($value)) {
                return $class;
            }
        }
    } elseif (request()->routeIs($routeName)) {
        return $class;
    }
}

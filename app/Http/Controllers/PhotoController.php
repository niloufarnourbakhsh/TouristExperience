<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;

class PhotoController extends Controller
{

    public function delete(Photo $photo)
    {
        //check how many photos the post have
        //if is less than 1 it can not be deleted
        $post = $photo->post;
        if (count($post->photos) > 1) {
            if ($photo) {
                Storage::disk('public')->delete($photo->file);
            }
            $photo->delete();
            Session::flash('photo_deleted', 'تصویر مورد نظر حذف شد');
            return back();
        }
        Session::flash('photo_deleted', 'متاسفانه تعداد عکسای موجود فقط یکی است و شما قادر به پاک کردن تصویر نیستید');
        return back();
    }
}

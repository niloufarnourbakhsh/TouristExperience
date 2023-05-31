<?php
/**
 * Created by PhpStorm.
 * User: N.Nourbakhsh
 * Date: 12/23/2020
 * Time: 7:17 PM
 */

namespace App\Listeners;


use App\Events\PostCreate;
use App\Events\PostDelete;
use App\Events\PostUpdate;
use App\Models\Photo;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class PostEventSubscribe
{

    public function subscribe(Dispatcher $events){
        $events->listen(PostCreate::class,'App\Listeners\PostEventSubscribe@createImagePart');
        $events->listen(PostUpdate::class,'\App\Listeners\PostEventSubscribe@editImagePart');
        $events->listen(PostDelete::class,'\App\Listeners\PostEventSubscribe@deleteImagePart');

    }
    public function createImagePart(PostCreate $event)
    {

        $images=$event->getImages();
        foreach($images as $image){
            $path=Storage::disk('public')->put('images',$image);
            Photo::create(['file'=>$path,'post_id'=>$event->getPost()->id]);
        }


    }

    public function editImagePart(PostUpdate $event)
    {
        $post=$event->getPost();
        if ($event->getImages()){
            foreach ($event->getImages() as $image){
                $path=Storage::disk('public')->put('images',$image);
                $post->photos()->create(['file'=>$path,'post_id',$event->getPost()->id]);
            }
        }
    }


    public function deleteImagePart(PostDelete $event)
    {
        $post=$event->getPost();
        foreach ($post->photos as $photo){
            $fileName=$photo->file;
            Storage::disk('public')->delete($fileName);
        }

    }

}

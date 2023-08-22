<?php
namespace App\Repositories;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaRepository extends Repository
{
    public function model()
    {
        return Media::class;
    }
    public function storeByRequest(UploadedFile $file, string $path, string $type = null): Media
    {
        $path = Storage::put('/'. trim($path, '/'), $file, 'public');
        $extension = $file->extension();
        if(!$type){
            $type = in_array($extension, ['jpg', 'png', 'jpeg', 'gif']) ? 'image' : $extension;
        }

        return $this->create([
            'type' => $type,
            'src' =>  $path,
        ]);
    }

    public function updateByRequest(UploadedFile $file,string $path, string $type = null, Media $media): Media
    {
        $path = Storage::put('/'. trim($path, '/'), $file, 'public');
        $extension = $file->extension();
        if(!$type){
            $type = in_array($extension, ['jpg', 'png', 'jpeg', 'gif']) ? 'image' : $extension;
        }

        if(Storage::exists($media->src)){
            Storage::delete($media->src);
        }

        $media->update([
            'type' => $type,
            'src' =>  $path,
        ]);
        return $media;
    }

    public function updateOrCreateByRequest(UploadedFile $file, string $path, string $type = null, $media = null): Media
    {
        $src = Storage::put('/'.trim($path, '/'), $file, 'public');
        if ($media && Storage::exists($media->src)) {
            Storage::delete($media->src);
        }
        $extension = $file->extension();
        if(!$type){
            $type = in_array($extension, ['jpg', 'png', 'jpeg', 'gif']) ? 'Image' : $extension;
        }
        return $this->query()->updateOrCreate([
            'id' => $media?->id ?? 0,
        ], [
            'type' => $type,
            'src' => $src,
            'extension' => $extension,
            'path' => $path,
        ]);
    }
}

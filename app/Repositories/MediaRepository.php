<?php

namespace App\Repositories;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaRepository extends Repository
{
    /**
     * A description of the entire PHP function.
     *
     * @return Media::class
     */
    public static function model()
    {
        return Media::class;
    }
    /**
     * A description of the entire PHP function.
     *
     * @param UploadedFile $file description
     * @param string $path description
     * @param string|null $type description
     * @return Media
     */
    public static function storeByRequest(UploadedFile $file, string $path, string $type = null): Media
    {
        $path = Storage::put('/' . trim($path, '/'), $file, 'public');
        $extension = $file->extension();
        if (!$type) {
            $type = in_array($extension, ['jpg', 'png', 'jpeg', 'gif']) ? 'Image' : $extension;
        }

        return self::create([
            'type' => $type,
            'src' =>  $path,
        ]);
    }
    /**
     * Update a media file based on the provided request.
     *
     * @param UploadedFile $file The file to be updated
     * @param string $path The path of the file
     * @param string|null $type The type of the file
     * @param Media $media The media object to be updated
     * @return Media The updated media object
     */
    public static function updateByRequest(UploadedFile $file, string $path, string $type = null, Media $media): Media
    {
        $path = Storage::put('/' . trim($path, '/'), $file, 'public');
        $extension = $file->extension();
        if (!$type) {
            $type = in_array($extension, ['jpg', 'png', 'jpeg', 'gif']) ? 'Image' : $extension;
        }

        if (Storage::exists($media->src)) {
            Storage::delete($media->src);
        }

        self::update($media, [
            'type' => $type,
            'src' =>  $path,
        ]);
        return $media;
    }
    /**
     * Updates or creates a media object based on the provided file, path, type, and media.
     *
     * @param UploadedFile $file The uploaded file.
     * @param string $path The path where the file will be stored.
     * @param string|null $type The type of the media (optional).
     * @param mixed|null $media The existing media object (optional).
     * @return Media The updated or created media object.
     */
    public static function updateOrCreateByRequest(UploadedFile $file, string $path, string $type = null, $media = null): Media
    {
        $src = Storage::put('/' . trim($path, '/'), $file, 'public');
        if ($media && Storage::exists($media->src)) {
            Storage::delete($media->src);
        }
        $extension = $file->extension();
        if (!$type) {
            $type = in_array($extension, ['jpg', 'png', 'jpeg', 'gif']) ? 'Image' : $extension;
        }
        return self::query()->updateOrCreate([
            'id' => $media?->id ?? 0,
        ], [
            'type' => $type,
            'src' => $src,
            'extension' => $extension,
            'path' => $path,
        ]);
    }
}

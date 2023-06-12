<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ImageService
{
    public function store(UploadedFile $file, Model $model, string $type = 'default'): ?Image
    {
        return $this->storeImage($file, $model->getTable(), $model->getKey(), $type);
    }

    public function storeImage(
        UploadedFile $file,
        string $table,
        int|string $id,
        string $type = 'default'
    ): ?Image {
        $path = \Storage::disk('public')->putFile("$table/$id", $file);

        if (!$path) {
            return null;
        }

        return Image::create([
            'imageable_type' => $table,
            'imageable_id' => $id,
            'type' => $type,
            'url' => asset("storage/$path"),
            'path' => $path,
            'size' => $file->getSize(),
            'filename' => $file->getFilename(),
            'extension' => $file->getExtension(),
        ]);
    }

    public function deleteImage(int|string $id, int|string $imageableId, string $imageableType)
    {
        $image = Image::where('imageable_id', $imageableId)
            ->where('imageable_type', $imageableType)
            ->findOrFail($id);

        if ($image->path) {
            \Storage::disk('public')->delete($image->path);
        }

        return $image->delete();
    }
}


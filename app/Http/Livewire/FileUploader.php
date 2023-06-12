<?php

namespace App\Http\Livewire;

use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class FileUploader extends Component
{
    use WithFileUploads;

    public bool $isLoading = true;

    public ?int $limitUpload = null;

    public ?string $imageType = null;
    public string $sourceId;
    public string $sourceType;
    public string $uploadAsType = 'default';

    public Collection $files;

    public bool $displayingFileSettings = false;
    public ?string $selectedImageId = null;
    public string $selectedImageType = 'default';


    public array $rules = [
        'files.*' => ['file']
    ];

    public function init(): void
    {
        $this->files = Image::where('imageable_type', $this->sourceType)
            ->where('imageable_id', $this->sourceId)
            ->when($this->imageType, fn(Builder $query) => $query->where('type', $this->imageType))
            ->get();

        $this->isLoading = false;
    }

    public function removeUpload($name, $id): void
    {
        (new ImageService())->deleteImage($id, $this->sourceId, $this->sourceType);

        $this->files = $this->files->except($id);
    }

    public function finishUpload($name, $tmpPath, $isMultiple): void
    {
        $imageService = new ImageService();
        foreach (collect($tmpPath) as $path) {
            if (($this->limitUpload ?? 100) <= $this->files->count()) {
                continue;
            }

            $file = TemporaryUploadedFile::createFromLivewire($path);

            $image = $imageService->storeImage($file, $this->sourceType, $this->sourceId, $this->uploadAsType);

            $this->files->push($image);
        }

        $this->emitSelf('upload:finished', $name, $this->files);

        $this->syncInput($name, $this->files);
    }

    public function selectImage($id)
    {
        $this->selectedImageId = $id;

        $image = $this->files->where('id', $this->selectedImageId)->first();

        $this->selectedImageType = $image?->type;
    }

    public function saveImageDetails()
    {
        $image = $this->files->where('id', $this->selectedImageId)->first();

        $image->fill([
            'type' => $this->selectedImageType,
        ])->save();
    }

    public function render()
    {
        $this->files ??= collect();

        return view('livewire.file-uploader');
    }
}

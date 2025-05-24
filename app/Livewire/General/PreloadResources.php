<?php

namespace App\Livewire\General;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Repositories\{
    CharacterRepository,
    CropRepository,
    ExplorationRepository,
    LoanRepository,
    NativeCleaningRepository,
    ProductionRepository,
    ProductRepository,
    StoryRepository
};

class PreloadResources extends Component
{
    public array $resources = [
        'images' => [],
        'audios' => [],
        'jsons'  => [],
        'videos' => [],
    ];

    public function mount(
        CharacterRepository $characters,
        CropRepository $crops,
        ExplorationRepository $explorations,
        LoanRepository $loans,
        NativeCleaningRepository $nativeCleaning,
        ProductionRepository $productions,
        ProductRepository $products,
        StoryRepository $stories
    ) {
        if (Session::get('resources_preloaded', false)) {
            //return redirect()->route('story.events');
        }
        $this->resources['images'] = array_merge(
            $this->extractImages($characters->all()),
            $this->extractImages($crops->all()),
            $this->extractImages($explorations->all()),
            $this->extractImages($loans->all()),
            $this->extractImages($nativeCleaning->all()),
            $this->extractImages($productions->all()),
            $this->extractImages($products->all()),
            $this->extractImages($stories->all())
        );

        Session::put('resources_preloaded', true);
    }

    private function extractImages($items): array
    {
        $images = [];

        foreach ($items as $item) {
            if (!empty($item->images) && is_array($item->images)) {
                foreach ($item->images as $img) {
                    if ($img) {
                        $images[] = $img;
                    }
                }
            }

            foreach (['front_square', 'side_square', 'front_partial', 'side_partial', 'front_full', 'side_full'] as $key) {
                if (!empty($item->$key)) {
                    $images[] = $item->$key;
                }
            }
        }

        return array_unique($images);
    }

    public function render()
    {
        return view('livewire.general.preload-resources') 
                    ->layout('layouts.guest');
    }
}
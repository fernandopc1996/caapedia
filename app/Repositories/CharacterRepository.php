<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class CharacterRepository
{
    protected string $basePath = 'game/characters/data';
    protected string $imagePath = 'game/characters/images';
    protected Collection $characters;
    protected string $cacheKey = 'characters_data';
    protected int $cacheDuration = 3600; // Cache por 1 hora

    public function __construct()
    {
        $this->loadCharacters();
    }

    protected function loadCharacters(): void
    {
        $this->characters = Cache::remember($this->cacheKey, $this->cacheDuration, function () {
            $files = Storage::files($this->basePath);
            $collection = collect();

            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                    $content = json_decode(Storage::get($file), true);
                    if ($content) {
                        $content['front_square'] = $this->getImageUrl($content['front_square']);
                        $content['side_square'] = $this->getImageUrl($content['side_square']);
                        $content['front_partial'] = $this->getImageUrl($content['front_partial']);
                        $content['side_partial'] = $this->getImageUrl($content['side_partial']);
                        $content['front_full'] = $this->getImageUrl($content['front_full']);
                        $content['side_full'] = $this->getImageUrl($content['side_full']);
                        $collection->push((object) $content);
                    }
                }
            }
            return $collection;
        });
    }

    protected function getImageUrl(?string $imagePath): ?string
    {
        return $imagePath ? url("imagens/{$this->imagePath}/$imagePath") : null;
    }

    public function all(): Collection
    {
        return $this->characters;
    }

    public function find(int $id): ?object
    {
        return $this->characters->firstWhere('id', $id);
    }

    public function search(array $criteria): Collection
    {
        return $this->characters->filter(function ($character) use ($criteria) {
            foreach ($criteria as $key => $value) {
                if (!property_exists($character, $key) || $character->$key != $value) {
                    return false;
                }
            }
            return true;
        })->values();
    }

    public function clearCache(): void
    {
        Cache::forget($this->cacheKey);
    }
}
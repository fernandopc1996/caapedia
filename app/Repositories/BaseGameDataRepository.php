<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

abstract class BaseGameDataRepository
{
    protected string $basePath;
    protected string $imagePath;
    protected string $cacheKey;
    protected int $cacheDuration = 10;//3600; 
    protected Collection $items;

    public function __construct()
    {
        $this->loadItems();
    }

    protected function loadItems(): void
    {
        $this->items = Cache::remember($this->cacheKey, $this->cacheDuration, function () {
            $files = Storage::files($this->basePath);
            $collection = collect();

            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                    $content = json_decode(Storage::get($file), true);
                    if ($content) {
                        $collection->push((object) $this->processContent($content));
                    }
                }
            }

            return $collection;
        });
    }

    protected function getImageUrl(?string $image): ?string
    {
        return $image ? url("i/{$this->imagePath}/$image") : null;
    }

    abstract protected function processContent(array $content): array;

    public function all(): Collection
    {
        return $this->items;
    }

    public function find(int $id): ?object
    {
        return $this->items->firstWhere('id', $id);
    }

    public function search(array $criteria): Collection
    {
        return $this->items->filter(function ($item) use ($criteria) {
            foreach ($criteria as $key => $value) {
                if (!property_exists($item, $key)) {
                    return false;
                }

                $itemValue = $item->$key;

                if (is_string($itemValue) && is_string($value)) {
                    if (stripos($itemValue, $value) === false) {
                        return false;
                    }
                } else {
                    if ($itemValue != $value) {
                        return false;
                    }
                }
            }
            return true;
        })->values();
    }


    public function paginateSearch(array $criteria, int $perPage = 15, ?array $sortBy = null): LengthAwarePaginator
    {
        $results = empty($criteria) ? $this->all() : $this->search($criteria);


        if (!empty($sortBy) && isset($sortBy['column'], $sortBy['direction']) && !empty($sortBy['column'])) {
            $column = $sortBy['column'];
            $direction = strtolower($sortBy['direction']);

            if ($direction === 'asc') {
                $results = $results->sortBy($column);
            } else {
                $results = $results->sortByDesc($column);
            }
            $results = $results->values();
        }

        $currentPage = Paginator::resolveCurrentPage() ?: 1;

        $currentItems = $results->forPage($currentPage, $perPage);

        return new LengthAwarePaginator(
            $currentItems,      
            $results->count(),  
            $perPage,           
            $currentPage,       
            [
                'path' => Paginator::resolveCurrentPath(), 
                'pageName' => 'page',
            ]
        );
    }

    public function clearCache(): void
    {
        Cache::forget($this->cacheKey);
    }
}

<?php

namespace App\Repositories;

class ProductRepository extends BaseGameDataRepository
{
    protected string $basePath = 'game/products/data';
    protected string $imagePath = 'game/products/images';
    protected string $cacheKey = 'products_data';

    protected function processContent(array $content): array
    {
        if (!empty($content['images']) && is_array($content['images'])) {
            $content['images'] = array_map(fn($img) => $this->getImageUrl($img), $content['images']);
        } else {
            $content['images'] = [];
        }

        return $content;
    }
}
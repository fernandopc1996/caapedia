<?php

namespace App\Repositories;

class ProductionRepository extends BaseGameDataRepository
{
    protected string $basePath = 'game/productions/data';
    protected string $imagePath = 'game/productions/images';
    protected string $cacheKey = 'productions_data';

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
<?php

namespace App\Repositories;

class CharacterRepository extends BaseGameDataRepository
{
    protected string $basePath = 'game/characters/data';
    protected string $imagePath = 'game/characters/images';
    protected string $cacheKey = 'characters_data';

    protected function processContent(array $content): array
    {
        $content['front_square'] = $this->getImageUrl($content['front_square'] ?? null);
        $content['side_square'] = $this->getImageUrl($content['side_square'] ?? null);
        $content['front_partial'] = $this->getImageUrl($content['front_partial'] ?? null);
        $content['side_partial'] = $this->getImageUrl($content['side_partial'] ?? null);
        $content['front_full'] = $this->getImageUrl($content['front_full'] ?? null);
        $content['side_full'] = $this->getImageUrl($content['side_full'] ?? null);
        return $content;
    }
}
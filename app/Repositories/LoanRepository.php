<?php

namespace App\Repositories;

class LoanRepository extends BaseGameDataRepository
{
    protected string $basePath = 'game/loans/data';
    protected string $imagePath = 'game/loans/images';
    protected string $cacheKey = 'loans_data';

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

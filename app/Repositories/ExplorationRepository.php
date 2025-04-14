<?php

namespace App\Repositories;

class ExplorationRepository extends BaseGameDataRepository
{
    protected string $basePath = 'game/explorations/data';
    protected string $imagePath = 'game/explorations/images';
    protected string $cacheKey = 'explorations_data';

    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        parent::__construct();
    }

    protected function processContent(array $content): array
    {
        if (!empty($content['images']) && is_array($content['images'])) {
            $content['images'] = array_map(fn($img) => $this->getImageUrl($img), $content['images']);
        } else {
            $content['images'] = [];
        }

        if (!empty($content['exploration']['products']) && is_array($content['exploration']['products'])) {
            $content['exploration']['products'] = array_map(function ($productInfo) {
                $product = $this->productRepository->find($productInfo['id'] ?? null);
                return $product ? (object) array_merge($productInfo, ['product' => $product]) : (object) $productInfo;
            }, $content['exploration']['products']);
        }
        
        return $content;
    }
}

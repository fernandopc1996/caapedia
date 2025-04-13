<?php

namespace App\Repositories;

class NativeCleaningRepository extends BaseGameDataRepository
{
    protected string $basePath = 'game/native_cleaning/data';
    protected string $imagePath = 'game/native_cleaning/images';
    protected string $cacheKey = 'native_cleaning_data';

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

        // Carregar os objetos dos produtos em execution.products
        if (!empty($content['execution']['products']) && is_array($content['execution']['products'])) {
            $content['execution']['products'] = array_map(function ($productInfo) {
                $product = $this->productRepository->find($productInfo['id'] ?? null);
                return $product ? (object) array_merge($productInfo, ['product' => $product]) : (object) $productInfo;
            }, $content['execution']['products']);
        }

        return $content;
    }
}
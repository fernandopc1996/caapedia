<?php

namespace App\Repositories;

class ProductionRepository extends BaseGameDataRepository
{
    protected string $basePath = 'game/productions/data';
    protected string $imagePath = 'game/productions/images';
    protected string $cacheKey = 'productions_data';

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

        // Carregar os objetos dos produtos em build.products
        if (!empty($content['build']['products']) && is_array($content['build']['products'])) {
            $content['build']['products'] = array_map(function ($productInfo) {
                $product = $this->productRepository->find($productInfo['id'] ?? null);
                return $product ? (object) array_merge($productInfo, ['product' => $product]) : (object) $productInfo;
            }, $content['build']['products']);
        }
        
        // Carregar os objetos dos produtos em production.products
        if (!empty($content['production']['products']) && is_array($content['production']['products'])) {
            $content['production']['products'] = array_map(function ($productInfo) {
                $product = $this->productRepository->find($productInfo['id'] ?? null);
                //dd($product, $productInfo['id']);
                return $product ? (object) array_merge($productInfo, ['product' => $product]) : (object) $productInfo;
            }, $content['production']['products']);
        }
        
        return $content;
    }
}

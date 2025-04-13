<?php

namespace App\Repositories;

class CropRepository extends BaseGameDataRepository
{
    protected string $basePath = 'game/crops/data';
    protected string $imagePath = 'game/crops/images';
    protected string $cacheKey = 'crops_data';

    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        parent::__construct();
    }

    protected function processContent(array $content): array
    {
        // Imagens
        if (!empty($content['images']) && is_array($content['images'])) {
            $content['images'] = array_map(fn($img) => $this->getImageUrl($img), $content['images']);
        }

        // Imagens no campo production 
        if (!empty($content['production']) && is_array($content['production']) && isset($content['production'][0])) {
            $content['production'] = array_map(fn($img) => $this->getImageUrl($img), $content['production']);
        }

        // Start Cycle: Fases e produtos
        if (!empty($content['production']['start_cycle']['phases'])) {
            $content['production']['start_cycle']['phases'] = $this->processPhases($content['production']['start_cycle']['phases']);
        }

        // Continue Cycle: Fases e produtos
        if (!empty($content['production']['continue_cycle']['phases'])) {
            $content['production']['continue_cycle']['phases'] = $this->processPhases($content['production']['continue_cycle']['phases']);
        }

        // Produtos da colheita
        if (!empty($content['production']['products']) && is_array($content['production']['products'])) {
            $content['production']['products'] = array_map(function ($productInfo) {
                $product = $this->productRepository->find($productInfo['id'] ?? null);
                return $product ? (object) array_merge($productInfo, ['product' => $product]) : (object) $productInfo;
            }, $content['production']['products']);
        }

        return $content;
    }

    protected function processPhases(array $phases): array
    {
        return array_map(function ($phase) {
            foreach (['required', 'optional'] as $type) {
                if (!empty($phase['products'][$type]) && is_array($phase['products'][$type])) {
                    $phase['products'][$type] = array_map(function ($productInfo) {
                        $product = $this->productRepository->find($productInfo['id'] ?? null);
                        return $product ? (object) array_merge($productInfo, ['product' => $product]) : (object) $productInfo;
                    }, $phase['products'][$type]);
                }
            }
            return $phase;
        }, $phases);
    }
}
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
        // Processa as imagens
        if (!empty($content['images']) && is_array($content['images'])) {
            $content['images'] = array_map(fn($img) => $this->getImageUrl($img), $content['images']);
        } else {
            $content['images'] = [];
        }

        // Processa os produtos de construção (build)
        $content['build']['products']['required'] = $this->mapProductsWithDetails($content['build']['products']['required'] ?? []);
        $content['build']['products']['optional'] = $this->mapProductsWithDetails($content['build']['products']['optional'] ?? []);

        // Processa os produtos de produção no modelo antigo
        if (!empty($content['production']['products']) && is_array($content['production']['products'])) {
            $content['production']['products'] = $this->mapProductsWithDetails($content['production']['products']);
        }

        // Processa os produtos de entrada (inputs) no modelo novo
        if (!empty($content['production']['inputs']) && is_array($content['production']['inputs'])) {
            $content['production']['inputs'] = $this->mapProductsWithDetails($content['production']['inputs']);
        }

        // Processa os produtos de saída (outputs) no modelo novo
        if (!empty($content['production']['outputs']) && is_array($content['production']['outputs'])) {
            $content['production']['outputs'] = $this->mapProductsWithDetails($content['production']['outputs']);
        }

        return $content;
    }

    /**
     * Função auxiliar para mapear produtos e carregar seus dados.
     */
    private function mapProductsWithDetails(array $products): array
    {
        return array_map(function ($productInfo) {
            $product = $this->productRepository->find($productInfo['id'] ?? null);
            return $product
                ? (object) array_merge($productInfo, ['product' => $product])
                : (object) $productInfo;
        }, $products);
    }
}
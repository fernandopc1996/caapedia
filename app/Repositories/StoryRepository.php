<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

class StoryRepository extends BaseGameDataRepository
{
    protected string $basePath = 'game/story/data';
    protected string $imagePath = 'game/story/images';
    protected string $cacheKey = 'story_data';

    protected CharacterRepository $characterRepository;

    public function __construct(CharacterRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
        parent::__construct();
    }

    protected function processContent(array $content): array
    {
        // Process images array
        if (!empty($content['images']) && is_array($content['images'])) {
            $content['images'] = array_map(
                fn($img) => $this->getImageUrl($img),
                $content['images']
            );
        } else {
            $content['images'] = [];
        }
        // Load character object
        if (!empty($content['character_id'])) {
            $character = $this->characterRepository->find($content['character_id']);
            $content['character'] = $character;
        }

        // Process choices and their actions
        if (!empty($content['choices']) && is_array($content['choices'])) {
            $content['choices'] = array_map(function ($choice) {
                $processedChoice = [
                    'text'    => $choice['text'] ?? '',
                    'description'    => $choice['description'] ?? null,
                    'actions' => [],
                ];

                if (!empty($choice['actions']) && is_array($choice['actions'])) {
                    $processedChoice['actions'] = array_map(
                        fn($action) => (object) $action,
                        $choice['actions']
                    );
                }

                return (object) $processedChoice;
            }, $content['choices']);
        }

        return $content;
    }
}
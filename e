[1mdiff --git a/LICENSE.md b/LICENSE.md[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Console/Commands/CheckInactivePlayers.php b/app/Console/Commands/CheckInactivePlayers.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Enums/TypeAreaProduction.php b/app/Enums/TypeAreaProduction.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Enums/TypeEvent.php b/app/Enums/TypeEvent.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Enums/TypeFinance.php b/app/Enums/TypeFinance.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Enums/TypeProduct.php b/app/Enums/TypeProduct.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Enums/UserRole.php b/app/Enums/UserRole.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Helpers/Formatter.php b/app/Helpers/Formatter.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Http/Controllers/Auth/GoogleLoginController.php b/app/Http/Controllers/Auth/GoogleLoginController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Http/Controllers/Auth/GuestUserController.php b/app/Http/Controllers/Auth/GuestUserController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Http/Controllers/General/ImageController.php b/app/Http/Controllers/General/ImageController.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Http/Middleware/CheckPlayerTime.php b/app/Http/Middleware/CheckPlayerTime.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Http/Middleware/UserHasPlayer.php b/app/Http/Middleware/UserHasPlayer.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Jobs/Events/ProcessMultiplePlayerEvents.php b/app/Jobs/Events/ProcessMultiplePlayerEvents.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Jobs/Events/ProcessPlayerEvent.php b/app/Jobs/Events/ProcessPlayerEvent.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Explore/ExploreAction.php b/app/Livewire/Game/Explore/ExploreAction.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Explore/ExploreManage.php b/app/Livewire/Game/Explore/ExploreManage.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Finance/FinanceManage.php b/app/Livewire/Game/Finance/FinanceManage.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Finance/LoanManage.php b/app/Livewire/Game/Finance/LoanManage.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Inventory/InventoryManage.php b/app/Livewire/Game/Inventory/InventoryManage.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Market/MarketManage.php b/app/Livewire/Game/Market/MarketManage.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Market/WaterPurchase.php b/app/Livewire/Game/Market/WaterPurchase.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/News/Newspaper.php b/app/Livewire/Game/News/Newspaper.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/People/PeopleManage.php b/app/Livewire/Game/People/PeopleManage.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Player/ControlTimer.php b/app/Livewire/Game/Player/ControlTimer.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Player/CreatePlayer.php b/app/Livewire/Game/Player/CreatePlayer.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Player/PlayerFinished.php b/app/Livewire/Game/Player/PlayerFinished.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Player/PlayerResources.php b/app/Livewire/Game/Player/PlayerResources.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Production/ProductionAreaCrop.php b/app/Livewire/Game/Production/ProductionAreaCrop.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Production/ProductionCreate.php b/app/Livewire/Game/Production/ProductionCreate.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Production/ProductionCrop.php b/app/Livewire/Game/Production/ProductionCrop.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Production/ProductionItem.php b/app/Livewire/Game/Production/ProductionItem.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Production/ProductionManage.php b/app/Livewire/Game/Production/ProductionManage.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Production/ProductionProduced.php b/app/Livewire/Game/Production/ProductionProduced.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Story/EventsView.php b/app/Livewire/Game/Story/EventsView.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/Game/Story/InteractionAction.php b/app/Livewire/Game/Story/InteractionAction.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/General/Person/PersonFormPage.php b/app/Livewire/General/Person/PersonFormPage.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/General/Person/PersonIndexPage.php b/app/Livewire/General/Person/PersonIndexPage.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/General/PreloadResources.php b/app/Livewire/General/PreloadResources.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Livewire/General/Score/RankingView.php b/app/Livewire/General/Score/RankingView.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/Game/Player.php b/app/Models/Game/Player.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/Game/PlayerAction.php b/app/Models/Game/PlayerAction.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/Game/PlayerActionArea.php b/app/Models/Game/PlayerActionArea.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/Game/PlayerCharacter.php b/app/Models/Game/PlayerCharacter.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/Game/PlayerFinance.php b/app/Models/Game/PlayerFinance.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/Game/PlayerProduct.php b/app/Models/Game/PlayerProduct.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/Game/PlayerProduction.php b/app/Models/Game/PlayerProduction.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/Game/PlayerScore.php b/app/Models/Game/PlayerScore.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/Game/PlayerStory.php b/app/Models/Game/PlayerStory.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/Game/PlayerWater.php b/app/Models/Game/PlayerWater.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/General/Area.php b/app/Models/General/Area.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/General/Author.php b/app/Models/General/Author.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/General/Category.php b/app/Models/General/Category.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/General/Character.php b/app/Models/General/Character.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/General/Event.php b/app/Models/General/Event.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/General/Fauna.php b/app/Models/General/Fauna.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/General/Flora.php b/app/Models/General/Flora.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/General/Product.php b/app/Models/General/Product.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/General/ProductComposition.php b/app/Models/General/ProductComposition.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Models/General/Reference.php b/app/Models/General/Reference.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Providers/ViewPlayerProvider.php b/app/Providers/ViewPlayerProvider.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Repositories/BaseGameDataRepository.php b/app/Repositories/BaseGameDataRepository.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Repositories/CharacterRepository.php b/app/Repositories/CharacterRepository.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Repositories/CropRepository.php b/app/Repositories/CropRepository.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Repositories/ExplorationRepository.php b/app/Repositories/ExplorationRepository.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Repositories/LoanRepository.php b/app/Repositories/LoanRepository.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Repositories/NativeCleaningRepository.php b/app/Repositories/NativeCleaningRepository.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Repositories/ProductRepository.php b/app/Repositories/ProductRepository.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Repositories/ProductionRepository.php b/app/Repositories/ProductionRepository.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Repositories/StoryRepository.php b/app/Repositories/StoryRepository.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Events/FixedEventService.php b/app/Services/Game/Events/FixedEventService.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Events/PlayerEventProcessorService.php b/app/Services/Game/Events/PlayerEventProcessorService.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Events/Rules/AddCharacter.php b/app/Services/Game/Events/Rules/AddCharacter.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Events/Rules/EndGameByResources.php b/app/Services/Game/Events/Rules/EndGameByResources.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Exploration/ExplorationService.php b/app/Services/Game/Exploration/ExplorationService.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Exploration/ExplorationUpdateService.php b/app/Services/Game/Exploration/ExplorationUpdateService.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Finance/FamilyCostService.php b/app/Services/Game/Finance/FamilyCostService.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Finance/FinancialStatementService.php b/app/Services/Game/Finance/FinancialStatementService.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Finance/LoanInstallmentService.php b/app/Services/Game/Finance/LoanInstallmentService.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Mechanics/PlayerRateAdjustmentService.php b/app/Services/Game/Mechanics/PlayerRateAdjustmentService.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Mechanics/WeightedRandomPicker.php b/app/Services/Game/Mechanics/WeightedRandomPicker.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Player/PlayerTimerService.php b/app/Services/Game/Player/PlayerTimerService.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Production/ProductionService.php b/app/Services/Game/Production/ProductionService.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Production/ProductionUpdateService.php b/app/Services/Game/Production/ProductionUpdateService.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Story/AddCharacterToStoryService.php b/app/Services/Game/Story/AddCharacterToStoryService.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Services/Game/Story/StoryActionExecutor.php b/app/Services/Game/Story/StoryActionExecutor.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Support/AclPermissions.php b/app/Support/AclPermissions.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/app/Traits/LoadsPlayerFromSession.php b/app/Traits/LoadsPlayerFromSession.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/config/livewire.php b/config/livewire.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2024_09_18_175439_create_players_table.php b/database/migrations/2024_09_18_175439_create_players_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2024_10_15_120107_create_authors_table.php b/database/migrations/2024_10_15_120107_create_authors_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2024_10_15_120229_create_references_table.php b/database/migrations/2024_10_15_120229_create_references_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2024_10_15_181211_create_categories_table.php b/database/migrations/2024_10_15_181211_create_categories_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2024_10_15_181907_create_characters_table.php b/database/migrations/2024_10_15_181907_create_characters_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2024_10_15_182023_create_products_table.php b/database/migrations/2024_10_15_182023_create_products_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2024_10_15_182520_create_areas_table.php b/database/migrations/2024_10_15_182520_create_areas_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2024_10_15_183052_create_fauna_table.php b/database/migrations/2024_10_15_183052_create_fauna_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2024_10_15_183056_create_flora_table.php b/database/migrations/2024_10_15_183056_create_flora_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2024_10_15_183725_create_product_compositions_table.php b/database/migrations/2024_10_15_183725_create_product_compositions_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2024_10_19_114543_create_events_table.php b/database/migrations/2024_10_19_114543_create_events_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2024_10_19_124030_create_referenceables_table.php b/database/migrations/2024_10_19_124030_create_referenceables_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2025_03_24_182202_create_player_characters_table.php b/database/migrations/2025_03_24_182202_create_player_characters_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2025_03_24_192154_create_player_productions_table.php b/database/migrations/2025_03_24_192154_create_player_productions_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2025_03_24_192632_create_player_actions_table.php b/database/migrations/2025_03_24_192632_create_player_actions_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2025_03_24_192711_create_player_action_areas_table.php b/database/migrations/2025_03_24_192711_create_player_action_areas_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2025_03_24_192907_create_player_products_table.php b/database/migrations/2025_03_24_192907_create_player_products_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2025_04_21_132534_create_player_stories_table.php b/database/migrations/2025_04_21_132534_create_player_stories_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2025_05_12_173446_create_player_waters_table.php b/database/migrations/2025_05_12_173446_create_player_waters_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2025_05_12_191720_create_player_finances_table.php b/database/migrations/2025_05_12_191720_create_player_finances_table.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/database/migrations/2025_05_16_183729_create_player_scores_view.php b/database/migrations/2025_05_16_183729_create_player_scores_view.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/public/a/images/background.jpg b/public/a/images/background.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/public/a/images/logo.png b/public/a/images/logo.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/public/a/images/pev.png b/public/a/images/pev.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/public/a/images/ppgdides.png b/public/a/images/ppgdides.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/public/a/images/texture.jpg b/public/a/images/texture.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/public/a/images/univasf.png b/public/a/images/univasf.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/css/animations/_index.css b/resources/css/animations/_index.css[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/css/animations/clock.css b/resources/css/animations/clock.css[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/css/animations/fade.css b/resources/css/animations/fade.css[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/css/animations/glass-shine.css b/resources/css/animations/glass-shine.css[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/css/animations/pulse.css b/resources/css/animations/pulse.css[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/css/animations/slide.css b/resources/css/animations/slide.css[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/js/inactivity.js b/resources/js/inactivity.js[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/buttons/big.blade.php b/resources/views/components/buttons/big.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/game/exploration/pending.blade.php b/resources/views/components/game/exploration/pending.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/game/inventory/sell-input.blade.php b/resources/views/components/game/inventory/sell-input.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/game/market/buy-input.blade.php b/resources/views/components/game/market/buy-input.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/game/production/build-info.blade.php b/resources/views/components/game/production/build-info.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/game/production/build-item.blade.php b/resources/views/components/game/production/build-item.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/game/production/header.blade.php b/resources/views/components/game/production/header.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/game/production/pending.blade.php b/resources/views/components/game/production/pending.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/game/production/product-item.blade.php b/resources/views/components/game/production/product-item.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/game/production/production-info.blade.php b/resources/views/components/game/production/production-info.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/layout/header.blade.php b/resources/views/components/layout/header.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/menu/button-row.blade.php b/resources/views/components/menu/button-row.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/selects/character-selector-params.blade.php b/resources/views/components/selects/character-selector-params.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/selects/character-selector.blade.php b/resources/views/components/selects/character-selector.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/timers/clock.blade.php b/resources/views/components/timers/clock.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/components/timers/timer.blade.php b/resources/views/components/timers/timer.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/credits.blade.php b/resources/views/credits.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/errors/401.blade.php b/resources/views/errors/401.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/errors/402.blade.php b/resources/views/errors/402.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/errors/403.blade.php b/resources/views/errors/403.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/errors/404.blade.php b/resources/views/errors/404.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/errors/419.blade.php b/resources/views/errors/419.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/errors/429.blade.php b/resources/views/errors/429.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/errors/500.blade.php b/resources/views/errors/500.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/errors/503.blade.php b/resources/views/errors/503.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/errors/layout.blade.php b/resources/views/errors/layout.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/errors/minimal.blade.php b/resources/views/errors/minimal.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/explore/explore-action.blade.php b/resources/views/livewire/game/explore/explore-action.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/explore/explore-manage.blade.php b/resources/views/livewire/game/explore/explore-manage.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/finance/finance-manage.blade.php b/resources/views/livewire/game/finance/finance-manage.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/finance/loan-manage.blade.php b/resources/views/livewire/game/finance/loan-manage.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/inventory/inventory-manage.blade.php b/resources/views/livewire/game/inventory/inventory-manage.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/market/market-manage.blade.php b/resources/views/livewire/game/market/market-manage.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/market/water-purchase.blade.php b/resources/views/livewire/game/market/water-purchase.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/news/newspaper.blade.php b/resources/views/livewire/game/news/newspaper.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/people/people-manage.blade.php b/resources/views/livewire/game/people/people-manage.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/player/control-timer.blade.php b/resources/views/livewire/game/player/control-timer.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/player/create-player.blade.php b/resources/views/livewire/game/player/create-player.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/player/player-finished.blade.php b/resources/views/livewire/game/player/player-finished.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/player/player-resources.blade.php b/resources/views/livewire/game/player/player-resources.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/production/production-area-crop.blade.php b/resources/views/livewire/game/production/production-area-crop.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/production/production-create.blade.php b/resources/views/livewire/game/production/production-create.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/production/production-crop.blade.php b/resources/views/livewire/game/production/production-crop.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/production/production-item.blade.php b/resources/views/livewire/game/production/production-item.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/production/production-manage.blade.php b/resources/views/livewire/game/production/production-manage.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/production/production-produced.blade.php b/resources/views/livewire/game/production/production-produced.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/story/events-view.blade.php b/resources/views/livewire/game/story/events-view.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/game/story/interaction-action.blade.php b/resources/views/livewire/game/story/interaction-action.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/general/person/person-form-page.blade.php b/resources/views/livewire/general/person/person-form-page.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/general/person/person-index-page.blade.php b/resources/views/livewire/general/person/person-index-page.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/general/preload-resources.blade.php b/resources/views/livewire/general/preload-resources.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/livewire/general/score/ranking-view.blade.php b/resources/views/livewire/general/score/ranking-view.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/vendor/pagination/bootstrap-4.blade.php b/resources/views/vendor/pagination/bootstrap-4.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/vendor/pagination/bootstrap-5.blade.php b/resources/views/vendor/pagination/bootstrap-5.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/vendor/pagination/default.blade.php b/resources/views/vendor/pagination/default.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/vendor/pagination/semantic-ui.blade.php b/resources/views/vendor/pagination/semantic-ui.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/vendor/pagination/simple-bootstrap-4.blade.php b/resources/views/vendor/pagination/simple-bootstrap-4.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/vendor/pagination/simple-bootstrap-5.blade.php b/resources/views/vendor/pagination/simple-bootstrap-5.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/vendor/pagination/simple-default.blade.php b/resources/views/vendor/pagination/simple-default.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/vendor/pagination/simple-tailwind.blade.php b/resources/views/vendor/pagination/simple-tailwind.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/resources/views/vendor/pagination/tailwind.blade.php b/resources/views/vendor/pagination/tailwind.blade.php[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/data/1.json b/storage/app/game/characters/data/1.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/data/2.json b/storage/app/game/characters/data/2.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/data/3.json b/storage/app/game/characters/data/3.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/data/4.json b/storage/app/game/characters/data/4.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/images/c1/01_ff.png b/storage/app/game/characters/images/c1/01_ff.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/images/c1/01_fp.png b/storage/app/game/characters/images/c1/01_fp.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/images/c1/01_fs.png b/storage/app/game/characters/images/c1/01_fs.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/images/c2/02_ff.png b/storage/app/game/characters/images/c2/02_ff.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/images/c2/02_fp.png b/storage/app/game/characters/images/c2/02_fp.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/images/c2/02_fs.png b/storage/app/game/characters/images/c2/02_fs.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/images/c3/03_ff.png b/storage/app/game/characters/images/c3/03_ff.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/images/c3/03_fp.png b/storage/app/game/characters/images/c3/03_fp.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/images/c3/03_fs.png b/storage/app/game/characters/images/c3/03_fs.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/images/c4/04_ff.png b/storage/app/game/characters/images/c4/04_ff.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/images/c4/04_fp.png b/storage/app/game/characters/images/c4/04_fp.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/characters/images/c4/04_fs.png b/storage/app/game/characters/images/c4/04_fs.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/crops/data/1.json b/storage/app/game/crops/data/1.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/crops/data/2.json b/storage/app/game/crops/data/2.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/crops/data/3.json b/storage/app/game/crops/data/3.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/crops/data/4.json b/storage/app/game/crops/data/4.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/crops/images/c1/1.jpg b/storage/app/game/crops/images/c1/1.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/crops/images/c2/2.jpg b/storage/app/game/crops/images/c2/2.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/crops/images/c3/3.jpg b/storage/app/game/crops/images/c3/3.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/crops/images/c4/4.jpg b/storage/app/game/crops/images/c4/4.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/crops/images/c4/5.jpg:Zone.Identifier b/storage/app/game/crops/images/c4/5.jpg:Zone.Identifier[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/events/data/9999.json b/storage/app/game/events/data/9999.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/explorations/data/1.json b/storage/app/game/explorations/data/1.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/explorations/data/2.json b/storage/app/game/explorations/data/2.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/explorations/data/3.json b/storage/app/game/explorations/data/3.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/explorations/images/e1/1.jpg b/storage/app/game/explorations/images/e1/1.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/explorations/images/e2/2.jpg b/storage/app/game/explorations/images/e2/2.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/explorations/images/e3/3.jpg b/storage/app/game/explorations/images/e3/3.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/explorations/images/e3/3.jpg:Zone.Identifier b/storage/app/game/explorations/images/e3/3.jpg:Zone.Identifier[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/loans/data/1.json b/storage/app/game/loans/data/1.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/loans/data/2.json b/storage/app/game/loans/data/2.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/loans/data/3.json b/storage/app/game/loans/data/3.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/loans/data/4.json b/storage/app/game/loans/data/4.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/loans/data/5.json b/storage/app/game/loans/data/5.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/loans/data/6.json b/storage/app/game/loans/data/6.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/loans/data/7.json b/storage/app/game/loans/data/7.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/native_cleaning/data/1.json b/storage/app/game/native_cleaning/data/1.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/native_cleaning/data/2.json b/storage/app/game/native_cleaning/data/2.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --gitwarning: CRLF will be replaced by LF in storage/app/game/productions/data/4.json.
The file will have its original line endings in your working directory
 a/storage/app/game/native_cleaning/data/3.json b/storage/app/game/native_cleaning/data/3.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/native_cleaning/data/4.json b/storage/app/game/native_cleaning/data/4.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/native_cleaning/data/5.json b/storage/app/game/native_cleaning/data/5.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/native_cleaning/images/t1/1.jpg b/storage/app/game/native_cleaning/images/t1/1.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/native_cleaning/images/t1/3.jpg b/storage/app/game/native_cleaning/images/t1/3.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/native_cleaning/images/t2/2.jpg b/storage/app/game/native_cleaning/images/t2/2.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/native_cleaning/images/t2/4.jpg b/storage/app/game/native_cleaning/images/t2/4.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/native_cleaning/images/t2/5.jpg b/storage/app/game/native_cleaning/images/t2/5.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/data/1.json b/storage/app/game/productions/data/1.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/data/2.json b/storage/app/game/productions/data/2.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/data/3.json b/storage/app/game/productions/data/3.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/data/4.json b/storage/app/game/productions/data/4.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/data/5.json b/storage/app/game/productions/data/5.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/data/6.json b/storage/app/game/productions/data/6.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/data/7.json b/storage/app/game/productions/data/7.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/data/8.json b/storage/app/game/productions/data/8.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/images/p1/01.jpg b/storage/app/game/productions/images/p1/01.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/images/p2/02.jpg b/storage/app/game/productions/images/p2/02.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/images/p3/3.jpg b/storage/app/game/productions/images/p3/3.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/images/p4/4.jpg b/storage/app/game/productions/images/p4/4.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/images/p5/5.jpg b/storage/app/game/productions/images/p5/5.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/images/p6/6.jpg b/storage/app/game/productions/images/p6/6.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/images/p7/7.jpg b/storage/app/game/productions/images/p7/7.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/images/p7/7.jpg:Zone.Identifier b/storage/app/game/productions/images/p7/7.jpg:Zone.Identifier[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/productions/images/p8/8.jpg b/storage/app/game/productions/images/p8/8.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/1.json b/storage/app/game/products/data/1.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/10.json b/storage/app/game/products/data/10.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/100.json b/storage/app/game/products/data/100.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/101.json b/storage/app/game/products/data/101.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/102.json b/storage/app/game/products/data/102.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/103.json b/storage/app/game/products/data/103.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/104.json b/storage/app/game/products/data/104.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/11.json b/storage/app/game/products/data/11.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/12.json b/storage/app/game/products/data/12.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/120.json b/storage/app/game/products/data/120.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/121.json b/storage/app/game/products/data/121.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/122.json b/storage/app/game/products/data/122.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/124.json b/storage/app/game/products/data/124.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/150.json b/storage/app/game/products/data/150.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/151.json b/storage/app/game/products/data/151.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/152.json b/storage/app/game/products/data/152.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/153.json b/storage/app/game/products/data/153.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/2.json b/storage/app/game/products/data/2.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/3.json b/storage/app/game/products/data/3.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/300.json b/storage/app/game/products/data/300.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/301.json b/storage/app/game/products/data/301.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/302.json b/storage/app/game/products/data/302.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/303.json b/storage/app/game/products/data/303.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/4.json b/storage/app/game/products/data/4.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/400.json b/storage/app/game/products/data/400.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/401.json b/storage/app/game/products/data/401.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/402.json b/storage/app/game/products/data/402.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/403.json b/storage/app/game/products/data/403.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/404.json b/storage/app/game/products/data/404.json[m
[1mold mode 100644warning: CRLF will be replaced by LF in storage/app/game/products/data/50.json.
The file will have its original line endings in your working directory
warning: CRLF will be replaced by LF in storage/app/game/products/data/51.json.
The file will have its original line endings in your working directory
[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/405.json b/storage/app/game/products/data/405.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/406.json b/storage/app/game/products/data/406.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/450.json b/storage/app/game/products/data/450.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/451.json b/storage/app/game/products/data/451.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/452.json b/storage/app/game/products/data/452.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/50.json b/storage/app/game/products/data/50.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/51.json b/storage/app/game/products/data/51.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/data/52.json b/storage/app/game/products/data/52.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/pr1/01.png b/storage/app/game/products/images/pr1/01.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/pr2/02.png b/storage/app/game/products/images/pr2/02.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/pr3/03.png b/storage/app/game/products/images/pr3/03.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/pr4/04.png b/storage/app/game/products/images/pr4/04.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t1/10.jpg b/storage/app/game/products/images/t1/10.jpg[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t2/100.png b/storage/app/game/products/images/t2/100.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t2/101.png b/storage/app/game/products/images/t2/101.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t2/103.png b/storage/app/game/products/images/t2/103.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/102.png b/storage/app/game/products/images/t3/102.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/104.png b/storage/app/game/products/images/t3/104.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/120.png b/storage/app/game/products/images/t3/120.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/121.png b/storage/app/game/products/images/t3/121.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/122.png b/storage/app/game/products/images/t3/122.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/124.png b/storage/app/game/products/images/t3/124.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/300.png b/storage/app/game/products/images/t3/300.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/301.png b/storage/app/game/products/images/t3/301.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/302.png b/storage/app/game/products/images/t3/302.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/303.png b/storage/app/game/products/images/t3/303.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/400.png b/storage/app/game/producwarning: CRLF will be replaced by LF in storage/app/game/products/images/t4/11.png:Zone.Identifier.
The file will have its original line endings in your working directory
warning: CRLF will be replaced by LF in storage/app/game/products/images/t4/12.png:Zone.Identifier.
The file will have its original line endings in your working directory
warning: CRLF will be replaced by LF in storage/app/game/products/images/t4/52.png:Zone.Identifier.
The file will have its original line endings in your working directory
ts/images/t3/400.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/401.png b/storage/app/game/products/images/t3/401.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/402.png b/storage/app/game/products/images/t3/402.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/403.png b/storage/app/game/products/images/t3/403.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/404.png b/storage/app/game/products/images/t3/404.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/405.png b/storage/app/game/products/images/t3/405.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t3/406.png b/storage/app/game/products/images/t3/406.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/11.png b/storage/app/game/products/images/t4/11.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/11.png:Zone.Identifier b/storage/app/game/products/images/t4/11.png:Zone.Identifier[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/12.png b/storage/app/game/products/images/t4/12.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/12.png:Zone.Identifier b/storage/app/game/products/images/t4/12.png:Zone.Identifier[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/450.png b/storage/app/game/products/images/t4/450.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/450.png:Zone.Identifier b/storage/app/game/products/images/t4/450.png:Zone.Identifier[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/451.png b/storage/app/game/products/images/t4/451.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/451.png:Zone.Identifier b/storage/app/game/products/images/t4/451.png:Zone.Identifier[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/452.png b/storage/app/game/products/images/t4/452.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/452.png:Zone.Identifier b/storage/app/game/products/images/t4/452.png:Zone.Identifier[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/50.png b/storage/app/game/products/images/t4/50.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/51.png b/storage/app/game/products/images/t4/51.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/52.png b/storage/app/game/products/images/t4/52.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t4/52.png:Zone.Identifier b/storage/app/game/products/images/t4/52.png:Zone.Identifier[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t5/150.png b/storage/app/game/products/images/t5/150.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t5/151.png b/storage/app/game/products/images/t5/151.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t5/152.png b/storage/app/game/products/images/t5/152.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/images/t5/153.png b/storage/app/game/products/images/t5/153.png[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/products/types.txt b/storage/app/game/products/types.txt[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/1.json b/storage/app/game/story/data/1.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/2.json b/storage/app/game/story/data/2.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/3.json b/storage/app/game/story/data/3.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/4.json b/storage/app/game/story/data/4.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/5.json b/storage/app/game/story/data/5.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/8000.json b/storage/app/game/story/data/8000.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/8001.json b/storage/app/game/story/data/8001.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/8002.json b/storage/app/game/story/data/8002.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/8003.json b/storage/app/game/story/data/8003.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/8500.json b/storage/app/game/story/data/8500.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/8501.json b/storage/app/game/story/data/8501.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/9001.json b/storage/app/game/story/data/9001.json[m
[1mold mode 100644[m
[1mnew mode 100755[m
[1mdiff --git a/storage/app/game/story/data/9999.json b/storage/app/game/story/data/9999.json[m
[1mold mode 100644[m
[1mnew mode 100755[m

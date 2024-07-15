<?php

namespace Fred\EndCrystal;

use Fred\EndCrystal\Item\ExtraItems;
use pocketmine\item\VanillaItems;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\RuntimeBlockStateRegistry;
use pocketmine\crafting\ExactRecipeIngredient;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\data\bedrock\block\BlockTypeNames;
use pocketmine\data\bedrock\item\ItemTypeNames;
use pocketmine\data\bedrock\item\SavedItemData;
use pocketmine\inventory\CreativeInventory;
use pocketmine\item\StringToItemParser;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\world\format\io\GlobalBlockStateHandlers;
use pocketmine\world\format\io\GlobalItemDataHandlers;

class Main extends PluginBase
{

    protected function onEnable(): void
    {

        // END_CRYSTAL
        GlobalItemDataHandlers::getDeserializer()->map(ItemTypeNames::END_CRYSTAL, fn() => clone ExtraItems::END_CRYSTAL());
        GlobalItemDataHandlers::getSerializer()->map(ExtraItems::END_CRYSTAL(), fn() => new SavedItemData(ItemTypeNames::END_CRYSTAL));
        StringToItemParser::getInstance()->register(ItemTypeNames::END_CRYSTAL, fn() => clone ExtraItems::END_CRYSTAL());
        CreativeInventory::getInstance()->add(ExtraItems::END_CRYSTAL());
        
        // ENDER_EYE
        GlobalItemDataHandlers::getDeserializer()->map(ItemTypeNames::ENDER_EYE, fn() => clone ExtraItems::ENDER_EYE());
        GlobalItemDataHandlers::getSerializer()->map(ExtraItems::ENDER_EYE(), fn() => new SavedItemData(ItemTypeNames::ENDER_EYE));
        StringToItemParser::getInstance()->register(ItemTypeNames::ENDER_EYE, fn() => clone ExtraItems::ENDER_EYE());
        CreativeInventory::getInstance()->add(ExtraItems::ENDER_EYE());

        // REGISTER CRAFTING RECIPE
        $this->getScheduler()->scheduleDelayedTask(new ClosureTask(function (): void {
            $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                [
                    "AAA",
                    "ABA",
                    "ACA"
                ],
                [
                    "A" => new ExactRecipeIngredient(VanillaBlocks::GLASS()->asItem()),
                    "B" => new ExactRecipeIngredient(ExtraItems::ENDER_EYE()),
                    "C" => new ExactRecipeIngredient(VanillaItems::GHAST_TEAR())
                ],
                [ExtraItems::END_CRYSTAL()]
            ));
        }), 2);
    }
}

<?php

namespace Fred\EndCrystal\Item;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\ToolTier;
use pocketmine\utils\CloningRegistryTrait;

/**
 * @method static Item ENDER_EYE()
 * @method static EndCrystalItem END_CRYSTAL()
 */
class ExtraItems
{
    use CloningRegistryTrait;

    protected static function setup(): void
    {
        self::_registryRegister('ender_eye', new Item(new ItemIdentifier(ItemTypeIds::newId()), 'Eye of Ender'));
        self::_registryRegister('end_crystal', new EndCrystalItem(new ItemIdentifier(ItemTypeIds::newId()), 'End Crystal'));
    }
}

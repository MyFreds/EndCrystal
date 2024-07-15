<?php

namespace Fred\EndCrystal\Item;

use Fred\EndCrystal\Entity\EnderCrystalEntity;
use pocketmine\block\Bedrock;
use pocketmine\block\Block;
use pocketmine\entity\Location;
use pocketmine\item\Item;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class EndCrystalItem extends Item {
  
  public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, &$returnedItems): ItemUseResult{
    if($blockClicked instanceof Bedrock && $face === Facing::UP){
        $entity = new EnderCrystalEntity(Location::fromObject(clone $blockReplace->getPosition()->add(0.5, 0, 0.5), $blockReplace->getPosition()->getWorld()));
        $entity->spawnToAll();
        if($player->hasFiniteResources()) $this->pop();
        return ItemUseResult::SUCCESS();
    }
    return ItemUseResult::FAIL();
  }
}

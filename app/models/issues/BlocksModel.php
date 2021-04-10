<?php

namespace app\models\issues;

/**
 * Class BlocksModel
 * @package app\models\issues
 */
class BlocksModel
{
    private int $blockId;
    private string $blockName;

    public function __construct(int $id, string $name)
    {
        $this->blockId = $id;
        $this->blockName = $name;
    }

    /**
     * @return int
     */
    public function getBlockId(): int
    {
        return $this->blockId;
    }

    /**
     * @return string
     */
    public function getBlockName(): string
    {
        return $this->blockName;
    }
}
<?php

namespace Neoisrecursive\StorageInfo\DataTransferObjects;

class StorageInfoDto
{
    public function __construct(
        public string $name,
        public string $url,
        public int $totalFiles,
        public string $totalSpaceUsed,
        public int $totalUnusedFiles,
    ) {
    }

    public static function make(
        string $name,
        string $url,
        int $totalFiles,
        string $totalSpaceUsed,
        int $totalUnusedFiles,
    ): self {
        return new self(
            $name,
            $url,
            $totalFiles,
            $totalSpaceUsed,
            $totalUnusedFiles,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'files' => $this->totalFiles,
            'spaceUsed' => $this->totalSpaceUsed,
            'unused' => $this->totalUnusedFiles,
        ];
    }
}

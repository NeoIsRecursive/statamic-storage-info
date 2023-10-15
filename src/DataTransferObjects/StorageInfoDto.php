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

    public static function make(array $data): self
    {
        return new self(
            $data['name'],
            $data['url'],
            $data['files'],
            $data['spaceUsed'],
            $data['unused'],
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

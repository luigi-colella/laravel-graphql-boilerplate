<?php

namespace App\Schema;

use Illuminate\Database\Eloquent\Collection;

class ModelPaginator
{
    /**
     * The class of model used to fetch items
     * 
     * @var string
     */
    private $modelClass;

    /**
     * The primary key used by the model
     * 
     * @var int
     */
    private $key;

    /**
     * The cursor used to determine the items to fetch.
     * 
     * @var int
     */
    private $cursor;

    /**
     * The number of items to fetch.
     * 
     * @var int
     */
    private $limit;

    /**
     * The fetched items for the current selection
     * 
     * @var Collection
     */
    private $items;

    /**
     * The total number of fetchable items
     * 
     * @var int
     */
    private $totalCount;

    /**
     * The cursor of the last fetchable item
     * 
     * @var int
     */
    private $endCursor;

    /**
     * Determine if other items can be fetched next this selection
     * 
     * @var bool
     */
    private $hasNextPage;

    /**
     * @var string $modelClass
     * @var int $cursor
     * @var int $limit
     */
    public function __construct(string $modelClass, int $cursor, int $limit)
    {
        $this->modelClass = $modelClass;
        $this->key = (new $modelClass)->getKeyName();
        $this->cursor = $cursor;
        $this->limit = $limit;
    }

    /**
     * Get the fetched items for the current selection
     * 
     * @return Collection
     */
    public function getItems(): Collection
    {
        if (!isset($this->items)) {
            $this->items = $this->modelClass::where($this->key, '>', $this->cursor)->take($this->limit)->get();
        };

        return $this->items;
    }

    /**
     * Get the total number of items
     * 
     * @return int
     */
    public function getTotalCount(): int
    {
        if (!isset($this->totalCount)) {
            $this->totalCount = $this->modelClass::count();
        }

        return $this->totalCount;
    }

    /**
     * Get the cursor of the last fetchable item
     * 
     * @return int
     */
    public function getEndCursor(): int
    {
        if (!isset($this->endCursor)) {
            $key = $this->key;
            $this->endCursor = $this->modelClass::select($key)->orderBy($key, 'DESC')->first()->$key;
        }

        return $this->endCursor;
    }

    /**
     * Check if other items can be fetched next this selection
     * 
     * @return bool
     */
    public function hasNextPage(): bool
    {
        if (!isset($this->hasNextPage)) {
            $this->hasNextPage = !$this->getItems()->contains($this->key, $this->getEndCursor());
        }

        return $this->hasNextPage;
    }
}
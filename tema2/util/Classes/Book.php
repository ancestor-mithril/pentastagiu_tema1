<?php
    class Book 
    {
        public int $id;
        public string $title;
        public int $authorId;
        public int $publisherId;
        public int $year;
        public ?string $created_at;
        public ?string $updated_at;

        public function __construct(int $id, string $title, int $authorId, int $publisherId, int $year, 
            $created_at, $updated_at)
        {
            $this->id = $id;
            $this->title = $title;
            $this->authorId = $authorId;
            $this->publisherId = $publisherId;
            $this->year = $year;
            $this->created_at = $created_at;
            $this->updated_at = $updated_at;
        }
    }
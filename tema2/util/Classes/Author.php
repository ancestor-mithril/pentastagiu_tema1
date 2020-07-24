<?php
    class Author 
    {
        public int $id;
        public string $name;
        public ?string $created_at;
        public ?string $updated_at;

        public function __construct(int $id, string $name, $created_at, $updated_at)
        {
            $this->id = $id;
            $this->name = $name;
            $this->created_at = $created_at;
            $this->updated_at = $updated_at;
        }
    }
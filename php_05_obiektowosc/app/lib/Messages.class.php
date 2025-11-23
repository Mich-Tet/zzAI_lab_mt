<?php
class Messages {
    private array $messages = [];

    public function add(string $msg): void {
        $this->messages[] = $msg;
    }

    public function isEmpty(): bool {
        return empty($this->messages);
    }

    public function getAll(): array {
        return $this->messages;
    }

    public function clear(): void {
        $this->messages = [];
    }
}
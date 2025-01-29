<?php

// src/Message/EmailMessage.php
namespace App\Message;

class EmailMessage
{
    public function __construct(
        private string $content,
    ) {
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
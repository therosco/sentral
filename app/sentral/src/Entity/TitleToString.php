<?php

namespace App\Entity;

trait TitleToString {
    abstract public function getTitle(): string;

    public function __toString(): string {
        return $this->getTitle();
    }
}
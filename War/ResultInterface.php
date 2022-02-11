<?php

interface ResultInterface
{
    public function __construct($army1, $army2, $weather = 'fine');

    public function getOverallResult(): array;

    public function getEachRowResults(): array;
}

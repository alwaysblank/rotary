<?php


namespace AlwaysBlank\Rotary;


class Rotary
{
    protected $input;

    public function __construct(string $input)
    {
        $this->input = $input;
    }

    public function pretty(): string
    {
        return Render::pretty($this->input);
    }

    public function href(): string
    {
        return Render::href($this->input);
    }

    public function simple(): string
    {
        return Render::simple($this->input);
    }

    public function normalized(): string
    {
        return Render::normalized($this->input);
    }

    public function format(callable $template): string
    {
        return Render::render($template, $this->input);
    }
}

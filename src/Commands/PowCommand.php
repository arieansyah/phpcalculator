<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;

class PowCommand extends Command
{
    /**
     * @var string
     */
    protected $signature;

    /**
     * @var string
     */
    protected $description;

    public function __construct()
    {
        $commandVerb = $this->getCommandVerb();

        // $this->signature = sprintf(
        //     '%s {numbers* : The numbers to be %s}',
        //     $commandVerb,
        //     $this->getCommandPassiveVerb()
        // );

        //argument
        $argument = '';
        foreach ($this->getCommandPassiveVerb() as $value) {
            $argument .= sprintf("%s", $value);
        }

        $this->signature = sprintf(
            '%s  %s',
            $commandVerb,
            $argument
        );
        // $this->description = sprintf('%s all given Numbers', ucfirst($commandVerb));
        $this->description = sprintf('Exponent all given Numbers');
        parent::__construct();
    }

    protected function getCommandVerb(): string
    {
        return 'pow';
    }

    protected function getCommandPassiveVerb(): array
    {
        return [
            '{base : The base number}',
            '{exp : The exponent number}',
        ];
    }

    public function handle(): void
    {
        $numbers = $this->shiftNumber();
        $description = $this->generateCalculationDescription($numbers);
        $result = $this->calculateAll($numbers);

        $this->comment(sprintf('%s = %s', $description, $result));
    }

    protected function shiftNumber(): array
    {
        $numbers = $this->getInput();

        $array = [];
        foreach ($numbers as $value) {
            $array[] = $value;
        }

        array_shift($array);
        return $array;
    }

    protected function getInput(): array
    {
        return $this->arguments();
    }

    protected function generateCalculationDescription(array $numbers): string
    {
        $operator = $this->getOperator();
        $glue = sprintf(' %s ', $operator);

        return implode($glue, $numbers);
    }

    protected function getOperator(): string
    {
        return '^';
    }

    /**
     * @param array $numbers
     *
     * @return float|int
     */
    protected function calculateAll(array $numbers)
    {
        $number = array_pop($numbers);

        if (count($numbers) <= 0) {
            return $number;
        }

        return $this->calculate($this->calculateAll($numbers), $number);
    }

    /**
     * @param int|float $number1
     * @param int|float $number2
     *
     * @return int|float
     */
    protected function calculate($number1, $number2)
    {
        return pow($number1, $number2);
    }
}

<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;
use Jakmall\Recruitment\Calculator\Repository\HistoryRepository as History;

abstract class Core extends Command
{
    /**
     * @var string
     */
    protected $signature;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $operator;

    /**
     * @var string
     */
    protected $command;

    /**
     * @var array
     */
    protected $argument;

    public function __construct()
    {
        $this->signature = $this->generateSignature();
        $this->description = sprintf('%s', ucwords($this->description));
        parent::__construct();
    }

    public function generateSignature()
    {
        $signatures = '';
        foreach ($this->argument as $value) {
            $signatures .= sprintf('{%s}', $value);
        }
        $result = sprintf('%s %s', $this->command, $signatures);

        return $result;
    }

    public function handle(): void
    {
        $input = $this->getInput();
        $description = $this->generateCalculationDescription($input);
        $result = $this->calculateAll($input);
        $output = sprintf('%s = %s', $description, $result);

        History::create([
            "command" => $this->command,
            "description" => $description,
            "result" => $result,
            "output" => $output,
        ]);
        $this->comment($output);
        return;
    }

    protected function getInput(): array
    {
        if (count($this->argument) > 1) {
            $array = [];
            foreach ($this->arguments() as $value) {
                $array[] = $value;
            }

            array_shift($array);
            return $array;
        }

        return $this->argument("numbers");
    }

    private function clean($string)
    {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        return $string;
    }

    protected function generateCalculationDescription(array $numbers): string
    {
        $operator = $this->getOperator();
        $glue = sprintf(' %s ', $operator);

        return implode($glue, $numbers);
    }

    protected function getOperator(): string
    {
        return $this->operator;
    }

    protected function calculateAll(array $numbers)
    {
        $sum = array_shift($numbers);

        foreach ($numbers as $number) {
            $sum = $this->calculate($sum, $number);
        }

        return $sum;
    }

    protected function calculate($number1, $number2)
    {
        switch ($this->command) {
            case 'add':
                return $number1 + $number2;
                break;
            case 'subtract':
                return $number1 - $number2;
                break;
            case 'multiply':
                return $number1 * $number2;
                break;
            case 'divide':
                return $number1 / $number2;
                break;
            case 'pow':
                return $number1 ** $number2;
                break;
            default:
                return 0;
        }
    }
}

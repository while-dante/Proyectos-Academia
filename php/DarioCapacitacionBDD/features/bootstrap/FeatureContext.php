<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Juego\Vieja;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{

    private $vieja;

    /**
     * @Given an empty board
     */
    public function anEmptyBoard()
    {
        $this->vieja = new Vieja;
    }

    /**
     * @When I select cell :row :column
     */
    public function iSelectCell($row, $column)
    {
        $this->vieja->jugar($row, $column);
    }

    /**
     * @Then the board should be marked with an :symbol on cell :row :column
     */
    public function theBoardShouldBeMarkedWithAnOnCell($symbol, $row, $column)
    {
        PHPUnit\Framework\Assert::assertEquals(
            $symbol,
            $this->vieja->mostrar()[$row][$column]
        );
    }

    /**
     * @Then there should not be a tie
     */
    public function thereShouldNotBeATie()
    {
        PHPUnit\Framework\Assert::assertFalse(
            $this->vieja->empate()
        );
    }

    /**
     * @Then there should be a tie
     */
    public function thereShouldBeATie()
    {
        PHPUnit\Framework\Assert::assertTrue(
            $this->vieja->empate()
        );
    }

    /**
     * @Then X should have won
     */
    public function xShouldHaveWon()
    {
        PHPUnit\Framework\Assert::assertTrue(
            $this->vieja->xGana()
        );
    }

    /**
     * @Then O should not have won
     */
    public function oShouldNotHaveWon()
    {
        PHPUnit\Framework\Assert::assertFalse(
            $this->vieja->oGana()
        );
    }

    /**
     * @Then the game should not have ended
     */
    public function theGameShouldNotHaveEnded()
    {
        PHPUnit\Framework\Assert::assertFalse(
            $this->vieja->termino()
        );
    }

    /**
     * @Then X should not have won
     */
    public function xShouldNotHaveWon()
    {
        PHPUnit\Framework\Assert::assertFalse(
            $this->vieja->xGana()
        );
    }

    /**
     * @Then O should have won
     */
    public function oShouldHaveWon()
    {
        PHPUnit\Framework\Assert::assertTrue(
            $this->vieja->oGana()
        );
    }

    /**
     * @Then the game should have ended
     */
    public function theGameShouldHaveEnded()
    {
        PHPUnit\Framework\Assert::assertTrue(
            $this->vieja->termino()
        );
    }

    /**
     * @Then the board should not be marked on cell :row :column
     */
    public function theBoardShouldNotBeMarkedOnCell($row, $column)
    {
        PHPUnit\Framework\Assert::assertEquals(
            ' ',
            $this->vieja->mostrar()[$row][$column]
        );
    }
}

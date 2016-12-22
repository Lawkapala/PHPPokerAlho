<?php

namespace PHPPokerAlho\Gameplay\Cards;

/**
 * A standard Poker Card
 *
 * @since  {nextRelease}
 *
 * @author Artur Alves <artur.ze.alves@gmail.com>
 */
class StandardCard extends Card
{
    /**
     * Create a StandardCard from their face value and Suit name abbreviation
     *
     * @since  {nextRelease}
     *
     * @param  string $str The StandardCard's face value and Suit's abbreviation
     *
     * @return StandardCard|null
     */
    public static function fromString(string $str)
    {
        if (strlen($str) != 2) {
            return null;
        }

        $instance = new self();
        $instance->setFaceValue($str[0]);
        $instance->setSuit(StandardSuit::fromAbbr($str[1]));
        return $instance;
    }

    /**
     * Return a string representation of the Card
     *
     * @since  {nextRelease}
     *
     * @return string The Card represented as a string
     */
    public function __toString()
    {
        return '[' . $this->getFaceValue() . $this->suit->__toString() . ']';
    }

    /**
     * Return a string representation of the Card, formated with CLI colors
     *
     * @since  {nextRelease}
     *
     * @return string The Card represented as a string
     */
    public function toCliOutput()
    {
        $symbol = $this->suit->getSymbol();
        if ($symbol == StandardSuit::CLUBS[1]
            || $symbol == StandardSuit::SPADES[1]
        ) {
            $suit = '<bg=white;fg=black>' . $this->suit . "</>";
        } elseif ($symbol == StandardSuit::HEARTS[1]
            || $symbol == StandardSuit::DIAMONDS[1]
        ) {
            $suit = '<bg=white;fg=red>' . $this->suit . "</>";
        }
        return '<bg=white;fg=black>[' . $this->getFaceValue() . $suit . ']</>';
    }

    /**
     * Set the Card's value.
     * The value must be between 1 and 13
     *
     * @since  {nextRelease}
     *
     * @param  int $value The card's value
     *
     * @return Card|null Card on success, null on failure
     */
    public function setValue($value)
    {
        if ($value < 1 || $value > 13) {
            return null;
        }

        return parent::setValue($value);
    }

    /**
     * Convert the Card's value to their corresponding face value
     *
     * @since  {nextRelease}
     *
     * @return string The Card's face value
     */
    public function getFaceValue()
    {
        switch ($this->value) {
            case 1:
                $value = "A";
                break;
            case 10:
                $value = "T";
                break;
            case 11:
                $value = "J";
                break;
            case 12:
                $value = "Q";
                break;
            case 13:
                $value = "K";
                break;
            default:
                $value = $this->value;
        }
        return $value;
    }

    /**
     * Set the Card value by their corresponding face value
     *
     * @since  {nextRelease}
     *
     * @param  string $value [description]
     */
    public function setFaceValue(string $value)
    {
        switch ($value) {
            case "A":
                $value = 1;
                break;
            case "T":
                $value = 10;
                break;
            case "J":
                $value = 11;
                break;
            case "Q":
                $value = 12;
                break;
            case "K":
                $value = 13;
                break;
        }

        return $this->setValue($value);
    }
}

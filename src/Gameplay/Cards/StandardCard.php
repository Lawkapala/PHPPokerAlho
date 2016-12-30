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
     * @var integer
     */
    const TWO = 2;

    /**
     * @var integer
     */
    const THREE = 3;

    /**
     * @var integer
     */
    const FOUR = 4;

    /**
     * @var integer
     */
    const FIVE = 5;

    /**
     * @var integer
     */
    const SIX = 6;

    /**
     * @var integer
     */
    const SEVEN = 7;

    /**
     * @var integer
     */
    const EIGHT = 8;

    /**
     * @var integer
     */
    const NINE = 9;

    /**
     * @var integer
     */
    const TEN = 10;

    /**
     * @var integer
     */
    const JACK = 11;

    /**
     * @var integer
     */
    const QUEEN = 12;

    /**
     * @var integer
     */
    const KING = 13;

    /**
     * @var integer
     */
    const ACE = 14;

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
     * The value must be between 2 and 14
     *
     * @since  {nextRelease}
     *
     * @param  int $value The card's value
     *
     * @return Card|null Card on success, null on failure
     */
    public function setValue($value)
    {
        if ($value < 2 || $value > 14) {
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
            case 14:
                $value = "A";
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
            case "A":
                $value = 14;
                break;
        }

        return $this->setValue($value);
    }

    /**
     * Gets the Card name given its value.<br/>
     * If invalid value of Card is given returns "Unknown".
     *
     * @since   {nextRelease}
     *
     * @param   int $value Card value.
     * @param   bool $plural [optional] <p>
     * If given and is <b>TRUE</b>, gets the Card name in the plural form,
     * <b>FALSE</b> otherwise.
     * 
     * @return  string Card name | "Unknown".
     */
    public static function getName(int $value, bool $plural = false)
    {
        switch ($value) {
            case self::TWO:
                $name = $plural ? "Twos" : "Two";
                break;
            case self::THREE:
                $name = $plural ? "Threes" : "Three";
                break;
            case self::FOUR:
                $name = $plural ? "Fours" : "Four";
                break;
            case self::FIVE:
                $name = $plural ? "Fives" : "Five";
                break;
            case self::SIX:
                $name = $plural ? "Sixes" : "Six";
                break;
            case self::SEVEN:
                $name = $plural ? "Sevens" : "Seven";
                break;
            case self::EIGHT:
                $name = $plural ? "Eights" : "Eight";
                break;
            case self::NINE:
                $name = $plural ? "Nines" : "Nine";
                break;
            case self::TEN:
                $name = $plural ? "Tens" : "Ten";
                break;
            case self::JACK:
                $name = $plural ? "Jacks" : "Jack";
                break;
            case self::QUEEN:
                $name = $plural ? "Queens" : "Queen";
                break;
            case self::KING:
                $name = $plural ? "Kings" : "King";
                break;
            case self::ACE:
                $name = $plural ? "Aces" : "Ace" ;
                break;
            default:
                $name = "Unknown";
        }
        return $name;
    }
}

<?php

namespace PHPPokerAlho\Gameplay\Game;

use PHPPokerAlho\Gameplay\Rules\HandRanking;
use PHPPokerAlho\Gameplay\Cards\StandardCard;

/**
 * @since  {nextRelease}
 *
 * @author Artur Alves <artur.ze.alves@gmail.com>
 * @author Flávio Diniz <f.diniz14@gmail.com>
 */
class HandStrength
{
    /**
     * The hand ranking.
     *
     * @see HandRanking::class
     *
     * @var int
     */
    protected $ranking = 0;

    /**
     * If the ranking is HandRanking::ONE_PAIR, then this variable represents
     * the value of those two cards that form the pair
     *
     * @var array
     */
    protected $rankCardValues = array();

    /**
     * A reverse sorted array containing the values of each kicker card
     *
     * @var array
     */
    protected $kickers = array();

    /**
     * Constructor
     *
     * @since  {nextRelease}
     *
     * @param  int $rank The HandRanking
     * @param  array $rankCardValues The Ranking Card's value
     * @param  array $kickers Array of kickers
     */
    public function __construct(int $rank, array $rankCardValues, array $kickers)
    {
        $this->ranking = $rank;
        $this->rankCardValues = $rankCardValues;
        $this->kickers = $kickers;
    }

    /**
     * Returns a string representation of the HandStrength
     *
     * @since   {nextRelease}
     *
     * @return  string The HandStrength represented as a string
     */
    public function __toString()
    {
        $str = $this->rankingToStr();
        $str .= $this->getRankingCardValuesString();
        $str .= $this->kickersToStr();

        return $str;
    }

    /**
     * Get the hand's ranking
     *
     * @since  {nextRelease}
     *
     * @return int The hand's ranking
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * Get the hand's ranking card value
     *
     * @since  {nextRelease}
     *
     * @return int The hand's ranking card value
     */
    public function getRankingCardValues()
    {
        return $this->rankCardValues;
    }

    /**
     * Get the array of kickers
     *
     * @since  {nextRelease}
     *
     * @return array The array of kickers
     */
    public function getKickers()
    {
        return $this->kickers;
    }

    /**
     * Gets the name of the HandStrength ranking.
     * 
     * @since   {nextRelease}
     * 
     * @return  string The ranking name.
     */
    private function rankingToStr()
    {
        return HandRanking::getName($this->ranking) . ": ";
    }
    
    /**
     * Based on the HandStrength ranking gets the name
     * of the HandStrength rankingCardValues.
     * 
     * @since   {nextRelease}
     * 
     * @return  string The ranking Crads names.
     */
    private function getRankingCardValuesString()
    {
        $rankCardStr = "";
        switch ($this->ranking) {
            case HandRanking::ONE_PAIR:
            case HandRanking::TWO_PAIR:
            case HandRanking::THREE_OF_A_KIND:
            case HandRanking::FULL_HOUSE:
            case HandRanking::FOUR_OF_A_KIND:
                $rankCardStr = $this->rankingCardValuesToStr(true);
                break;
            case HandRanking::FLUSH:
                break;
            default :
                $rankCardStr = $this->rankingCardValuesToStr();
        }
        return $rankCardStr;
    }

    /**
     * Gets the name(s) of the HandStrength ranking Card(s).
     * 
     * @since   {nextRelease}
     * 
     * @param   bool $plural [optional] <p>
     * If given and is <b>TRUE</b>, gets the Card name in the plural form,
     * <b>FALSE</b> otherwise.
     * 
     * @return  string The ranking Cards name
     */
    private function rankingCardValuesToStr(bool $plural = false)
    {
        $str = "";
        foreach ($this->rankCardValues as $cardValue) {
           $str .= StandardCard::getName($cardValue, $plural) . ", ";
        }
        $str = rtrim($str, ", ") . ". ";
        $pos = strrpos($str, ", ");
        if($pos !== false) {
            $str = substr_replace($str, " and ", $pos, strlen(", "));
        }
        return $str;
    }

    /**
     * Gets the name(s) of the HandStrength kicker(s).
     * 
     * @since   {nextRelease}
     * 
     * @return  string The kickers names.
     */
    private function kickersToStr()
    {
        $str = "";
        if (!empty($this->kickers)) {
            $str .= "Kickers: ";
            foreach ($this->kickers as $kicker) {
                $str .= StandardCard::getName($kicker) . ", ";
            }
            $str = rtrim($str, ", ") . ".";
        }
        return $str;
    }
}

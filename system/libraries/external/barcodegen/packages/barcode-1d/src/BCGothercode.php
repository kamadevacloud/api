<?php
declare(strict_types=1);

/**
 *--------------------------------------------------------------------
 *
 * Sub-Class - othercode
 *
 * Other Codes
 * Starting with a bar and altern to space, bar, ...
 * 0 is the smallest
 *
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://www.barcodebakery.com
 */
namespace BarcodeBakery\Barcode;

use BarcodeBakery\Common\BCGBarcode1D;
use BarcodeBakery\Common\BCGParseException;

class BCGothercode extends BCGBarcode1D
{
    /**
     * Creates an other type barcode.
     */
    public function __construct()
    {
        parent::__construct();

        $this->keys = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    }

    /**
     * Draws the barcode.
     *
     * @param resource $image The surface.
     * @return void
     */
    public function draw($image): void
    {
        $this->drawChar($image, $this->text, true);
        $this->drawText($image, 0, 0, $this->positionX, $this->thickness);
    }

    /**
     * Gets the label.
     * If the label was set to BCGBarcode1D::AUTO_LABEL, the label will display the value from the text parsed.
     *
     * @return string The label string.
     */
    public function getLabel(): string
    {
        $label = $this->label;
        if ($this->label === BCGBarcode1D::AUTO_LABEL) {
            $label = '';
        }

        return $label;
    }

    /**
     * Returns the maximal size of a barcode.
     *
     * @param int $width The width.
     * @param int $height The height.
     * @return int[] An array, [0] being the width, [1] being the height.
     */
    public function getDimension(int $width, int $height): array
    {
        $array = str_split($this->text, 1);
        $textlength = array_sum($array) + count($array);

        $width += $textlength;
        $height += $this->thickness;
        return parent::getDimension($width, $height);
    }

    /**
     * Validates the input.
     *
     * @return void
     */
    protected function validate(): void
    {
        $c = strlen((string) $this->text);
        if ($c === 0) {
            throw new BCGParseException('othercode', 'No data has been entered.');
        }

        // Checking if all chars are allowed
        for ($i = 0; $i < $c; $i++) {
            if (array_search($this->text[$i], $this->keys) === false) {
                throw new BCGParseException('othercode', 'The character \'' . $this->text[$i] . '\' is not allowed.');
            }
        }

        parent::validate();
    }
}

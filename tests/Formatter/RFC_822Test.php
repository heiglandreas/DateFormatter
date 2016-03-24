<?php
/**
 * Copyright (c) 2016-2016} Andreas Heigl<andreas@heigl.org>
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright 2016-2016 Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     24.03.2016
 * @link      http://github.com/heiglandreas/org.heigl.DateFormater
 */

namespace Org_Heigl\DateFormatterTest;

use Org_Heigl\DateFormatter\Formatter\RFC_822;

class RFC_822Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @param \DateTimeInterface $date
     * @param $expected
     *
     * @dataProvider formattingRFC_822DatesProvider
     */
    public function testThatFormattingRFC_822DatesWorks($date, $expected)
    {
        $formatter = new RFC_822();
        $this->assertEquals($expected, $formatter->format($date));
    }

    public function formattingRFC_822DatesProvider()
    {
        return [
            [new \DateTime('2013-12-03 12:34:45', new \DateTimeZone('Europe/Berlin')), 'Tue, 03 Dec 13 12:34:45 +0100'],
            [new \DateTime('2013-12-03 12:34:45', new \DateTimeZone('UTC')), 'Tue, 03 Dec 13 12:34:45 +0000'],
            [new \DateTime('2013-06-03 12:34:45', new \DateTimeZone('Europe/London')), 'Mon, 03 Jun 13 12:34:45 +0100'],
            [new \DateTime('2013-12-03 12:34:45', new \DateTimeZone('Europe/London')), 'Tue, 03 Dec 13 12:34:45 +0000'],

        ];
    }
}

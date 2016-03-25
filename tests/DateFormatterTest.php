<?php

/**
 * Copyright (c) 2016-2016} Andreas Heigl<andreas@heigl.org>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
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
 * @since     25.03.2016
 * @link      http://github.com/heiglandreas/org.heigl.DateFormatter
 */

namespace Org_HeiglTest\DateFormatter;

use Org_Heigl\DateFormatter\DateFormatter;

class DateFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testThatFormattingWithAFormatterWorks()
    {
        $date = new \DateTime('2013-12-03 12:23:34+01:00');
        $mock = $this->getMockBuilder('Org_Heigl\DateFormatter\Formatter\FormatterInterface')
            ->setMethods(['format', 'getFormatString'])
            ->getMock();

        $mock->expects($this->once())
            ->method('format')
            ->with($this->equalTo($date))
            ->will($this->returnValue('foo'))
        ;

        $formatter = new DateFormatter($mock);
        $this->assertAttributeEquals($mock, 'formatter', $formatter);
        $this->assertEquals('foo', $formatter->format($date));
    }

    public function testThatAddingAFormatterStringAddsTheFormatter()
    {
        $formatter = new DateFormatter('Atom');
        $this->assertAttributeInstanceOf(
            'Org_Heigl\DateFormatter\Formatter\Atom',
            'formatter',
            $formatter
        );
    }

    /**
     * @expectedException Org_Heigl\DateFormatter\UnknownFormatException
     */
    public function testThatTryingToSetInvalidFormatterResultsInAnException()
    {
        $formatter = new DateFormatter('NotExistingFormatter');
    }
}
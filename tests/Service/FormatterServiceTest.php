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
 * @since     24.03.2016
 * @link      http://github.com/heiglandreas/org.heigl.DateFormatter
 */

namespace Org_HeiglTest\Service;

use Org_Heigl\DateFormatter\Formatter\RSS;
use Org_Heigl\DateFormatter\Service\FormatterService;
use Org_Heigl\DateFormatter\UnknownFormatException;

class FormatterServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testThatGettingFormatterWorksForKnownFormatter()
    {
        $this->assertEquals(
            new RSS(),
            FormatterService::getFormatter('RSS')
        );
    }

    /** @expectedException Org_Heigl\DateFormatter\UnknownFormatException */
    public function testThatGettingFormatterFailsForUnknownFormatter()
    {
        FormatterService::getFormatter('BarFoo');
    }

    public function testThatAddingADirectoryAddsToArrayAndRemovesList()
    {
        FormatterService::getFormatter('RSS');

        $this->assertAttributeInstanceof(
            '\Org_Heigl\FileFinder\FileListInterface',
            'list',
            'Org_Heigl\DateFormatter\Service\FormatterService'
        );
        $this->assertAttributeEquals(
            [realpath(__DIR__ . '/../../src/Service') . '/../Formatter/'],
            'formatterDirectories',
            'Org_Heigl\DateFormatter\Service\FormatterService'
        );
        FormatterService::addFormatterFolder('FOoBar');
        $this->assertAttributeInstanceof(
            '\Org_Heigl\FileFinder\FileListInterface',
            'list',
            'Org_Heigl\DateFormatter\Service\FormatterService'
        );
        $this->assertAttributeEquals(
            [realpath(__DIR__ . '/../../src/Service') . '/../Formatter/'],
            'formatterDirectories',
            'Org_Heigl\DateFormatter\Service\FormatterService'
        );
        FormatterService::addFormatterFolder(__DIR__);
        $this->assertAttributeEquals(
            null,
            'list',
            'Org_Heigl\DateFormatter\Service\FormatterService'
        );
        $this->assertAttributeEquals(
            [
                __DIR__,
                realpath(__DIR__ . '/../../src/Service') . '/../Formatter/',
            ],
            'formatterDirectories',
            'Org_Heigl\DateFormatter\Service\FormatterService'
        );


    }
}

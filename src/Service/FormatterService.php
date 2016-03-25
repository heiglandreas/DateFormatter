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

namespace Org_Heigl\DateFormatter\Service;

use Org_Heigl\DateFormatter\UnknownFormatException;
use Org_Heigl\FileFinder\ClassMapList;
use Org_Heigl\FileFinder\FileFinder;
use Org_Heigl\FileFinder\Filter\ClassIsInstanceof;

class FormatterService
{
    protected static $list;

    protected static $formatterDirectories = [
        __DIR__ . '/../Formatter/',
    ];

    /**
     * @return \Org_Heigl\FileFinder\FileListInterface
     */
    protected static function getList()
    {
        if (! self::$list) {
            $finder = new FileFinder();
            $finder->addFilter(new ClassIsInstanceof(['Org_Heigl\DateFormatter\Formatter\FormatterInterface']));
            $finder->setFileList(new ClassMapList());
            foreach (self::$formatterDirectories as $directory) {
                $finder->addDirectory($directory);
            }
            self::$list = $finder->find();
        }

        return self::$list;
    }

    /**
     * @param string $format
     *
     * @return Org_Heigl\DateFormatter\Formatter\FormatterInterface
     */
    public static function getFormatter($format)
    {
        foreach (self::getList() as $class => $path) {
            if (! in_array(strtolower($format), array_map('strtolower', $class::getFormatString()))) {
                continue;
            }

            return new $class();
        }

        throw new UnknownFormatException('There is no formater for this format');
    }

    /**
     * @param string $folder
     *
     * @return void
     */
    public static function addFormatterFolder($folder)
    {
        if (! is_dir($folder)) {
            return;
        }

        array_unshift(self::$formatterDirectories, $folder);
        self::$list = null;
    }


}
<?php

namespace Everzet\HTAML\Filters;

use \Everzet\HTAML\Filters\Filter;

/*
 * This file is part of the HTAML package.
 * (c) 2010 Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * PHP filter.
 *
 * @package     HTAML
 * @author      Konstantin Kudryashov <ever.zet@gmail.com>
 */
class PHP implements Filter
{
    public function replaceHoldersWithEcho($str)
    {
        return preg_replace(array("/\{\{/", "/\}\}/"), array('<?php echo ', ' ?>'), $str);
    }

    public function filter($str, $indentation = 0)
    {
        $php = <<<PHP
<?php
$str
?>
PHP;
        return preg_replace("/\n/", "\n" . str_repeat('  ', $indentation), $php);
    }
}

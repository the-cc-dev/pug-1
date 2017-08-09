<?php

use Pug\Pug;

class ShareTest extends PHPUnit_Framework_TestCase
{
    public function testShare()
    {
        $pug = new Pug([
            'debug' => true,
        ]);
        $pug->share('answear', 42);
        $pug->share([
            'foo' => 'Hello',
            'bar' => 'world',
        ]);
        $html = $pug->render("p=foo\ndiv=answear");
        $this->assertSame('<p>Hello</p><div>42</div>', $html);

        $html = $pug->render("p=foo\ndiv=answear", [
            'answear' => 16,
        ]);
        $this->assertSame('<p>Hello</p><div>16</div>', $html);

        $html = $pug->render("p\n  =foo\n  =' '\n  =bar\n  | !");
        $this->assertSame('<p>Hello world!</p>', $html);
    }

    public function testResetSharedVariables()
    {
        $pug = new Pug([
            'debug' => true,
        ]);
        $pug->share('answear', 42);
        $pug->share([
            'foo' => 'Hello',
            'bar' => 'world',
        ]);
        $pug->resetSharedVariables();

        $error = null;
        try {
            $pug->render("p\n  =foo\n=' '\n=bar\n  | !");
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        $this->assertSame('Undefined variable: foo', $error);
    }
}

<?php namespace Assetic\Test;

use Assetic\AssetManager;

class AssetManagerTest extends \PHPUnit_Framework_TestCase
{
    /** @var AssetManager */
    private $am;

    protected function setUp()
    {
        $this->am = new AssetManager();
    }

    public function testGetAsset()
    {
        $asset = $this->getMockBuilder('Assetic\\Contracts\\Asset\\AssetInterface')->getMock();
        $this->am->set('foo', $asset);
        $this->assertSame($asset, $this->am->get('foo'), '->get() returns an asset');
    }

    public function testGetInvalidAsset()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->am->get('foo');
    }

    public function testHas()
    {
        $asset = $this->getMockBuilder('Assetic\\Contracts\\Asset\\AssetInterface')->getMock();
        $this->am->set('foo', $asset);

        $this->assertTrue($this->am->has('foo'), '->has() returns true if the asset is set');
        $this->assertFalse($this->am->has('bar'), '->has() returns false if the asset is not set');
    }

    public function testInvalidName()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->am->set('@foo', $this->getMockBuilder('Assetic\\Contracts\\Asset\\AssetInterface')->getMock());
    }

    public function testClear()
    {
        $this->am->set('foo', $this->getMockBuilder('Assetic\\Contracts\\Asset\\AssetInterface')->getMock());
        $this->am->clear();

        $this->assertFalse($this->am->has('foo'));
    }
}

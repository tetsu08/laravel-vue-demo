<?php

namespace App\Tests\Unit\Http\Builders;

use App\Http\Builders\ImageBuilder;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use ReflectionMethod;
use Tests\TestCase;

class ImageBuilderTest extends TestCase
{
    private ImageBuilder $builder;

    public function setUp(): void
    {
        $this->builder = new ImageBuilder();
        parent::setUp();
    }

    public function tearDown(): void
    {
        Storage::disk('public')->delete($this->builder->getImageFileName());
        parent::tearDown();
    }

    /**
     * @throws \ReflectionException
     */
    public function test_saveImage()
    {
        $reflection = new ReflectionMethod($this->builder, 'saveImage');
        $reflection->setAccessible(true);
        $reflection->invoke($this->builder, Image::canvas(10, 10, '#000000'));
        Storage::disk('public')->assertExists($this->builder->getImageFileName());
    }
}

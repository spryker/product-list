<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\ProductList\Business\ProductListRestrictionFilter;

use Codeception\Test\Unit;
use Spryker\Zed\ProductList\Business\ProductList\ProductListReaderInterface;
use Spryker\Zed\ProductList\Business\ProductListRestrictionFilter\ProductListRestrictionFilter;
use Spryker\Zed\ProductList\Business\ProductListRestrictionFilter\ProductListRestrictionFilterInterface;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group ProductList
 * @group Business
 * @group ProductListRestrictionFilter
 * @group ProductListRestrictionFilterTest
 * Add your own group annotations below this line
 */
class ProductListRestrictionFilterTest extends Unit
{
    /**
     * @var \SprykerTest\Zed\ProductList\ProductListBusinessTester
     */
    protected $tester;

    /**
     * @var \Spryker\Zed\ProductList\Business\ProductList\ProductListReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListReaderMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->productListReaderMock = $this->createProductListReaderMock();
    }

    public function testFilterRestrictedProductConcreteSkusWithSkuInBlacklist(): void
    {
        // Assign
        $customerBlacklistIds = [1];
        $customerWhitelistIds = [];

        $this->productListReaderMock
            ->method('getProductConcreteSkusInBlacklists')
            ->willReturn(['x']);

        $cartSkus = ['x', 'y'];
        $expectedSku = ['x'];

        // Act
        $filteredSkus = $this->createProductListRestrictionFilter()
            ->filterRestrictedProductConcreteSkus($cartSkus, $customerBlacklistIds, $customerWhitelistIds);

        // Assert
        $this->assertSame($filteredSkus, $expectedSku);
    }

    public function testFilterRestrictedProductConcreteSkusWithSkuInWhitelist(): void
    {
        // Assign
        $customerBlacklistIds = [];
        $customerWhitelistIds = [2];

        $this->productListReaderMock
            ->method('getProductConcreteSkusInWhitelists')
            ->willReturn(['y']);

        $cartSkus = ['x', 'y'];
        $expectedSku = ['x'];

        // Act
        $filteredSkus = $this->createProductListRestrictionFilter()
            ->filterRestrictedProductConcreteSkus($cartSkus, $customerBlacklistIds, $customerWhitelistIds);

        // Assert
        $this->assertSame($filteredSkus, $expectedSku);
    }

    public function testFilterRestrictedProductConcreteSkusWithSkuInBlacklistAndWhitelist(): void
    {
        // Assign
        $customerBlacklistIds = [1];
        $customerWhitelistIds = [2];

        $this->productListReaderMock
            ->method('getProductConcreteSkusInWhitelists')
            ->willReturn(['y']);

        $this->productListReaderMock
            ->method('getProductConcreteSkusInBlacklists')
            ->willReturn(['x']);

        $cartSkus = ['x', 'y', 'z'];
        $expectedSku = ['x', 'z'];

        // Act
        $filteredSkus = $this->createProductListRestrictionFilter()
            ->filterRestrictedProductConcreteSkus($cartSkus, $customerBlacklistIds, $customerWhitelistIds);

        // Assert
        $this->assertSame(array_values($filteredSkus), $expectedSku);
    }

    public function testFilterRestrictedProductConcreteSkusWithSkuInBlacklistWhileDuplicatedInWhitelistShouldAlsoBeBlacklisted(): void
    {
        // Assign
        $customerBlacklistIds = [1];
        $customerWhitelistIds = [2];

        $this->productListReaderMock
            ->method('getProductConcreteSkusInWhitelists')
            ->willReturn(['y']);

        $this->productListReaderMock
            ->method('getProductConcreteSkusInBlacklists')
            ->willReturn(['x', 'y']);

        $cartSkus = ['x', 'y', 'z'];
        $expectedSku = ['x', 'y', 'z'];

        // Act
        $filteredSkus = $this->createProductListRestrictionFilter()
            ->filterRestrictedProductConcreteSkus($cartSkus, $customerBlacklistIds, $customerWhitelistIds);

        // Assert
        $this->assertSame(array_values($filteredSkus), $expectedSku);
    }

    public function testFilterRestrictedProductConcreteSkusWithEmptyWhitelist(): void
    {
        // Assign
        $customerBlacklistIds = [];
        $customerWhitelistIds = [2];

        $this->productListReaderMock
            ->method('getProductConcreteSkusInWhitelists')
            ->willReturn([]);

        $cartSkus = ['x', 'y', 'z'];
        $expectedSku = ['x', 'y', 'z'];

        // Act
        $filteredSkus = $this->createProductListRestrictionFilter()
            ->filterRestrictedProductConcreteSkus($cartSkus, $customerBlacklistIds, $customerWhitelistIds);

        // Assert
        $this->assertSame($filteredSkus, $expectedSku);
    }

    protected function createProductListRestrictionFilter(): ProductListRestrictionFilterInterface
    {
        return new ProductListRestrictionFilter(
            $this->productListReaderMock,
        );
    }

    /**
     * @return \Spryker\Zed\ProductList\Business\ProductList\ProductListReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected function createProductListReaderMock(): ProductListReaderInterface
    {
        return $this->getMockBuilder(ProductListReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}

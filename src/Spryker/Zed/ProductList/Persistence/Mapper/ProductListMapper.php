<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductList\Persistence\Mapper;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\SpyProductListEntityTransfer;
use Orm\Zed\ProductList\Persistence\SpyProductList;
use Propel\Runtime\Collection\ObjectCollection;

class ProductListMapper
{
    public function mapProductListTransferToEntityTransfer(
        ProductListTransfer $productListTransfer,
        SpyProductListEntityTransfer $spyProductListEntityTransfer
    ): SpyProductListEntityTransfer {
        return $spyProductListEntityTransfer->fromArray($productListTransfer->modifiedToArray(), true);
    }

    public function mapEntityTransferToProductListTransfer(
        SpyProductListEntityTransfer $spyProductListEntityTransfer,
        ProductListTransfer $productListTransfer
    ): ProductListTransfer {
        return $productListTransfer->fromArray($spyProductListEntityTransfer->toArray(), true);
    }

    public function mapEntityToProductListTransfer(
        SpyProductList $spyProductListEntity,
        ProductListTransfer $productListTransfer
    ): ProductListTransfer {
        return $productListTransfer->fromArray($spyProductListEntity->toArray(), true);
    }

    public function mapProductListTransferToEntity(
        ProductListTransfer $productListTransfer,
        SpyProductList $spyProductListEntity
    ): SpyProductList {
        $spyProductListEntity->fromArray($productListTransfer->toArray());

        return $spyProductListEntity;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\ProductList\Persistence\SpyProductList> $productListEntities
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function mapProductListEntitiesToProductListCollectionTransfer(
        ObjectCollection $productListEntities,
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ProductListCollectionTransfer {
        foreach ($productListEntities as $productListEntity) {
            $productListCollectionTransfer->addProductList(
                $this->mapEntityToProductListTransfer($productListEntity, new ProductListTransfer()),
            );
        }

        return $productListCollectionTransfer;
    }
}

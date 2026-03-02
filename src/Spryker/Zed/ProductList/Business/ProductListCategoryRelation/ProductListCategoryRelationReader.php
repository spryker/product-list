<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductList\Business\ProductListCategoryRelation;

use Generated\Shared\Transfer\ProductListCategoryRelationTransfer;
use Spryker\Zed\ProductList\Persistence\ProductListRepositoryInterface;

class ProductListCategoryRelationReader implements ProductListCategoryRelationReaderInterface
{
    /**
     * @var \Spryker\Zed\ProductList\Persistence\ProductListRepositoryInterface
     */
    protected $productListRepository;

    public function __construct(
        ProductListRepositoryInterface $productListRepository
    ) {
        $this->productListRepository = $productListRepository;
    }

    public function getProductListCategoryRelation(
        ProductListCategoryRelationTransfer $productListCategoryRelationTransfer
    ): ProductListCategoryRelationTransfer {
        $productListCategoryRelationTransfer->requireIdProductList();

        $categoryIds = $this->productListRepository->getRelatedCategoryIdsByIdProductList($productListCategoryRelationTransfer->getIdProductList());
        $productListCategoryRelationTransfer->setCategoryIds($categoryIds);

        return $productListCategoryRelationTransfer;
    }
}

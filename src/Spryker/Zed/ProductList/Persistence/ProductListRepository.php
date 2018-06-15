<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductList\Persistence;

use Generated\Shared\Transfer\ProductListTransfer;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCategoryTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListProductConcreteTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use Spryker\Zed\ProductList\Persistence\Mapper\ProductListMapperInterface;

/**
 * @method \Spryker\Zed\ProductList\Persistence\ProductListPersistenceFactory getFactory()
 */
class ProductListRepository extends AbstractRepository implements ProductListRepositoryInterface
{
    /**
     * @param int $idProductList
     *
     * @return int[]
     */
    public function getRelatedCategoryIdsByIdProductList(int $idProductList): array
    {
        return $this->getFactory()
            ->createProductListCategoryQuery()
            ->select(SpyProductListCategoryTableMap::COL_FK_CATEGORY)
            ->findByFkProductList($idProductList)
            ->toArray();
    }

    /**
     * @param int $idProductList
     *
     * @return int[]
     */
    public function getRelatedProductConcreteIdsByIdProductList(int $idProductList): array
    {
        return $this->getFactory()
            ->createProductListProductConcreteQuery()
            ->select(SpyProductListProductConcreteTableMap::COL_FK_PRODUCT)
            ->findByFkProductList($idProductList)
            ->toArray();
    }

    /**
     * @param int $idProductList
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function getProductListById(int $idProductList): ProductListTransfer
    {
        $productListTransfer = new ProductListTransfer();
        $query = $this->getFactory()
            ->createProductListQuery()
            ->filterByIdProductList($idProductList);
        $spyProductListEntityTransfer = $this->buildQueryFromCriteria($query)->findOne();

        return $this->getMapper()
            ->mapEntityTransferToProductListTransfer($spyProductListEntityTransfer, $productListTransfer);
    }

    /**
     * @return \Spryker\Zed\ProductList\Persistence\Mapper\ProductListMapperInterface
     */
    protected function getMapper(): ProductListMapperInterface
    {
        return $this->getFactory()
            ->createProductListMapper();
    }
}

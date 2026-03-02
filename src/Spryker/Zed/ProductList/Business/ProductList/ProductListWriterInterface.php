<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductList\Business\ProductList;

use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListWriterInterface
{
    public function saveProductList(ProductListTransfer $productListTransfer): ProductListTransfer;

    public function createProductList(ProductListTransfer $productListTransfer): ProductListResponseTransfer;

    public function updateProductList(ProductListTransfer $productListTransfer): ProductListResponseTransfer;

    public function deleteProductList(ProductListTransfer $productListTransfer): ProductListResponseTransfer;
}

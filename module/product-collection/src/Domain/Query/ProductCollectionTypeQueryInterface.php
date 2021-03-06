<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\ProductCollection\Domain\Query;

use Ergonode\Core\Domain\ValueObject\Language;
use Ergonode\Grid\DataSetInterface;
use Ergonode\ProductCollection\Domain\ValueObject\ProductCollectionTypeCode;
use Ergonode\SharedKernel\Domain\Aggregate\ProductCollectionTypeId;

/**
 */
interface ProductCollectionTypeQueryInterface
{
    /**
     * @param Language $language
     *
     * @return DataSetInterface
     */
    public function getDataSet(Language $language): DataSetInterface;

    /**
     * @return string[]
     */
    public function getDictionary(): array;

    /**
     * @param ProductCollectionTypeCode $code
     *
     * @return ProductCollectionTypeId|null
     */
    public function findIdByCode(ProductCollectionTypeCode $code): ?ProductCollectionTypeId;

    /**
     * @param Language $language
     *
     * @return array
     */
    public function getCollectionTypes(Language $language): array;
}

<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Attribute\Application\Controller\Api\Option;

use Ergonode\Api\Application\Response\SuccessResponse;
use Ergonode\Attribute\Domain\Entity\AbstractAttribute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Ergonode\Attribute\Domain\Query\OptionQueryInterface;

/**
 * @Route("/attributes/{attribute}/options", methods={"GET"})
 */
class OptionsReadAction
{
    /**
     * @var OptionQueryInterface
     */
    private OptionQueryInterface $query;

    /**
     * @param OptionQueryInterface $query
     */
    public function __construct(OptionQueryInterface $query)
    {
        $this->query = $query;
    }

    /**
     * @IsGranted("ATTRIBUTE_READ")
     *
     * @SWG\Tag(name="Attribute")
     * @SWG\Parameter(
     *     name="attribute",
     *     in="path",
     *     type="string",
     *     description="Attribute id",
     * )
     * @SWG\Parameter(
     *     name="language",
     *     in="path",
     *     type="string",
     *     required=true,
     *     default="en",
     *     description="Language Code",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns options collections",
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not found",
     * )
     *
     * @param AbstractAttribute $attribute
     *
     * @return Response
     *
     * @ParamConverter(class="Ergonode\Attribute\Domain\Entity\AbstractAttribute")
     */
    public function __invoke(AbstractAttribute $attribute): Response
    {
        $collection = $this->query->getAll($attribute->getId());

        return new SuccessResponse($collection);
    }
}

<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Attribute\Application\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Ergonode\Attribute\Infrastructure\Provider\CreateAttributeCommandFactoryProvider;

/**
 */
class CreateAttributeCommandFactoryProviderInterfaceCompilerPass implements CompilerPassInterface
{
    public const TAG = 'component.attribute.create_attribute_command_factory_interface';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container): void
    {
        if ($container->has(CreateAttributeCommandFactoryProvider::class)) {
            $this->processProvider($container);
        }
    }

    /**
     * @param ContainerBuilder $container
     */
    private function processProvider(ContainerBuilder $container): void
    {
        $arguments = [];
        $definition = $container->findDefinition(CreateAttributeCommandFactoryProvider::class);
        $strategies = $container->findTaggedServiceIds(self::TAG);

        foreach ($strategies as $id => $strategy) {
            $arguments[] = new Reference($id);
        }

        $definition->setArguments($arguments);
    }
}

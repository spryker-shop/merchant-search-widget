<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\MerchantSearchWidget;

use Generated\Shared\Transfer\ShopContextTransfer;
use Spryker\Yves\Kernel\AbstractFactory;
use SprykerShop\Yves\MerchantSearchWidget\Dependency\Client\MerchantSearchWidgetToMerchantSearchClientInterface;
use SprykerShop\Yves\MerchantSearchWidget\Form\DataProvider\MerchantsChoiceFormDataProvider;
use SprykerShop\Yves\MerchantSearchWidget\Form\MerchantsChoiceForm;
use SprykerShop\Yves\MerchantSearchWidget\Form\MerchantsSearchForm;
use SprykerShop\Yves\MerchantSearchWidget\Resolver\ShopContextResolver;
use SprykerShop\Yves\MerchantSearchWidget\Resolver\ShopContextResolverInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormInterface;

/**
 * @method \SprykerShop\Yves\MerchantSearchWidget\MerchantSearchWidgetConfig getConfig()
 */
class MerchantSearchWidgetFactory extends AbstractFactory
{
    public function createShopContextResolver(): ShopContextResolverInterface
    {
        return new ShopContextResolver($this->getContainer());
    }

    public function getShopContext(): ShopContextTransfer
    {
        return $this->createShopContextResolver()->resolve();
    }

    public function getFormFactory(): FormFactory
    {
        return $this->getProvidedDependency(MerchantSearchWidgetDependencyProvider::FORM_FACTORY);
    }

    /**
     * @param array<mixed> $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createMerchantsChoiceForm(array $options = []): FormInterface
    {
        return $this->getFormFactory()->create(MerchantsChoiceForm::class, null, $options);
    }

    public function createMerchantsChoiceFormDataProvider(): MerchantsChoiceFormDataProvider
    {
        return new MerchantsChoiceFormDataProvider($this->getMerchantSearchClient());
    }

    public function createMerchantsHiddenForm(): FormInterface
    {
        return $this->getFormFactory()->create(MerchantsSearchForm::class);
    }

    public function getMerchantSearchClient(): MerchantSearchWidgetToMerchantSearchClientInterface
    {
        return $this->getProvidedDependency(MerchantSearchWidgetDependencyProvider::CLIENT_MERCHANT_SEARCH);
    }
}

<?php declare(strict_types=1);

namespace Lacknere\PaulsBikeshopTheme\Controller;

use Shopware\Core\Framework\Validation\DataBag\QueryDataBag;
use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Controller\RegisterController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @phpstan-ignore shopware.internalClassExtends
 */
class RegisterControllerDecorator extends RegisterController
{
    public function __construct(
        private readonly RegisterController $decorated,
        private readonly SystemConfigService $systemConfigService
    ) {
    }

    public function accountRegisterPage(Request $request, RequestDataBag $data, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventAccount', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->accountRegisterPage($request, $data, $context);
    }

    public function customerGroupRegistration(string $customerGroupId, Request $request, RequestDataBag $data, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventAccount', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->customerGroupRegistration($customerGroupId, $request, $data, $context);
    }

    public function checkoutRegisterPage(Request $request, RequestDataBag $data, SalesChannelContext $context): Response
    {
        if (
            $this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventCheckout', $context->getSalesChannelId())
            || $this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventAccount', $context->getSalesChannelId())
        ) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->checkoutRegisterPage($request, $data, $context);
    }

    public function register(Request $request, RequestDataBag $data, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventAccount', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->register($request, $data, $context);
    }

    public function confirmRegistration(SalesChannelContext $context, QueryDataBag $queryDataBag): Response
    {
        return $this->decorated->confirmRegistration($context, $queryDataBag);
    }
}

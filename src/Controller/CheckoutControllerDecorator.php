<?php declare(strict_types=1);

namespace Lacknere\PaulsBikeshopTheme\Controller;

use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Controller\CheckoutController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @phpstan-ignore shopware.internalClassExtends
 */
class CheckoutControllerDecorator extends CheckoutController
{
    public function __construct(
        private readonly CheckoutController $decorated,
        private readonly SystemConfigService $systemConfigService
    ) {
    }

    public function cartPage(Request $request, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventCart', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->cartPage($request, $context);
    }

    public function cartJson(Request $request, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventCart', $context->getSalesChannelId())) {
            return new Response('Cart usage is currently disabled.', Response::HTTP_FORBIDDEN);
        }

        return $this->decorated->cartJson($request, $context);
    }

    public function confirmPage(Request $request, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventCheckout', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->confirmPage($request, $context);
    }

    public function finishPage(Request $request, SalesChannelContext $context, RequestDataBag $dataBag): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventCheckout', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->finishPage($request, $context, $dataBag);
    }

    public function order(RequestDataBag $data, SalesChannelContext $context, Request $request): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventCheckout', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->order($data, $context, $request);
    }

    public function info(Request $request, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventCart', $context->getSalesChannelId())) {
            return new Response('Cart usage is currently disabled.', Response::HTTP_FORBIDDEN);
        }

        return $this->decorated->info($request, $context);
    }

    public function offcanvas(Request $request, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventCart', $context->getSalesChannelId())) {
            return new Response('Cart usage is currently disabled.', Response::HTTP_FORBIDDEN);
        }

        return $this->decorated->offcanvas($request, $context);
    }
}

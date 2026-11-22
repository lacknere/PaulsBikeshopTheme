<?php declare(strict_types=1);

namespace Lacknere\PaulsBikeshopTheme\Controller;

use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Controller\AuthController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @phpstan-ignore shopware.internalClassExtends
 */
class AuthControllerDecorator extends AuthController
{
    public function __construct(
        private readonly AuthController $decorated,
        private readonly SystemConfigService $systemConfigService
    ) {
    }

    public function loginPage(Request $request, RequestDataBag $data, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventAccount', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->loginPage($request, $data, $context);
    }

    public function guestLoginPage(Request $request, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventAccount', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->guestLoginPage($request, $context);
    }

    public function logout(Request $request, SalesChannelContext $context, RequestDataBag $dataBag): Response
    {
        return $this->decorated->logout($request, $context, $dataBag);
    }

    public function login(Request $request, RequestDataBag $data, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventAccount', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->login($request, $data, $context);
    }

    public function recoverAccountForm(Request $request, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventAccount', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->recoverAccountForm($request, $context);
    }

    public function generateAccountRecovery(Request $request, RequestDataBag $data, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventAccount', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->generateAccountRecovery($request, $data, $context);
    }

    public function resetPasswordForm(Request $request, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventAccount', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->resetPasswordForm($request, $context);
    }

    public function resetPassword(RequestDataBag $data, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventAccount', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->resetPassword($data, $context);
    }

    public function imitateCustomerLogin(RequestDataBag $data, SalesChannelContext $context): Response
    {
        if ($this->systemConfigService->getBool('PaulsBikeshopTheme.config.preventAccount', $context->getSalesChannelId())) {
            return $this->redirectToRoute('frontend.home.page');
        }

        return $this->decorated->imitateCustomerLogin($data, $context);
    }

    public function convertForm(SalesChannelContext $context): Response
    {
        return $this->decorated->convertForm($context);
    }

    public function convert(RequestDataBag $request, SalesChannelContext $context): Response
    {
        return $this->decorated->convert($request, $context);
    }
}

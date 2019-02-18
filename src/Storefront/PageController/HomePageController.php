<?php declare(strict_types=1);

namespace Shopware\Storefront\PageController;

use Shopware\Core\Checkout\CheckoutContext;
use Shopware\Core\Framework\Routing\InternalRequest;
use Shopware\Storefront\Framework\Controller\StorefrontController;
use Shopware\Storefront\Framework\Page\PageLoaderInterface;
use Shopware\Storefront\Page\Home\HomePageLoader;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends StorefrontController
{
    /**
     * @var HomePageLoader|PageLoaderInterface
     */
    private $homePageLoader;

    public function __construct(PageLoaderInterface $homePageLoader)
    {
        $this->homePageLoader = $homePageLoader;
    }

    /**
     * @Route("/", name="frontend.home.page", options={"seo"="false"}, methods={"GET"})
     *
     * @param InternalRequest $request
     * @param CheckoutContext $context
     *
     * @return Response|null
     */
    public function index(InternalRequest $request, CheckoutContext $context): ?Response
    {
        $data = $this->homePageLoader->load($request, $context);

        return $this->renderStorefront('@Storefront/page/home/index.html.twig', ['page' => $data]);
    }
}

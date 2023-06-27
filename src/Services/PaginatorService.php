<?php

namespace App\Services;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class PaginatorService
{
       /**
     * le requete en cours
     *
     * @var RequestStack
     */
    private $requestStack;

    /**
     *
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(PaginatorInterface $paginator, RequestStack $requestStack)
    {
        $this->paginator = $paginator;
        $this->requestStack = $requestStack;
    } 

    public function paginator($data, $numberPerPage)
    {
        $request = $this->requestStack->getCurrentRequest();
        $page = $request->query->getInt('page', 1);

          $dataPaginate = $this->paginator->paginate(
            $data,
            $page,
            $numberPerPage // Number of elements per page
        );
        return $dataPaginate;
    }
}

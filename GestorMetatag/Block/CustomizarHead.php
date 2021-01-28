<?php
namespace AndersonMorais\GestorMetatag\Block;

class CustomizarHead extends \Magento\Framework\View\Element\Template
{
    /* Inicialização das variáveis */
    protected $_paginasCms = null;
    protected $_search = null;
    protected $_storeManager = null;
    protected $_storeLocal = null;
    protected $_paginaCms = null;

    public function __construct(
        /* Injeção de dependências necessárias */
        \Magento\Framework\View\Element\Template\Context $context, 
        \Magento\Cms\Api\PageRepositoryInterface $paginasCms,
        \Magento\Framework\Api\SearchCriteriaBuilder $search,
        \Magento\Store\Model\StoreManagerInterface $storeManager,  
        \Magento\Framework\Locale\Resolver $storeLocal,
        \Magento\Cms\Model\Page $paginaCms,
        array $data = []
    )
    {
        $this->_paginasCms = $paginasCms;
        $this->_search = $search;
        $this->_storeManager = $storeManager;
        $this->_storeLocal = $storeLocal;
        $this->_paginaCms = $paginaCms;
        parent::__construct($context, $data);
    }

    public function getPaginaId(){
        /* Captura o ID da pagina CMS atual */
        return $this->_paginaCms->getId();
    }

    public function getInfosPaginas($paginaId = null)
    {
        /* Filtra página CMS por ID ou exibe uma lista com todas elas */
        if($paginaId){
            $searchCriteria = $this->_search->addFilter('page_id', $paginaId)->create();
        } else {
            $searchCriteria = $this->_search->create();
        }
        
        /* Carrega a lista de páginas CMS */
        $paginasCms = $this->_paginasCms->getList($searchCriteria)->getItems();
        $retorno = array();
        foreach($paginasCms as $paginaCms) {

            /* Valida lojas ativas */
            $lojasAtivasIds  = array();
            foreach($paginaCms->getData()['store_id'] as $item){
                if($this->validaLojaAtiva($item)){
                    $lojasAtivasIds[] = $item;
                }
            }

            /* Guarda informações necessárias */
            $retorno[] = [
                'id' => $paginaCms->getId(),
                'url' => $paginaCms->getIdentifier(),
                'label' => $paginaCms->getTitle(),
                'lojasIdsLista' => $lojasAtivasIds
            ];
        }

        /* Retorna array com as informações das lojas ativas */
        return $retorno;
    }

    public function validaLojaAtiva($idLoja = null){
        $lojasLista = $this->_storeManager->getStores();
        $retorno = false;

        /* Valida se a loja informada esta ativa atraves da lista */
        foreach ($lojasLista as $key => $value) {
            if($value['is_active'] == 1 && $idLoja == $key){
                $retorno = true;
            }
        }
        /* Retorna um boolean com o status da pagina CMS */
        return $retorno;
    }

    public function getLojaIdioma(){
        /* Captura o idioma da página atual */
        return strtolower($this->_storeLocal->getLocale());
    }
}
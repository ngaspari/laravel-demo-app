<?php
namespace App\Domain;

abstract class AbstractPaginatedQueryRequest
{
    /**
     * Page number to be displayed eg. 5
     * @var int
     * */
    protected $page;
    
    /**
     * The number of items per page eg. 25
     * @var int
     */
    protected $itemCount;
    
    /**
     * Is the search enabled
     * @var boolean
     */
    protected $searchEnabled;
    
    /**
     * Parameters by which the data are filtered eg. array('groupOp' => 'AND', 'rules' => array('field'=>'plant', 'op'=>'eq', 'data'=>500))
     * @var SearchGroup
     */
    protected $searchParams;
    
    /**
     * Order specifications eg. array(0 => 'plantNr ASC', 1 => 'workCenterCode DESC')
     * @var array
     */
    protected $orderSpecs;
    
    /** @var bool */
    protected $resultShouldBePaginated = true;
    
    /**
     *
     * @param int $page
     * @param int $itemCount
     * @param string $search
     * @param string $filters
     * @param string $sidx
     * @param string $sord
     */
    public function __construct(
        $page,
        $itemCount,
        $search,
        $filters,
        $sidx,
        $sord
    ){
        $this->page = $page;
        $this->itemCount = $itemCount;
        $this->setSearchEnabled($search);
        $this->setSearchParams($filters);
        $this->setOrderSpecs($sidx. ' '.$sord);
        $this->setResultShouldBePaginated( true );        
    }
    
    /**
     *
     * @param bool|string $resultShouldBePaginated
     */
    public function setResultShouldBePaginated($resultShouldBePaginated)
    {
        if (is_string($resultShouldBePaginated) && strtolower($resultShouldBePaginated) === "true"){
            $resultShouldBePaginated = true;
        }elseif (is_string($resultShouldBePaginated) && strtolower($resultShouldBePaginated) === "false"){
            $resultShouldBePaginated = false;
        }else{
            $resultShouldBePaginated = boolval($resultShouldBePaginated);
        }
        $this->resultShouldBePaginated = $resultShouldBePaginated;
    }
    
    /**
     *
     * @param string $searchEnabled
     */
    public function setSearchEnabled($searchEnabled)
    {
        if (is_string($searchEnabled) && strtolower($searchEnabled) === "true"){
            $searchEnabled = true;
        }elseif (is_string($searchEnabled) && strtolower($searchEnabled) === "false"){
            $searchEnabled = false;
        }else{
            $searchEnabled = boolval($searchEnabled);
        }
        $this->searchEnabled = $searchEnabled;
    }
    
    /**
     *
     * @param string $searchParams (JSON encoded string)
     */
    public function setSearchParams( $filters )
    {
        if (empty($filters)) {
            return;
        }
        
        $filters = stripcslashes($filters);
        $searchParams = json_decode( $filters, true );
        
        if (isset($searchParams['rules']) && count($searchParams['rules']) > 0){
            $rules = [];
            foreach ($searchParams['rules'] as $rule){
                $rules[] = new SearchRule($rule['field'], $rule['op'], $rule['data']);
            }
            $this->searchParams = new SearchGroup($searchParams['groupOp'], $rules);
        } else if(isset($searchParams['groups'])){
            $rules = [];
            $this->searchParams = new SearchGroup($searchParams['groupOp'], $rules);
        }
        
        if (isset($searchParams['groups']) && count($searchParams['groups']) > 0)
        {
            foreach($searchParams['groups'] as $group)
            {
                $subRules = [];
                foreach($group['rules'] as $rule)
                {
                    $subRules[] = new SearchRule($rule['field'], $rule['op'], $rule['data']);
                }
                $this->searchParams->addGroup(new SearchGroup($group['groupOp'], $subRules));
            }
        }
    }
    
    
    /**
     * @return int
     */
    public function getPage() {
        return $this->page;
    }
    
    /**
     * @return int
     */
    public function getItemCount() {
        return $this->itemCount;
    }
    
    /**
     * @return boolean
     */
    public function getSearchEnabled() {
        return $this->searchEnabled;
    }
    
    /**
     * @return SearchGroup
     */
    public function getSearchParams() {
        return $this->searchParams;
    }
    
    /**
     *
     * @return array
     */
    public function getOrderSpecs() {
        return $this->orderSpecs;
    }
    
    /**
     * @return boolean
     */
    public function getResultShouldBePaginated() {
        return $this->resultShouldBePaginated;
    }
    
    
    public function setOrderSpecs($combOrder)
    {
        if (empty($combOrder)) {
            return;
        }
        
        $orderSpecsArr = explode(', ', $combOrder);
        $orderSpecs = array();
        foreach($orderSpecsArr as $orderSpecsRow)
        {
            $orderSpecsSplit = explode(' ', $orderSpecsRow);
            $orderSpecs[$orderSpecsSplit[0]] = $orderSpecsSplit[1];
        }
        
        $this->orderSpecs = $orderSpecs;
    }
    
}
<?php
class AmhsoftCollector extends \DebugBar\DataCollector\PDO\PDOCollector
{
    public function __construct()
    {
        parent::__construct();
        $this->addConnection($this->getTraceablePdo(), 'Amhsoft PDO');
    }


    protected function getAmhsoftDatabase() {
        Amhsoft_Database::getInstance();
    }

    /**
     * @return PDO
     */
    protected function getAmhsoftPdo() {
        return $this->getAmhsoftDatabase()->getConnection()->getPdo();
    }

}
?>
<?php
class Village 
{
    private $buildings;
    private $storage;
    private $upgradeCost;

    public function __construct()
    {
        $this->buildings = array(
            'townHall' => 1,
            'woodcutter' => 0,
            'ironMine' => 0,
            'kopalniaKamienia' => 0,
        );
        $this->storage = array(
            'wood' => 50,
            'iron' => 0,
            'kamien' => 0,
        );
        $this->upgradeCost = array( //tablica wszystkich budynkow
            'woodcutter' => array(
                1 => array(
                    'wood' => 50,  //free
                ),
                2 => array(
                    'wood' => 250, // 10min
                ),
                3 => array(
                    'wood' => 1500, // 30min
                    'kamien' => 500, 
                ),
                4 => array(
                    'wood' => 12000, // 2h
                    'kamien' => 250,
                    'iron' => 50,
                ),
                5 => array(
                    'wood' => 100000, //duzo
                    'kamien' => 10000,
                    'iron' => 2000,
                )
            ),
            'kopalniaKamienia' => array(
                1 => array(
                    'wood' => 1000,  // 10min
                ),
                2 => array(
                    'wood' => 3000, // 
                    'kamien' => 1000,
                ),
                3 => array(
                    'wood' => 14000,
                    'kamien' => 700,
                    'iron' => 250,
                ),
                4 => array(
                    'wood' => 40000,
                    'kamien' => 2000,
                    'iron' => 500,
                ),
                5 => array(
                    'wood' => 120000,
                    'kamien' => 10000,
                    'iron' => 2000,
                )
            ),
            'ironMine' => array(
                1 => array(
                    'wood' => 100,
                ),
                2 => array(
                    'wood' => 300,
                    'iron' => 100,
                )
            ),
        );
    }
    private function woodGain(int $deltaTime) : float
    {
        //liczymy zysk na godzine z wzoru poziom_drwala ^ 2
        $gain = $this->buildings['woodcutter']* 2 * 750 ;
        // liczymy zysk na sekunde (godzina/3600)
        $perSecondGain = $gain / 3600;
        //zwracamy zysk w czasie $deltaTime
        return $perSecondGain * $deltaTime;
    }
    private function ironGain(int $deltaTime) : float
    {
        //liczymy zysk na godzine z wzoru poziom_drwala ^ 2
        $gain = $this->buildings['ironMine']*2 * 125;
        // liczymy zysk na sekunde (godzina/3600)
        $perSecondGain = $gain / 3600;
        //zwracamy zysk w czasie $deltaTime
        return $perSecondGain * $deltaTime;
    }
    private function kamienGain(int $deltaTime) : float
    {
        //liczymy zysk na godzine z wzoru poziom_drwala ^ 2
        $gain = $this->buildings['kopalniaKamienia']*2 * 500;
        // liczymy zysk na sekunde (godzina/3600)
        $perSecondGain = $gain / 3600;
        //zwracamy zysk w czasie $deltaTime
        return $perSecondGain * $deltaTime;
    }
    public function gain($deltaTime) 
    {
        $this->storage['wood'] += $this->woodGain($deltaTime);
        $this->storage['iron'] += $this->ironGain($deltaTime);
        $this->storage['kamien'] += $this->kamienGain($deltaTime);
    }
    public function upgradeBuilding(string $buildingName) : bool
    {
        $currentLVL = $this->buildings[$buildingName];
        $cost = $this->upgradeCost[$buildingName][$currentLVL+1];
        foreach ($cost as $key => $value) {
            //key - nazwa surowca
            //value koszt surowca
            if($value > $this->storage[$key])
                return false;
        }
        foreach ($cost as $key => $value) {
            //odejmujemy surowce na budynek
            $this->storage[$key] -= $value;
        }
        //podnies lvl budynku o 1
        $this->buildings[$buildingName] += 1; 
        return true;
    }
    public function showHourGain(string $resource) : string
    {
        switch($resource) {
            case 'wood':
                return $this->woodGain(3600);
            break;
            case 'iron':
                return $this->ironGain(3600);
            break;
            case 'kamien':
                return $this->kamienGain(3600);
            break;
            default:
                echo "Nie ma takiego surowca!";
            break;
        }
    }
    public function showStorage(string $resource) : string 
    {
        if(isset($this->storage[$resource]))
        {
            return floor($this->storage[$resource]);
        }
        else
        {
            return "Nie ma takiego surowca!";
        }
    }
    public function buildingLVL(string $building) : int 
    {
        return $this->buildings[$building];
    }
}
?>
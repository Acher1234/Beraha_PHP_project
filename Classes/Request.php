<?php


class Request
{
    private $ID;
    private $Company_name;
    private $operational_pilots;
    private $Flight_communication;
    private $photographyEquipement;


    private $ENOTF;
    private $COSF;
    private $ArrayStartPoint;
    private $ArrayEndPoint;
    private $Arraytrack_height;
    private $ArrayImage;
    private $dates;
    private $IDclient;
    private $DateStart;
    private $DateEnd;
    private $HourStart;
    private $HourEnd;
    private $TextSup;
    private $hasShmSign;
    private $hasCAAIsign;
    private $haAirforceSign;
    private $DateAirForcesign;
    private $AirForceReason;
    private $AdditionalCommentsAirforce;
    private $Name_and_role;





    static function RemoveOnId($i)
    {
        require_once("config.php");
        $conn = returnAConnexion();
        $query="DELETE FROM request WHERE ID=?";
        $stmt =$conn->prepare($query);
        $stmt->execute([$i]);
    }

    static function getRequestOnId($i):Request
    {
        require_once("config.php");
        $conn = returnAConnexion();
        $query="SELECT * FROM request WHERE ID=?";
        $stmt =$conn->prepare($query);
        $stmt->execute([$i]);
        $result=($stmt->fetchAll())[0];
        $returnVar = new Request();
        $returnVar->setCompanyName($result["Company_Name"]);
        $returnVar->setPhotographyEquipement($result["Photography_Equipement"]);
        $returnVar->setID($result["ID"]);
        $returnVar->setOperationalPilots($result["Operational_Pilot"]);
        $returnVar->setFlightCommunication($result["Flight_Comunication"]);
        $returnVar->setDates($result["Date"]);
        $returnVar->setENOTF($result["ENOTF"]);
        $returnVar->setCOSF($result["COSF"]);
        $returnVar->setArrayEndPoint($result["endPointList"]);
        $returnVar->setArrayImage($result["imagesList"]);
        $returnVar->setArrayStartPoint($result["startPointList"]);
        $returnVar->setArraytrackHeight($result["TrackHeight"]);
        $returnVar->setIDclient($result["CLIENTID"]);
        $returnVar->setHourStart($result["HourStart"]);
        $returnVar->setHourEnd($result["HourEnd"]);
        $returnVar->setDateStart($result["DateStart"]);
        $returnVar->setDateEnd($result["DateEnd"]);
        $returnVar->setTextSup($result["TextSup"]);
        $returnVar->setHaAirforceSign($result["hasAirFSign"]);
        $returnVar->setHasShmSign($result["hasShamgarSign"]);
        $returnVar->setHasCAAIsign($result["hasCAAISign"]);
        $returnVar->setOnTypes($result["OnTypul"]);
        $returnVar->setTexte($result["Heharot"]);
        $returnVar->setDateShmsign($result["DateShmsign"]);
        $returnVar->setDateCAAIsign($result["DateCAAIsign"]);
        $returnVar->setDateAirForcesign($result["DateAirForcesign"]);
        $returnVar->setNameAndRole($result['Name_and_role']);
        $returnVar->setAdditionalCommentsAirforce($result['AdditionalCommentsAirforce']);
        $returnVar->setAirForceReason($result['AirForceReason']);
        return $returnVar;
    }


    public function AddorUpgradeRequest()
    {
        require_once("config.php");
        $conn = returnAConnexion();
        if(isset($this->ID))
        {
            $stm = $conn->prepare("UPDATE request SET Company_Name=? ,Operational_Pilot=?,Flight_Comunication=?,Photography_Equipement=?,`Date`=?,ENOTF=?,COSF=?,startPointList=?,endPointList=?,imagesList=?,TrackHeight=?,HourStart=?,HourEnd=?,DateStart=?,DateEnd=?,TextSup=?,hasAirFSign=?,hasShamgarSign=?,hasCAAISign=?,OnTypul=?,Heharot=?,DateAirForcesign=?,DateCAAIsign=?,DateShmsign=?,AirForceReason=?,Name_and_role=?,AdditionalCommentsAirforce=? WHERE ID=?");
            $bool = $stm->execute([$this->getCompanyName(),$this->getOperationalPilots(),$this->getFlightCommunication(),$this->getPhotographyEquipement(),$this->getDates(),$this->getENOTF(),$this->getCOSF(),implode("?",$this->getArrayStartPoint()),implode("?",$this->getArrayEndPoint()),implode("?",$this->getArrayImage()),implode("?",$this->getArraytrackHeight()),$this->getHourStart(),$this->getHourEnd(),$this->getDateStart(),
            $this->getDateEnd(),$this->getTextSup(),$this->getHaAirforceSign(),$this->getHasShmSign(),$this->getHasCAAIsign(),$this->getOnTypes(),$this->getTexte(),$this->getDateAirForcesign(),$this->getDateCAAIsign(),$this->getDateShmsign(),$this->getAirForceReason(),$this->getNameAndRole(),$this->getAdditionalCommentsAirforce(),$this->ID]);
            print_r($stm->errorInfo());
            return $bool ? true : false;
        }
        else
        {
            $stm = $conn->prepare("INSERT INTO request ( Company_Name, Operational_Pilot, Flight_Comunication,Photography_Equipement, `Date`, ENOTF, COSF, startPointList, endPointList, imagesList, TrackHeight,CLIENTID,HourStart,HourEnd,DateStart,DateEnd,TextSup) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $Array = [$this->getCompanyName(),$this->getOperationalPilots(),$this->getFlightCommunication(),$this->getPhotographyEquipement(),$this->getDates(),$this->getENOTF(),$this->getCOSF(),implode("?",$this->getArrayStartPoint()),implode("?",$this->getArrayEndPoint()),implode("?",$this->getArrayImage()),implode("?",$this->getArraytrackHeight()),intval($this->getIDclient()),$this->getHourStart(),$this->getHourEnd(),$this->getDateStart(),$this->getDateEnd(),$this->getTextSup()];
            $bool = $stm->execute($Array);
            print_r($stm->errorInfo());
            return $bool ? true : false;
        }
    }
    public function UpgradeRequest()
    {

    }
    public function UpgradeRequest()
    {
        require_once("config.php");
        $conn = returnAConnexion();
        $stm = $conn->prepare("UPDATE request SET `Date`=?,hasAirFSign=?,hasShamgarSign=?,hasCAAISign=?,OnTypul=?,Heharot=?,DateAirForcesign=?,DateCAAIsign=?,DateShmsign=?,Name_and_role=?,AdditionalCommentsAirforce=? WHERE ID=?");
        $bool = $stm->execute([$this->getCompanyName(),$this->getOperationalPilots(),$this->getFlightCommunication(),$this->getPhotographyEquipement(),$this->getDates(),$this->getENOTF(),$this->getCOSF(),implode("?",$this->getArrayStartPoint()),implode("?",$this->getArrayEndPoint()),implode("?",$this->getArrayImage()),implode("?",$this->getArraytrackHeight()),$this->getHourStart(),$this->getHourEnd(),$this->getDateStart(),
            $this->getDateEnd(),$this->getTextSup(),$this->getHaAirforceSign(),$this->getHasShmSign(),$this->getHasCAAIsign(),$this->getOnTypes(),$this->getTexte(),$this->getDateAirForcesign(),$this->getDateCAAIsign(),$this->getDateShmsign(),$this->getAirForceReason(),$this->getNameAndRole(),$this->getAdditionalCommentsAirforce(),$this->ID]);
        print_r($stm->errorInfo());
    }
    public function UpgradeData()
    {
        Company_Name=? ,Operational_Pilot=?,Flight_Comunication=?,Photography_Equipement=?,ENOTF=?,COSF=?HourStart=?,HourEnd=?,DateStart=?,DateEnd=?,TextSup=?,Heharot=?,AirForceReason=?,AdditionalCommentsAirforce=?
    }
    public function UpgradetrackHeight()
    {
        startPointList=?,endPointList=?,imagesList=?,TrackHeight=?
    }

    /**
     * @return mixed
     */
    public function getAirForceReason()
    {
        return $this->AirForceReason;
    }

    /**
     * @param mixed $AirForceReason
     */
    public function setAirForceReason($AirForceReason)
    {
        $this->AirForceReason = $AirForceReason;
    }

    /**
     * @return mixed
     */
    public function getOnTypes()
    {
        return $this->OnTypes;
    }

    /**
     * @param mixed $OnTypes
     */
    public function setOnTypes($OnTypes)
    {
        $this->OnTypes = $OnTypes;
    }

    /**
     * @return mixed
     */
    public function getDateAirForcesign()
    {
        return $this->DateAirForcesign;
    }

    /**
     * @return mixed
     */
    public function getNameAndRole()
    {
        return $this->Name_and_role;
    }

    /**
     * @param mixed $Name_and_role
     */
    public function setNameAndRole($Name_and_role)
    {
        $this->Name_and_role = $Name_and_role;
    }

    /**
     * @return mixed
     */
    public function getAdditionalCommentsAirforce()
    {
        return $this->AdditionalCommentsAirforce;
    }

    /**
     * @param mixed $AdditionalCommentsAirforce
     */
    public function setAdditionalCommentsAirforce($AdditionalCommentsAirforce)
    {
        $this->AdditionalCommentsAirforce = $AdditionalCommentsAirforce;
    }

    /**
     * @param mixed $DateAirForcesign
     */
    public function setDateAirForcesign($DateAirForcesign)
    {
        $this->DateAirForcesign = $DateAirForcesign;
    }

    /**
     * @return mixed
     */
    public function getDateCAAIsign()
    {
        return $this->DateCAAIsign;
    }

    /**
     * @param mixed $DateCAAIsign
     */
    public function setDateCAAIsign($DateCAAIsign)
    {
        $this->DateCAAIsign = $DateCAAIsign;
    }

    /**
     * @return mixed
     */
    public function getDateShmsign()
    {
        return $this->DateShmsign;
    }

    /**
     * @param mixed $DateShmsign
     */
    public function setDateShmsign($DateShmsign)
    {
        $this->DateShmsign = $DateShmsign;
    }
    private $DateCAAIsign;
    private $DateShmsign;

    private $OnTypes;
    private $Texte;

    /**
     * @return mixed
     */
    public function getTexte()
    {
        return $this->Texte;
    }

    /**
     * @param mixed $Texte
     */
    public function setTexte($Texte)
    {
        $this->Texte = $Texte;
    }

    /**
     * @return mixed
     */
    public function getHasShmSign()
    {
        return $this->hasShmSign;
    }

    /**
     * @param mixed $hasShmSign
     */
    public function setHasShmSign($hasShmSign)
    {
        $this->hasShmSign = $hasShmSign;
    }

    /**
     * @return mixed
     */
    public function getPhotographyEquipement()
    {
        return $this->photographyEquipement;
    }

    /**
     * @param mixed $photographyEquipement
     */
    public function setPhotographyEquipement($photographyEquipement)
    {
        $this->photographyEquipement = $photographyEquipement;
    }

    /**
     * @return mixed
     */
    public function getHasCAAIsign()
    {
        return $this->hasCAAIsign;
    }

    /**
     * @param mixed $hasCAAIsign
     */
    public function setHasCAAIsign($hasCAAIsign)
    {
        $this->hasCAAIsign = $hasCAAIsign;
    }

    /**
     * @return mixed
     */
    public function getHaAirforceSign()
    {
        return $this->haAirforceSign;
    }

    /**
     * @param mixed $haAirforceSign
     */
    public function setHaAirforceSign($haAirforceSign)
    {
        $this->haAirforceSign = $haAirforceSign;
    }


    /**
     * @return mixed
     */
    public function getDates()
    {
        return $this->dates;
    }

    /**
     * @param mixed $dates
     */
    public function setDates($dates)
    {
        $this->dates = $dates;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }


    /**
     * Request constructor.
     * @param $Company_name
     */
    public function __construct()
    {
        $this->ArrayEndPoint = [];
        $this->Arraytrack_height = [];
        $this->ArrayStartPoint = [];
        $this->ArrayImage = [];
    }
    /**
     * @return mixed
     */
    public function getTextSup()
    {
        return $this->TextSup;
    }

    /**
     * @param mixed $TextSup
     */
    public function setTextSup($TextSup)
    {
        $this->TextSup = $TextSup;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->DateStart;
    }

    /**
     * @param mixed $DateStart
     */
    public function setDateStart($DateStart)
    {
        $this->DateStart = $DateStart;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->DateEnd;
    }

    /**
     * @param mixed $DateEnd
     */
    public function setDateEnd($DateEnd)
    {
        $this->DateEnd = $DateEnd;
    }

    /**
     * @return mixed
     */
    public function getHourStart()
    {
        return $this->HourStart;
    }

    /**
     * @param mixed $HourStart
     */
    public function setHourStart($HourStart)
    {
        $this->HourStart = $HourStart;
    }

    /**
     * @return mixed
     */
    public function getHourEnd()
    {
        return $this->HourEnd;
    }

    /**
     * @param mixed $HourEnd
     */
    public function setHourEnd($HourEnd)
    {
        $this->HourEnd = $HourEnd;
    }

    /**
     * @return mixed
     */
    public function getIDclient()
    {
        return $this->IDclient;
    }

    /**
     * @param mixed $IDclient
     */
    public function setIDclient($IDclient)
    {
        $this->IDclient = $IDclient;
    }
    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->Company_name;
    }

    /**
     * @param mixed $Company_name
     */
    public function setCompanyName($Company_name)
    {
        $this->Company_name = $Company_name;
    }

    /**
     * @return mixed
     */
    public function getOperationalPilots()
    {
        return $this->operational_pilots;
    }

    /**
     * @param mixed $operational_pilots
     */
    public function setOperationalPilots($operational_pilots)
    {
        $this->operational_pilots = $operational_pilots;
    }

    /**
     * @return mixed
     */
    public function getFlightCommunication()
    {
        return $this->Flight_communication;
    }

    /**
     * @param mixed $Flight_communication
     */
    public function setFlightCommunication($Flight_communication)
    {
        $this->Flight_communication = $Flight_communication;
    }

    /**
     * @return mixed
     */
    public function getENOTF()
    {
        return $this->ENOTF;
    }

    /**
     * @param mixed $ENOTF
     */
    public function setENOTF($ENOTF)
    {
        $this->ENOTF = $ENOTF;
    }

    /**
     * @return mixed
     */
    public function getCOSF()
    {
        return $this->COSF;
    }

    /**
     * @param mixed $COSF
     */
    public function setCOSF($COSF)
    {
        $this->COSF = $COSF;
    }

    /**
     * @return array
     */
    public function getArrayStartPoint(): array
    {
        return $this->ArrayStartPoint;
    }

    /**
     * @param array $ArrayStartPoint
     */
    public function addArrayStartPoint($ArrayStartPoint)
    {
        array_push($this->ArrayStartPoint,$ArrayStartPoint);
    }
    /**
     * @param array $ArrayStartPoint
     */
    public function setArrayStartPoint($ArrayStartPoint)
    {
        $this->ArrayStartPoint = explode('?',$ArrayStartPoint);
    }

    /**
     * @return array
     */
    public function getArrayEndPoint(): array
    {
        return $this->ArrayEndPoint;
    }

    /**
     * @param array $ArrayEndPoint
     */
    public function addArrayEndPoint( $ArrayEndPoint)
    {
        array_push($this->ArrayEndPoint,$ArrayEndPoint);
    }
    /**
     * @param array $ArrayStartPoint
     */
    public function setArrayEndPoint($ArrayStartPoint)
    {
        $this->ArrayEndPoint = explode('?',$ArrayStartPoint);
    }


    /**
     * @return array
     */
    public function getArraytrackHeight(): array
    {
        return $this->Arraytrack_height;
    }

    /**
     * @param array $Arraytrack_height
     */
    public function addArraytrackHeight( $Arraytrack_height)
    {
        array_push($this->Arraytrack_height,$Arraytrack_height);
    }

    public function setArraytrackHeight($Arraytrack_height)
    {
        $this->Arraytrack_height = explode('?',$Arraytrack_height);
    }

    /**
     * @return array
     */
    public function getArrayImage(): array
    {
        return $this->ArrayImage;
    }

    /**
     * @param array $ArrayImage
     */
    public function addArrayImage($ArrayImage)
    {
        array_push($this->ArrayImage,$ArrayImage);
    }

    public function setArrayImage($ArrayImage)
    {
        $this->ArrayImage = explode('?',$ArrayImage);
    }


}
<?php
	class AtelierConstruct{
		protected $idatelier;
	        protected $nomAtelier;
	        protected $dateAtelier;
	        protected $description;
	        
	       
		protected function __construct($map=array()){
			$this->idatelier = $map['idatelier'];
			$this->nomAtelier = $map['nomAtelier'];
			$this->dateAtelier = $map['dateAtelier'];
			$this->description = $map['description'];
			
					
		}
		
		static public function initialize($data=array()) {
		      $map = array();
		      if (isset($data['idatelier'])) {
		    $map['idatelier'] = $data['idatelier'];
		      } else {
		    $map['idatelier'] = '';
		      }
		      if (isset($data['nomAtelier'])) {
		    $map['nomAtelier'] = $data['nomAtelier'];
		      } else {
		    $map['nomAtelier'] = '';
		      }
		      if (isset($data['dateAtelier'])) {
		    $map['dateAtelier'] = $data['dateAtelier'];
		      } else {
		    $map['dateAtelier'] = '';
		      }
		      if (isset($data['description'])) {
		    $map['description'] = $data['description'];
		      } else {
		    $map['description'] = '';
		      }
		      
		        
		      return new self($map);
               }
		
	 	public function update($data) {
    /* titre pr�sent dans $data ? */
    if (isset($data['nomAtelier'])) {
      $this->setNomAtelier($data['nomAtelier']);
    }

    /* dateAtelier pr�sent dans $data ? */
    if (isset($data['dateAtelier'])) {
      $this->dateAtelier($data['dateAtelier']);
    } 

       if (isset($data['description'])) {
      $this->setDescription($data['description']);
    } 
  } 
		 public function getId() { return $this->idatelier; }


		 
		  public function getNomAtelier() { return $this->nomAtelier; }


		
		  public function getDateAtelier() { return $this->dateAtelier; }


		
		  public function getDescription() { return $this->description; }


		

		public function setId($idatelier) { 
		    $this->idatelier = $idatelier; 
		  }

		  public function setNomAtelier($nomAtelier) { 
		    $this->nomAtelier = $nomAtelier;
		  }

		  public function setDateAtelier($dateAtelier) { 
		    $this->dateAtelier = $dateAtelier; 
		  }

		  public function setDescription($description) { 
		    $this->description = $description;
		  }

		 
    	
	}




?>

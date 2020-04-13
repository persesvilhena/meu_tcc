<?php
$dj = '{
      "name": "Principal",
      "children": [
        {
          "name": "dashboard",
          "children": [
            {
              "name": "app.js",
              "size": 126,
              "language": "Javascript"
            }
          ],
          "size": 5840
        },
        {
          "name": "api",
          "children": [
            {
              "name": "app.js",
              "size": 59,
              "language": "Javascript"
            }
          ],
          "size": 286
        }
      ],
      "size": 6126
    }';


    //var_dump(json_decode($dj));
    $elementos = array();
    foreach ($regras as $i => $n) {
    	$ele_se = "";
    	$ele_entao = "";
    	foreach ($n->se_s as $j => $m) {
    		$ele_se .= $m;
    	}
    	if(!isset($elementos[$ele_se])){
    		$elementos[$ele_se] = (int)$n->se_qtde;
		}else{
			$elementos[$ele_se] = (int)($elementos[$ele_se] + $n->se_qtde);
		}

    	foreach ($n->entao_s as $j => $m) {
    		$ele_entao .= $m;
    	}
    	if(!isset($elementos[$ele_entao])){
			$elementos[$ele_entao] = (int)$n->entao_qtde;
		}else{
			$elementos[$ele_entao] = (int)($elementos[$ele_entao] + $n->entao_qtde);
		}
    }
    //var_dump($elementos);

    $relacao = array();
    foreach ($regras as $i => $n) {
    	//$temp = array();
        

        $ele_se = "";
        $ele_entao = "";
        foreach ($n->se_s as $j => $m) {
            $ele_se .= $m;
        }
        foreach ($n->entao_s as $j => $m) {
            $ele_entao .= $m;
        }
        $obj_filho = new StdClass;
        $obj_filho->name = $ele_entao;
        $obj_filho->size = (int)$elementos[$ele_entao];
        $obj_filho->language = "PHP";


        $obj = new StdClass;
        $obj->name = $ele_se;
        $obj->children = array($obj_filho);
        $obj->size = (int)$elementos[$ele_se];

        array_push($relacao, $obj);


    }

    $obj = new StdClass;
    $obj->name = "Principal";
    $obj->children = $relacao;
    $obj->size = (int)10000;

    $res = json_encode($obj);
    //var_dump($obj);

    echo $res;
    ?>
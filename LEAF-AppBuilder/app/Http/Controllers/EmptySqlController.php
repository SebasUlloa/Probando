<?php
public function prueba($machineID,$firstActuators,$seccion,$product,$indice)
{
            $botsurco = array();
            
            //Actuator_sections `actuatorsectionsid``productsId``actuatorsId``sectionNumber`
            DB::table('actuator_sections')->insert([
            'actuatorsectionsid' => $lastactuartorsectionId,
            'productsId' => $product,
            'actuatorsId' => $firstActuators,
            'sectionNumber' => $i,
            'machineId' => $machineID
            ]);

            $lastactuartorsectionId++;
            $ho = 22;
            for($a=1;$a<=$rowslimit;$a++){
                // Checkbox surco		SURCO-1-2
                $vas         = 2;
                //$vamos       = $_POST['SURCO'.$indice.$a];
                $surcoCheck2 = $request->input('SURCO-'.$indice.'-'.$a);
                dd($surcoCheck2);
                $testasd[$i] = 'pro2';
                if($surcoCheck2){
                    $botsurco[$a] =  $a;
                    
                    //`actuators_rows` WHERE `actuatorsrowsId``actuatorId``rowId`
                    DB::table('actuators_rows')->insert([
                        'actuatorsrowsId' => $lastactuartorrowId,
                        'actuatorId' => $firstActuators,
                        'rowId' => $a
                        ]);
                    //`sections_rows` `sectionrowsid``productsId``sectionNumber``rowId`
                    DB::table('sections_rows')->insert([
                        'sectionrowsid' => $lastsectionrowId,
                        'productsId' => $prod2,
                        'sectionNumber' => $s,
                        'rowId' => $a
                        ]);

                    $lastactuartorrowId ++;
                    $lastsectionrowId ++;
                }else{
                    $botsurco[$a] =  null;
                }
            }
            $indice = $indice + 1;
        }
    }
    $indice = 0;
}

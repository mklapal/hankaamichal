<?php

if (file_exists('./content/svatebnidary.json'))
  {
  $data = json_decode(file_get_contents('./content/svatebnidary.json'), true);
}  else {
  $data = null;
}

unset($output);

foreach ($data["data"] as $key) {

    $output .= ('
    <div class="box">
        <div class="front '.$key['pict'].'"></div>
        <div class="back">
            <div class="wrapper">
                <h3>'.$key['nazev'].'</h3>
                <p>'.$key['popis'].'</p>
                <div class="cena">'.$key['cena'].'</div>
                <div class="rezervace js-darovat">
                ');
                if ($key['status'] === "0"){
                    $output .= ('Rezervovat');
                } else {
                    $output .= ('Zamluveno');
                }
                $output .=('
                </div>

            </div>
        </div>

        ');
        
        if ($key['url'] <> "") {
            $output .= ('
            <div class="url">
                <div class="wrapper"><a href="http://'.$key['url'].'" target="_blank">koupíte zde >> </a></div>
            </div>
            ');
        }

    $output .= ('
    </div>
    ');

    if ($key['status'] === "0"){
    $output .= ('

    <div class="popup">
        <div>
        
        <p class="js-form">
        Pro rezervaci daru prosim vyplnte Vasi emailovou adresu:
        <input class="js-dar" type="hidden" name="dar" value="'.$key['id'].'">
        <input class="js-input" name="email" type="email" placeholder="Vase emailova adresa">
        <input type="submit" class="js-submit" value="Zarezervovat">
        </p>

        <p class="js-hint">
        Vyplnte prosim Vas email!
        </p>

        <p class="js-loading">
        Odesilam...
        </p>        

        <p class="js-confirm">
        Dekujeme za rezervaci daru. Email s potvrzenim byl odeslan na Vasi adresu.
        </p>

        <p class="js-error">
        Nastala chyba pri rezervaci. Prosim obnovte stranku a zkuste dar zarezervovat znovu. Pokud problemy pretrvavaji, kontaktujte nas!
        </p>

        </div>
    </div>
    ');
    
    } else {
    
    $output .=('
    <div class="popup">
        <div>
        Tento dar je se jiz rozhodl nekdo darovat. Prosim vyberte si jiny z nabidky!
        </div>
    </div>
    ');
    }
    
}

?>
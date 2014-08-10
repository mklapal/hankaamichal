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
                <div class="rezervace js-darovat js-dar-'.$key['id'].'">
                ');
                if ($key['status'] === "0"){
                    $output .= ('Rezervovat');
                } elseif ($key['status'] === "1") {
                    $output .= ('Zamluveno');
                } else {
                    $output .= $key['status'];
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
        
        <p class="js-form form">
        Pro rezervaci daru prosím vyplňte Vaši emailovou adresu:
        <input class="js-dar" type="hidden" name="dar" value="'.$key['id'].'">
        <input class="js-input email" name="email" type="email" placeholder="Vaše emailová adresa">
        <input type="submit" class="submit js-submit" value="Zarezervovat">
        </p>

        <p class="js-hint">
        Vyplňte prosím Váš email!
        </p>

        <p class="js-loading">
        Odesilam...
        </p>        

        <p class="js-confirm">
        Děkujeme za rezervaci daru. Email s potvrzením byl odeslán na Vaši adresu.
        </p>

        <p class="js-error">
        Nastala chyba při rezervaci. Prosím obnovte stránku a zkuste dar zarezervovat znovu. Pokud problémy přetrvávají, kontaktujte nás!
        </p>

        </div>
    </div>
    ');
    
    } else {
    
    $output .=('
    <div class="popup">
        <div>
        Tento dar je se již rozhodl někdo darovat. Prosím vyberte si jiný z nabídky!
        </div>
    </div>
    ');
    }
    
}

?>
<?php 
    require __DIR__."/vendor/autoload.php";
    
    use src\Support\Email;

    $email =new Email();

    $email->add (
        "Olá estou testando envio e disparo de emails",
        "<h1>Estou testando espero que funcione</h1>",
        "Jefferson",
        "jrsottodev@gmail.com"
    ) ->send();
    //se estiver tudo certo
    if (!$email->error()) 
    {
        var_dump(true);
    } 
    else 
    {
        echo $email->error()->getMessage();
    }

?>
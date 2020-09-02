<?php
    namespace src\Support;

    class Emails
    {
        /** @var PHPMailer */
        private $email; // vai conter a classe mailer encapsulada

        /** @var stdClass */
        private $data; 

        /** @var stdException */
        private $error;


    // aqui no construtor faremos toda a configuração da nossa abstração e preparamos o objeto.

        public function __construct()
        {
            $this->mail = new PHPMailer("true");
            $this->data = new stdClass;

            $this->mail->isSMTP();
            $this->mail->isHTML();
            $this->mail->setLanguage("br");

            //config modo de envio
            $this->mail->SMTPAuth = true;
            $this->mail->SMTPSecure = "tls";
            $this->mail->Charset = "UTF-8";

            //agora vamos autenticar, buscando os dados que ja configurei no arquivo de autoload este é o encapsulamento
            $this->mail->Host = MAIL["host"];
            $this->mail->Port = MAIL["port"];
            $this->mail->Username = MAIL["username"];
            $this->mail->Password = MAIL["password"];   
        }

        //configurando o corpo da mensagem para montar o email a ser enviado e tambem compor o metodo para enviar este email
        //veja que passamos varios parametros na function
        //veja que montamos os dados para disparos e guardamos estes dados para o disparo
        public function add(string $subject, string $body, string $recipient_name, string $recipient_email) : Email
        {
            $this->data->subject = $subject;
            $this->data->body = $body;
            $this->data->recipient_name = $recipient_name;
            $this->data->recipient_email = $recipient_email;

            //retornando o proprio objeto
            return $this;
        }

            //este proximo metodos podemos anexar arquivos
            //não é padrão mais temos que preparar e saber a quantidade de anexos que este email vai pode enviar  então montamos isso nestye metodo tambem
            //veja que foi criado um ARRAY que recebe outro ARRAY para podermosd anexar varios arquivos (seria interessante limitar?)
            public function anexos(string $filepath, string $filename) : Email
            {
                $this->data->anexos[$filepath] = $filename;
                return $this;
            }

            //fazer o disparo do email com 2 parametros configurados
            public function send(string $from_name = MAIL["from_name"], string $from_email = MAIL["from_email"]) : boolean
            {
                try 
                {
                    //se ele encontrar um erro ele joga pro catch
                    $this->mail->Subject = $this->data->subject;
                    $this->mail->msgHTML($this->data->body);
                    $this->mail->addAddress($this->data->recipient_email, $this->data->recipient_name);
                    //quem vai estar disparando esta mensagem
                    $this->mail->setFrom($from_name, $from_email);

                    //verificar se existe anexos 
                    // o foreach porque sao mais de um anexo
                    if(!empty($this->data->anexos))
                    {
                        foreach ($this->data->anexos as $path => $name) 
                        {
                            $this->mail->addAnexos($path, $name);
                        }
                    }

                    //vamos de fato disparar o email
                    $this->mail->send();
                    return true;

                }
                catch(Exception $exception)
                {
                    $this->error = $exception;
                    return false;
                }
            }

            //para mostrar o erro caso ele existir
            public function error() : ?Exception 
            {
                return $this->error;
            }
    }

?>
<?

namespace Carro;

class AdminPage implements \Interfaces\Controler{

    public function get($get,$post,&$session){
        $teAdminPage = new \Library\TemplateEngine("../templates/adminPage.template");
        $teAdminPage->addVariable("bienvenida","Bienvenido Administrador");
        $teAdminPage->addVariable("cabecera","Pagina Secreta");

        return $teAdminPage->render();
    }

    public function post($get,$post,&$session){
        if(empty($session["color"])){
            $session["color"] = $post["color"];
        }else{
            $session["color"] = $post["color"];
        }

        header("Location: index.php?page=adminPage");

        return "";
    }

}